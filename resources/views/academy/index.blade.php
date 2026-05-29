@extends('layouts.app')

@section('title', $seo['title'])

@section('schema')
<script type="application/ld+json">
{!! $seo['schema'] !!}
</script>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-24">
    <header class="text-center mb-16 sm:mb-24 reveal active">
        <span class="text-brand-900 font-semibold tracking-widest text-[11px] uppercase mb-3 block">Inisiatif Pendidikan AMV</span>
        <h1 class="text-4xl sm:text-6xl font-bold tracking-tight text-ink-main mb-6 leading-tight text-balance">Nuansa Coding Academy</h1>
        <p class="text-lg text-ink-muted max-w-2xl mx-auto leading-relaxed text-pretty">
            Mencetak talenta digital siap kerja melalui kurikulum terapan yang disusun bersama praktisi dan akademisi berpengalaman.
        </p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-12">
        @forelse($courses as $course)
        <article class="reveal group flex flex-col bg-white border border-surface-border rounded-3xl overflow-hidden shadow-soft hover:shadow-card transition-all">
            <figure class="relative w-full h-52 overflow-hidden bg-surface-light m-0">
                <img src="{{ $course->image_path ? Storage::url($course->image_path) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800&auto=format&fit=crop' }}" 
                     alt="{{ $course->title }}" 
                     class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500">
                <div class="absolute top-4 right-4 px-3 py-1 bg-brand-900 text-white text-[10px] font-bold rounded-full uppercase shadow-sm">
                    {{ $course->price > 0 ? 'Rp ' . number_format($course->price, 0, ',', '.') : 'Gratis' }}
                </div>
            </figure>
            
            <div class="p-8 flex flex-col flex-grow">
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-[10px] font-bold text-brand-900 uppercase tracking-widest">{{ $course->modules_count }} Modul</span>
                </div>
                <h2 class="font-bold text-ink-main text-xl mb-3 group-hover:text-brand-900 transition-colors">
                    {{ $course->title }}
                </h2>
                <p class="text-[14px] text-ink-muted leading-relaxed mb-8 line-clamp-3 text-pretty">
                    {{ $course->description }}
                </p>
                <div class="mt-auto pt-6 border-t border-surface-border flex items-center justify-between">
                    <a href="{{ route('academy.show', $course) }}" class="text-brand-900 font-bold text-[13px] hover:underline flex items-center gap-1.5">
                        Lihat Silabus
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </a>
                    <form action="{{ route('academy.enroll', $course) }}" method="POST">
                        @csrf
                        <button type="submit" class="spring-click px-5 py-2.5 bg-brand-900 text-white font-bold text-[12px] rounded-full hover:bg-brand-800 transition-colors shadow-sm">
                            Daftar Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-full py-20 text-center">
            <p class="text-ink-muted">Belum ada kursus yang tersedia saat ini.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
