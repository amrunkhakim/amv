@extends('layouts.portal')

@section('title', 'Buat Tiket Baru')
@section('page_title', 'Support Request')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-[40px] border border-slate-100 shadow-premium p-10 lg:p-12 relative overflow-hidden">
        <div class="relative z-10">
            <header class="mb-10">
                <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Kirim Permintaan Bantuan</h3>
                <p class="text-slate-500 text-sm mt-2 font-medium leading-relaxed text-pretty">Ceritakan kendala Anda secara detail, tim teknis kami akan segera membantu mencarikan solusi terbaik.</p>
            </header>

            <form action="{{ route('portal.tickets.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="space-y-2">
                    <label for="subject" class="block text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Subjek Masalah</label>
                    <input type="text" id="subject" name="subject" required placeholder="Contoh: Kendala akses login dashboard" 
                           class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-slate-900 shadow-sm placeholder:text-slate-300">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="priority" class="block text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Tingkat Prioritas</label>
                        <select id="priority" name="priority" required 
                                class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-slate-900 shadow-sm appearance-none cursor-pointer">
                            <option value="low">Rendah (Low)</option>
                            <option value="normal" selected>Normal</option>
                            <option value="high">Tinggi (High)</option>
                            <option value="urgent">Mendesak (Urgent)</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-4 bg-brand-50/50 p-6 rounded-2xl border border-brand-100 mt-6 md:mt-0">
                        <div class="w-10 h-10 rounded-full bg-brand-500 text-white flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-[10px] font-bold text-brand-900 leading-relaxed uppercase tracking-wider">Kami merespon prioritas "Urgent" dalam waktu kurang dari 30 menit.</p>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="message" class="block text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Deskripsi Lengkap</label>
                    <textarea id="message" name="message" rows="6" required placeholder="Jelaskan kendala Anda sedetail mungkin agar kami dapat membantu lebih cepat..." 
                              class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-medium text-slate-700 shadow-sm resize-none leading-relaxed placeholder:text-slate-300"></textarea>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-5 bg-brand-900 text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl hover:shadow-2xl hover:shadow-brand-900/40 hover:-translate-y-1 transition-all">
                        Kirim Tiket Sekarang
                    </button>
                </div>
            </form>
        </div>
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-slate-50 rounded-full blur-3xl opacity-50"></div>
    </div>
</div>
@endsection
