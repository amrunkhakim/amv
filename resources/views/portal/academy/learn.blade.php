@extends('layouts.portal')

@section('title', $course->title)
@section('page_title', 'Learning Console')

@section('content')
<div class="h-full flex flex-col lg:flex-row -m-12 bg-white min-h-[calc(100vh-80px)]">
    
    <!-- Sidebar: Curriculum Navigation -->
    <aside class="w-full lg:w-96 bg-slate-50 border-r border-slate-100 flex flex-col h-full order-2 lg:order-1">
        <div class="p-8 border-b border-slate-200/60 bg-white">
            <h2 class="text-lg font-black text-slate-900 leading-tight mb-6 tracking-tight">{{ $course->title }}</h2>
            <div>
                <div class="flex justify-between items-center text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">
                    <span>Progress Belajar</span>
                    <span class="text-brand-600">{{ $enrollment->progress_percent }}%</span>
                </div>
                <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden border border-slate-200/50">
                    <div class="h-full bg-brand-500 rounded-full shadow-lg shadow-brand-500/20 transition-all duration-1000" style="width: {{ $enrollment->progress_percent }}%"></div>
                </div>
            </div>
        </div>

        <div class="flex-grow overflow-y-auto custom-scrollbar">
            @foreach($course->modules as $mIndex => $module)
            <div class="border-b border-slate-100">
                <div class="px-8 py-5 bg-slate-50/50">
                    <span class="text-[9px] font-black text-brand-500 uppercase tracking-[0.2em] block mb-1">Modul {{ $mIndex + 1 }}</span>
                    <h3 class="text-xs font-extrabold text-slate-900 tracking-tight">{{ $module->title }}</h3>
                </div>
                <nav class="flex flex-col">
                    @foreach($module->lessons as $lIndex => $lItem)
                    <a href="{{ route('portal.academy.learn', [$course->slug, $lItem->slug]) }}" 
                       class="px-8 py-4 text-[13px] flex items-center gap-4 transition-all {{ $lesson && $lesson->id === $lItem->id ? 'bg-white text-brand-900 font-black border-r-4 border-brand-900' : 'text-slate-500 hover:bg-white hover:text-slate-900 font-medium' }}">
                        <div class="w-6 h-6 rounded-lg flex items-center justify-center shrink-0 {{ $lesson && $lesson->id === $lItem->id ? 'bg-brand-900 text-white' : 'bg-slate-200/50 text-slate-400' }}">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path></svg>
                        </div>
                        <span class="truncate">{{ $lItem->title }}</span>
                    </a>
                    @endforeach
                </nav>
            </div>
            @endforeach
        </div>
    </aside>

    <!-- Main Content: Lesson Player/Text -->
    <main class="flex-grow bg-white overflow-y-auto custom-scrollbar p-8 lg:p-16 order-1 lg:order-2">
        @if($lesson)
        <div class="max-w-4xl mx-auto space-y-12">
            <header>
                <div class="flex items-center gap-3 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">
                    <span class="truncate max-w-[150px]">{{ $lesson->module->title }}</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
                    <span class="text-brand-600 truncate">{{ $lesson->title }}</span>
                </div>
                <h1 class="text-3xl lg:text-5xl font-black text-slate-900 tracking-tightest leading-tight">{{ $lesson->title }}</h1>
            </header>

            @if($lesson->video_url)
            <div class="aspect-video w-full rounded-[40px] overflow-hidden bg-slate-900 shadow-2xl relative group">
                @php
                    $isYoutube = str_contains($lesson->video_url, 'youtube.com') || str_contains($lesson->video_url, 'youtu.be');
                @endphp
                @if($isYoutube)
                    @php
                        $vidId = '';
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $lesson->video_url, $match)) {
                            $vidId = $match[1];
                        }
                    @endphp
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $vidId }}?modestbranding=1&rel=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                    <video src="{{ $lesson->video_url }}" class="w-full h-full" controls></video>
                @endif
                <div class="absolute inset-0 pointer-events-none border-[12px] border-white/5 rounded-[40px]"></div>
            </div>
            @endif

            <article class="prose prose-slate prose-lg max-w-none">
                <div class="text-[17px] leading-[2] text-slate-600 font-medium whitespace-pre-wrap">{{ $lesson->content }}</div>
            </article>

            <div class="pt-12 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-6">
                <button class="w-full sm:w-auto px-8 py-4 rounded-2xl border border-slate-200 text-[11px] font-black uppercase tracking-widest text-slate-400 hover:bg-slate-50 transition-all disabled:opacity-50">
                    Materi Sebelumnya
                </button>
                <button class="w-full sm:w-auto px-10 py-5 bg-brand-900 text-white rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] shadow-2xl shadow-brand-900/30 hover:-translate-y-1 transition-all">
                    Selesai & Lanjutkan
                </button>
            </div>
        </div>
        @else
        <div class="flex flex-col items-center justify-center h-full text-center py-20">
            <div class="w-24 h-24 bg-brand-50 rounded-full flex items-center justify-center mb-8 text-brand-900 shadow-premium">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tightest mb-4">Siap Belajar Hari Ini?</h2>
            <p class="text-slate-500 text-sm max-w-sm mx-auto font-medium leading-relaxed">Silakan pilih materi di panel navigasi untuk memulai perjalanan pembelajaran Anda.</p>
        </div>
        @endif
    </main>
</div>
@endsection
