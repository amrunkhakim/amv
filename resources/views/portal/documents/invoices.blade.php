@extends('layouts.portal')

@section('title', 'Daftar Invoice')
@section('page_title', 'Billing & Financials')

@section('content')
<div class="space-y-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @php
            $totalAmount = $invoices->sum('amount');
            $unpaidCount = $invoices->where('status', '!=', 'paid')->count();
            $paidAmount = $invoices->where('status', 'paid')->sum('amount');
        @endphp
        <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-premium">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Investasi</div>
            <div class="text-2xl font-black text-slate-900 tracking-tightest">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
        </div>
        <div class="bg-brand-900 p-8 rounded-[40px] shadow-2xl shadow-brand-900/20">
            <div class="text-[10px] font-black text-white/50 uppercase tracking-widest mb-2">Tagihan Aktif</div>
            <div class="text-2xl font-black text-white tracking-tightest">{{ $unpaidCount }} Invoice</div>
        </div>
        <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-premium">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Terbayar</div>
            <div class="text-2xl font-black text-emerald-600 tracking-tightest">Rp {{ number_format($paidAmount, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="bg-white rounded-[40px] border border-slate-100 shadow-premium overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">No. Invoice</th>
                        <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Tanggal Terbit</th>
                        <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Jumlah Tagihan</th>
                        <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($invoices as $inv)
                    <tr class="group hover:bg-slate-50/50 transition-colors">
                        <td class="px-10 py-8">
                            <div class="font-black text-slate-900 text-sm">#{{ $inv->invoice_number }}</div>
                        </td>
                        <td class="px-10 py-8">
                            <div class="text-sm font-bold text-slate-600">{{ $inv->issued_date->translatedFormat('d M Y') }}</div>
                            <div class="text-[10px] font-medium text-slate-400 uppercase tracking-widest mt-1 text-red-500">Jatuh Tempo: {{ $inv->due_date->translatedFormat('d M Y') }}</div>
                        </td>
                        <td class="px-10 py-8">
                            <div class="text-lg font-black text-slate-900 tracking-tight">Rp {{ number_format($inv->amount, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-10 py-8">
                            @if($inv->status === 'paid')
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-[9px] font-black uppercase tracking-wider rounded-full border border-emerald-100">Lunas</span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-orange-50 text-orange-700 text-[9px] font-black uppercase tracking-wider rounded-full border border-orange-100">Belum Bayar</span>
                            @endif
                        </td>
                        <td class="px-10 py-8 text-right">
                            <a href="{{ route('invoice.view', $inv->verification_token) }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-black transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Lihat Invoice
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-10 py-20 text-center">
                            <div class="text-slate-300 font-bold text-sm uppercase tracking-widest">Belum ada riwayat tagihan</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
