@extends('layouts.portal')

@section('title', 'Beranda')
@section('page_title', 'Overview Hub')

@section('content')
<div class="space-y-10">
    <!-- Quick Actions / Welcome -->
    <div class="relative bg-brand-900 rounded-[40px] p-8 lg:p-12 overflow-hidden shadow-2xl shadow-brand-900/20">
        <div class="relative z-10 flex flex-col lg:flex-row justify-between items-center gap-8">
            <div class="max-w-xl text-center lg:text-left">
                <span class="inline-block px-4 py-1.5 bg-white/10 rounded-full text-[10px] font-extrabold uppercase tracking-[0.2em] text-white/80 mb-4 border border-white/10">Selamat Datang Kembali</span>
                <h2 class="text-3xl lg:text-5xl font-extrabold text-white tracking-tightest mb-4">Mulai Kolaborasi Digital Anda.</h2>
                <p class="text-white/60 text-sm lg:text-lg font-medium leading-relaxed">
                    Halo {{ explode(' ', $user->name)[0] }}, pantau seluruh progres proyek, dokumen legal, dan tingkatkan keahlian Anda di satu tempat terpusat.
                </p>
                <div class="mt-8 flex flex-wrap justify-center lg:justify-start gap-4">
                    <a href="{{ route('portal.tickets.create') }}" class="px-8 py-4 bg-white text-brand-900 font-extrabold text-sm rounded-2xl hover:shadow-xl transition-all hover:-translate-y-1">Buat Tiket Bantuan</a>
                    <a href="{{ route('academy.index') }}" class="px-8 py-4 bg-brand-800/50 text-white font-extrabold text-sm rounded-2xl border border-white/10 hover:bg-brand-800 transition-all">Jelajahi Akademi</a>
                </div>
            </div>
            <div class="hidden lg:block w-72 h-72 bg-gradient-to-br from-white/20 to-transparent rounded-full blur-3xl absolute -right-20 -top-20"></div>
            <div class="relative w-full lg:w-auto flex justify-center">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/10 w-36 text-center">
                        <div class="text-2xl font-black text-white mb-1">{{ $projectCount }}</div>
                        <div class="text-[10px] font-bold text-white/40 uppercase tracking-widest">Proyek</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/10 w-36 text-center">
                        <div class="text-2xl font-black text-white mb-1">{{ $openTickets->count() }}</div>
                        <div class="text-[10px] font-bold text-white/40 uppercase tracking-widest">Tiket</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Main Column: Active Projects -->
        <div class="lg:col-span-8 space-y-8">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Proyek Sedang Berjalan</h3>
                <a href="{{ route('portal.projects.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-900 transition-colors">Lihat Semua</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @forelse($activeProjects as $project)
                <div class="group bg-white p-7 rounded-[32px] border border-slate-100 shadow-premium hover:shadow-hover transition-all duration-500">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 group-hover:bg-brand-600 group-hover:text-white transition-all duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <span class="px-3 py-1 bg-brand-50 text-brand-700 text-[9px] font-extrabold rounded-full uppercase tracking-wider border border-brand-100">{{ $project->status }}</span>
                    </div>
                    <h4 class="font-extrabold text-slate-900 text-lg mb-2 group-hover:text-brand-900 transition-colors">{{ $project->title }}</h4>
                    <p class="text-slate-500 text-xs leading-relaxed line-clamp-2 mb-6 font-medium">{{ $project->description }}</p>
                    
                    <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Mulai</span>
                            <span class="text-[11px] font-bold text-slate-700">{{ $project->start_date?->translatedFormat('d M Y') ?? 'N/A' }}</span>
                        </div>
                        <a href="{{ route('portal.projects.show', $project) }}" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-brand-900 hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full p-12 text-center bg-white rounded-[40px] border-2 border-dashed border-slate-100">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Tidak ada proyek aktif</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar Column: Activity & Billing -->
        <div class="lg:col-span-4 space-y-8">
            <!-- Billing Card -->
            <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-premium relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="flex justify-between items-center mb-8">
                        <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <a href="{{ route('portal.invoices') }}" class="text-[10px] font-extrabold text-orange-600 uppercase tracking-widest">Detail</a>
                    </div>
                    @php
                        $unpaid = $recentInvoices->where('status', '!=', 'paid')->sum('amount');
                    @endphp
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tagihan Belum Lunas</div>
                    <div class="text-3xl font-black text-slate-900 mb-6 tracking-tightest">Rp {{ number_format($unpaid, 0, ',', '.') }}</div>
                    
                    <button class="w-full py-4 bg-slate-900 text-white font-extrabold text-xs rounded-2xl hover:bg-brand-900 transition-all shadow-lg shadow-slate-900/10">Bayar Sekarang</button>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-orange-50/50 rounded-full blur-2xl group-hover:bg-orange-100 transition-colors duration-500"></div>
            </div>

            <!-- Support Tickets -->
            <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-premium">
                <h3 class="text-lg font-extrabold text-slate-900 mb-6 tracking-tight">Tiket Terbaru</h3>
                <div class="space-y-4">
                    @forelse($openTickets->take(3) as $ticket)
                    <a href="{{ route('portal.tickets.show', $ticket) }}" class="flex items-center gap-4 p-4 rounded-2xl border border-transparent hover:bg-slate-50 hover:border-slate-100 transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-white group-hover:text-brand-600 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <div class="font-bold text-[13px] text-slate-900 truncate">{{ $ticket->subject }}</div>
                            <div class="text-[10px] font-medium text-slate-400 uppercase tracking-wider">{{ $ticket->updated_at->diffForHumans() }}</div>
                        </div>
                    </a>
                    @empty
                    <p class="text-xs font-bold text-slate-300 text-center py-4 uppercase tracking-widest">Semua Tiket Tutup</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
