<?php

namespace App\Helpers;

use App\Models\Course;
use App\Models\Service;
use App\Models\VisitorLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class SeoEngine
{
    /**
     * Generates a fully dynamic, self-optimizing SEO/GEO JSON-LD Schema Graph
     * based on real-time visitor patterns and popular content.
     */
    public static function generateDynamicSchema(): string
    {
        $schemas = [];

        try {
            // 1. Basic Organization Info
            $settings = DB::table('settings')->pluck('value', 'key')->toArray();
            $logoUrl = $settings['logo_path'] ?? asset('logo.png');

            $orgSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'Organization',
                'name' => 'PT AMV Studio Development',
                'url' => url('/'),
                'logo' => $logoUrl,
                'sameAs' => [
                    $settings['linkedin_url'] ?? 'https://linkedin.com/',
                    $settings['github_url'] ?? 'https://github.com/',
                    $settings['instagram_url'] ?? 'https://instagram.com/',
                ],
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'telephone' => '+62-812-3456-7890',
                    'contactType' => 'customer service',
                    'areaServed' => 'ID',
                    'availableLanguage' => ['Indonesian', 'English'],
                ],
            ];
            $schemas[] = $orgSchema;

            // 2. Dynamic "Trending Content" Schema (ItemList) for GEO Optimization
            $popularPages = VisitorLog::select('uri', DB::raw('count(*) as total_views'))
                ->where('created_at', '>=', now()->subDays(30))
                ->groupBy('uri')
                ->orderBy('total_views', 'desc')
                ->limit(3)
                ->get();

            if ($popularPages->isNotEmpty()) {
                $itemList = [
                    '@context' => 'https://schema.org',
                    '@type' => 'ItemList',
                    'name' => 'Top Trending Services & Resources',
                    'description' => 'Most requested technologies and insights dynamically tracked by our analytics engine.',
                    'itemListElement' => [],
                ];

                foreach ($popularPages as $index => $page) {
                    $title = 'PT AMV Studio Development';
                    if ($page->uri === '/about' || $page->uri === '/tentang') {
                        $title = 'Tentang Kami - PT AMV Studio Development';
                    } elseif ($page->uri === '/services' || $page->uri === '/layanan') {
                        $title = 'Solusi & Layanan - Cloud, SaaS & ERP';
                    } elseif ($page->uri === '/portfolio' || $page->uri === '/portofolio') {
                        $title = 'Portofolio Showcase - Rekayasa Sistem';
                    } elseif ($page->uri === '/news' || $page->uri === '/insight') {
                        $title = 'Insight Global - Jurnal Teknologi';
                    }

                    $itemList['itemListElement'][] = [
                        '@type' => 'ListItem',
                        'position' => $index + 1,
                        'url' => url($page->uri),
                        'name' => $title,
                    ];
                }
                $schemas[] = $itemList;
            }

            // 3. Dynamic "Frequently Asked Questions" (FAQPage)
            $services = Service::limit(3)->get();
            if ($services->isNotEmpty()) {
                $faqSchema = [
                    '@context' => 'https://schema.org',
                    '@type' => 'FAQPage',
                    'mainEntity' => [],
                ];

                foreach ($services as $srv) {
                    $faqSchema['mainEntity'][] = [
                        '@type' => 'Question',
                        'name' => 'Apa keunggulan dari layanan '.$srv->title.' PT AMV Studio Development?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => $srv->description.' Layanan ini didukung oleh ISO 27001 Certified Enterprise Architecture.',
                        ],
                    ];
                }
                $schemas[] = $faqSchema;
            }

            // 4. Dynamic Course Catalog Schema (Fase 2 LMS Integration)
            $courses = Course::where('is_published', true)->limit(6)->get();
            if ($courses->isNotEmpty()) {
                foreach ($courses as $course) {
                    $courseSchema = [
                        '@context' => 'https://schema.org',
                        '@type' => 'Course',
                        'name' => $course->title,
                        'description' => strip_tags($course->description),
                        'provider' => [
                            '@type' => 'Organization',
                            'name' => 'Nuansa Coding Academy',
                            'sameAs' => url('/akademi'),
                        ],
                        'offers' => [
                            '@type' => 'Offer',
                            'category' => 'Paid/Free Training',
                            'price' => $course->price,
                            'priceCurrency' => 'IDR',
                        ],
                        'educationalCredentialAwarded' => 'Sertifikat Digital AMV Studio',
                        'occupationalCategory' => 'IT Professional, Software Engineer',
                    ];
                    $schemas[] = $courseSchema;
                }
            }

        } catch (\Exception $e) {
            // Fallback to basic structure on database errors
        }

        return json_encode($schemas, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    /**
     * Checks if the current visitor is an AI Crawler or Search Bot
     */
    public static function isBot(): bool
    {
        $ua = Request::header('User-Agent', '');
        return (bool) preg_match('/(google-extended|gemini|gptbot|googlebot|applebot|bingbot|duckduckbot)/i', $ua);
    }
}
