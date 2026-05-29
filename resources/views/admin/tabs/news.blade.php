<div class="flex flex-col gap-8">
    <div class="flex justify-between items-center px-4">
        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Latest Published Insights</h3>
        <button onclick="openAddNewsModal()" class="px-6 py-3 bg-admin-900 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl shadow-lg hover:-translate-y-0.5 transition-all">Create Article</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        @foreach($news as $article)
        <div class="bg-white rounded-[40px] border border-slate-100 shadow-premium overflow-hidden group">
            <div class="relative h-48 overflow-hidden">
                <img src="{{ (str_starts_with($article->image_path, 'http')) ? $article->image_path : Storage::url($article->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
                <div class="absolute top-6 left-6">
                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md text-white text-[9px] font-black uppercase tracking-widest rounded-lg border border-white/10">{{ $article->category }}</span>
                </div>
            </div>
            <div class="p-8">
                <h4 class="font-black text-slate-900 text-lg mb-2 line-clamp-2">{{ $article->title }}</h4>
                <p class="text-xs font-medium text-slate-400 leading-relaxed mb-6">{{ \Illuminate\Support\Str::limit($article->description, 80) }}</p>
                <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">{{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}</span>
                    <div class="flex items-center gap-2">
                        <button onclick="openEditNewsModal(this)" 
                                data-id="{{ $article->id }}" 
                                data-category="{{ $article->category }}" 
                                data-title="{{ $article->title }}" 
                                data-description="{{ $article->description }}" 
                                data-date="{{ $article->published_at }}" 
                                data-order="{{ $article->sort_order }}" 
                                data-link="{{ $article->link }}" 
                                data-url="{{ $article->image_path }}"
                                class="w-8 h-8 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-brand-50 hover:text-brand-600 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                        <form action="{{ route('admin.news.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Delete this article?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-xl bg-slate-50 flex items-center justify-center text-slate-300 hover:bg-red-50 hover:text-red-500 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
