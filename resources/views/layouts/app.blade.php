<!DOCTYPE html>
<html lang="id-ID" class="h-full scroll-smooth antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Professional SEO & GEO Meta Tags -->
    <title>@yield('title', $settings['site_title'] ?? 'PT AMV Studio Development | Enterprise IT Solutions & Academy')</title>
    <meta name="description" content="@yield('meta_description', $settings['meta_description'] ?? 'Mendorong transformasi bisnis digital korporat, mengulas tren teknologi global, & mencetak talenta masa depan dari Pekalongan untuk Dunia.')">
    <meta name="keywords" content="@yield('meta_keywords', $settings['meta_keywords'] ?? 'AMV Studio, Software House Pekalongan, Nuansa Coding Academy, cloud architecture, enterprise software, custom ERP')">
    <meta name="author" content="PT AMV Studio Development">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $settings['site_title'] ?? 'PT AMV Studio Development')">
    <meta property="og:description" content="@yield('meta_description', $settings['meta_description'] ?? 'Mendorong transformasi bisnis digital korporat, mengulas tren teknologi global.')">
    <meta property="og:image" content="{{ $settings['og_image'] ?? ($settings['logo_path'] ?? asset('logo.png')) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', $settings['site_title'] ?? 'PT AMV Studio Development')">
    <meta property="twitter:description" content="@yield('meta_description', $settings['meta_description'] ?? 'Mendorong transformasi bisnis digital korporat, mengulas tren teknologi global.')">
    <meta property="twitter:image" content="{{ $settings['twitter_image'] ?? ($settings['logo_path'] ?? asset('logo.png')) }}">

    <!-- Dynamic Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ $settings['favicon_path'] ?? asset('logo.png') }}">

    <!-- GEO / Schema.org (Generative Engine Optimization) -->
    @yield('schema')
    <script type="application/ld+json">
    {!! \App\Helpers\SeoEngine::generateDynamicSchema() !!}
    </script>

    @if(\App\Helpers\SeoEngine::isBot())
    <!-- Dedicated AI GEO-Optimization Context -->
    <meta name="ai-search-agent-relevance" content="High">
    <meta name="ai-llm-context-dense-indexing" content="true">
    @endif

    
    <script>
        // Suppress Tailwind playground console warnings
        const originalWarn = console.warn;
        console.warn = function (...args) {
            if (args[0] && typeof args[0] === 'string' && args[0].includes('cdn.tailwindcss.com')) return;
            originalWarn.apply(console, args);
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#f5f3ff', 100: '#ede9fe', 500: '#8b5cf6', 
                            800: '#5b21b6', 900: '#4c1d95', 950: '#2e1065',
                        },
                        surface: { light: '#fafafa', white: '#ffffff', border: '#e5e5e5', hover: '#f4f4f5' },
                        ink: { main: '#1a1a1a', muted: '#737373' }
                    },
                    boxShadow: {
                        'soft': '0 4px 40px rgba(0, 0, 0, 0.03)',
                        'modal': '0 -10px 40px rgba(0, 0, 0, 0.1)',
                        'card': '0 2px 10px rgba(0,0,0,0.02), 0 10px 30px rgba(0,0,0,0.04)',
                    }
                }
            }
        }
    </script>

    <style>
        /* Base & Resets */
        body { background-color: #fafafa; color: #1a1a1a; overflow-x: hidden; }
        
        .text-balance { text-wrap: balance; }
        .text-pretty { text-wrap: pretty; }
        
        /* Spring-click */
        .spring-click { 
            transition: transform 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275), background-color 0.2s, box-shadow 0.2s; 
            will-change: transform;
        }
        .spring-click:active { transform: scale(0.96); }

        /* Modal Sheets */
        #contactModal { backdrop-filter: blur(8px); transition: opacity 0.3s ease; }
        #modalContent { transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1); will-change: transform; }
        .modal-open #contactModal { opacity: 1; pointer-events: auto; }
        
        @media (max-width: 640px) {
            .modal-open #modalContent { transform: translateY(0%); }
            #modalContent { transform: translateY(100%); }
        }
        @media (min-width: 641px) {
            .modal-open #modalContent { transform: translateY(0) scale(1); opacity: 1;}
            #modalContent { transform: translateY(40px) scale(0.95); opacity: 0;}
        }

        /* Mobile Menu */
        #mobileMenu { transition: opacity 0.2s ease, transform 0.3s cubic-bezier(0.16, 1, 0.3, 1); transform-origin: top; }
        .menu-hidden { opacity: 0; pointer-events: none; transform: translateY(-10px); }
        .menu-visible { opacity: 1; pointer-events: auto; transform: translateY(0); }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e5e5e5; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #cccccc; }
        
        /* Scroll Reveal */
        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1); will-change: transform, opacity; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        
        .canvas-mask { mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 40%, rgba(0,0,0,0) 100%); -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 40%, rgba(0,0,0,0) 100%); }
        .news-card:hover .news-img { transform: scale(1.05); }

        /* Infinite Marquee */
        .mask-edges {
            mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
        }
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-100%); }
        }
        .animate-marquee {
            display: flex;
            width: max-content;
            animation: marquee 35s linear infinite;
        }
        .group-marquee:hover .animate-marquee {
            animation-play-state: paused;
        }

        /* Portfolio Stack Mechanics */
        .port-scene { perspective: 1500px; transform-style: preserve-3d; }
        .port-card { 
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: transform, opacity, filter;
            transform-origin: 50% 100%; 
        }
        @keyframes dash { from { stroke-dashoffset: 1000; } to { stroke-dashoffset: 0; } }
        #port-connection-path { stroke-dasharray: 1000; stroke-dashoffset: 1000; }
    </style>
