<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\CoreValue;
use App\Models\Course;
use App\Models\Invoice;
use App\Models\Mou;
use App\Models\News;
use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Setting;
use App\Models\VisitorLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();
        $partners = Partner::orderBy('sort_order', 'asc')->get();
        $coreValues = CoreValue::orderBy('sort_order', 'asc')->get();
        $services = Service::orderBy('sort_order', 'asc')->get();
        $portfolios = Portfolio::orderBy('sort_order', 'asc')->get();
        $news = News::orderBy('published_at', 'desc')->orderBy('sort_order', 'asc')->get();
        $courses = Course::withCount('modules')->orderBy('created_at', 'desc')->get();
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        $mous = Mou::orderBy('created_at', 'desc')->get();
        $invoices = Invoice::orderBy('created_at', 'desc')->get();

        // --- Visitor Logs & SEO/GEO Analytics Engine (10-minute Cached) ---
        $analytics = Cache::remember('dashboard_analytics_v2', 600, function () {
            $totalPageviews = VisitorLog::where('created_at', '>=', now()->subDays(30))->count();
            $uniqueVisitors = VisitorLog::where('created_at', '>=', now()->subDays(30))
                ->distinct('ip_hash')
                ->count('ip_hash');

            $topPages = VisitorLog::select('uri', DB::raw('count(*) as views'))
                ->where('created_at', '>=', now()->subDays(30))
                ->groupBy('uri')
                ->orderBy('views', 'desc')
                ->limit(5)
                ->get();

            $referrers = VisitorLog::select('referer', DB::raw('count(*) as count'))
                ->where('created_at', '>=', now()->subDays(30))
                ->groupBy('referer')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get();

            $devices = VisitorLog::select('device', DB::raw('count(*) as count'))
                ->where('created_at', '>=', now()->subDays(30))
                ->groupBy('device')
                ->get();

            $browsers = VisitorLog::select('browser', DB::raw('count(*) as count'))
                ->where('created_at', '>=', now()->subDays(30))
                ->groupBy('browser')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get();

            $aiBotsCount = VisitorLog::whereIn('browser', ['Google Gemini Bot', 'ChatGPT Bot'])
                ->where('created_at', '>=', now()->subDays(30))
                ->count();

            return compact('totalPageviews', 'uniqueVisitors', 'topPages', 'referrers', 'devices', 'browsers', 'aiBotsCount');
        });

        $totalPageviews = $analytics['totalPageviews'];
        $uniqueVisitors = $analytics['uniqueVisitors'];
        $topPages = $analytics['topPages'];
        $referrers = $analytics['referrers'];
        $devices = $analytics['devices'];
        $browsers = $analytics['browsers'];
        $aiBotsCount = $analytics['aiBotsCount'];

        // Calculate dynamic SEO/GEO health score (out of 100)
        $seoScore = 40; // Base score
        if (isset($settings['logo_path'])) {
            $seoScore += 15;
        }
        if (isset($settings['favicon_path'])) {
            $seoScore += 15;
        }
        if (isset($settings['meta_description'])) {
            $seoScore += 15;
        }
        if ($aiBotsCount > 0) {
            $seoScore += 15;
        }

        return view('admin.dashboard', compact(
            'settings', 'partners', 'coreValues', 'services', 'portfolios', 'news', 'courses', 'contacts', 'mous', 'invoices',
            'totalPageviews', 'uniqueVisitors', 'topPages', 'referrers', 'devices', 'browsers', 'aiBotsCount', 'seoScore'
        ));
    }

    // --- SETTINGS ---
    public function updateSettings(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|mimes:png,ico,jpg,jpeg,svg|max:1024',
        ]);

        $data = $request->except('_token', 'logo', 'favicon');

        // Handle corporate logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'logo_path'], ['value' => asset('storage/'.$logoPath)]);
        }

        // Handle website favicon upload
        if ($request->hasFile('favicon')) {
            $faviconPath = $request->file('favicon')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'favicon_path'], ['value' => asset('storage/'.$faviconPath)]);
        }

        // Handle other settings keys
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->to(route('admin.dashboard').'#settings')->with('success', 'Pengaturan situs berhasil diperbarui!');
    }

    // --- PARTNERS ---
    public function storePartner(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'svg_icon' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'logo_url' => 'nullable|string|max:500',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->only('name', 'svg_icon', 'sort_order');

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('partners', 'public');
            $data['logo_path'] = asset('storage/'.$path);
        } elseif ($request->filled('logo_url')) {
            $data['logo_path'] = $request->logo_url;
        }

        Partner::create($data);

        return redirect()->to(route('admin.dashboard').'#partners')->with('success', 'Partner berhasil ditambahkan!');
    }

    public function updatePartner(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'svg_icon' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'logo_url' => 'nullable|string|max:500',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->only('name', 'svg_icon', 'sort_order');

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('partners', 'public');
            $data['logo_path'] = asset('storage/'.$path);
        } elseif ($request->filled('logo_url')) {
            $data['logo_path'] = $request->logo_url;
        }

        $partner->update($data);

        return redirect()->to(route('admin.dashboard').'#partners')->with('success', 'Partner berhasil diperbarui!');
    }

    public function destroyPartner(Partner $partner)
    {
        $partner->delete();

        return redirect()->to(route('admin.dashboard').'#partners')->with('success', 'Partner berhasil dihapus!');
    }

    // --- CORE VALUES ---
    public function updateCoreValue(Request $request, CoreValue $coreValue)
    {
        $request->validate([
            'letter' => 'required|string|max:10',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'required|integer',
        ]);

        $coreValue->update($request->only('letter', 'title', 'description', 'sort_order'));

        return redirect()->to(route('admin.dashboard').'#core-values')->with('success', 'Nilai Inti (Core Value) berhasil diperbarui!');
    }

    // --- SERVICES ---
    public function storeService(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'svg_icon' => 'nullable|string',
            'badge' => 'nullable|string|max:50',
            'link' => 'nullable|string|max:255',
            'is_highlighted' => 'boolean',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->only('title', 'description', 'svg_icon', 'badge', 'link', 'sort_order');
        $data['is_highlighted'] = $request->has('is_highlighted');

        Service::create($data);

        return redirect()->to(route('admin.dashboard').'#services')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function updateService(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'svg_icon' => 'nullable|string',
            'badge' => 'nullable|string|max:50',
            'link' => 'nullable|string|max:255',
            'is_highlighted' => 'boolean',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->only('title', 'description', 'svg_icon', 'badge', 'link', 'sort_order');
        $data['is_highlighted'] = $request->has('is_highlighted');

        $service->update($data);

        return redirect()->to(route('admin.dashboard').'#services')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroyService(Service $service)
    {
        $service->delete();

        return redirect()->to(route('admin.dashboard').'#services')->with('success', 'Layanan berhasil dihapus!');
    }

    // --- PORTFOLIOS ---
    public function storePortfolio(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->only('category', 'title', 'description', 'link', 'sort_order');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('portfolios', 'public');
            $data['image_path'] = asset('storage/'.$path);
        } elseif ($request->filled('image_url')) {
            $data['image_path'] = $request->image_url;
        }

        Portfolio::create($data);

        return redirect()->to(route('admin.dashboard').'#portfolios')->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function updatePortfolio(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->only('category', 'title', 'description', 'link', 'sort_order');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('portfolios', 'public');
            $data['image_path'] = asset('storage/'.$path);
        } elseif ($request->filled('image_url')) {
            $data['image_path'] = $request->image_url;
        }

        $portfolio->update($data);

        return redirect()->to(route('admin.dashboard').'#portfolios')->with('success', 'Portofolio berhasil diperbarui!');
    }

    public function destroyPortfolio(Portfolio $portfolio)
    {
        $portfolio->delete();

        return redirect()->to(route('admin.dashboard').'#portfolios')->with('success', 'Portofolio berhasil dihapus!');
    }

    // --- NEWS ---
    public function storeNews(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string|max:255',
            'published_at' => 'required|date',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->only('category', 'title', 'description', 'published_at', 'link', 'sort_order');
        $data['slug'] = News::generateUniqueSlug($data['title']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $data['image_path'] = $path;
        } elseif ($request->filled('image_url')) {
            $data['image_path'] = $request->image_url;
        }

        News::create($data);

        return redirect()->to(route('admin.dashboard').'#news')->with('success', 'Artikel Berita berhasil ditambahkan!');
    }

    public function updateNews(Request $request, News $news)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string|max:255',
            'published_at' => 'required|date',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->only('category', 'title', 'description', 'published_at', 'link', 'sort_order');
        // Regenerate slug only if the title changed
        if ($data['title'] !== $news->title) {
            $data['slug'] = News::generateUniqueSlug($data['title'], $news->id);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $data['image_path'] = $path;
        } elseif ($request->filled('image_url')) {
            $data['image_path'] = $request->image_url;
        }

        $news->update($data);

        return redirect()->to(route('admin.dashboard').'#news')->with('success', 'Artikel Berita berhasil diperbarui!');
    }

    public function destroyNews(News $news)
    {
        $news->delete();

        return redirect()->to(route('admin.dashboard').'#news')->with('success', 'Artikel Berita berhasil dihapus!');
    }

    // --- INQUIRIES ---
    public function destroyContact(Contact $contact)
    {
        $contact->delete();

        return redirect()->to(route('admin.dashboard').'#inquiries')->with('success', 'Pesan inquiry berhasil dihapus!');
    }
}
