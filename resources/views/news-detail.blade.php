@extends('layouts.app')

@php
    $seoTitle    = $article->title . ' | PT AMV Studio Development';
    $seoDesc     = \Illuminate\Support\Str::limit(strip_tags($article->description), 160);
    $seoKeywords = $article->category . ', AMV Studio, Insight Teknologi, ' .
                   collect(explode(' ', $article->title))->filter(fn($w) => mb_strlen($w) > 4)->take(8)->implode(', ');
    $ogImage     = $article->image_path ?? ($settings['og_image'] ?? asset('logo.png'));
    $articleUrl  = route('news.show', $article->slug);
@endphp

@section('title', $seoTitle)
@section('meta_description', $seoDesc)
@section('meta_keywords', $seoKeywords)

@section('schema')
<meta property="og:type" content="article">
<meta property="og:url" content="{{ $articleUrl }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="article:published_time" content="{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->toIso8601String() : now()->toIso8601String() }}">
<meta property="article:section" content="{{ $article->category }}">
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large">
<meta name="geo.region" content="ID-JT">
<meta name="geo.placename" content="Pekalongan, Jawa Tengah, Indonesia">
<link rel="canonical" href="{{ $articleUrl }}">

<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BlogPosting",
  "headline": "{{ addslashes($article->title) }}",
  "description": "{{ addslashes($seoDesc) }}",
  "image": "{{ $ogImage }}",
  "url": "{{ $articleUrl }}",
  "datePublished": "{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->toIso8601String() : now()->toIso8601String() }}",
  "dateModified": "{{ \Carbon\Carbon::parse($article->updated_at)->toIso8601String() }}",
  "articleSection": "{{ $article->category }}",
  "inLanguage": "id-ID",
  "author": {
    "@@type": "Organization",
    "name": "PT AMV Studio Development",
    "url": "{{ url('/') }}"
  },
  "publisher": {
    "@@type": "Organization",
    "name": "PT AMV Studio Development",
    "logo": {
      "@@type": "ImageObject",
      "url": "{{ $settings['logo_path'] ?? asset('logo.png') }}"
    }
  },
  "keywords": "{{ $seoKeywords }}"
}
</script>

