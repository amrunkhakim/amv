@extends('layouts.app')

@section('title', 'Solusi & Layanan | PT AMV Studio Development')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Service",
  "name": "Solusi Rekosistem Korporat & Pilar Bisnis AMV",
  "description": "Layanan rekayasa software kustom, integrasi ERP, arsitektur cloud AWS/GCP, modul AI Generatif, serta bootcamp digital Nuansa Coding Academy.",
  "provider": {
    "@@type": "Organization",
    "name": "PT AMV Studio Development"
  }
}
</script>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
    <!-- Header / Hero Layanan -->
    <header class="text-center mb-16 sm:mb-24 reveal active">
        <span class="text-brand-900 font-semibold tracking-widest text-[11px] uppercase mb-3 block">
            {{ $settings['services_badge'] ?? 'Pilar Bisnis Utama' }}
        </span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-ink-main mb-6 leading-tight max-w-4xl mx-auto text-balance">
            {{ $settings['services_title'] ?? 'Solusi Ekosistem Korporat' }}
        </h1>
        <p class="text-lg text-ink-muted max-w-2xl mx-auto leading-relaxed text-pretty">
            Meningkatkan efisiensi operasional, skalabilitas infrastruktur, dan daya saing pasar Anda dengan solusi teknologi terintegrasi.
        </p>
    </header>

    <!-- Content: List Grid Layanan (High Fidelity Cards) -->
    <section class="space-y-16 reveal">
        <!-- Part A: Enterprise Solutions (Non-Highlighted) -->
        <div>
            <h2 class="font-bold text-xl sm:text-2xl text-ink-main mb-8 flex items-center gap-3">
                <span class="w-1.5 h-6 bg-brand-500 rounded-full inline-block"></span>
                Sistem Enterprise & Arsitektur Cloud
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($services->where('is_highlighted', false) as $srv)
                <article class="group bg-surface-white border border-surface-border p-8 sm:p-10 rounded-3xl shadow-soft hover:shadow-card hover:border-brand-500/30 transition-all flex flex-col md:flex-row gap-6 items-start">
                    <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-900 flex items-center justify-center shrink-0 group-hover:bg-brand-900 group-hover:text-white transition-colors duration-300" aria-hidden="true">
                        @if($srv->svg_icon)
                            {!! $srv->svg_icon !!}
                        @else
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                        @endif
                    </div>
                    <div class="flex-grow flex flex-col justify-between h-full">
                        <div>
                            <h3 class="text-ink-main font-bold text-xl mb-3">{{ $srv->title }}</h3>
                            <p class="text-ink-muted text-[14px] leading-relaxed mb-6 text-pretty">{{ $srv->description }}</p>
                        </div>
                        <div class="flex items-center gap-4 mt-auto">
                            <a href="{{ $srv->link ?? '#' }}" class="inline-flex items-center gap-2 text-brand-900 font-bold text-[13px] hover:text-brand-800">
                                Dapatkan Penawaran <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>

        <!-- Part B: Highlighting Ecosystem & Academies (Highlighted) -->
        <div class="pt-8">
            <h2 class="font-bold text-xl sm:text-2xl text-ink-main mb-8 flex items-center gap-3">
                <span class="w-1.5 h-6 bg-brand-900 rounded-full inline-block"></span>
                Inovasi Ekosistem & Inkubasi Talenta
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($services->where('is_highlighted', true) as $srv)
                <article class="group bg-brand-900 border border-brand-800 p-8 sm:p-10 rounded-3xl shadow-modal hover:shadow-card transition-all flex flex-col justify-between relative overflow-hidden min-h-[300px]">
                    <div class="absolute right-0 top-0 w-48 h-48 bg-brand-500/20 rounded-full blur-3xl -translate-y-10 translate-x-10" aria-hidden="true"></div>
                    
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center mb-6 text-brand-900 font-bold text-xl" aria-hidden="true">
                                {{ $srv->badge ?? 'N' }}
                            </div>
                            <h3 class="text-white font-bold text-2xl mb-3">{{ $srv->title }}</h3>
                            <p class="text-brand-100 text-[14px] leading-relaxed mb-8 max-w-xl text-pretty">{{ $srv->description }}</p>
                        </div>
                        
                        <a href="{{ $srv->link ?? '#' }}" class="inline-flex items-center gap-2 text-white font-bold text-[13px] hover:underline mt-auto">
                            Daftar & Kolaborasi Sekarang <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Professional Business Consultation CTA Section -->
    <section class="mt-24 bg-surface-white border border-surface-border rounded-3xl p-8 sm:p-12 shadow-soft flex flex-col md:flex-row justify-between items-center gap-8 reveal">
        <div class="max-w-xl">
            <h3 class="font-bold text-2xl text-ink-main mb-3">Butuh Solusi IT Kustom?</h3>
            <p class="text-[14px] text-ink-muted leading-relaxed text-pretty">
                Kami siap membantu Anda merancang arsitektur sistem berskala besar, merapikan operasional ERP, atau merintis program pelatihan internal perusahaan Anda.
            </p>
        </div>
        <button onclick="openModal()" class="spring-click px-8 py-4 bg-brand-900 text-white font-semibold rounded-full hover:bg-brand-800 transition-colors shadow-md flex items-center gap-2 shrink-0">
            Jadwalkan Konsultasi Gratis
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
        </button>
    </section>
</div>
@endsection
