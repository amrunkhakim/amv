@extends('layouts.portal')

@section('title', 'Daftar MOU')
@section('page_title', 'Legal & Documentation')

@section('content')
<div class="space-y-10">
    <div class="bg-white rounded-[40px] border border-slate-100 shadow-premium p-10 flex flex-col md:flex-row justify-between items-center gap-8 relative overflow-hidden">
        <div class="relative z-10">
            <span class="inline-block px-3 py-1 bg-brand-50 text-brand-700 text-[10px] font-black uppercase tracking-widest rounded-full mb-4">Official Agreement</span>
            <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Memorandum of Understanding</h3>
            <p class="text-slate-500 text-sm mt-2 font-medium">Seluruh dokumen kerjasama Anda tersimpan aman dengan enkripsi bank-grade.</p>
        </div>
        <div class="relative z-10 w-20 h-20 bg-brand-900 rounded-3xl flex items-center justify-center text-white shadow-2xl rotate-3 shrink-0">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
        </div>
        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-brand-50 rounded-full blur-3xl opacity-50"></div>
    </div>

    <div class="bg-white rounded-[40px] border border-slate-100 shadow-premium overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">No. Dokumen</th>
                        <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Judul Kerjasama</th>
                        <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status Legal</th>
                        <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($mous as $mou)
                    <tr class="group hover:bg-slate-50/50 transition-colors">
                        <td class="px-10 py-8">
                            <div class="font-black text-brand-900 text-xs tracking-widest">{{ $mou->mou_number }}</div>
                            <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-wider">{{ $mou->created_at->translatedFormat('d M Y') }}</div>
                        </td>
                        <td class="px-10 py-8">
                            <div class="font-extrabold text-slate-900 text-sm group-hover:text-brand-900 transition-colors">{{ $mou->title }}</div>
                            <div class="text-[10px] font-medium text-slate-400 uppercase tracking-widest mt-1">PT AMV Studio x {{ $mou->client_name }}</div>
                        </td>
                        <td class="px-10 py-8">
                            @if($mou->is_signed)
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-[9px] font-black uppercase tracking-wider rounded-full border border-emerald-100">
                                <span class="w-1 h-1 bg-emerald-600 rounded-full"></span>
                                Terverifikasi
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-orange-50 text-orange-700 text-[9px] font-black uppercase tracking-wider rounded-full border border-orange-100">
                                <span class="w-1 h-1 bg-orange-600 rounded-full animate-pulse"></span>
                                Menunggu TTD
                            </span>
                            @endif
                        </td>
                        <td class="px-10 py-8 text-right">
                            @if(!$mou->is_signed)
                            <a href="{{ route('mou.sign', $mou->verification_token) }}" target="_blank" class="inline-block px-6 py-3 bg-brand-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.15em] hover:shadow-xl hover:shadow-brand-900/20 transition-all">Tanda Tangani</a>
                            @else
                            <a href="{{ route('mou.view', $mou->verification_token) }}" target="_blank" class="inline-block px-6 py-3 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.15em] hover:bg-black transition-all">Review Dokumen</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-10 py-20 text-center">
                            <div class="text-slate-300 font-bold text-sm uppercase tracking-widest">Belum ada dokumen MOU terdaftar</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
