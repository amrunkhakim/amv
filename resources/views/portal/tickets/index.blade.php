@extends('layouts.portal')

@section('title', 'Tiket Support')
@section('page_title', 'Pusat Bantuan')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-brand-600 shadow-premium border border-slate-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Butuh Bantuan Teknis?</h3>
                <p class="text-slate-500 text-xs font-medium uppercase tracking-widest mt-1">Estimasi respon: <span class="text-brand-600 font-bold">< 2 Jam</span></p>
            </div>
        </div>
        <a href="{{ route('portal.tickets.create') }}" class="px-8 py-4 bg-brand-900 text-white font-extrabold text-sm rounded-2xl shadow-xl shadow-brand-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path d="M12 4v16m8-8H4"></path></svg>
            Buat Tiket Baru
        </a>
    </div>

    <div class="bg-white rounded-[40px] border border-slate-100 shadow-premium overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">ID Tiket</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Subjek Masalah</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Prioritas</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($tickets as $ticket)
                    <tr class="group hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-6">
                            <span class="text-xs font-black text-brand-900">#TCK-{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="font-extrabold text-slate-900 text-sm mb-1 group-hover:text-brand-900 transition-colors">{{ $ticket->subject }}</div>
                            <div class="text-[10px] font-medium text-slate-400 uppercase tracking-widest">Update: {{ $ticket->updated_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider {{ $ticket->priority === 'urgent' ? 'bg-red-50 text-red-600' : 'bg-brand-50 text-brand-600' }}">
                                <span class="w-1 h-1 rounded-full {{ $ticket->priority === 'urgent' ? 'bg-red-600' : 'bg-brand-600' }} animate-pulse"></span>
                                {{ $ticket->priority }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider {{ $ticket->status === 'open' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-100 text-slate-500' }}">
                                {{ $ticket->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <a href="{{ route('portal.tickets.show', $ticket) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-brand-900 transition-all">
                                Lihat Percakapan
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="text-slate-300 font-bold text-sm uppercase tracking-widest">Belum ada riwayat tiket</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
