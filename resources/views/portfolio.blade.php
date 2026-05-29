@extends('layouts.app')

@section('title', 'Portofolio Showcase | PT AMV Studio Development')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "CreativeWorkPortfolio",
  "name": "Portofolio Solusi Digital - PT AMV Studio Development",
  "description": "Showcase produk software enterprise, sistem KasirKUY, ERP, dan aplikasi terintegrasi digital PT AMV Studio Development.",
  "creator": {
    "@@type": "Organization",
    "name": "PT AMV Studio Development"
  }
}
</script>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
    <!-- Header / Hero Portofolio -->
    <header class="text-center mb-16 sm:mb-24 reveal active">
        <span class="text-brand-900 font-semibold tracking-widest text-[11px] uppercase mb-3 block">
            {{ $settings['portfolio_badge'] ?? 'Showcase Teknologi' }}
        </span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-ink-main mb-6 leading-tight max-w-4xl mx-auto text-balance">
            {{ $settings['portfolio_title'] ?? 'Portofolio Enterprise' }}
        </h1>
        <p class="text-lg text-ink-muted max-w-2xl mx-auto leading-relaxed text-pretty">
            {{ $settings['portfolio_subtitle'] ?? 'Inovasi yang menghubungkan sistem kompleks menjadi pengalaman digital tanpa batas (seamless).' }}
        </p>
    </header>

    <!-- Grid Portofolio Terbuka (Open Portfolio Grid for detail exploration) -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 reveal">
        @foreach($portfolios as $port)
        <article class="group bg-surface-white border border-surface-border rounded-3xl overflow-hidden shadow-soft hover:shadow-card hover:border-brand-500/30 transition-all flex flex-col h-full">
            <figure class="relative w-full h-56 overflow-hidden bg-surface-light m-0">
                <img src="{{ (str_starts_with($port->image_path, 'http://') || str_starts_with($port->image_path, 'https://')) ? $port->image_path : Storage::url($port->image_path) }}" alt="Screenshot {{ $port->title }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500 ease-out" loading="lazy">
                <span class="absolute top-4 left-4 px-3 py-1 bg-white/95 backdrop-blur-sm rounded-full text-[10px] font-bold text-brand-900 uppercase tracking-wider shadow-sm">
                    {{ $port->category }}
                </span>
            </figure>
            
            <div class="p-6 sm:p-8 flex flex-col flex-grow">
                <h3 class="font-bold text-ink-main text-lg mb-2 group-hover:text-brand-900 transition-colors">
                    {{ $port->title }}
                </h3>
                <p class="text-[13px] text-ink-muted leading-relaxed mb-6 text-pretty line-clamp-4">
                    {{ $port->description }}
                </p>
                <div class="mt-auto pt-4 border-t border-surface-border flex items-center justify-between">
                    <span class="text-[11px] font-medium text-ink-muted">Prod ID: #AMV-00{{ $port->id }}</span>
                    <a href="{{ $port->link ?? '#' }}" class="spring-click px-4 py-2 bg-brand-50 hover:bg-brand-900 text-brand-900 hover:text-white font-bold text-[12px] rounded-full transition-colors inline-flex items-center gap-1.5 shadow-sm">
                        Kunjungi Demo 
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
            </div>
        </article>
        @endforeach
    </section>

    <!-- Project Collaboration CTA Section -->
    <section class="mt-24 bg-brand-900 border border-brand-800 text-white rounded-3xl p-8 sm:p-12 relative overflow-hidden reveal">
        <div class="absolute right-0 top-0 w-64 h-64 bg-brand-500/20 rounded-full blur-3xl -translate-y-10 translate-x-10" aria-hidden="true"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="max-w-2xl">
                <h3 class="font-bold text-2xl sm:text-3xl text-white mb-3">Siap Mengukir Sejarah Digital Baru Bersama Kami?</h3>
                <p class="text-[14px] text-brand-100 leading-relaxed text-pretty">
                    Beri tahu kami tantangan bisnis Anda. Dari skalabilitas server, integrasi IoT, hingga dasbor analitik real-time, kami memiliki keahlian rekayasa untuk mewujudkannya.
                </p>
            </div>
            <button onclick="openModal()" class="spring-click px-8 py-4 bg-white text-brand-900 font-semibold rounded-full hover:bg-brand-50 transition-colors shadow-md flex items-center gap-2 shrink-0">
                Hubungi Kami Sekarang
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>
        </div>
    </section>
</div>
@endsection
