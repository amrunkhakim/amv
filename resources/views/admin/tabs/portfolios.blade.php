<div class="flex flex-col gap-8">
    <div class="flex justify-between items-center px-4">
        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Project Showcases</h3>
        <button onclick="openAddPortfolioModal()" class="px-6 py-3 bg-admin-900 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl shadow-lg hover:-translate-y-0.5 transition-all">Add Showcase</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        @foreach($portfolios as $port)
        <div class="bg-white rounded-[40px] border border-slate-100 shadow-premium overflow-hidden group">
            <div class="relative h-48 overflow-hidden">
                <img src="{{ $port->image_path }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-slate-900/20"></div>
            </div>
            <div class="p-8">
                <span class="text-[9px] font-black text-brand-600 uppercase tracking-widest">{{ $port->category }}</span>
                <h4 class="font-black text-slate-900 text-lg mt-1 mb-6 tracking-tight line-clamp-1">{{ $port->title }}</h4>
                <div class="flex items-center gap-2 pt-6 border-t border-slate-50">
                    <button class="flex-1 py-3 bg-slate-50 text-slate-400 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-brand-50 hover:text-brand-600 transition-all">Edit Suite</button>
                    <form action="{{ route('admin.portfolios.destroy', $port->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
