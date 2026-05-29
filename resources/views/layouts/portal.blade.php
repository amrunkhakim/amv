<!DOCTYPE html>
<html lang="id-ID" class="h-full bg-[#f8fafc]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | AMV Hub</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#f5f3ff', 100: '#ede9fe', 500: '#8b5cf6', 
                            600: '#7c3aed', 800: '#5b21b6', 900: '#4c1d95',
                        },
                        surface: { 
                            bg: '#f8fafc',
                            card: '#ffffff',
                            border: '#f1f5f9',
                            muted: '#94a3b8'
                        },
                        ink: { main: '#0f172a', muted: '#64748b' }
                    },
                    boxShadow: {
                        'premium': '0 10px 30px -10px rgba(0,0,0,0.04), 0 4px 10px -5px rgba(0,0,0,0.02)',
                        'hover': '0 20px 40px -15px rgba(76,29,149,0.08)',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-sidebar { background: rgba(76, 29, 149, 0.98); backdrop-filter: blur(12px); }
        .active-link { background: rgba(255, 255, 255, 0.1); border-left: 4px solid #ffffff; }
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="h-full flex overflow-hidden">

    <!-- Sidebar Desktop -->
    <aside id="sidebar" class="hidden lg:flex w-72 glass-sidebar text-white flex-col h-full z-50 transition-all duration-500 ease-in-out relative shadow-2xl">
        <div class="p-8 flex items-center gap-4">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-brand-900 font-extrabold text-xl shadow-lg transform -rotate-3 hover:rotate-0 transition-transform duration-300">A</div>
            <div class="flex flex-col">
                <span class="font-extrabold text-lg tracking-tight">AMV Hub</span>
                <span class="text-[10px] font-bold text-white/50 uppercase tracking-[0.2em]">Client Portal</span>
            </div>
        </div>

        <nav class="flex-grow px-4 space-y-1.5 py-6 custom-scrollbar overflow-y-auto">
            <div class="px-4 mb-3">
                <span class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-white/30">Utama</span>
            </div>
            
            <a href="{{ route('portal.dashboard') }}" class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-soft group {{ request()->routeIs('portal.dashboard') ? 'active-link' : 'hover:bg-white/5' }}">
                <svg class="w-5 h-5 transition-soft {{ request()->routeIs('portal.dashboard') ? 'text-white' : 'text-white/40 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="text-[14px] font-semibold">Beranda</span>
            </a>

            <a href="{{ route('portal.projects.index') }}" class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-soft group {{ request()->routeIs('portal.projects.*') ? 'active-link' : 'hover:bg-white/5' }}">
                <svg class="w-5 h-5 transition-soft {{ request()->routeIs('portal.projects.*') ? 'text-white' : 'text-white/40 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <span class="text-[14px] font-semibold">Proyek Saya</span>
            </a>

            <a href="{{ route('portal.tickets.index') }}" class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-soft group {{ request()->routeIs('portal.tickets.*') ? 'active-link' : 'hover:bg-white/5' }}">
                <svg class="w-5 h-5 transition-soft {{ request()->routeIs('portal.tickets.*') ? 'text-white' : 'text-white/40 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                <span class="text-[14px] font-semibold">Tiket Support</span>
            </a>

            <div class="pt-8 px-4 mb-3">
                <span class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-white/30">Ecosystem</span>
            </div>

            <a href="{{ route('portal.academy.index') }}" class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-soft group {{ request()->routeIs('portal.academy.*') ? 'active-link' : 'hover:bg-white/5' }}">
                <svg class="w-5 h-5 transition-soft {{ request()->routeIs('portal.academy.*') ? 'text-white' : 'text-white/40 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span class="text-[14px] font-semibold">Akademi Belajar</span>
            </a>

            <a href="{{ route('portal.mous') }}" class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-soft group {{ request()->routeIs('portal.mous') ? 'active-link' : 'hover:bg-white/5' }}">
                <svg class="w-5 h-5 transition-soft {{ request()->routeIs('portal.mous') ? 'text-white' : 'text-white/40 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="text-[14px] font-semibold">E-Signature MOU</span>
            </a>

            <a href="{{ route('portal.invoices') }}" class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-soft group {{ request()->routeIs('portal.invoices') ? 'active-link' : 'hover:bg-white/5' }}">
                <svg class="w-5 h-5 transition-soft {{ request()->routeIs('portal.invoices') ? 'text-white' : 'text-white/40 group-hover:text-white' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="text-[14px] font-semibold">Billing (Invoice)</span>
            </a>
        </nav>

        <div class="p-6">
            <div class="bg-white/5 rounded-3xl p-5 border border-white/10 relative overflow-hidden">
                <div class="flex items-center gap-3 mb-4 relative z-10">
                    <div class="w-10 h-10 rounded-full bg-white text-brand-900 flex items-center justify-center font-bold shadow-lg">{{ substr(auth()->user()->name, 0, 1) }}</div>
                    <div class="flex flex-col overflow-hidden">
                        <span class="font-bold text-sm truncate">{{ auth()->user()->name }}</span>
                        <span class="text-[10px] text-white/50 font-bold uppercase tracking-wider">Client</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-2.5 bg-white/10 hover:bg-red-500/20 text-white rounded-xl text-xs font-bold transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Mobile Header -->
    <div class="lg:hidden flex flex-col flex-1 overflow-hidden">
        <header class="bg-white border-b border-slate-100 px-6 py-4 flex justify-between items-center shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-brand-900 rounded-lg flex items-center justify-center text-white font-extrabold">A</div>
                <span class="font-extrabold text-lg text-brand-900">AMV Hub</span>
            </div>
            <button onclick="toggleMobileMenu()" class="p-2 bg-slate-50 rounded-xl text-brand-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </header>

        <!-- Main Scrollable Content -->
        <main class="flex-1 overflow-y-auto custom-scrollbar p-6 lg:p-12 pb-24 lg:pb-12">
            <!-- Breadcrumbs / Top Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-10">
                <div>
                    <nav class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.15em] text-slate-400 mb-2">
                        <span>AMV HUB</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
                        <span class="text-brand-600">@yield('title')</span>
                    </nav>
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">@yield('page_title', 'Dashboard')</h1>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-xs font-bold text-slate-900 leading-none">{{ now()->translatedFormat('l, d F Y') }}</span>
                        <span class="text-[10px] font-medium text-slate-400 mt-1">Status Sistem: <span class="text-green-500 font-bold">Optimal</span></span>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-3xl shadow-soft mb-8 flex items-center gap-3 reveal">
                    <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white shrink-0"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path d="M5 13l4 4L19 7"></path></svg></div>
                    <span class="font-bold text-sm leading-tight">{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Layout Desktop Container -->
    <div class="hidden lg:flex flex-col flex-1 overflow-hidden">
        <header class="h-20 border-b border-slate-100 flex items-center justify-end px-12 gap-8 bg-white/50 backdrop-blur-md sticky top-0 z-40">
             <div class="relative group">
                <button class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-brand-900 hover:bg-brand-50 transition-all relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                </button>
             </div>
             
             <div class="h-8 w-[1px] bg-slate-100"></div>
             
             <div class="flex items-center gap-3">
                 <div class="text-right">
                     <div class="text-[13px] font-extrabold text-slate-900 leading-none">{{ auth()->user()->name }}</div>
                     <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-wider">Corporate Client</div>
                 </div>
                 <div class="w-10 h-10 rounded-xl bg-brand-900 text-white flex items-center justify-center font-bold shadow-soft">{{ substr(auth()->user()->name, 0, 1) }}</div>
             </div>
        </header>

        <main class="flex-1 overflow-y-auto custom-scrollbar p-12 bg-surface-bg">
            <!-- Breadcrumbs -->
            <div class="flex items-center justify-between gap-6 mb-12">
                <div>
                    <nav class="flex items-center gap-2 text-[11px] font-extrabold uppercase tracking-[0.2em] text-slate-400 mb-3">
                        <span>AMV HUB</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 5l7 7-7 7"></path></svg>
                        <span class="text-brand-600">@yield('title')</span>
                    </nav>
                    <h1 class="text-4xl font-extrabold text-slate-900 tracking-tightest">@yield('page_title', 'Overview Dashboard')</h1>
                </div>

                <div class="flex items-center gap-4 bg-white p-3 rounded-2xl border border-slate-100 shadow-premium">
                    <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="pr-4">
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Hari Ini</span>
                        <span class="block text-sm font-extrabold text-slate-900 leading-none">{{ now()->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-5 rounded-3xl shadow-premium mb-10 flex items-center gap-4 transition-all duration-500 transform hover:scale-[1.01]">
                    <div class="w-10 h-10 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-emerald-200/50"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path d="M5 13l4 4L19 7"></path></svg></div>
                    <div>
                        <div class="font-extrabold text-sm tracking-tight">Proses Berhasil</div>
                        <div class="text-xs font-medium opacity-80">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Mobile Menu Sheet -->
    <div id="mobile-overlay" onclick="toggleMobileMenu()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 hidden opacity-0 transition-all duration-300"></div>
    <div id="mobile-sidebar" class="fixed top-0 bottom-0 left-0 w-80 glass-sidebar z-50 transform -translate-x-full transition-all duration-500 ease-in-out p-8 flex flex-col">
        <div class="flex justify-between items-center mb-10">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-brand-900 font-bold">A</div>
                <span class="font-bold text-lg text-white">AMV Hub</span>
            </div>
            <button onclick="toggleMobileMenu()" class="p-2 text-white/50 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <nav class="flex-grow space-y-2">
             <a href="{{ route('portal.dashboard') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl text-white {{ request()->routeIs('portal.dashboard') ? 'bg-white/10' : '' }}">Dashboard</a>
             <a href="{{ route('portal.projects.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl text-white {{ request()->routeIs('portal.projects.*') ? 'bg-white/10' : '' }}">Proyek Saya</a>
             <a href="{{ route('portal.tickets.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl text-white {{ request()->routeIs('portal.tickets.*') ? 'bg-white/10' : '' }}">Tiket Support</a>
             <a href="{{ route('portal.academy.index') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl text-white {{ request()->routeIs('portal.academy.*') ? 'bg-white/10' : '' }}">Akademi Belajar</a>
             <a href="{{ route('portal.mous') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl text-white {{ request()->routeIs('portal.mous') ? 'bg-white/10' : '' }}">E-Signature MOU</a>
             <a href="{{ route('portal.invoices') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl text-white {{ request()->routeIs('portal.invoices') ? 'bg-white/10' : '' }}">Billing (Invoice)</a>
        </nav>
        
        <div class="pt-6 border-t border-white/10">
             <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-4 bg-red-500/20 text-red-200 rounded-2xl font-bold">Logout</button>
            </form>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('mobile-overlay');
            const isHidden = sidebar.classList.contains('-translate-x-full');

            if (isHidden) {
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.add('opacity-100'), 10);
                sidebar.classList.remove('-translate-x-full');
            } else {
                overlay.classList.remove('opacity-100');
                setTimeout(() => overlay.classList.add('hidden'), 300);
                sidebar.classList.add('-translate-x-full');
            }
        }
    </script>
    @yield('scripts')
</body>
</html>
