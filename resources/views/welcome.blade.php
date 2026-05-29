@extends('layouts.app')

@section('title', $settings['site_title'] ?? 'PT AMV Studio Development | Enterprise IT Solutions & Academy')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "Organization",
      "@@id": "https://amvsd.id/#organization",
      "name": "PT AMV Studio Development",
      "alternateName": ["AMV Studio", "AmrunDev"],
      "url": "{{ url('/') }}",
      "logo": {
        "@@type": "ImageObject",
        "url": "{{ $settings['logo_path'] ?? asset('logo.png') }}"
      },
      "description": "Enterprise Software House and Tech Academy based in Pekalongan, Indonesia. Specializing in Cloud Architecture, AI, ERP solutions, and Global Tech Insights.",
      "foundingDate": "2018-01-01",
      "contactPoint": {
        "@@type": "ContactPoint",
        "telephone": "+62-811-0000-0000",
        "contactType": "customer service",
        "areaServed": "ID",
        "availableLanguage": ["Indonesian", "English"]
      },
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "Pusat Teknologi",
        "addressLocality": "Pekalongan",
        "addressRegion": "Jawa Tengah",
        "postalCode": "51164",
        "addressCountry": "ID"
      },
      "sameAs": [
        "{{ $settings['linkedin_url'] ?? 'https://www.linkedin.com/company/amvstudiodev' }}",
        "{{ $settings['github_url'] ?? 'https://github.com/amvstudiodev' }}",
        "{{ $settings['instagram_url'] ?? 'https://instagram.com/amvstudiodev' }}"
      ]
    },
    {
      "@@type": "WebSite",
      "@@id": "https://amvsd.id/#website",
      "url": "{{ url('/') }}",
      "name": "AMV Studio Development",
      "publisher": {
        "@@id": "https://amvsd.id/#organization"
      }
    }
  ]
}
</script>
@endsection

@section('content')
<!-- Section: Hero -->
<section aria-label="Pengenalan Perusahaan" class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-24 flex flex-col items-center text-center reveal active">
    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-white border border-surface-border shadow-sm text-ink-main text-xs font-semibold tracking-wide mb-8 spring-click cursor-default" role="status">
        {!! $settings['hero_badge_icon'] ?? '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-brand-900" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>' !!}
        {{ $settings['hero_badge_text'] ?? 'ISO 27001 Certified Enterprise Architecture' }}
    </div>
    
    <h1 class="text-4xl sm:text-6xl lg:text-[76px] font-bold tracking-tight text-ink-main max-w-5xl leading-[1.05] text-balance">
        {!! $settings['hero_title'] ?? 'Empowering Digital Future, <br class="hidden sm:block"> Inspiring <span class="text-brand-900 relative whitespace-nowrap"> Tech Talents. <svg class="absolute w-full h-3 -bottom-1 left-0 text-brand-100 -z-10" viewBox="0 0 100 10" preserveAspectRatio="none" aria-hidden="true"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="8" fill="transparent"/></svg> </span>' !!}
    </h1>
    
    <p class="mt-8 text-lg sm:text-xl text-ink-muted max-w-2xl font-normal leading-relaxed text-pretty">
        {{ $settings['hero_subtitle'] ?? 'Pelopor solusi digital terintegrasi dari Indonesia. Mendorong transformasi bisnis global melalui arsitektur Cloud, AI, dan memberdayakan generasi talenta masa depan.' }}
    </p>
    
    <div class="mt-10 flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
        <button onclick="openModal()" aria-controls="contactModal" class="spring-click px-8 py-4 bg-brand-900 text-white text-[15px] font-semibold rounded-full hover:bg-brand-800 transition-all shadow-md flex items-center justify-center gap-2">
            {{ $settings['hero_button_text'] ?? 'Jadwalkan Demo Bisnis' }}
        </button>
    </div>
</section>