</head>
<body class="relative flex flex-col min-h-screen">

    <!-- 3D Interactive Background Network -->
    <div id="threejs-container" aria-hidden="true" class="fixed inset-0 w-full h-full z-[-1] pointer-events-none opacity-[0.25] canvas-mask">
        <canvas id="network-canvas" class="w-full h-full block"></canvas>
    </div>

    <!-- Navigation Header -->
    <header class="fixed top-0 w-full z-40 bg-surface-white/80 backdrop-blur-xl border-b border-surface-border transition-all duration-300" id="navbar" role="banner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 sm:h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center cursor-pointer spring-click outline-none focus:ring-2 focus:ring-brand-500 rounded-xl" aria-label="Beranda AMV Studio">
                    <img src="{{ isset($settings['logo_path']) ? Storage::url($settings['logo_path']) : asset('logo.png') }}" alt="logo amv studio" class="h-14 sm:h-16 w-auto object-contain shrink-0">
                </a>

                <!-- Desktop Menu Navigation -->
                <nav class="hidden md:flex items-center gap-4 lg:gap-8" aria-label="Navigasi Utama">
                    <a href="{{ route('about') }}" class="text-[14px] font-medium {{ request()->routeIs('about') ? 'text-brand-900 font-bold' : 'text-ink-muted hover:text-ink-main' }} transition-colors px-2 py-1 outline-none focus:text-brand-900">Tentang Kami</a>
                    
                    <!-- Mega Menu Dropdown -->
                    <div class="relative group" data-component="mega-menu">
                        <button aria-expanded="false" class="flex items-center gap-1.5 text-[14px] font-medium {{ request()->routeIs('services') ? 'text-brand-900 font-bold' : 'text-ink-muted hover:text-ink-main' }} group-hover:text-ink-main transition-colors px-2 py-1 outline-none focus:text-brand-900">
                            Solusi & Layanan
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        
                        <div class="absolute top-full left-0 w-full h-5" aria-hidden="true"></div> <!-- Bridge -->

                        <div class="absolute left-1/2 -translate-x-1/2 top-full mt-5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-out transform group-hover:translate-y-0 translate-y-3 w-[480px] z-50">
                            <div class="bg-surface-white/95 backdrop-blur-xl border border-surface-border rounded-2xl shadow-modal p-3 grid grid-cols-2 gap-3 relative before:content-[''] before:absolute before:-top-1.5 before:left-1/2 before:-translate-x-1/2 before:w-3 before:h-3 before:bg-surface-white before:border-l before:border-t before:border-surface-border before:rotate-45 before:z-[-1]">
                                
                                @php
                                    $navServices = \App\Models\Service::orderBy('sort_order', 'asc')->get();
                                @endphp

                                <!-- Category: Enterprise -->
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-bold text-brand-900 uppercase tracking-widest px-3 py-2" id="menu-enterprise">Enterprise</span>
                                    
                                    @foreach($navServices->where('is_highlighted', false) as $srv)
                                    <a href="{{ $srv->link ?? route('services') }}" aria-labelledby="menu-enterprise" class="flex items-start gap-3 p-3 rounded-xl hover:bg-surface-light transition-all duration-200 group/item focus:bg-surface-light outline-none">
                                        <div class="w-9 h-9 rounded-lg bg-brand-50 text-brand-900 flex items-center justify-center shrink-0 group-hover/item:bg-brand-900 group-hover/item:text-white transition-colors duration-300" aria-hidden="true">
                                            @if($srv->svg_icon)
                                                {!! $srv->svg_icon !!}
                                            @else
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-[13px] font-bold text-ink-main mb-0.5">{{ $srv->title }}</div>
                                            <div class="text-[11px] text-ink-muted leading-tight text-pretty">{{ $srv->description }}</div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>

                                <!-- Category: Ecosystem -->
                                <div class="flex flex-col bg-surface-light/50 rounded-xl p-1 border border-surface-border/50">
                                    <span class="text-[10px] font-bold text-ink-muted uppercase tracking-widest px-3 py-2" id="menu-ecosystem">Ecosystem</span>
                                    
                                    @foreach($navServices->where('is_highlighted', true) as $srv)
                                    <a href="{{ $srv->link ?? route('services') }}" aria-labelledby="menu-ecosystem" class="flex items-center gap-3 p-2 rounded-lg hover:bg-white hover:shadow-sm transition-all duration-200 border border-transparent hover:border-surface-border group/item focus:bg-white outline-none mb-1">
                                        <div class="w-8 h-8 rounded-md bg-brand-900 text-white flex items-center justify-center font-bold text-[10px] shrink-0" aria-hidden="true">
                                            {{ $srv->badge ?? 'N' }}
                                        </div>
                                        <div>
                                            <div class="text-[12px] font-bold text-ink-main">{{ $srv->title }}</div>
                                            <div class="text-[10px] text-brand-900 font-medium">{{ $srv->description }}</div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('portfolio') }}" class="text-[14px] font-medium {{ request()->routeIs('portfolio') ? 'text-brand-900 font-bold' : 'text-ink-muted hover:text-ink-main' }} transition-colors px-2 py-1 outline-none focus:text-brand-900">Portofolio</a>
                    <a href="{{ route('academy.index') }}" class="text-[14px] font-medium {{ request()->routeIs('academy.*') ? 'text-brand-900 font-bold' : 'text-ink-muted hover:text-ink-main' }} transition-colors px-2 py-1 outline-none focus:text-brand-900">Akademi</a>
                    <a href="{{ route('news') }}" class="text-[14px] font-medium {{ request()->routeIs('news') ? 'text-brand-900 font-bold' : 'text-ink-muted hover:text-ink-main' }} transition-colors px-2 py-1 relative flex items-center outline-none focus:text-brand-900">
                        Insight Global
                        <span class="absolute -top-1 -right-2 flex h-2 w-2" aria-hidden="true">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-500 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                        </span>
                    </a>
                </nav>

                <!-- Desktop CTA & Lang Toggle -->
                <div class="hidden md:flex items-center gap-4">
                    <div class="flex items-center gap-2 border-r border-surface-border pr-4" aria-label="Pilih Bahasa">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-ink-muted" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                        <span class="text-xs font-semibold text-ink-muted cursor-pointer hover:text-ink-main transition-colors">ID / EN</span>
                    </div>
                    <button onclick="openModal()" aria-haspopup="dialog" aria-controls="contactModal" class="spring-click px-5 py-2.5 bg-brand-900 text-white text-[14px] font-semibold rounded-full hover:bg-brand-800 transition-colors shadow-sm flex items-center gap-2 outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-900">
                        Konsultasi Project
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobileMenuBtn" onclick="toggleMobileMenu()" aria-expanded="false" aria-controls="mobileMenu" class="p-2 -mr-2 text-ink-main spring-click rounded-lg outline-none focus:bg-surface-light" aria-label="Buka Menu Navigasi">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobileMenu" class="absolute top-full left-0 w-full bg-surface-white border-b border-surface-border shadow-soft menu-hidden md:hidden" role="navigation" aria-label="Mobile Navigation">
            <div class="px-4 py-6 flex flex-col gap-4">
                <a href="{{ route('about') }}" onclick="toggleMobileMenu()" class="text-lg font-medium text-ink-main block">Tentang Kami</a>
                <a href="{{ route('services') }}" onclick="toggleMobileMenu()" class="text-lg font-medium text-ink-main block">Solusi & Layanan</a>
                <a href="{{ route('portfolio') }}" onclick="toggleMobileMenu()" class="text-lg font-medium text-ink-main block">Portofolio</a>
                <a href="{{ route('academy.index') }}" onclick="toggleMobileMenu()" class="text-lg font-medium text-ink-main block">Nuansa Academy</a>
                <a href="{{ route('news') }}" onclick="toggleMobileMenu()" class="text-lg font-medium text-ink-main flex items-center gap-2">
                    Insight Global <span class="px-2 py-0.5 rounded-full bg-brand-100 text-brand-900 text-[10px] font-bold uppercase">Baru</span>
                </a>
                <div class="pt-4 mt-2 border-t border-surface-border flex flex-col gap-4">
                    <button onclick="toggleMobileMenu(); openModal();" class="spring-click w-full py-3 bg-brand-900 text-white text-[15px] font-semibold rounded-xl flex justify-center items-center gap-2">
                        Mulai Kolaborasi
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow pt-24 sm:pt-32 pb-20" id="main-content">
        @yield('content')
    </main>

    <!-- Footer Component -->
    <footer class="bg-surface-light border-t border-surface-border pt-16 pb-8 reveal" role="contentinfo">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-12">
                <!-- Col 1: Branding -->
                <div class="md:col-span-5 flex flex-col gap-4">
                    <a href="/" class="flex items-center spring-click self-start outline-none focus:ring-2 focus:ring-brand-500 rounded-xl" aria-label="Beranda Utama">
                        <img src="{{ isset($settings['logo_path']) ? Storage::url($settings['logo_path']) : asset('logo.png') }}" alt="logo amv studio" class="h-12 sm:h-14 w-auto object-contain shrink-0">
                    </a>

                    <p class="text-[13px] text-ink-muted leading-relaxed max-w-sm text-pretty">
                        {{ $settings['footer_desc'] ?? 'Enterprise Software House & Tech Academy. Mendorong transformasi digital dan mencetak talenta berkualitas dari Pekalongan untuk dunia.' }}
                    </p>
                </div>

                <!-- Col 2: Navigation -->
                <div class="md:col-span-3 flex flex-col gap-3">
                    <h4 class="text-[11px] font-bold text-ink-main uppercase tracking-widest">Perusahaan</h4>
                    <nav class="flex flex-col gap-2" aria-label="Navigasi Footer">
                        <a href="{{ route('about') }}" class="text-[13px] text-ink-muted hover:text-ink-main transition-colors outline-none focus:underline">Tentang Kami</a>
                        <a href="{{ route('services') }}" class="text-[13px] text-ink-muted hover:text-ink-main transition-colors outline-none focus:underline">Solusi & Layanan</a>
                        <a href="{{ route('news') }}" class="text-[13px] text-ink-muted hover:text-ink-main transition-colors outline-none focus:underline">Berita Global</a>
                    </nav>
                </div>

                <!-- Col 3: Contact & Legal -->
                <div class="md:col-span-4 flex flex-col gap-3">
                    <h4 class="text-[11px] font-bold text-ink-main uppercase tracking-widest">Kontak Legal</h4>
                    <div class="text-[13px] text-ink-muted leading-relaxed flex flex-col gap-2">
                        <address class="not-italic flex items-start gap-2 max-w-xs text-pretty">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0 mt-0.5 text-brand-900" aria-hidden="true"><path d="M12 2a8 8 0 0 0-8 8c0 5.25 8 12 8 12s8-6.75 8-12a8 8 0 0 0-8-8z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            <span>{{ $settings['footer_address'] ?? 'Pusat Teknologi, Pekalongan, Jawa Tengah, ID' }}</span>
                        </address>
                    </div>
                </div>
            </div>

            <!-- Bottom Line -->
            <div class="border-t border-surface-border pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-[12px] text-ink-muted">
                    {{ $settings['footer_copyright'] ?? '© 2026 PT AMV Studio Development. Hak Cipta Dilindungi.' }}
                </p>
                
                <!-- Social Media Links -->
                <div class="flex gap-4">
                    <a href="{{ $settings['linkedin_url'] ?? 'https://linkedin.com/company/amvstudio' }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn AMV Studio" class="text-ink-muted hover:text-brand-900 transition-colors spring-click outline-none focus:ring-2 focus:ring-brand-500 rounded-md">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                    </a>
                    <a href="{{ $settings['github_url'] ?? 'https://github.com/amvstudiodev' }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub AMV Studio" class="text-ink-muted hover:text-brand-900 transition-colors spring-click outline-none focus:ring-2 focus:ring-brand-500 rounded-md">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                    </a>
                    <a href="{{ $settings['instagram_url'] ?? 'https://instagram.com/amvstudio.dev' }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram AMV Studio" class="text-ink-muted hover:text-brand-900 transition-colors spring-click outline-none focus:ring-2 focus:ring-brand-500 rounded-md">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Contact Form Modal Component -->
    <dialog id="contactModal" aria-labelledby="modal-title" aria-modal="true" class="fixed inset-0 w-full h-full z-50 pointer-events-none opacity-0 flex flex-col justify-end sm:justify-center items-center bg-transparent m-0 p-0">
        <div class="absolute inset-0 bg-ink-main/20 transition-opacity" onclick="closeModal()" aria-hidden="true"></div>
        
        <div id="modalContent" class="w-full sm:max-w-xl bg-surface-white rounded-t-3xl sm:rounded-3xl shadow-modal relative z-10 flex flex-col max-h-[90vh] border border-surface-border mx-auto sm:my-auto">
            <div class="sm:hidden w-full flex justify-center pt-3 pb-1" aria-hidden="true">
                <div class="w-12 h-1.5 bg-surface-border rounded-full"></div>
            </div>

            <header class="flex justify-between items-center px-4 py-3 sm:p-5 border-b border-surface-border">
                <button onclick="closeModal()" class="text-[15px] font-medium text-ink-muted px-3 py-1.5 hover:bg-surface-light rounded-lg transition-colors spring-click outline-none focus:ring-2 focus:ring-brand-500" aria-label="Tutup Form">Batal</button>
                <h3 id="modal-title" class="font-bold text-[16px] text-ink-main">Mulai Diskusi Project</h3>
                <div class="w-16" aria-hidden="true"></div>
            </header>

            <div class="px-5 pt-5 pb-0">
                <div class="p-4 bg-green-50 border border-green-100 rounded-2xl flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-[#25D366] text-white flex items-center justify-center shadow-sm">
                            <svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor"><path d="M16 0C7.163 0 0 7.163 0 16c0 2.822.736 5.47 2.027 7.774L0 32l8.467-2.003A15.94 15.94 0 0 0 16 32c8.837 0 16-7.163 16-16S24.837 0 16 0zm0 29.333a13.27 13.27 0 0 1-6.773-1.854l-.487-.29-5.027 1.188 1.21-4.904-.32-.503A13.267 13.267 0 0 1 2.667 16C2.667 8.636 8.636 2.667 16 2.667S29.333 8.636 29.333 16 23.364 29.333 16 29.333zm7.3-9.953c-.4-.2-2.364-1.167-2.73-1.3-.367-.133-.634-.2-.9.2-.267.4-1.033 1.3-1.267 1.567-.233.267-.467.3-.867.1-.4-.2-1.687-.622-3.213-1.983-1.187-1.06-1.99-2.37-2.223-2.77-.233-.4-.025-.617.175-.817.18-.18.4-.467.6-.7.2-.233.267-.4.4-.667.133-.267.067-.5-.033-.7-.1-.2-.9-2.167-1.233-2.967-.325-.78-.656-.675-.9-.687l-.767-.013c-.267 0-.7.1-1.067.5s-1.4 1.367-1.4 3.333 1.433 3.867 1.633 4.133c.2.267 2.82 4.307 6.833 6.033.955.413 1.7.66 2.28.844.958.306 1.83.263 2.52.16.769-.115 2.364-.967 2.697-1.9.333-.933.333-1.733.233-1.9-.1-.167-.367-.267-.767-.467z"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-ink-main text-sm">Respon Lebih Cepat?</p>
                            <p class="text-[11px] text-ink-muted leading-tight">Hubungi konsultan kami via WhatsApp.</p>
                        </div>
                    </div>
                    <a href="https://wa.me/6281391782567?text=Halo%20AMV%20Studio%2C%20saya%20ingin%20berdiskusi%20mengenai%20proyek%20saya..." target="_blank" class="px-4 py-2 bg-[#25D366] text-white text-[11px] font-bold rounded-full hover:opacity-90 transition-opacity flex items-center gap-1.5 shadow-sm">
                        WhatsApp
                    </a>
                </div>
                
                <div class="mt-6 flex items-center gap-4">
                    <div class="h-[1px] flex-grow bg-surface-border"></div>
                    <span class="text-[10px] font-bold text-ink-muted uppercase tracking-widest">Atau Isi Form</span>
                    <div class="h-[1px] flex-grow bg-surface-border"></div>
                </div>
            </div>

            <form id="contactForm" action="#" method="POST" class="p-5 pt-2 flex flex-col gap-5 overflow-y-auto" onsubmit="submitForm(event)">
                @csrf
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-900 flex items-center justify-center font-bold text-sm shrink-0" aria-hidden="true">@</div>
                    <div class="w-full pt-1">
                        <label for="modal-email" class="font-bold text-[15px] text-ink-main block mb-0.5">Email Korporat</label>
                        <input type="email" id="modal-email" name="email" required autocomplete="email" placeholder="nama@perusahaan.com" class="w-full outline-none text-[15px] py-1 placeholder-ink-muted text-ink-main bg-transparent border-b border-surface-border focus:border-brand-500 transition-colors">
                    </div>
                </div>

                <div class="w-[2px] h-6 bg-surface-border ml-[19px] -my-4" aria-hidden="true"></div>

                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full border border-surface-border bg-surface-light flex items-center justify-center shrink-0 text-ink-muted" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    </div>
                    <div class="w-full pt-1">
                        <label for="modal-name" class="sr-only">Nama Lengkap</label>
                        <input type="text" id="modal-name" name="name" required autocomplete="name" placeholder="Nama Anda..." class="w-full outline-none text-[15px] font-medium mb-2 placeholder-ink-muted bg-transparent border-b border-surface-border focus:border-brand-500 transition-colors pb-1">
                        
                        <label for="modal-message" class="sr-only">Kebutuhan Proyek</label>
                        <textarea id="modal-message" name="message" required placeholder="Jelaskan kebutuhan arsitektur cloud atau web Anda..." rows="3" class="w-full outline-none text-[15px] resize-none placeholder-ink-muted bg-transparent mt-1"></textarea>
                    </div>
                </div>
                
                <div class="flex justify-between items-center mt-2 ml-14 pt-2 border-t border-surface-border">
                    <p class="text-[11px] font-medium text-ink-muted uppercase tracking-wider" aria-hidden="true">Enkripsi SSL</p>
                    <button type="submit" id="submitBtn" class="py-2 px-6 bg-brand-900 text-white font-semibold text-[14px] rounded-full hover:bg-brand-800 transition-colors spring-click flex items-center justify-center min-w-[120px] shadow-sm outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-900">
                        Kirim Pesan
                    </button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        // --- UI & Accessibility Interaction ---
        const body = document.body;
        const modal = document.getElementById('contactModal');
        
        function openModal() {
            body.classList.add('modal-open');
            body.style.overflow = 'hidden';
            modal.setAttribute('open', 'true');
            if(document.getElementById('mobileMenu').classList.contains('menu-visible')) toggleMobileMenu();
        }
        
        function closeModal() {
            body.classList.remove('modal-open');
            body.style.overflow = '';
            setTimeout(() => modal.removeAttribute('open'), 300);
        }

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const btn = document.getElementById('mobileMenuBtn');
            const isVisible = menu.classList.contains('menu-visible');
            
            if (isVisible) {
                menu.classList.replace('menu-visible', 'menu-hidden');
                btn.setAttribute('aria-expanded', 'false');
            } else {
                menu.classList.replace('menu-hidden', 'menu-visible');
                btn.setAttribute('aria-expanded', 'true');
            }
        }

        // CSRF-protected AJAX contact form submission
        function submitForm(e) {
            e.preventDefault();
            const form = document.getElementById('contactForm');
            const btn = document.getElementById('submitBtn');
            const originalText = btn.innerText;
            
            btn.innerHTML = `<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>`;
            btn.style.pointerEvents = 'none';
            btn.setAttribute('aria-disabled', 'true');
            
            const formData = new FormData(form);

            fetch("{{ route('contact.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    btn.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>`;
                    btn.classList.replace('bg-brand-900', 'bg-green-600');
                    btn.classList.replace('hover:bg-brand-800', 'hover:bg-green-700');
                    
                    setTimeout(() => {
                        closeModal();
                        setTimeout(() => {
                            btn.innerText = originalText;
                            btn.classList.replace('bg-green-600', 'bg-brand-900');
                            btn.classList.replace('hover:bg-green-700', 'hover:bg-brand-800');
                            btn.style.pointerEvents = 'auto';
                            btn.removeAttribute('aria-disabled');
                            form.reset();
                        }, 400); 
                    }, 1000); 
                } else {
                    alert('Validasi gagal: ' + Object.values(data.errors).flat().join(', '));
                    btn.innerText = originalText;
                    btn.style.pointerEvents = 'auto';
                    btn.removeAttribute('aria-disabled');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim pesan.');
                btn.innerText = originalText;
                btn.style.pointerEvents = 'auto';
                btn.removeAttribute('aria-disabled');
            });
        }

        // --- Scroll Reveal ---
        function initRevealObserver() {
            const reveals = document.querySelectorAll(".reveal");
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });
            
            reveals.forEach(el => observer.observe(el));
        }

        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 10) nav.classList.add('shadow-sm');
            else nav.classList.remove('shadow-sm');
        });

        // --- 3D Background Network Engine ---
        function init3DNetwork() {
            const canvas = document.getElementById('network-canvas');
            if (!canvas || typeof THREE === 'undefined') return;

            const scene = new THREE.Scene();
            const renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            renderer.setSize(window.innerWidth, window.innerHeight);

            const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 1, 1000);
            camera.position.z = 300;

            const group = new THREE.Group();
            scene.add(group);

            const geometry = new THREE.IcosahedronGeometry(200, 2); 
            const materialPoints = new THREE.PointsMaterial({ size: 4, color: 0x4c1d95, transparent: true, opacity: 0.6 });
            const points = new THREE.Points(geometry, materialPoints);
            group.add(points);

            const materialLines = new THREE.LineBasicMaterial({ color: 0x8b5cf6, transparent: true, opacity: 0.15 });
            const lines = new THREE.LineSegments(new THREE.WireframeGeometry(geometry), materialLines);
            group.add(lines);

            let mouseX = 0; let mouseY = 0;
            let targetX = 0; let targetY = 0;
            const windowHalfX = window.innerWidth / 2;
            const windowHalfY = window.innerHeight / 2;

            document.addEventListener('mousemove', (event) => {
                targetX = (event.clientX - windowHalfX) * 0.05;
                targetY = (event.clientY - windowHalfY) * 0.05;
            }, { passive: true });

            function animate() {
                requestAnimationFrame(animate);
                
                mouseX += (targetX - mouseX) * 0.05;
                mouseY += (targetY - mouseY) * 0.05;
                
                group.rotation.y += 0.0015; 
                group.rotation.x += 0.0005;
                
                camera.position.x += (mouseX - camera.position.x) * 0.05;
                camera.position.y += (-mouseY - camera.position.y) * 0.05;
                camera.lookAt(scene.position);
                
                renderer.render(scene, camera);
            }
            
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    camera.aspect = window.innerWidth / window.innerHeight;
                    camera.updateProjectionMatrix();
                    renderer.setSize(window.innerWidth, window.innerHeight);
                }, 150);
            });

            animate();
        }

        window.addEventListener('DOMContentLoaded', () => {
            init3DNetwork();
            initRevealObserver();
            document.querySelectorAll('.reveal.active').forEach(el => el.style.opacity = '1');

            // Custom page initializers
            if (typeof initPageCustom === 'function') {
                initPageCustom();
            }
        });
        </script>
        @yield('scripts')
        </body>
        </html>
