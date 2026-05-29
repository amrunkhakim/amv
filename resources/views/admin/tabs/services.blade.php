<div class="bg-white rounded-[40px] border border-slate-100 shadow-premium p-10 flex flex-col md:flex-row justify-between items-center gap-8 relative overflow-hidden mb-10">
    <div class="relative z-10">
        <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Enterprise Solutions</h3>
        <p class="text-slate-500 text-sm mt-2 font-medium">Manage the range of digital services and technological pillars offered by AMV Studio.</p>
    </div>
    <button onclick="openAddServiceModal()" class="relative z-10 px-8 py-4 bg-admin-900 text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-xl hover:-translate-y-1 transition-all">Add Service Pillar</button>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($services as $srv)
    <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-premium group transition-all duration-500 hover:shadow-hover">
        <div class="flex justify-between items-start mb-8">
            <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 group-hover:bg-brand-900 group-hover:text-white transition-all duration-500">
                {!! $srv->svg_icon !!}
            </div>
            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Order: {{ $srv->sort_order }}</span>
        </div>
        <h4 class="font-black text-slate-900 text-lg mb-3 tracking-tight">{{ $srv->title }}</h4>
        <p class="text-slate-500 text-xs leading-relaxed font-medium mb-10 line-clamp-3">{{ $srv->description }}</p>
        
        <div class="flex items-center gap-2 pt-6 border-t border-slate-50">
            <button onclick="openEditServiceModal(this)" 
                    data-id="{{ $srv->id }}" 
                    data-title="{{ $srv->title }}" 
                    data-description="{{ $srv->description }}" 
                    data-icon="{{ $srv->svg_icon }}"
                    data-order="{{ $srv->sort_order }}"
                    class="flex-1 py-3 bg-slate-50 text-slate-400 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-brand-50 hover:text-brand-600 transition-all">Modify</button>
            <form action="{{ route('admin.services.destroy', $srv->id) }}" method="POST" onsubmit="return confirm('Archive this service pillar?')">
                @csrf @method('DELETE')
                <button type="submit" class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
