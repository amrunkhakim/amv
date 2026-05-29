<!DOCTYPE html>
<html lang="id-ID" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Access | AMV Hub</title>
    
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
                            500: '#8b5cf6', 
                            600: '#7c3aed', 
                            900: '#4c1d95',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-mesh {
            background-color: #020617;
            background-image: 
                radial-gradient(at 0% 0%, hsla(263,64%,20%,1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(242,76%,15%,1) 0, transparent 50%),
                radial-gradient(at 100% 100%, hsla(263,64%,12%,1) 0, transparent 50%),
                radial-gradient(at 0% 100%, hsla(217,91%,10%,1) 0, transparent 50%);
        }
        .glass-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .input-dark {
            background: rgba(2, 6, 23, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        .input-dark:focus {
            border-color: #8b5cf6;
            background: rgba(2, 6, 23, 0.6);
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.15);
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .float-anim { animation: float 6s ease-in-out infinite; }
    </style>
</head>
<body class="h-full flex items-center justify-center p-6 bg-mesh relative overflow-hidden">

    <!-- Decorative Elements -->
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-brand-900/20 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-900/10 rounded-full blur-[120px]"></div>

    <div class="w-full max-w-[1100px] grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
        
        <!-- Left Side: Branding -->
        <div class="hidden lg:flex flex-col space-y-8">
            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-brand-900 font-black text-3xl shadow-2xl float-anim">A</div>
            <div>
                <h1 class="text-5xl font-extrabold text-white tracking-tightest leading-tight">
                    Portal Bisnis <br> <span class="text-brand-500">PT AMV Studio.</span>
                </h1>
                <p class="text-slate-400 text-lg mt-6 leading-relaxed max-w-md font-medium">
                    Pusat kendali ekosistem digital terpadu untuk monitoring proyek, manajemen akademi, dan operasional enterprise.
                </p>
            </div>
            
            <div class="flex items-center gap-6 pt-4">
                <div class="flex -space-x-3">
                    <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-slate-800 flex items-center justify-center text-[10px] text-white font-bold">JD</div>
                    <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-brand-600 flex items-center justify-center text-[10px] text-white font-bold">MK</div>
                    <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-blue-600 flex items-center justify-center text-[10px] text-white font-bold">AS</div>
                </div>
                <div class="text-xs font-bold text-slate-500 uppercase tracking-widest">Dipercaya oleh 50+ <br> Corporate Partners</div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full max-w-md mx-auto">
            <div class="glass-card rounded-[40px] p-8 lg:p-12 shadow-2xl shadow-black/40">
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-2xl font-black text-white tracking-tight">Selamat Datang</h2>
                    <p class="text-slate-500 text-sm mt-2 font-medium">Masuk untuk mengelola dashboard Anda</p>
                </div>

                @if($errors->any())
                    <div class="mb-8 p-4 bg-red-500/10 border border-red-500/20 rounded-2xl flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-xs font-bold text-red-400">{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label for="email" class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 ml-4">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="email@amv.com" 
                                   class="input-dark w-full pl-12 pr-6 py-4 rounded-2xl outline-none font-bold text-sm">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center ml-4 mr-2">
                            <label for="password" class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">Kata Sandi</label>
                            <a href="#" class="text-[10px] font-black text-brand-500 uppercase tracking-widest hover:text-white transition-colors">Lupa?</a>
                        </div>
                        <div class="relative">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <input type="password" id="password" name="password" required placeholder="••••••••" 
                                   class="input-dark w-full pl-12 pr-6 py-4 rounded-2xl outline-none font-bold text-sm tracking-widest">
                        </div>
                    </div>

                    <div class="flex items-center gap-3 ml-4">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-slate-800 bg-slate-900 text-brand-600 focus:ring-brand-500">
                        <label for="remember" class="text-xs font-bold text-slate-500 cursor-pointer">Ingat saya untuk 30 hari</label>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full py-4 bg-brand-600 text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-brand-900/40 hover:bg-brand-500 hover:-translate-y-0.5 transition-all">
                            Masuk ke Dashboard
                        </button>
                    </div>
                </form>

                <div class="mt-10 text-center">
                    <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Secure Access Environment v2.0</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
