@extends('layouts.app')

@section('title', 'Tentang Kami | PT AMV Studio Development')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "AboutPage",
  "name": "Tentang Kami - PT AMV Studio Development",
  "description": "Sejarah, visi misi, dan komitmen PT AMV Studio Development dari inisiatif independen AmrunDev 2018 hingga bertransformasi menjadi Software House Skala Korporat Global pada 2022.",
  "publisher": {
    "@@type": "Organization",
    "name": "PT AMV Studio Development",
    "logo": {
      "@@type": "ImageObject",
      "url": "{{ isset($settings['logo_path']) ? Storage::url($settings['logo_path']) : asset('logo.png') }}"
    }
  }
}
</script>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
    <!-- Header / Hero Tentang -->
    <header class="text-center mb-16 sm:mb-24 reveal active">
        <span class="text-brand-900 font-semibold tracking-widest text-[11px] uppercase mb-3 block">
            {{ $settings['about_badge'] ?? 'Sejarah & Transformasi' }}
        </span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-ink-main mb-6 leading-tight max-w-4xl mx-auto text-balance">
            {{ $settings['about_title'] ?? 'Dari Independen menuju Skala Korporat Global.' }}
        </h1>
        <p class="text-lg text-ink-muted max-w-2xl mx-auto leading-relaxed text-pretty">
            Membangun masa depan digital yang tangguh, efisien, dan inklusif bagi korporasi modern melalui rekayasa perangkat lunak kelas dunia.
        </p>
    </header>

    <!-- Content: Deskripsi Utama -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start mb-24 reveal">
        <!-- Visi & Misi Ringkas -->
        <div class="lg:col-span-5 flex flex-col gap-6">
            <div class="bg-surface-white border border-surface-border p-8 rounded-3xl shadow-soft">
                <h2 class="font-bold text-ink-main text-lg mb-4 flex items-center gap-2">
                    <span class="w-2 h-6 bg-brand-900 rounded-full inline-block"></span>
                    Visi Kami
                </h2>
                <p class="text-[14px] leading-relaxed text-ink-muted">
                    Menjadi pelopor solusi arsitektur cloud dan ekosistem digital terintegrasi dari Indonesia yang diakui secara global, memberdayakan industri, dan mencetak talenta digital terbaik.
                </p>
            </div>
            
            <div class="bg-surface-white border border-surface-border p-8 rounded-3xl shadow-soft">
                <h2 class="font-bold text-ink-main text-lg mb-4 flex items-center gap-2">
                    <span class="w-2 h-6 bg-brand-900 rounded-full inline-block"></span>
                    Misi Utama
                </h2>
                <ul class="text-[14px] leading-relaxed text-ink-muted flex flex-col gap-3 list-disc pl-5">
                    <li>Mengembangkan arsitektur software tangguh yang scalable bagi korporat global.</li>
                    <li>Mengakselerasi transisi dan adopsi AI, Cloud, serta Otomasi bisnis.</li>
                    <li>Membuka gerbang pendidikan terapan terintegrasi guna memberdayakan inovator muda.</li>
                </ul>
            </div>
        </div>

        <!-- Paragraf Sejarah Panjang -->
        <div class="lg:col-span-7 bg-surface-white border border-surface-border p-8 sm:p-10 rounded-3xl shadow-soft flex flex-col gap-6">
            <h2 class="font-bold text-ink-main text-2xl tracking-tight">Kisah Perjalanan & Transformasi</h2>
            <div class="prose text-ink-muted text-[15px] leading-relaxed flex flex-col gap-6">
                <p>
                    {!! $settings['about_desc_1'] ?? 'Berawal dari sebuah inisiatif independen bernama <strong class="text-ink-main font-semibold">AmrunDev</strong> pada tahun 2018, kami memulai langkah dengan semangat murni untuk menyelesaikan masalah melalui baris-baris kode.' !!}
                </p>
                <p>
                    {!! $settings['about_desc_2'] ?? 'Seiring kompleksitas dan kepercayaan klien yang terus bertumbuh, tahun 2022 menjadi tonggak sejarah ketika kami bertransformasi dan resmi berbadan hukum sebagai PT AMV Studio Development. Kami bukan lagi sekadar pembuat software; kami adalah mitra strategis transformasi digital Anda.' !!}
                </p>
                <p>
                    Hari ini, dengan kantor pusat di Pekalongan, Jawa Tengah, kami bangga dapat melayani klien dari skala UMKM unggulan hingga institusi pendidikan, korporat perbankan, dan jaringan ritel nasional. Melalui integrasi tanpa batas antara arsitektur sistem modern dan pelatihan talenta terarah, kami meretas batas digital setiap harinya.
                </p>
            </div>
        </div>
    </section>

    <!-- Timeline Perjalanan (Milestones) -->
    <section class="mb-24 reveal">
        <h2 class="text-center font-bold text-2xl sm:text-3xl text-ink-main mb-12">Milestone Sejarah Kami</h2>
        
        <div class="relative border-l border-surface-border ml-4 sm:mx-auto max-w-4xl space-y-12">
            <!-- 2018 -->
            <div class="relative pl-8 sm:pl-10">
                <div class="absolute -left-2 top-1.5 w-4 h-4 rounded-full bg-brand-900 border-4 border-white shadow-sm" aria-hidden="true"></div>
                <span class="text-xs font-bold text-brand-900 tracking-wider uppercase">Tahun 2018</span>
                <h3 class="font-bold text-lg text-ink-main mt-1">Lahirnya AmrunDev</h3>
                <p class="text-[14px] text-ink-muted leading-relaxed mt-2">
                    Didirikan sebagai komunitas developer independen untuk membangun website dinamis, aplikasi web kustom, serta membantu digitalisasi usaha lokal di Jawa Tengah.
                </p>
            </div>

            <!-- 2020 -->
            <div class="relative pl-8 sm:pl-10">
                <div class="absolute -left-2 top-1.5 w-4 h-4 rounded-full bg-brand-500 border-4 border-white shadow-sm" aria-hidden="true"></div>
                <span class="text-xs font-bold text-brand-500 tracking-wider uppercase">Tahun 2020</span>
                <h3 class="font-bold text-lg text-ink-main mt-1">Ekspansi ke Sistem Cloud & ERP</h3>
                <p class="text-[14px] text-ink-muted leading-relaxed mt-2">
                    Mulai menangani proyek arsitektur cloud terdistribusi, sistem manajemen inventaris berskala besar, serta integrasi gateway pembayaran eksternal untuk retail.
                </p>
            </div>

            <!-- 2022 -->
            <div class="relative pl-8 sm:pl-10">
                <div class="absolute -left-2 top-1.5 w-4 h-4 rounded-full bg-brand-900 border-4 border-white shadow-sm" aria-hidden="true"></div>
                <span class="text-xs font-bold text-brand-900 tracking-wider uppercase">Tahun 2022</span>
                <h3 class="font-bold text-lg text-ink-main mt-1">Transformasi Hukum: PT AMV Studio Development</h3>
                <p class="text-[14px] text-ink-muted leading-relaxed mt-2">
                    Resmi berbadan hukum perseroan terbatas, meluncurkan lini bisnis pelatihan "Nuansa Coding Academy", serta mematangkan sistem tata kelola ISO 27001 Certified Enterprise Architecture.
                </p>
            </div>

            <!-- 2026 -->
            <div class="relative pl-8 sm:pl-10">
                <div class="absolute -left-2 top-1.5 w-4 h-4 rounded-full bg-green-600 border-4 border-white shadow-sm" aria-hidden="true"></div>
                <span class="text-xs font-bold text-green-600 tracking-wider uppercase">Tahun Kini (2026)</span>
                <h3 class="font-bold text-lg text-ink-main mt-1">Era Integrasi AI & Keamanan Skala Global</h3>
                <p class="text-[14px] text-ink-muted leading-relaxed mt-2">
                    Meningkatkan kapabilitas platform dengan modul AI Generatif terenkripsi, optimalisasi server edge nirsentuh, serta kemitraan formal dengan universitas riset global terkemuka.
                </p>
            </div>
        </div>
    </section>

    <!-- Core Values Section (Dynamic) -->
    <section class="bg-surface-light border border-surface-border p-8 sm:p-12 rounded-3xl reveal">
        <div class="max-w-3xl mx-auto text-center mb-10">
            <h2 class="font-bold text-2xl sm:text-3xl text-ink-main mb-4">{{ $settings['core_values_title'] ?? 'Nilai Inti (Core Values)' }}</h2>
            <p class="text-[14px] text-ink-muted leading-relaxed">
                Prinsip-prinsip fundamental yang memandu setiap baris kode, keputusan manajemen, dan interaksi kami bersama seluruh klien strategis.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($coreValues as $val)
            <div class="bg-surface-white border border-surface-border p-6 rounded-2xl shadow-sm hover:shadow-card transition-shadow">
                <div class="w-12 h-12 rounded-full bg-brand-50 flex items-center justify-center text-brand-900 font-bold text-lg mb-4" aria-hidden="true">
                    {{ $val->letter }}
                </div>
                <h3 class="font-bold text-ink-main text-[16px] mb-2">{{ $val->title }}</h3>
                <p class="text-[13px] text-ink-muted leading-relaxed">{{ $val->description }}</p>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
