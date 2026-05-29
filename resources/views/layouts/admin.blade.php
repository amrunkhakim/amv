<!DOCTYPE html>
<html lang="id-ID" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Control Center | Admin AMV</title>
    
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
                        admin: {
                            50: '#f8fafc', 100: '#f1f5f9', 800: '#1e293b', 900: '#0f172a', 950: '#020617',
                        },
                        accent: {
                            500: '#6366f1', 600: '#4f46e5', 700: '#4338ca',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-item-active { background: #0f172a; color: white; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        .tab-panel { display: none; }
        .tab-panel.active { display: block; animation: fadeIn 0.4s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="h-full flex overflow-hidden bg-slate-50">

    <!-- Sidebar Admin -->
    <aside class="hidden lg:flex w-72 bg-white border-r border-slate-200 flex-col h-full z-50">
        <div class="p-8 border-b border-slate-100 flex items-center gap-3">
            <div class="w-10 h-10 bg-admin-900 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-lg">A</div>
            <div class="flex flex-col">
                <span class="font-black text-admin-900 tracking-tight">AMV Control</span>
                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.2em]">Management Suite</span>
            </div>
        </div>

        <nav class="flex-grow px-4 space-y-1 py-8 custom-scrollbar overflow-y-auto">
            <div class="px-4 mb-4"><span class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">Dashboard</span></div>
            <button onclick="switchTab('analytics')" id="btn-analytics" class="sidebar-btn w-full flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-500 font-bold text-sm hover:bg-slate-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Site Analytics
            </button>
            <button onclick="switchTab('inquiries')" id="btn-inquiries" class="sidebar-btn w-full flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-500 font-bold text-sm hover:bg-slate-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                Inbox Client
            </button>

            <div class="pt-8 px-4 mb-4"><span class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">Content Engine</span></div>
            <button onclick="switchTab('news')" id="btn-news" class="sidebar-btn w-full flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-500 font-bold text-sm hover:bg-slate-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                Insight & Blog
            </button>
            <button onclick="switchTab('lms')" id="btn-lms" class="sidebar-btn w-full flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-500 font-bold text-sm hover:bg-slate-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                Academy (LMS)
            </button>
            <button onclick="switchTab('portfolios')" id="btn-portfolios" class="sidebar-btn w-full flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-500 font-bold text-sm hover:bg-slate-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                Showcase Portfolio
            </button>

            <div class="pt-8 px-4 mb-4"><span class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">Branding & Trust</span></div>
            <button onclick="switchTab('partners')" id="btn-partners" class="sidebar-btn w-full flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-500 font-bold text-sm hover:bg-slate-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2m16-10a4 4 0 11-8 0 4 4 0 018 0zM12 14c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"></path></svg>
                Trusted Partners
            </button>
            <button onclick="switchTab('core-values')" id="btn-core-values" class="sidebar-btn w-full flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-500 font-bold text-sm hover:bg-slate-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                Core Principles
            </button>
            <button onclick="switchTab('services')" id="btn-services" class="sidebar-btn w-full flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-500 font-bold text-sm hover:bg-slate-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
                Service Pillars
            </button>

            <div class="pt-8 px-4 mb-4"><span class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">Legal & Core</span></div>
            <button onclick="switchTab('mous')" id="btn-mous" class="sidebar-btn w-full flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-500 font-bold text-sm hover:bg-slate-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                MOU & E-Signature
            </button>
            <button onclick="switchTab('invoices')" id="btn-invoices" class="sidebar-btn w-full flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-500 font-bold text-sm hover:bg-slate-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                Finance / Invoice
            </button>
            <button onclick="switchTab('settings')" id="btn-settings" class="sidebar-btn w-full flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-slate-500 font-bold text-sm hover:bg-slate-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                Sistem & Metadata
            </button>
        </nav>

        <div class="p-6">
            <div class="bg-slate-900 rounded-[32px] p-6 text-white relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Signed in as</div>
                    <div class="font-black text-sm truncate">{{ auth()->user()->name }}</div>
                    <form action="{{ route('logout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="text-[10px] font-black uppercase tracking-widest text-brand-500 hover:text-white transition-colors">Logout Command</button>
                    </form>
                </div>
                <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-brand-900/30 rounded-full blur-2xl group-hover:bg-brand-500/20 transition-all duration-500"></div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <!-- Header -->
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-10 shrink-0">
            <div>
                <h1 id="header-tab-title" class="text-xl font-black text-admin-900 tracking-tight">Dashboard Overview</h1>
            </div>
            <div class="flex items-center gap-6">
                <div class="hidden md:flex items-center gap-3 px-4 py-2 bg-slate-50 rounded-xl border border-slate-100">
                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Server: Production</span>
                </div>
                <button class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-400 hover:border-admin-900 hover:text-admin-900 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </button>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-10 custom-scrollbar bg-slate-50/50">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-3xl mb-8 flex items-center gap-3">
                    <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path d="M5 13l4 4L19 7"></path></svg></div>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Tabs Container -->
            <div id="panel-analytics" class="tab-panel space-y-10 active">
                <!-- Analytics implementation (already existing content optimized) -->
                @include('admin.tabs.analytics')
            </div>

            <div id="panel-inquiries" class="tab-panel space-y-10">
                @include('admin.tabs.inquiries')
            </div>
            
            <div id="panel-news" class="tab-panel space-y-10">
                @include('admin.tabs.news')
            </div>

            <div id="panel-lms" class="tab-panel space-y-10">
                @include('admin.tabs.lms')
            </div>

            <div id="panel-partners" class="tab-panel space-y-10">
                @include('admin.tabs.partners')
            </div>

            <div id="panel-core-values" class="tab-panel space-y-10">
                @include('admin.tabs.core-values')
            </div>

            <div id="panel-services" class="tab-panel space-y-10">
                @include('admin.tabs.services')
            </div>

            <div id="panel-portfolios" class="tab-panel space-y-10">
                @include('admin.tabs.portfolios')
            </div>

            <div id="panel-mous" class="tab-panel space-y-10">
                @include('admin.tabs.mous')
            </div>

            <div id="panel-invoices" class="tab-panel space-y-10">
                @include('admin.tabs.invoices')
            </div>

            <div id="panel-settings" class="tab-panel space-y-10">
                @include('admin.tabs.settings')
            </div>

            @yield('content')
        </div>
    </main>

    <script>
        function switchTab(tabId) {
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.sidebar-btn').forEach(b => b.classList.remove('sidebar-item-active'));

            const panel = document.getElementById('panel-' + tabId);
            if (panel) panel.classList.add('active');
            
            const btn = document.getElementById('btn-' + tabId);
            if (btn) btn.classList.add('sidebar-item-active');

            const titles = {
                'analytics': 'Site Intelligence',
                'inquiries': 'Client Inquiries',
                'news': 'Global Insights',
                'lms': 'Academy Management',
                'portfolios': 'Enterprise Portfolio',
                'mous': 'Legal Agreements',
                'invoices': 'Financial Suite',
                'settings': 'Core Configuration'
            };
            document.getElementById('header-tab-title').innerText = titles[tabId] || 'Dashboard';
            window.location.hash = tabId;
        }

        window.addEventListener('DOMContentLoaded', () => {
            const hash = window.location.hash.replace('#', '');
            if (hash) switchTab(hash);
            else switchTab('analytics');
        });
    </script>
    @yield('scripts')
</body>
</html>
