@extends('layouts.portal')

@section('title', 'Proyek Saya')
@section('page_title', 'Manajemen Proyek')

@section('content')
<div class="space-y-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($projects as $project)
        <div class="group bg-white rounded-[40px] border border-slate-100 shadow-premium hover:shadow-hover transition-all duration-500 overflow-hidden flex flex-col">
            <div class="p-8 flex-1">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 group-hover:bg-brand-900 group-hover:text-white transition-all duration-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2M7 7h10"></path></svg>
                    </div>
                    <span class="px-3 py-1 bg-brand-50 text-brand-700 text-[9px] font-extrabold rounded-full uppercase tracking-wider border border-brand-100 transition-colors group-hover:bg-white group-hover:text-brand-900">{{ $project->status }}</span>
                </div>
                
                <h3 class="text-xl font-extrabold text-slate-900 mb-3 group-hover:text-brand-900 transition-colors tracking-tight">{{ $project->title }}</h3>
                <p class="text-slate-500 text-[13px] leading-relaxed line-clamp-3 mb-8 font-medium">{{ $project->description }}</p>
                
                <div class="grid grid-cols-2 gap-4 pt-6 border-t border-slate-50">
                    <div class="flex flex-col">
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Mulai</span>
                        <span class="text-[12px] font-extrabold text-slate-700">{{ $project->start_date?->translatedFormat('d M Y') ?? '-' }}</span>
                    </div>
                    <div class="flex flex-col text-right">
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Estimasi</span>
                        <span class="text-[12px] font-extrabold text-slate-700">{{ $project->end_date?->translatedFormat('d M Y') ?? '-' }}</span>
                    </div>
                </div>
            </div>
            
            <a href="{{ route('portal.projects.show', $project) }}" class="block w-full py-5 bg-slate-50 text-center text-[11px] font-extrabold uppercase tracking-widest text-slate-400 group-hover:bg-brand-900 group-hover:text-white transition-all duration-300">
                Detail Proyek
            </a>
        </div>
        @empty
        <div class="col-span-full p-20 text-center bg-white rounded-[50px] border-2 border-dashed border-slate-100">
            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 text-slate-300">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <h4 class="text-xl font-extrabold text-slate-900 mb-2">Belum Ada Proyek</h4>
            <p class="text-slate-400 text-sm max-w-sm mx-auto font-medium">Hubungi admin atau mulai konsultasi project untuk memulai kolaborasi digital Anda.</p>
            <button onclick="window.parent.openModal()" class="mt-8 px-8 py-3.5 bg-brand-900 text-white font-extrabold text-xs rounded-2xl shadow-xl shadow-brand-900/10 hover:-translate-y-1 transition-all">Mulai Konsultasi</button>
        </div>
        @endforelse
    </div>
</div>
@endsection
