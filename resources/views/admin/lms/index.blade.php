@extends('layouts.app')

@section('title', 'LMS Management')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-bold text-ink-main">Manajemen LMS</h1>
            <p class="text-ink-muted">Kelola kursus, modul, dan materi pembelajaran Nuansa Coding Academy.</p>
        </div>
        <button onclick="openCourseModal()" class="px-6 py-3 bg-brand-900 text-white font-bold rounded-full hover:bg-brand-800 transition-colors shadow-md flex items-center gap-2">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Kursus
        </button>
    </header>

    <div class="grid grid-cols-1 gap-6">
        @foreach($courses as $course)
        <div class="bg-white border border-surface-border rounded-3xl p-6 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center gap-6">
                <div class="w-16 h-16 rounded-2xl bg-brand-50 flex items-center justify-center text-brand-900 font-bold text-xl overflow-hidden shrink-0">
                    @if($course->image_path)
                        <img src="{{ Storage::url($course->image_path) }}" class="w-full h-full object-cover">
                    @else
                        {{ substr($course->title, 0, 1) }}
                    @endif
                </div>
                <div>
                    <h2 class="font-bold text-xl text-ink-main">{{ $course->title }}</h2>
                    <div class="flex items-center gap-3 text-xs text-ink-muted mt-1">
                        <span>{{ $course->modules_count }} Modul</span>
                        <span class="w-1 h-1 bg-surface-border rounded-full"></span>
                        <span>{{ $course->is_published ? 'Publik' : 'Draft' }}</span>
                        <span class="w-1 h-1 bg-surface-border rounded-full"></span>
                        <span>Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-3 w-full md:w-auto">
                <button class="flex-grow md:flex-none px-4 py-2 border border-surface-border text-xs font-bold rounded-full hover:bg-surface-light transition-colors">Edit</button>
                <button class="flex-grow md:flex-none px-4 py-2 bg-red-50 text-red-600 text-xs font-bold rounded-full hover:bg-red-100 transition-colors">Hapus</button>
            </div>
        </div>
        @endforeach
    </div>

    @if($courses->isEmpty())
    <div class="p-20 text-center bg-surface-light rounded-3xl border border-dashed border-surface-border">
        <p class="text-ink-muted">Belum ada kursus. Mulai dengan membuat kursus pertama Anda.</p>
    </div>
    @endif
</div>
@endsection
