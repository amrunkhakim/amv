@extends('layouts.portal')

@section('title', 'Akademi Belajar')
@section('page_title', 'Knowledge Center')

@section('content')
<div class="space-y-12">
    <div class="flex flex-col lg:flex-row justify-between items-end gap-8 border-b border-slate-100 pb-10">
        <div class="max-w-2xl">
            <span class="inline-block px-3 py-1 bg-brand-50 text-brand-700 text-[10px] font-black uppercase tracking-widest rounded-full mb-4">Ecosystem Education</span>
            <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Kembangkan Keahlian Digital Bersama Nuansa Academy.</h3>
            <p class="text-slate-500 text-sm mt-2 font-medium">Akses kurikulum terapan yang dirancang khusus untuk kebutuhan industri masa depan.</p>
        </div>
        <a href="{{ route('academy.index') }}" class="px-8 py-4 bg-white border border-slate-200 text-slate-900 font-extrabold text-xs rounded-2xl shadow-premium hover:bg-slate-50 transition-all flex items-center gap-3">
            Tambah Kursus Baru
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path d="M12 4v16m8-8H4"></path></svg>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($enrollments as $enrollment)
        <div class="group bg-white rounded-[40px] border border-slate-100 shadow-premium hover:shadow-hover transition-all duration-500 overflow-hidden flex flex-col">
            <div class="relative h-48 overflow-hidden">
                <img src="{{ $enrollment->course->image_path ? Storage::url($enrollment->course->image_path) : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800&auto=format&fit=crop' }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                <div class="absolute bottom-6 left-8 right-6">
                    <span class="px-2 py-0.5 bg-brand-500 text-white text-[9px] font-black uppercase tracking-widest rounded-md">Aktif</span>
                    <h4 class="text-white font-extrabold text-lg mt-2 tracking-tight line-clamp-1">{{ $enrollment->course->title }}</h4>
                </div>
            </div>
            
            <div class="p-8 flex-1 flex flex-col">
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Progress</span>
                        <span class="text-[11px] font-black text-brand-600">{{ $enrollment->progress_percent }}%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                        <div class="h-full bg-brand-500 rounded-full shadow-lg shadow-brand-500/20 transition-all duration-1000" style="width: {{ $enrollment->progress_percent }}%"></div>
                    </div>
                </div>
                
                <a href="{{ route('portal.academy.learn', $enrollment->course->slug) }}" class="mt-auto block w-full py-4 bg-brand-900 text-white text-center font-extrabold text-[11px] uppercase tracking-[0.15em] rounded-2xl shadow-xl shadow-brand-900/10 hover:-translate-y-1 transition-all">
                    Lanjutkan Belajar
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full py-24 text-center bg-white rounded-[50px] border-2 border-dashed border-slate-100">
            <div class="w-24 h-24 bg-brand-50 text-brand-600 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <h4 class="text-2xl font-black text-slate-900 tracking-tight mb-3">Belum Terdaftar di Kursus</h4>
            <p class="text-slate-500 text-sm max-w-sm mx-auto font-medium leading-relaxed">Mulailah investasi pada diri Anda dengan mendaftar di kursus pilihan kami.</p>
            <a href="{{ route('academy.index') }}" class="mt-10 inline-block px-10 py-4 bg-brand-900 text-white font-extrabold text-[11px] uppercase tracking-widest rounded-2xl shadow-2xl shadow-brand-900/20 hover:-translate-y-1 transition-all">
                Jelajahi Katalog Akademi
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
