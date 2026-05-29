<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm relative overflow-hidden group">
        <div class="relative z-10">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Pageviews</div>
            <div class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($totalPageviews) }}</div>
        </div>
        <div class="absolute -right-2 -bottom-2 w-16 h-16 bg-slate-50 rounded-full group-hover:bg-brand-50 transition-colors"></div>
    </div>
    <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm relative overflow-hidden group">
        <div class="relative z-10">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Unique Visitors</div>
            <div class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($uniqueVisitors) }}</div>
        </div>
        <div class="absolute -right-2 -bottom-2 w-16 h-16 bg-slate-50 rounded-full group-hover:bg-brand-50 transition-colors"></div>
    </div>
    <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm relative overflow-hidden group">
        <div class="relative z-10">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">AI Crawler Detection</div>
            <div class="text-3xl font-black text-brand-600 tracking-tight">{{ $aiBotsCount }}</div>
        </div>
        <div class="absolute -right-2 -bottom-2 w-16 h-16 bg-brand-50 rounded-full"></div>
    </div>
    <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm relative overflow-hidden group">
        <div class="relative z-10">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">SEO Health Score</div>
            <div class="text-3xl font-black {{ $seoScore >= 80 ? 'text-emerald-600' : 'text-orange-600' }} tracking-tight">{{ $seoScore }}%</div>
        </div>
        <div class="absolute -right-2 -bottom-2 w-16 h-16 bg-slate-50 rounded-full"></div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 bg-white rounded-[32px] border border-slate-100 shadow-sm p-8">
        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-8">Top Visited Resources</h3>
        <div class="space-y-6">
            @foreach($topPages as $page)
            <div class="flex items-center justify-between group">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-2 rounded-full bg-slate-200 group-hover:bg-brand-500 transition-colors"></div>
                    <span class="text-sm font-bold text-slate-600 tracking-tight">{{ $page->uri }}</span>
                </div>
                <span class="text-xs font-black text-slate-900">{{ number_format($page->views) }} views</span>
            </div>
            @endforeach
        </div>
    </div>
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm p-8">
        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-8">Browser Ecosystem</h3>
        <div class="space-y-6">
            @foreach($browsers as $br)
            <div class="flex justify-between items-center">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ $br->browser }}</span>
                <span class="text-xs font-black text-slate-900">{{ $br->count }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
