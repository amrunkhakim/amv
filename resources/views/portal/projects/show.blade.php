@extends('layouts.portal')

@section('title', $project->title)
@section('page_title', 'Project Roadmap')

@section('content')
<div class="max-w-5xl mx-auto space-y-10">
    <div class="bg-white rounded-[40px] border border-slate-100 shadow-premium overflow-hidden">
        <div class="bg-brand-900 p-10 lg:p-12 text-white relative">
            <div class="relative z-10">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                    <span class="px-4 py-1.5 bg-white/10 rounded-full text-[10px] font-black uppercase tracking-[0.2em] text-white/80 border border-white/10">ID: #PRJ-{{ str_pad($project->id, 4, '0', STR_PAD_LEFT) }}</span>
                    <span class="px-4 py-1.5 bg-emerald-500 text-white rounded-full text-[10px] font-black uppercase tracking-[0.2em] shadow-lg shadow-emerald-500/20">{{ $project->status }}</span>
                </div>
                <h2 class="text-3xl lg:text-5xl font-black tracking-tightest leading-tight mb-4">{{ $project->title }}</h2>
                <p class="text-white/60 text-sm lg:text-lg font-medium max-w-2xl leading-relaxed">{{ $project->description }}</p>
            </div>
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
        </div>

        <div class="p-10 lg:p-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12">
                <div class="space-y-6">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Timeline & Milestone</h3>
                    <div class="flex items-center gap-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-brand-50 flex items-center justify-center text-brand-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1.5">Kick-off</span>
                                <span class="block text-sm font-black text-slate-900 tracking-tight">{{ $project->start_date?->translatedFormat('d M Y') ?? 'TBA' }}</span>
                            </div>
                        </div>
                        <div class="w-8 h-[1px] bg-slate-100 hidden sm:block"></div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1.5">Estimasi Selesai</span>
                                <span class="block text-sm font-black text-slate-900 tracking-tight">{{ $project->end_date?->translatedFormat('d M Y') ?? 'TBA' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Manajer Proyek</h3>
                    <div class="flex items-center gap-4 p-4 rounded-3xl bg-slate-50 border border-slate-100">
                        <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center font-black text-brand-900 shadow-sm border border-slate-100">A</div>
                        <div>
                            <div class="text-sm font-black text-slate-900 tracking-tight">Technical Lead AMV</div>
                            <div class="text-[10px] font-bold text-brand-600 uppercase tracking-widest">Enterprise Division</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-10 border-t border-slate-50">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Arsip Dokumen Proyek</h3>
                    <span class="text-[9px] font-black uppercase tracking-widest text-brand-500 bg-brand-50 px-2 py-1 rounded-md">Sedang Sinkronisasi</span>
                </div>
                <div class="p-10 text-center bg-slate-50 rounded-[32px] border-2 border-dashed border-slate-100">
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Akses repository & dokumentasi sedang disiapkan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
