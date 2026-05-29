<?php

namespace Database\Seeders;

use App\Models\CoreValue;
use App\Models\News;
use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin & Client Users
        User::updateOrCreate(
            ['email' => 'admin@amv.com'],
            [
                'name' => 'Admin AMV',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'client@amv.com'],
            [
                'name' => 'Client AMV',
                'password' => Hash::make('client123'),
                'role' => 'client',
            ]
        );

        // 2. Create Site Settings (Key-Value)
        $settings = [
            'site_title' => 'PT AMV Studio Development | Enterprise IT Solutions & Academy',
            'meta_description' => 'Software House Enterprise berbasis di Pekalongan, Indonesia. Ahli dalam Arsitektur Cloud, Pengembangan Web/Mobile, Integrasi AI, dan Pendidikan Talenta Digital.',
            'meta_keywords' => 'Software House Pekalongan, Enterprise IT Solutions Indonesia, Cloud Architecture, Artificial Intelligence, Web Development, PT AMV Studio Development',
            'meta_author' => 'PT AMV Studio Development',
            'og_url' => 'https://amvsd.id/',
            'og_title' => 'PT AMV Studio Development | Code The Future',
            'og_description' => 'Mendorong transformasi bisnis digital korporat, mengulas tren teknologi global, & mencetak talenta masa depan dari Pekalongan untuk Dunia.',
            'og_image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1200&auto=format&fit=crop',
            'twitter_title' => 'PT AMV Studio Development | Enterprise IT Solutions',
            'twitter_description' => 'Enterprise Software House & Tech Academy. Mendorong transformasi digital global.',
            'twitter_image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1200&auto=format&fit=crop',
            'hero_badge_text' => 'Innovative Enterprise Digital Solutions & Academy',
            'hero_badge_icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-brand-900" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>',
            'hero_title' => 'Empowering Digital Future, <br class="hidden sm:block"> Inspiring <span class="text-brand-900 relative whitespace-nowrap"> Tech Talents. <svg class="absolute w-full h-3 -bottom-1 left-0 text-brand-100 -z-10" viewBox="0 0 100 10" preserveAspectRatio="none" aria-hidden="true"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="8" fill="transparent"/></svg> </span>',
            'hero_subtitle' => 'Pelopor solusi digital terintegrasi dari Indonesia. Mendorong transformasi bisnis global melalui arsitektur Cloud, AI, dan memberdayakan generasi talenta masa depan.',
            'hero_button_text' => 'Jadwalkan Demo Bisnis',
            'about_badge' => 'Sejarah & Transformasi',
            'about_title' => 'Dari Independen menuju Skala Korporat Global.',
            'about_desc_1' => 'Berawal dari sebuah inisiatif independen bernama <strong class="text-ink-main font-semibold">AmrunDev</strong> pada tahun 2018, kami memulai langkah dengan semangat murni untuk menyelesaikan masalah melalui baris-baris kode.',
            'about_desc_2' => 'Seiring kompleksitas dan kepercayaan klien yang terus bertumbuh, tahun 2022 menjadi tonggak sejarah ketika kami bertransformasi dan resmi berbadan hukum sebagai <strong class="text-brand-900 font-semibold">PT AMV Studio Development</strong>. Kami bukan lagi sekadar pembuat software, melainkan ruang kolaborasi inovasi AI dan pendidikan terapan.',
            'footer_logo' => 'logofooter.png',
            'footer_desc' => 'Enterprise Software House & Tech Academy. Mendorong transformasi digital dan mencetak talenta berkualitas dari Pekalongan untuk dunia.',
            'footer_address' => 'Pusat Teknologi, Pekalongan, Jawa Tengah, ID',
            'footer_copyright' => '© 2026 PT AMV Studio Development. Hak Cipta Dilindungi.',
            'linkedin_url' => 'https://linkedin.com/company/amvstudiodev',
            'github_url' => 'https://github.com/amvstudiodev',
            'instagram_url' => 'https://instagram.com/amvstudio.dev',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 3. Create Partners
        $partners = [
            [
                'name' => 'EduPrime Univ.',
                'svg_icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>',
                'sort_order' => 1,
            ],
            [
                'name' => 'TechGlobal Corp',
                'svg_icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>',
                'sort_order' => 2,
            ],
            [
                'name' => 'GovNet System',
                'svg_icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>',
                'sort_order' => 3,
            ],
            [
                'name' => 'FinTrust Bank',
                'svg_icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>',
                'sort_order' => 4,
            ],
            [
                'name' => 'RetailMaju Group',
                'svg_icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>',
                'sort_order' => 5,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::updateOrCreate(['name' => $partner['name']], $partner);
        }

        // 4. Create Core Values
        $coreValues = [
            [
                'letter' => 'A',
                'title' => 'Agile',
                'description' => 'Cepat beradaptasi terhadap perubahan tren dan arsitektur teknologi global.',
                'sort_order' => 1,
            ],
            [
                'letter' => 'M',
                'title' => 'Masterful',
                'description' => 'Berkomitmen pada standar rekayasa perangkat lunak dan *Good Corporate Governance*.',
                'sort_order' => 2,
            ],
            [
                'letter' => 'V',
                'title' => 'Visionary',
                'description' => 'Berpikir ke depan, mengintegrasikan AI dan visi masa depan dalam ekosistem hari ini.',
                'sort_order' => 3,
            ],
        ];

        foreach ($coreValues as $val) {
            CoreValue::updateOrCreate(['letter' => $val['letter']], $val);
        }

        // 5. Create Services
        $services = [
            [
                'title' => 'Enterprise Software',
                'description' => 'Pengembangan Web & Mobile App High Availability. Infrastruktur Cloud Native yang disesuaikan dengan alur bisnis perusahaan Anda.',
                'svg_icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>',
                'badge' => null,
                'link' => '#layanan',
                'is_highlighted' => false,
                'sort_order' => 1,
            ],
            [
                'title' => 'SaaS & ERP System',
                'description' => 'Produk *in-house* unggulan seperti Identic (Sistem Manajemen Sekolah) dan KasirKUY (Smart POS) untuk efisiensi *real-time*.',
                'svg_icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>',
                'badge' => null,
                'link' => '#layanan',
                'is_highlighted' => false,
                'sort_order' => 2,
            ],
            [
                'title' => 'Nuansa Coding Academy',
                'description' => 'Inisiatif pendidikan IT. Bootcamp, pelatihan intensif, dan kolaborasi penyusunan silabus terapan bersama berbagai universitas lokal.',
                'svg_icon' => null,
                'badge' => 'N',
                'link' => '#akademi',
                'is_highlighted' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['title' => $service['title']], $service);
        }

        // 6. Create Portfolios
        $portfolios = [
            [
                'category' => 'EdTech Ecosystem',
                'title' => 'Sistem Identic v3.0',
                'description' => 'Platform manajemen sekolah end-to-end berbasis microservices. Menghubungkan jutaan data akademik secara real-time dengan uptime 99.9%.',
                'image_path' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=800&auto=format&fit=crop',
                'link' => '#',
                'sort_order' => 1,
            ],
            [
                'category' => 'Smart Retail & POS',
                'title' => 'KasirKUY Enterprise',
                'description' => 'Sistem Point of Sales pintar terpusat (Cloud POS) untuk efisiensi inventaris multi-cabang. Terintegrasi dengan analitik prediksi restock otomatis.',
                'image_path' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=800&auto=format&fit=crop',
                'link' => '#',
                'sort_order' => 2,
            ],
            [
                'category' => 'FinTech & Gateway',
                'title' => 'FiberPaY / NetPay',
                'description' => 'Infrastruktur pembayaran digital B2B berkapasitas besar. Memproses transaksi massal dengan enkripsi bank-grade dan latensi di bawah 200ms.',
                'image_path' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=800&auto=format&fit=crop',
                'link' => '#',
                'sort_order' => 3,
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::updateOrCreate(['title' => $portfolio['title']], $portfolio);
        }

        // 7. Create News
        $newsItems = [
            [
                'category' => 'AI & Cloud',
                'title' => 'Integrasi LLM pada Sistem ERP Enterprise: Masa Depan Otomatisasi Bisnis',
                'description' => 'Bagaimana PT AMV Studio Development mulai mengimplementasikan kecerdasan buatan generatif ke dalam arsitektur ERP untuk mempercepat pengambilan keputusan manajerial korporat.',
                'image_path' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?q=80&w=600&auto=format&fit=crop',
                'published_at' => '2026-05-20',
                'link' => '#',
                'sort_order' => 1,
            ],
            [
                'category' => 'Academy',
                'title' => 'Nuansa Academy Resmikan Silabus Terapan bersama Universitas Terkemuka',
                'description' => 'Langkah strategis dari Pekalongan untuk Indonesia. Misi kami untuk memangkas kesenjangan talenta digital melalui kurikulum berbasis kebutuhan industri riil global.',
                'image_path' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=600&auto=format&fit=crop',
                'published_at' => '2026-05-12',
                'link' => '#',
                'sort_order' => 2,
            ],
            [
                'category' => 'Product Update',
                'title' => 'Identic v3.0 Dirilis: Arsitektur Microservices untuk Skalabilitas Tanpa Batas',
                'description' => 'Pembaruan masif pada ekosistem manajemen sekolah Identic. Kini didukung oleh infrastruktur cloud-native yang menjamin uptime 99.9% untuk puluhan ribu pengguna harian.',
                'image_path' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=600&auto=format&fit=crop',
                'published_at' => '2026-04-28',
                'link' => '#',
                'sort_order' => 3,
            ],
        ];

        foreach ($newsItems as $news) {
            News::updateOrCreate(['title' => $news['title']], $news);
        }
    }
}
