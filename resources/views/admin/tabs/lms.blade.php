<div class="flex flex-col gap-8">
    <div class="flex justify-between items-center px-4">
        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Active Academic Courses</h3>
        <button onclick="openAddCourseModal()" class="px-6 py-3 bg-admin-900 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl shadow-lg hover:-translate-y-0.5 transition-all">Publish New Course</button>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @forelse($courses as $course)
        <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-premium flex flex-col md:flex-row items-center gap-8 group">
            <div class="w-24 h-24 rounded-3xl bg-slate-100 overflow-hidden shrink-0 border border-slate-200">
                <img src="{{ $course->image_path ? Storage::url($course->image_path) : 'https://placehold.co/200x200?text=LMS' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            </div>
            <div class="flex-grow">
                <div class="flex items-center gap-3 mb-2">
                    <span class="px-2 py-0.5 bg-brand-50 text-brand-600 text-[9px] font-black uppercase tracking-widest rounded-md border border-brand-100">{{ $course->modules_count }} Modules</span>
                    <span class="px-2 py-0.5 {{ $course->is_published ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-slate-100 text-slate-400 border-slate-200' }} text-[9px] font-black uppercase tracking-widest rounded-md border">
                        {{ $course->is_published ? 'Live' : 'Draft' }}
                    </span>
                </div>
                <h4 class="text-lg font-black text-slate-900 tracking-tight">{{ $course->title }}</h4>
                <div class="text-[11px] font-bold text-slate-400 mt-1">Valuation: <span class="text-slate-900">Rp {{ number_format($course->price, 0, ',', '.') }}</span></div>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <button onclick="openEditCourseModal(this)" 
                        data-id="{{ $course->id }}" 
                        data-title="{{ $course->title }}" 
                        data-description="{{ $course->description }}" 
                        data-price="{{ $course->price }}" 
                        data-published="{{ $course->is_published }}"
                        class="px-5 py-2.5 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-black transition-all">Edit Suite</button>
                <form action="{{ route('admin.lms.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Archive this course?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-20 text-center bg-white rounded-[40px] border-2 border-dashed border-slate-100">
            <p class="text-xs font-black text-slate-300 uppercase tracking-widest">No active courses in catalog</p>
        </div>
        @endforelse
    </div>
</div>
