<?php

namespace App\Http\Controllers;

use App\Models\CoreValue;
use App\Models\News;
use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();
        $partners = Partner::orderBy('sort_order', 'asc')->get();
        $coreValues = CoreValue::orderBy('sort_order', 'asc')->get();
        $services = Service::orderBy('sort_order', 'asc')->get();
        $portfolios = Portfolio::orderBy('sort_order', 'asc')->get();
        $news = News::orderBy('published_at', 'desc')->orderBy('sort_order', 'asc')->get();

        return view('welcome', compact('settings', 'partners', 'coreValues', 'services', 'portfolios', 'news'));
    }

    public function about()
    {
        $settings = Setting::pluck('value', 'key')->all();
        $partners = Partner::orderBy('sort_order', 'asc')->get();
        $coreValues = CoreValue::orderBy('sort_order', 'asc')->get();

        return view('about', compact('settings', 'partners', 'coreValues'));
    }

    public function services()
    {
        $settings = Setting::pluck('value', 'key')->all();
        $services = Service::orderBy('sort_order', 'asc')->get();

        return view('services', compact('settings', 'services'));
    }

    public function portfolio()
    {
        $settings = Setting::pluck('value', 'key')->all();
        $portfolios = Portfolio::orderBy('sort_order', 'asc')->get();

        return view('portfolio', compact('settings', 'portfolios'));
    }

    public function news()
    {
        $settings = Setting::pluck('value', 'key')->all();
        $news = News::orderBy('published_at', 'desc')->orderBy('sort_order', 'asc')->get();

        // 1. Basic Metadata Preparation
        $articleKeywords = $news->flatMap(function ($a) {
            $words = [$a->category];
            foreach (explode(' ', $a->title) as $w) {
                if (mb_strlen($w) > 4) $words[] = $w;
            }
            return $words;
        })->unique()->take(15)->implode(', ');

        $seo = [
            'title' => ($settings['news_title'] ?? 'Insight Teknologi Global') . ' | PT AMV Studio Development',
            'keywords' => 'AMV Studio, Insight Teknologi, Berita IT Indonesia, Cloud Computing, AI Generatif, Arsitektur Enterprise, Software House Pekalongan, ' . $articleKeywords,
            'description' => 'Kumpulan jurnal teknologi terkini dari PT AMV Studio Development: AI Generatif, arsitektur cloud enterprise, studi kasus rekayasa sistem, dan literasi digital untuk pelaku bisnis & institusi pendidikan.',
            'og_image' => $news->first() ? 
                ((str_starts_with($news->first()->image_path, 'http')) ? $news->first()->image_path : Storage::url($news->first()->image_path)) : 
                ($settings['og_image'] ?? asset('logo.png')),
        ];

        // 2. Prepare Blog Schema (JSON-LD)
        $blogPosts = [];
        foreach($news as $article) {
            $blogPosts[] = [
                '@type' => 'BlogPosting',
                'headline' => $article->title,
                'description' => Str::limit($article->description, 200),
                'image' => (str_starts_with($article->image_path, 'http')) ? $article->image_path : Storage::url($article->image_path),
                'articleSection' => $article->category,
                'datePublished' => $article->published_at ? Carbon::parse($article->published_at)->toIso8601String() : now()->toIso8601String(),
                'dateModified' => $article->updated_at ? Carbon::parse($article->updated_at)->toIso8601String() : now()->toIso8601String(),
                'url' => route('news.show', $article->slug),
                'author' => ['@type' => 'Organization', 'name' => 'PT AMV Studio Development'],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => 'PT AMV Studio Development',
                    'logo' => ['@type' => 'ImageObject', 'url' => isset($settings['logo_path']) ? Storage::url($settings['logo_path']) : asset('logo.png')]
                ],
                'keywords' => $article->category . ', AMV Studio, Insight Teknologi',
                'inLanguage' => 'id-ID'
            ];
        }

        $blogSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Blog',
            'name' => ($settings['news_title'] ?? 'Insight Teknologi Global') . ' - PT AMV Studio Development',
            'description' => $seo['description'],
            'url' => route('news'),
            'inLanguage' => 'id-ID',
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'PT AMV Studio Development',
                'url' => url('/'),
                'logo' => ['@type' => 'ImageObject', 'url' => isset($settings['logo_path']) ? Storage::url($settings['logo_path']) : asset('logo.png')]
            ],
            'blogPost' => $blogPosts
        ];
        
        $seo['schema'] = json_encode($blogSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return view('news', compact('settings', 'news', 'seo'));
    }
}