<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    { "@@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Insight", "item": "{{ route('news') }}" },
    { "@@type": "ListItem", "position": 3, "name": "{{ $article->title }}", "item": "{{ $articleUrl }}" }
  ]
}
</script>
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">

    {{-- Breadcrumb --}}
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-[12px] text-ink-muted mb-8 font-medium">
        <a href="{{ url('/') }}" class="hover:text-brand-900 transition-colors">Beranda</a>
        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
        <a href="{{ route('news') }}" class="hover:text-brand-900 transition-colors">Insight</a>
        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
        <span class="text-ink-main line-clamp-1">{{ $article->title }}</span>
    </nav>

    {{-- Article Header --}}
    <header class="mb-10 reveal active">
        <span class="inline-block px-3 py-1 bg-brand-50 text-brand-900 rounded-full text-[11px] font-bold uppercase tracking-wider mb-4">
            {{ $article->category }}
        </span>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-ink-main leading-tight mb-6 text-balance">
            {{ $article->title }}
        </h1>
        <div class="flex items-center gap-4 text-sm text-ink-muted font-medium flex-wrap">
            <time datetime="{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('Y-m-d') : '' }}" class="flex items-center gap-1.5">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->isoFormat('D MMMM Y') : 'Draf' }}
            </time>
            <span class="w-1.5 h-1.5 bg-brand-500 rounded-full"></span>
            <span>Oleh Editor Senior — PT AMV Studio Development</span>
        </div>
    </header>

    {{-- Hero Image --}}
    <figure class="w-full h-72 sm:h-96 rounded-3xl overflow-hidden bg-surface-light mb-10 shadow-card reveal">
        <img src="{{ (str_starts_with($article->image_path, 'http://') || str_starts_with($article->image_path, 'https://')) ? $article->image_path : Storage::url($article->image_path) }}" alt="Ilustrasi {{ $article->title }}" class="w-full h-full object-cover" loading="eager">
    </figure>

    {{-- Article Body --}}
    <article class="prose prose-lg max-w-none text-ink-main reveal">
        <div class="text-[16px] leading-[1.9] text-ink-muted whitespace-pre-wrap font-normal">{{ $article->description }}</div>
    </article>

    {{-- External Link CTA --}}
    @if($article->link && $article->link !== '#')
    <div class="mt-10 p-6 bg-brand-50 border border-brand-100 rounded-2xl flex items-center justify-between gap-4 flex-wrap reveal">
        <div>
            <p class="font-bold text-brand-900 text-sm">Baca Sumber Asli</p>
            <p class="text-[13px] text-ink-muted mt-0.5">Artikel ini memiliki referensi eksternal.</p>
        </div>
        <a href="{{ $article->link }}" target="_blank" rel="noopener noreferrer"
           class="spring-click px-5 py-2.5 bg-brand-900 text-white font-semibold text-[13px] rounded-full hover:bg-brand-800 transition-colors shadow-sm inline-flex items-center gap-2">
            Kunjungi Sumber
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
        </a>
    </div>
    @endif

    {{-- Social Share --}}
    <div class="mt-10 pt-8 border-t border-surface-border flex items-center gap-3 flex-wrap reveal">
        <span class="text-[11px] font-bold uppercase tracking-widest text-slate-400 shrink-0">Bagikan:</span>
        @php
            $encodedUrl   = urlencode($articleUrl);
            $encodedTitle = urlencode($article->title);
            $encodedText  = urlencode($article->title . ' - Baca di AMV Studio Insight');
        @endphp
        <a href="https://wa.me/?text={{ $encodedText }}%20{{ $encodedUrl }}" target="_blank" rel="noopener"
           class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#25D366] text-white text-[11px] font-bold hover:opacity-90 transition-opacity shadow-sm">
            <svg width="13" height="13" viewBox="0 0 32 32" fill="currentColor"><path d="M16 0C7.163 0 0 7.163 0 16c0 2.822.736 5.47 2.027 7.774L0 32l8.467-2.003A15.94 15.94 0 0 0 16 32c8.837 0 16-7.163 16-16S24.837 0 16 0zm0 29.333a13.27 13.27 0 0 1-6.773-1.854l-.487-.29-5.027 1.188 1.21-4.904-.32-.503A13.267 13.267 0 0 1 2.667 16C2.667 8.636 8.636 2.667 16 2.667S29.333 8.636 29.333 16 23.364 29.333 16 29.333zm7.3-9.953c-.4-.2-2.364-1.167-2.73-1.3-.367-.133-.634-.2-.9.2-.267.4-1.033 1.3-1.267 1.567-.233.267-.467.3-.867.1-.4-.2-1.687-.622-3.213-1.983-1.187-1.06-1.99-2.37-2.223-2.77-.233-.4-.025-.617.175-.817.18-.18.4-.467.6-.7.2-.233.267-.4.4-.667.133-.267.067-.5-.033-.7-.1-.2-.9-2.167-1.233-2.967-.325-.78-.656-.675-.9-.687l-.767-.013c-.267 0-.7.1-1.067.5s-1.4 1.367-1.4 3.333 1.433 3.867 1.633 4.133c.2.267 2.82 4.307 6.833 6.033.955.413 1.7.66 2.28.844.958.306 1.83.263 2.52.16.769-.115 2.364-.967 2.697-1.9.333-.933.333-1.733.233-1.9-.1-.167-.367-.267-.767-.467z"/></svg>
            WhatsApp
        </a>
        <a href="https://twitter.com/intent/tweet?text={{ $encodedTitle }}&url={{ $encodedUrl }}" target="_blank" rel="noopener"
           class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-900 text-white text-[11px] font-bold hover:opacity-90 transition-opacity shadow-sm">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.259 5.63L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            X
        </a>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $encodedUrl }}" target="_blank" rel="noopener"
           class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#0077B5] text-white text-[11px] font-bold hover:opacity-90 transition-opacity shadow-sm">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            LinkedIn
        </a>
        <button onclick="navigator.clipboard.writeText('{{ $articleUrl }}').then(()=>{alert('Tautan Tersalin!')})"
                class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white border border-slate-200 text-slate-600 text-[11px] font-bold hover:bg-slate-100 transition-all shadow-sm">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
            Salin Tautan
        </button>
    </div>

    {{-- Related Articles --}}
    @if($related->isNotEmpty())
    <section class="mt-16 pt-10 border-t border-surface-border reveal">
        <h2 class="font-bold text-ink-main text-xl mb-8">Artikel Terkait</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach($related as $rel)
            <a href="{{ route('news.show', $rel->slug) }}"
               class="group bg-surface-white border border-surface-border rounded-2xl overflow-hidden hover:shadow-card hover:border-brand-500/30 transition-all spring-click">
                <figure class="w-full h-36 overflow-hidden bg-surface-light m-0">
                    <img src="{{ (str_starts_with($rel->image_path, 'http://') || str_starts_with($rel->image_path, 'https://')) ? $rel->image_path : Storage::url($rel->image_path) }}" alt="Ilustrasi {{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                </figure>
                <div class="p-4">
                    <span class="text-[10px] font-bold text-brand-900 uppercase tracking-wider block mb-1">{{ $rel->category }}</span>
                    <h3 class="font-bold text-ink-main text-sm leading-snug group-hover:text-brand-900 transition-colors line-clamp-2">{{ $rel->title }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Back Link --}}
    <div class="mt-12 reveal">
        <a href="{{ route('news') }}" class="inline-flex items-center gap-2 text-[13px] font-semibold text-ink-muted hover:text-brand-900 transition-colors">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali ke Semua Insight
        </a>
    </div>

</div>
@endsection
