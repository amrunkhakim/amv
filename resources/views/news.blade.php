@extends('layouts.app')

@section('title', $seo['title'])

@section('schema')
<script type="application/ld+json">
{!! $seo['schema'] !!}
</script>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
    <header class="mb-16 reveal">
        <span class="text-brand-900 font-semibold tracking-widest text-[11px] uppercase mb-3 block">{{ $settings['news_badge'] ?? 'Pemikiran & Inovasi' }}</span>
        <h1 class="text-3xl sm:text-5xl font-bold tracking-tight text-ink-main mb-6 text-balance">
            {{ $settings['news_title'] ?? 'Insight Teknologi Global' }}
        </h1>
        <p class="text-lg text-ink-muted max-w-3xl leading-relaxed text-pretty">
            {{ $settings['news_subtitle'] ?? 'Kumpulan jurnal, studi kasus, dan pandangan strategis mengenai arsitektur sistem, kecerdasan buatan, dan transformasi digital untuk masa depan.' }}
        </p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-12">
        @forelse($news as $article)
        <article class="reveal">
            <a href="{{ route('news.show', $article->slug) }}" class="news-card group flex flex-col spring-click rounded-2xl overflow-hidden border border-transparent hover:border-surface-border hover:shadow-card transition-all bg-surface-white">
                <figure class="w-full h-56 overflow-hidden bg-surface-light relative m-0">
                    <img src="{{ (str_starts_with($article->image_path, 'http://') || str_starts_with($article->image_path, 'https://')) ? $article->image_path : Storage::url($article->image_path) }}" 
                         alt="Ilustrasi {{ $article->title }}" 
                         class="news-img w-full h-full object-cover transition-transform duration-500 ease-out" 
                         loading="lazy">
                    <figcaption class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-[10px] font-bold text-ink-main uppercase tracking-wider shadow-sm">
                        {{ $article->category }}
                    </figcaption>
                </figure>
                <div class="p-6 flex flex-col flex-grow">
                    <time datetime="{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('Y-m-d') : '' }}" class="text-[12px] font-medium text-ink-muted mb-3 flex items-center gap-2">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->isoFormat('D MMMM Y') : 'Draf' }}
                    </time>
                    <h2 class="font-bold text-ink-main text-[18px] leading-snug group-hover:text-brand-900 transition-colors mb-3 line-clamp-2">
                        {{ $article->title }}
                    </h2>
                    <p class="text-[14px] text-ink-muted leading-relaxed line-clamp-3 mb-6 text-pretty">
                        {{ $article->description }}
                    </p>
                    <span class="text-[13px] font-semibold text-brand-900 inline-flex items-center gap-1 hover:underline mt-auto">
                        Baca Selengkapnya <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </span>
                </div>
            </a>
        </article>
        @empty
        <div class="col-span-full py-20 text-center reveal">
            <div class="w-16 h-16 bg-surface-light rounded-full flex items-center justify-center mx-auto mb-4 text-ink-muted">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-ink-main mb-2">Belum Ada Insight Tersedia</h3>
            <p class="text-ink-muted">Kami sedang menyiapkan konten berkualitas untuk Anda. Silakan kembali lagi nanti.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
