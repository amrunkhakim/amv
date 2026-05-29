<div class="bg-white rounded-[40px] border border-slate-100 shadow-premium p-10 flex flex-col md:flex-row justify-between items-center gap-8 relative overflow-hidden mb-10">
    <div class="relative z-10">
        <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Core Values</h3>
        <p class="text-slate-500 text-sm mt-2 font-medium">Define the foundational principles that drive AMV Studio Development.</p>
    </div>
    <div class="relative z-10 w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 shadow-sm">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12l2 2 4-4M7.835 4.697a.747.747 0 00-.114-.145L4.566 1.4a.75.75 0 00-1.06 1.06l3.155 3.155a.75.75 0 001.06-1.06l-3.155-3.155zM12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12 19.5a7.5 7.5 0 110-15 7.5 7.5 0 010 15z"></path></svg>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($coreValues as $val)
    <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-premium group transition-all duration-500 hover:shadow-hover">
        <div class="w-14 h-14 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 mb-6 group-hover:bg-brand-900 group-hover:text-white transition-all duration-500">
            {!! $val->svg_icon !!}
        </div>
        <h4 class="font-black text-slate-900 text-lg mb-3">{{ $val->title }}</h4>
        <p class="text-slate-500 text-xs leading-relaxed font-medium mb-8 line-clamp-3">{{ $val->description }}</p>
        
        <button onclick="openEditCoreValueModal(this)" 
                data-id="{{ $val->id }}" 
                data-title="{{ $val->title }}" 
                data-description="{{ $val->description }}" 
                data-icon="{{ $val->svg_icon }}"
                class="w-full py-3.5 bg-slate-50 text-slate-400 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-brand-50 hover:text-brand-600 transition-all">
            Update Principle
        </button>
    </div>
    @endforeach
</div>