<!-- Section: Kemitraan (Partners / Trusted By) -->
<section aria-labelledby="partners-heading" class="py-10 border-t border-surface-border bg-surface-white overflow-hidden reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8 text-center">
        <h2 id="partners-heading" class="text-[11px] font-bold text-ink-muted uppercase tracking-widest">{{ $settings['partners_title'] ?? 'Dipercaya oleh Inovator, Universitas, & Institusi' }}</h2>
    </div>
    
    <div class="relative w-full flex overflow-hidden mask-edges group-marquee" data-type="dynamic-list" data-source="partners">
        <!-- Track 1 -->
        <div class="animate-marquee flex gap-16 sm:gap-24 items-center px-8 sm:px-12" aria-hidden="true">
            @foreach($partners as $partner)
            <div class="flex items-center gap-3 text-ink-muted hover:text-brand-900 transition-colors cursor-pointer grayscale hover:grayscale-0 opacity-70 hover:opacity-100">
                @if($partner->logo_path)
                    <img src="{{ (str_starts_with($partner->logo_path, 'http://') || str_starts_with($partner->logo_path, 'https://')) ? $partner->logo_path : Storage::url($partner->logo_path) }}" alt="Logo {{ $partner->name }}" class="h-8 sm:h-10 w-auto max-w-[140px] object-contain" loading="lazy">
                @elseif($partner->svg_icon)
                    {!! $partner->svg_icon !!}
                @endif
                <span class="font-bold text-lg tracking-tight">{{ $partner->name }}</span>
            </div>
            @endforeach
        </div>
        
        <!-- Track 2 (Duplicate for Seamless Loop) -->
        <div class="animate-marquee flex gap-16 sm:gap-24 items-center px-8 sm:px-12" aria-hidden="true">
            @foreach($partners as $partner)
            <div class="flex items-center gap-3 text-ink-muted hover:text-brand-900 transition-colors cursor-pointer grayscale hover:grayscale-0 opacity-70 hover:opacity-100">
                @if($partner->logo_path)
                    <img src="{{ (str_starts_with($partner->logo_path, 'http://') || str_starts_with($partner->logo_path, 'https://')) ? $partner->logo_path : Storage::url($partner->logo_path) }}" alt="Logo {{ $partner->name }}" class="h-8 sm:h-10 w-auto max-w-[140px] object-contain" loading="lazy">
                @elseif($partner->svg_icon)
                    {!! $partner->svg_icon !!}
                @endif
                <span class="font-bold text-lg tracking-tight">{{ $partner->name }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Section: About & History -->
<article id="tentang" aria-labelledby="about-heading" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 reveal border-t border-surface-border">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
        <div class="lg:col-span-6 flex flex-col justify-center">
            <span class="text-brand-900 font-semibold tracking-widest text-[11px] uppercase mb-3 block">{{ $settings['about_badge'] ?? 'Sejarah & Transformasi' }}</span>
            <h2 id="about-heading" class="text-3xl sm:text-4xl font-bold text-ink-main mb-6 tracking-tight leading-tight text-balance">{{ $settings['about_title'] ?? 'Dari Independen menuju Skala Korporat Global.' }}</h2>
            <div class="prose prose-lg text-ink-muted leading-relaxed text-pretty">
                <p class="mb-4 text-[15px]">
                    {!! $settings['about_desc_1'] ?? 'Berawal dari sebuah inisiatif independen bernama <strong class="text-ink-main font-semibold">AmrunDev</strong> pada tahun 2018, kami memulai langkah dengan semangat murni untuk menyelesaikan masalah melalui baris-baris kode.' !!}
                </p>
                <p class="text-[15px]">
                    {!! $settings['about_desc_2'] ?? 'Seiring kompleksitas dan kepercayaan klien yang terus bertumbuh, tahun 2022 menjadi tonggak sejarah ketika kami bertransformasi dan resmi berbadan hukum sebagai PT AMV Studio Development.' !!}
                </p>
            </div>
        </div>
        
        <div class="lg:col-span-6 relative">
            <div class="absolute inset-0 bg-brand-50 rounded-3xl transform translate-x-4 translate-y-4 -z-10" aria-hidden="true"></div>
            <div class="bg-surface-white border border-surface-border p-8 rounded-3xl shadow-sm">
                <h3 class="text-lg font-bold text-ink-main mb-6">{{ $settings['core_values_title'] ?? 'Nilai Inti (Core Values)' }}</h3>
                <ul class="flex flex-col gap-6" role="list">
                    @foreach($coreValues as $val)
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-brand-50 flex items-center justify-center shrink-0 text-brand-900 font-bold" aria-hidden="true">
                            {{ $val->letter }}
                        </div>
                        <div>
                            <h4 class="font-bold text-ink-main text-[15px] mb-1">{{ $val->title }}</h4>
                            <p class="text-[14px] text-ink-muted text-pretty">{{ $val->description }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</article>

<!-- Section: Solusi & Layanan (Services) -->
<section id="layanan" aria-labelledby="services-heading" class="bg-surface-light border-y border-surface-border py-24 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center text-center mb-16">
            <span class="text-brand-900 font-semibold tracking-widest text-[11px] uppercase mb-3 block">{{ $settings['services_badge'] ?? 'Pilar Bisnis Utama' }}</span>
            <h2 id="services-heading" class="text-3xl sm:text-4xl font-bold tracking-tight text-ink-main text-balance">{{ $settings['services_title'] ?? 'Solusi Ekosistem Korporat' }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-type="dynamic-list" data-source="services">
            @foreach($services as $srv)
                @php $srvLink = ($srv->link && $srv->link !== '#') ? $srv->link : route('services'); @endphp
                @if($srv->is_highlighted)
                <!-- Data Item: Highlighted (Special Highlight Component) -->
                <a href="{{ $srvLink }}" class="group bg-brand-900 border border-brand-800 p-8 rounded-3xl shadow-modal hover:shadow-card transition-all spring-click flex flex-col justify-between relative overflow-hidden no-underline">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-brand-500/30 rounded-full blur-2xl -translate-y-10 translate-x-10" aria-hidden="true"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center mb-6 text-brand-900 font-bold text-xl" aria-hidden="true">
                            {{ $srv->badge ?? 'N' }}
                        </div>
                        <h3 class="text-white font-bold text-lg mb-2">{{ $srv->title }}</h3>
                        <p class="text-brand-100 text-[13px] leading-relaxed mb-6">{{ $srv->description }}</p>
                    </div>
                    <span class="relative z-10 inline-flex items-center gap-2 text-white font-semibold text-[13px] group-hover:underline mt-auto">
                        Daftar Sekarang <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </span>
                </a>
                @else
                <!-- Data Item: Standard -->
                <a href="{{ $srvLink }}" class="group bg-surface-white border border-surface-border p-8 rounded-3xl shadow-soft hover:shadow-card hover:border-brand-500/30 transition-all spring-click flex flex-col justify-between no-underline">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-900 flex items-center justify-center mb-6 group-hover:bg-brand-900 group-hover:text-white transition-colors duration-300" aria-hidden="true">
                            @if($srv->svg_icon)
                                {!! $srv->svg_icon !!}
                            @else
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                            @endif
                        </div>
                        <h3 class="text-ink-main font-bold text-lg mb-2">{{ $srv->title }}</h3>
                        <p class="text-ink-muted text-[13px] leading-relaxed mb-6">{{ $srv->description }}</p>
                    </div>
                    <span class="inline-flex items-center gap-2 text-brand-900 font-semibold text-[13px] group-hover:text-brand-800 mt-auto">
                        Jelajahi Solusi <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </span>
                </a>
                @endif
            @endforeach
        </div>
    </div>
</section>

<!-- Section: Portofolio Showcase (Interactive Stack) -->
<section id="portofolio" aria-labelledby="portfolio-heading" class="py-24 relative overflow-hidden bg-surface-white reveal">
    <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-surface-light to-transparent pointer-events-none" aria-hidden="true"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16">
            <div class="max-w-2xl">
                <span class="text-brand-900 font-semibold tracking-widest text-[11px] uppercase mb-3 block">{{ $settings['portfolio_badge'] ?? 'Showcase Teknologi' }}</span>
                <h2 id="portfolio-heading" class="text-3xl sm:text-4xl font-bold tracking-tight text-ink-main mb-4 text-balance">{{ $settings['portfolio_title'] ?? 'Portofolio Enterprise' }}</h2>
                <p class="text-[15px] text-ink-muted text-pretty">{{ $settings['portfolio_subtitle'] ?? 'Inovasi yang menghubungkan sistem kompleks menjadi pengalaman digital tanpa batas (seamless).' }}</p>
            </div>
            <!-- Navigation Controls Desktop -->
            <div class="hidden md:flex gap-3">
                <button onclick="prevPort()" aria-label="Portofolio Sebelumnya" class="w-10 h-10 rounded-full border border-surface-border bg-surface-white flex items-center justify-center hover:border-brand-500 hover:text-brand-900 transition-colors spring-click shadow-sm outline-none focus:ring-2 focus:ring-brand-500">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>
                <button onclick="nextPort()" aria-label="Portofolio Selanjutnya" class="w-10 h-10 rounded-full border border-surface-border bg-surface-white flex items-center justify-center hover:border-brand-500 hover:text-brand-900 transition-colors spring-click shadow-sm outline-none focus:ring-2 focus:ring-brand-500">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- 3D Stack (Left Column) -->
            <div class="lg:col-span-7 flex justify-center items-center h-[380px] sm:h-[450px] relative w-full overflow-visible" id="portfolio-stack-container">
                <div class="port-scene w-[280px] sm:w-[380px] h-[220px] sm:h-[280px] relative flex justify-center items-center" id="portfolio-stack">
                    @foreach($portfolios as $index => $port)
                    <article class="port-card absolute w-full h-full bg-surface-white border border-surface-border rounded-2xl shadow-card overflow-hidden cursor-pointer" data-index="{{ $index }}" aria-hidden="true" style="transform: translate3d(0, 0, 0); opacity: 0; pointer-events: none;">
                        <img src="{{ $port->image_path }}" alt="Tampilan antarmuka {{ $port->title }}" class="w-full h-full object-cover">
                    </article>
                    @endforeach
                </div>
            </div>

            <!-- Dynamic Data Card (Right Column) -->
            <div class="lg:col-span-5 flex flex-col justify-center min-h-[220px] relative z-10">
                <div class="absolute left-0 top-0 w-1 bg-brand-500 h-full rounded-full" aria-hidden="true"></div>
                <div class="pl-8">
                    @foreach($portfolios as $index => $port)
                    @php
                        $portLink = ($port->link && $port->link !== '#') ? $port->link : route('portfolio');
                        $portExternal = str_starts_with($portLink, 'http');
                    @endphp
                    <div id="port-desc-{{ $index }}" class="port-description-block {{ $index === 0 ? '' : 'hidden' }} transition-opacity duration-300">
                        <span class="text-[10px] font-bold text-brand-900 uppercase tracking-widest block mb-2">{{ $port->category }}</span>
                        <h3 class="text-xl sm:text-2xl font-bold text-ink-main mb-4">{{ $port->title }}</h3>
                        <p class="text-[14px] leading-relaxed text-ink-muted mb-6 text-pretty">{{ $port->description }}</p>
                        
                        <div class="flex gap-4">
                            <a href="{{ $portLink }}"
                               {{ $portExternal ? 'target=_blank rel=noopener' : '' }}
                               class="spring-click px-5 py-2.5 bg-brand-900 text-white font-semibold text-[13px] rounded-full hover:bg-brand-800 transition-colors shadow-sm inline-flex items-center gap-2 outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-900">
                                Kunjungi Live Demo <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Navigation Controls Mobile -->
        <div class="flex md:hidden justify-center gap-4 mt-10">
            <button onclick="prevPort()" aria-label="Portofolio Sebelumnya" class="w-12 h-12 rounded-full border border-surface-border bg-surface-white flex items-center justify-center hover:border-brand-500 hover:text-brand-900 transition-colors spring-click shadow-sm">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
            <button onclick="nextPort()" aria-label="Portofolio Selanjutnya" class="w-12 h-12 rounded-full border border-surface-border bg-surface-white flex items-center justify-center hover:border-brand-500 hover:text-brand-900 transition-colors spring-click shadow-sm">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
        </div>
    </div>
</section>

<!-- Section: Global News & Insights -->
<section id="berita" aria-labelledby="news-heading" class="bg-surface-white py-24 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <header class="flex flex-col md:flex-row justify-between items-end mb-12 border-b border-surface-border pb-6">
            <div class="max-w-2xl">
                <span class="text-brand-900 font-semibold tracking-widest text-[11px] uppercase mb-3 block">{{ $settings['news_badge'] ?? 'Pemikiran & Inovasi' }}</span>
                <h2 id="news-heading" class="text-3xl sm:text-4xl font-bold tracking-tight text-ink-main mb-4 text-balance">{{ $settings['news_title'] ?? 'Insight Teknologi Global' }}</h2>
                <p class="text-[15px] text-ink-muted text-pretty">{{ $settings['news_subtitle'] ?? 'Pembaruan terkini dari jurnal PT AMV Studio Development seputar AI Generatif, Arsitektur Cloud, dan pencapaian transformasi digital.' }}</p>
            </div>
            <a href="{{ route('news') }}" class="hidden md:inline-flex items-center gap-2 text-[14px] font-semibold text-brand-900 hover:text-brand-800 transition-colors spring-click outline-none focus:underline rounded-md">
                {{ $settings['news_button_text'] ?? 'Lihat Semua Rilis' }} <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-type="dynamic-list" data-source="news">
            @foreach($news->take(3) as $article)
            <a href="{{ route('news.show', $article->slug) }}" class="news-card group flex flex-col spring-click rounded-2xl overflow-hidden border border-transparent hover:border-surface-border hover:shadow-card transition-all bg-surface-white">
                <figure class="w-full h-48 overflow-hidden bg-surface-light relative m-0">
                    <img src="{{ (str_starts_with($article->image_path, 'http://') || str_starts_with($article->image_path, 'https://')) ? $article->image_path : Storage::url($article->image_path) }}" alt="Ilustrasi {{ $article->title }}" class="news-img w-full h-full object-cover transition-transform duration-500 ease-out" loading="lazy">
                    <figcaption class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-[10px] font-bold text-ink-main uppercase tracking-wider shadow-sm">{{ $article->category }}</figcaption>
                </figure>
                <div class="p-6 flex flex-col flex-grow">
                    <time datetime="{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('Y-m-d') : '' }}" class="text-[12px] font-medium text-ink-muted mb-3 flex items-center gap-2">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->isoFormat('D MMMM Y') : 'Draf' }}
                    </time>
                    <h3 class="font-bold text-ink-main text-[16px] leading-snug group-hover:text-brand-900 transition-colors mb-2 line-clamp-2">{{ $article->title }}</h3>
                    <p class="text-[13px] text-ink-muted leading-relaxed line-clamp-3 mb-4 text-pretty">{{ $article->description }}</p>
                    <span class="text-[12px] font-semibold text-brand-900 inline-flex items-center gap-1 hover:underline mt-auto">
                        Baca Selengkapnya <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // --- Dynamic 3D Portfolio Stack ---
    let currentPortIndex = 0;
    let portCards = [];
    
    function initPortfolio() {
        portCards = Array.from(document.querySelectorAll('#portfolio-stack .port-card'));
        if(portCards.length > 0) updatePortfolioStack();
    }

    function updatePortfolioStack() {
        portCards.forEach((card, index) => {
            const diff = (index - currentPortIndex + portCards.length) % portCards.length;
            
            if (diff === 0) {
                card.style.transform = 'translate3d(0, 0, 0) scale(1)';
                card.style.opacity = '1';
                card.style.zIndex = '30';
                card.style.pointerEvents = 'auto';
                card.style.filter = 'blur(0px)';
                card.setAttribute('aria-hidden', 'false');
            } else if (diff === 1) {
                card.style.transform = 'translate3d(0, -30px, -100px) scale(0.95)';
                card.style.opacity = '0.7';
                card.style.zIndex = '20';
                card.style.pointerEvents = 'none';
                card.style.filter = 'blur(1px)';
                card.setAttribute('aria-hidden', 'true');
            } else {
                card.style.transform = 'translate3d(0, -60px, -200px) scale(0.9)';
                card.style.opacity = '0.3';
                card.style.zIndex = '10';
                card.style.pointerEvents = 'none';
                card.style.filter = 'blur(2px)';
                card.setAttribute('aria-hidden', 'true');
            }
        });

        // Toggle descriptions
        document.querySelectorAll('.port-description-block').forEach((block, index) => {
            if (index === currentPortIndex) {
                block.classList.remove('hidden');
                block.style.opacity = '1';
            } else {
                block.classList.add('hidden');
                block.style.opacity = '0';
            }
        });
    }

    function nextPort() {
        if(portCards.length === 0) return;
        currentPortIndex = (currentPortIndex + 1) % portCards.length;
        updatePortfolioStack();
    }

    function prevPort() {
        if(portCards.length === 0) return;
        currentPortIndex = (currentPortIndex - 1 + portCards.length) % portCards.length;
        updatePortfolioStack();
    }

    // Assign custom page initializers to shared layout
    function initPageCustom() {
        initPortfolio();
    }
</script>
@endsection
