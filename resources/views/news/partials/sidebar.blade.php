<aside class="lg:col-span-4 flex flex-col gap-8">
    <!-- Newsletter Widget -->
    <div class="bg-brand-950 border border-brand-900 p-8 rounded-3xl text-white relative overflow-hidden shadow-modal">
        <div class="absolute right-0 top-0 w-32 h-32 bg-brand-500/20 rounded-full blur-2xl -translate-y-10 translate-x-10" aria-hidden="true"></div>
        
        <h3 class="font-bold text-lg mb-3 relative z-10">Dapatkan Insight Premium</h3>
        <p class="text-[13px] text-brand-200 leading-relaxed mb-6 relative z-10">
            Daftarkan email korporat Anda untuk menerima buletin dwi-mingguan berisi bedah arsitektur sistem, optimalisasi AI, dan penawaran khusus.
        </p>
        <form class="relative z-10 flex flex-col gap-3" onsubmit="event.preventDefault(); alert('Terima kasih! Email Anda telah terdaftar.'); this.reset();">
            <input type="email" placeholder="nama@perusahaan.com" required class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-sm placeholder-brand-200/60 focus:bg-white/20 outline-none transition-all text-white">
            <button type="submit" class="spring-click w-full py-3 bg-white text-brand-950 font-semibold text-[13px] rounded-xl hover:bg-brand-50 transition-colors shadow-sm">
                Berlangganan
            </button>
        </form>
    </div>

    <!-- Jurnal Kategori -->
    <div class="bg-surface-white border border-surface-border p-8 rounded-3xl shadow-soft">
        <h3 class="font-bold text-ink-main text-[16px] mb-4 pb-2 border-b border-surface-border">Kategori Jurnal</h3>
        <ul class="flex flex-col gap-3 text-[13px] text-ink-muted">
            <li class="flex justify-between items-center hover:text-brand-900 transition-colors cursor-pointer">
                <span>AI & Machine Learning</span>
                <span class="px-2 py-0.5 rounded-full bg-brand-50 text-brand-900 font-bold text-[10px]">Eksklusif</span>
            </li>
            <li class="flex justify-between items-center hover:text-brand-900 transition-colors cursor-pointer">
                <span>Arsitektur Cloud & Serverless</span>
                <span class="px-2 py-0.5 rounded-full bg-surface-light text-ink-muted font-bold text-[10px]">Populer</span>
            </li>
            <li class="flex justify-between items-center hover:text-brand-900 transition-colors cursor-pointer">
                <span>Enterprise Software Engineering</span>
                <span class="px-2 py-0.5 rounded-full bg-surface-light text-ink-muted font-bold text-[10px]">Rilis</span>
            </li>
            <li class="flex justify-between items-center hover:text-brand-900 transition-colors cursor-pointer">
                <span>Pendidikan & Inkubasi Talenta</span>
                <span class="px-2 py-0.5 rounded-full bg-surface-light text-ink-muted font-bold text-[10px]">Akademi</span>
            </li>
        </ul>
    </div>
</aside>
