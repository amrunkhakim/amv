<article id="news-{{ $article->id }}" class="bg-surface-white border border-surface-border rounded-3xl overflow-hidden shadow-soft hover:shadow-card transition-all flex flex-col md:flex-row scroll-mt-24">
    <figure class="w-full md:w-80 h-64 md:h-auto overflow-hidden bg-surface-light relative m-0 shrink-0">
        <img src="{{ (str_starts_with($article->image_path, 'http')) ? $article->image_path : Storage::url($article->image_path) }}" alt="Ilustrasi {{ $article->title }}" class="w-full h-full object-cover" loading="lazy">
        <figcaption class="absolute top-4 left-4 px-3 py-1 bg-white/95 backdrop-blur-sm rounded-full text-[10px] font-bold text-brand-900 uppercase tracking-wider shadow-sm">
            {{ $article->category }}
        </figcaption>
    </figure>
    
    <div class="p-6 sm:p-8 flex flex-col justify-between flex-grow">
        <div>
            <div class="flex items-center gap-4 text-xs font-semibold text-ink-muted mb-3">
                <time datetime="{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('Y-m-d') : '' }}" class="flex items-center gap-1.5">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->isoFormat('D MMMM Y') : 'Draf' }}
                </time>
                <span class="w-1.5 h-1.5 bg-brand-500 rounded-full inline-block"></span>
                <span>Oleh Editor Senior</span>
            </div>
            <h2 class="font-bold text-ink-main text-xl sm:text-2xl leading-snug mb-3 hover:text-brand-900 transition-colors">
                {{ $article->title }}
            </h2>
            <p class="text-[14px] text-ink-muted leading-relaxed mb-6 text-pretty line-clamp-3">
                {{ $article->description }}
            </p>
        </div>
        <div class="flex items-center justify-between pt-4 border-t border-surface-border mt-auto">
            <a href="{{ route('news.show', $article->slug) }}"
               class="spring-click px-5 py-2.5 bg-brand-900 text-white font-bold text-[13px] rounded-full hover:bg-brand-800 transition-colors inline-flex items-center gap-1.5 shadow-sm">
                Baca Artikel Lengkap
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </div>
</article>
