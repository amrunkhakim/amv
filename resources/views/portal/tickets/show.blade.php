@extends('layouts.portal')

@section('title', $ticket->subject)
@section('page_title', 'Ticket Discussion')

@section('content')
<div class="max-w-4xl mx-auto space-y-10">
    <!-- Ticket Summary Card -->
    <div class="bg-white rounded-[40px] border border-slate-100 shadow-premium overflow-hidden">
        <div class="p-8 lg:p-10">
            <div class="flex flex-col sm:flex-row justify-between items-start gap-6 mb-8">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-[10px] font-black text-brand-900 uppercase tracking-widest bg-brand-50 px-2 py-1 rounded">#TCK-{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}</span>
                        <span class="px-2 py-1 bg-slate-50 text-slate-400 text-[9px] font-black uppercase tracking-wider rounded border border-slate-100">{{ $ticket->priority }} priority</span>
                    </div>
                    <h2 class="text-2xl lg:text-3xl font-extrabold text-slate-900 tracking-tight">{{ $ticket->subject }}</h2>
                </div>
                <span class="px-4 py-1.5 {{ $ticket->status === 'open' ? 'bg-emerald-500' : 'bg-slate-400' }} text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-full shadow-lg">
                    {{ $ticket->status }}
                </span>
            </div>
            
            <div class="p-8 bg-slate-50 rounded-3xl text-sm lg:text-[15px] text-slate-600 leading-relaxed font-medium border border-slate-100">
                {{ $ticket->message }}
            </div>
            <div class="mt-6 text-[10px] text-slate-400 font-bold uppercase tracking-widest flex items-center gap-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Diajukan pada {{ $ticket->created_at->translatedFormat('d M Y, H:i') }}
            </div>
        </div>
    </div>

    <!-- Replies Section -->
    <div class="space-y-6">
        <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Percakapan Bantuan</h3>
        
        <div class="space-y-6">
            @foreach($ticket->replies as $reply)
            <div class="flex {{ $reply->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-[85%] sm:max-w-[70%] space-y-2">
                    <div class="flex items-center gap-3 {{ $reply->user_id === auth()->id() ? 'justify-end' : 'justify-start' }} px-4">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $reply->user->name }}</span>
                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                        <span class="text-[10px] font-bold text-slate-300 italic">{{ $reply->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="p-6 rounded-[32px] shadow-premium border {{ $reply->user_id === auth()->id() ? 'bg-brand-900 text-white border-brand-800 rounded-tr-none' : 'bg-white text-slate-600 border-slate-100 rounded-tl-none' }}">
                        <p class="text-sm font-medium leading-relaxed">{{ $reply->message }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Reply Form -->
    @if($ticket->status !== 'closed')
    <div class="bg-white rounded-[40px] border border-slate-100 shadow-premium p-8 lg:p-10">
        <h3 class="text-lg font-extrabold text-slate-900 mb-6 tracking-tight">Kirim Balasan</h3>
        <form action="{{ route('portal.tickets.reply', $ticket) }}" method="POST">
            @csrf
            <textarea name="message" rows="4" required placeholder="Tulis pesan Anda di sini..." 
                      class="w-full px-6 py-5 rounded-3xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-medium text-slate-700 shadow-sm resize-none leading-relaxed placeholder:text-slate-300 mb-6"></textarea>
            <div class="flex justify-end">
                <button type="submit" class="px-10 py-4 bg-brand-900 text-white font-black text-[11px] uppercase tracking-[0.2em] rounded-2xl hover:shadow-xl transition-all hover:-translate-y-1">
                    Kirim Balasan
                </button>
            </div>
        </form>
    </div>
    @else
    <div class="p-10 text-center bg-slate-100 rounded-[40px] border-2 border-dashed border-slate-200">
        <p class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Tiket ini telah ditutup</p>
    </div>
    @endif
</div>
@endsection
