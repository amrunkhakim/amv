@extends('layouts.app')

@section('title', $seo['title'])

@section('schema')
<script type="application/ld+json">
{!! $seo['schema'] !!}
</script>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20">
        <!-- Main Column: Syllabus -->
        <div class="lg:col-span-8">
            <nav class="flex items-center gap-2 text-[12px] text-ink-muted mb-8 font-medium">
                <a href="{{ route('home') }}" class="hover:text-brand-900">Beranda</a>
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
                <a href="{{ route('academy.index') }}" class="hover:text-brand-900">Akademi</a>
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
                <span class="text-ink-main">{{ $course->title }}</span>
            </nav>

            <header class="mb-12 reveal active">
                <h1 class="text-3xl sm:text-5xl font-bold tracking-tight text-ink-main mb-6 leading-tight">{{ $course->title }}</h1>
                <p class="text-[16px] text-ink-muted leading-relaxed mb-10 text-pretty">
                    {{ $course->description }}
                </p>
                
                <div class="flex items-center gap-8 border-y border-surface-border py-6">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-brand-900 uppercase tracking-widest">Total Modul</span>
                        <span class="text-lg font-bold text-ink-main">{{ $course->modules->count() }} Modul</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-brand-900 uppercase tracking-widest">Tingkat Kesulitan</span>
                        <span class="text-lg font-bold text-ink-main">Menengah</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-brand-900 uppercase tracking-widest">Sertifikat</span>
                        <span class="text-lg font-bold text-ink-main">Ya</span>
                    </div>
                </div>
            </header>

            <section class="reveal">
                <h2 class="text-2xl font-bold text-ink-main mb-8">Kurikulum & Silabus</h2>
                <div class="space-y-4">
                    @foreach($course->modules as $index => $module)
                    <div class="bg-white border border-surface-border rounded-2xl overflow-hidden shadow-sm">
                        <div class="p-6 flex justify-between items-center bg-surface-light/50">
                            <div>
                                <span class="text-[10px] font-bold text-brand-900 uppercase tracking-widest block mb-1">Bagian {{ $index + 1 }}</span>
                                <h3 class="font-bold text-ink-main">{{ $module->title }}</h3>
                            </div>
                            <span class="text-xs font-semibold text-ink-muted">{{ $module->lessons->count() }} Materi</span>
                        </div>
                        <ul class="divide-y divide-surface-border">
                            @foreach($module->lessons as $lIndex => $lesson)
                            <li class="px-6 py-4 flex items-center gap-3 text-sm text-ink-muted">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" class="text-brand-500" viewBox="0 0 24 24"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>{{ $lesson->title }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>

        <!-- Sidebar: Pricing & Enroll -->
        <div class="lg:col-span-4">
            <div class="sticky top-32 space-y-8">
                <div class="bg-white border border-surface-border p-8 rounded-3xl shadow-modal reveal">
                    <div class="mb-8">
                        <span class="text-[12px] font-bold text-ink-muted uppercase tracking-widest block mb-2">Harga Investasi</span>
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-bold text-ink-main">{{ $course->price > 0 ? 'Rp ' . number_format($course->price, 0, ',', '.') : 'Gratis' }}</span>
                        </div>
                    </div>

                    <form action="{{ route('academy.enroll', $course) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-4 bg-brand-900 text-white font-bold rounded-2xl hover:bg-brand-800 transition-all shadow-md flex justify-center items-center gap-3">
                            Daftar Kursus Ini
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </button>
                    </form>
                    
                    <ul class="mt-8 space-y-4">
                        <li class="flex items-start gap-3 text-[13px] text-ink-muted">
                            <svg class="w-4 h-4 text-green-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Akses materi selamanya (Lifetime Access)</span>
                        </li>
                        <li class="flex items-start gap-3 text-[13px] text-ink-muted">
                            <svg class="w-4 h-4 text-green-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Sertifikat Digital AMV Studio</span>
                        </li>
                        <li class="flex items-start gap-3 text-[13px] text-ink-muted">
                            <svg class="w-4 h-4 text-green-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Forum diskusi eksklusif bersama mentor</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
