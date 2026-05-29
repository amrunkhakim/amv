<div class="space-y-12 pb-20">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- 1. IDENTITY & SEO -->
        <section class="bg-white rounded-[40px] border border-slate-100 shadow-premium p-10 relative overflow-hidden mb-8">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-12 h-12 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9h18"></path></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Identity & Global SEO</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Site Title</label>
                        <input type="text" name="site_title" value="{{ $settings['site_title'] ?? '' }}" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Site Tagline</label>
                        <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? '' }}" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Meta Keywords</label>
                        <textarea name="meta_keywords" rows="1" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-medium text-sm resize-none">{{ $settings['meta_keywords'] ?? '' }}</textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Meta Description</label>
                        <textarea name="meta_description" rows="2" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-medium text-sm resize-none leading-relaxed">{{ $settings['meta_description'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </section>

        <!-- 2. HERO SECTION CONTROL -->
        <section class="bg-white rounded-[40px] border border-slate-100 shadow-premium p-10 relative overflow-hidden mb-8">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Hero Section (Beranda)</h3>
            </div>

            <div class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Hero Badge Text</label>
                        <input type="text" name="hero_badge_text" value="{{ $settings['hero_badge_text'] ?? '' }}" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Hero Button CTA</label>
                        <input type="text" name="hero_button_text" value="{{ $settings['hero_button_text'] ?? '' }}" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-bold text-sm">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Hero Main Title</label>
                    <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? '' }}" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-black text-lg">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-4">Hero Subtitle</label>
                    <textarea name="hero_subtitle" rows="3" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:bg-white focus:border-brand-500 transition-all font-medium text-sm resize-none leading-relaxed">{{ $settings['hero_subtitle'] ?? '' }}</textarea>
                </div>
            </div>
        </section>

        <!-- 3. SECTION CONTENT & BADGES -->
        <section class="bg-white rounded-[40px] border border-slate-100 shadow-premium p-10 relative overflow-hidden mb-8">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Section Management (Titles & Badges)</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                <!-- About -->
                <div class="space-y-4 p-6 bg-slate-50/50 rounded-3xl border border-slate-100">
                    <h4 class="text-xs font-black text-brand-600 uppercase tracking-widest ml-2 mb-4">About Section</h4>
                    <input type="text" name="about_badge" value="{{ $settings['about_badge'] ?? '' }}" placeholder="Badge" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold mb-2">
                    <input type="text" name="about_title" value="{{ $settings['about_title'] ?? '' }}" placeholder="Title" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold">
                    <textarea name="about_description" rows="3" placeholder="Description" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs mt-2">{{ $settings['about_description'] ?? '' }}</textarea>
                </div>
                <!-- Services -->
                <div class="space-y-4 p-6 bg-slate-50/50 rounded-3xl border border-slate-100">
                    <h4 class="text-xs font-black text-brand-600 uppercase tracking-widest ml-2 mb-4">Services Section</h4>
                    <input type="text" name="service_badge" value="{{ $settings['service_badge'] ?? '' }}" placeholder="Badge" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold mb-2">
                    <input type="text" name="service_title" value="{{ $settings['service_title'] ?? '' }}" placeholder="Title" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold">
                    <input type="text" name="service_subtitle" value="{{ $settings['service_subtitle'] ?? '' }}" placeholder="Subtitle" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs">
                </div>
                <!-- Portfolio -->
                <div class="space-y-4 p-6 bg-slate-50/50 rounded-3xl border border-slate-100">
                    <h4 class="text-xs font-black text-brand-600 uppercase tracking-widest ml-2 mb-4">Portfolio Section</h4>
                    <input type="text" name="portfolio_badge" value="{{ $settings['portfolio_badge'] ?? '' }}" placeholder="Badge" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold mb-2">
                    <input type="text" name="portfolio_title" value="{{ $settings['portfolio_title'] ?? '' }}" placeholder="Title" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold">
                    <input type="text" name="portfolio_subtitle" value="{{ $settings['portfolio_subtitle'] ?? '' }}" placeholder="Subtitle" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs">
                </div>
                <!-- News -->
                <div class="space-y-4 p-6 bg-slate-50/50 rounded-3xl border border-slate-100">
                    <h4 class="text-xs font-black text-brand-600 uppercase tracking-widest ml-2 mb-4">News/Insight Section</h4>
                    <input type="text" name="news_badge" value="{{ $settings['news_badge'] ?? '' }}" placeholder="Badge" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold mb-2">
                    <input type="text" name="news_title" value="{{ $settings['news_title'] ?? '' }}" placeholder="Title" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold">
                    <input type="text" name="news_subtitle" value="{{ $settings['news_subtitle'] ?? '' }}" placeholder="Subtitle" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs">
                </div>
            </div>
        </section>

        <!-- 4. CONTACT & FOOTER -->
        <section class="bg-white rounded-[40px] border border-slate-100 shadow-premium p-10 relative overflow-hidden mb-8">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Contact Information & Socials</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="space-y-4">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400">Communication</label>
                    <input type="text" name="email" value="{{ $settings['email'] ?? '' }}" placeholder="Email" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-100 text-sm font-bold">
                    <input type="text" name="phone" value="{{ $settings['phone'] ?? '' }}" placeholder="Phone" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-100 text-sm font-bold">
                    <input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}" placeholder="WhatsApp Number" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-100 text-sm font-bold">
                </div>
                <div class="space-y-4">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400">Social Media Links</label>
                    <input type="text" name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}" placeholder="Instagram URL" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-100 text-sm font-bold">
                    <input type="text" name="linkedin_url" value="{{ $settings['linkedin_url'] ?? '' }}" placeholder="LinkedIn URL" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-100 text-sm font-bold">
                    <input type="text" name="github_url" value="{{ $settings['github_url'] ?? '' }}" placeholder="GitHub URL" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-100 text-sm font-bold">
                </div>
                <div class="space-y-4">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400">Office Address</label>
                    <textarea name="address" rows="5" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-100 text-sm font-bold resize-none leading-relaxed">{{ $settings['address'] ?? '' }}</textarea>
                </div>
            </div>
        </section>

        <!-- SAVE BUTTON STICKY -->
        <div class="fixed bottom-10 right-10 z-50">
            <button type="submit" class="group flex items-center gap-4 px-10 py-5 bg-admin-900 text-white font-black text-sm uppercase tracking-[0.3em] rounded-full shadow-2xl hover:bg-black transition-all transform hover:-translate-y-1">
                Save All Changes
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </form>
</div>
