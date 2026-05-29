<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOU {{ $mou->mou_number }} | PT AMV Studio Development</title>
    <!-- Outfit Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: #f8fafc;
        }
        .paper {
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }
        .legal-header {
            font-family: 'Playfair Display', serif;
        }
        
        /* Modern print rules to ensure it fits perfectly on 1 page */
        @page {
            size: A4;
            margin: 1.0cm 1.2cm 1.0cm 1.2cm;
        }
        @media print {
            body {
                background: #ffffff !important;
                color: #000000 !important;
                padding: 0 !important;
                margin: 0 !important;
                font-size: 11px !important;
            }
            .no-print {
                display: none !important;
            }
            .paper {
                box-shadow: none !important;
                border: none !important;
                padding: 0px !important;
                margin: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
            }
            
            /* Compress elements spacing inside print mode */
            .border-b-2 {
                padding-bottom: 0.5rem !important;
                margin-bottom: 1rem !important;
            }
            .my-8 {
                margin-top: 0.75rem !important;
                margin-bottom: 0.75rem !important;
            }
            .mt-8 {
                margin-top: 0.75rem !important;
            }
            .my-6 {
                margin-top: 0.5rem !important;
                margin-bottom: 0.5rem !important;
            }
            .p-6 {
                padding: 1rem !important;
            }
            .mt-16 {
                margin-top: 1rem !important;
            }
            .pt-8 {
                padding-top: 0.5rem !important;
            }
            .h-48 {
                height: 7.5rem !important;
            }
            .mt-16.pt-6 {
                margin-top: 1rem !important;
                padding-top: 0.5rem !important;
            }
            .absolute.top-10.right-10 {
                top: 0px !important;
                right: 0px !important;
            }
            /* Clean line heights */
            p, div {
                line-height: 1.5 !important;
            }
        }
    </style>
</head>
<body class="py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Action bar (No Print) -->
        <div class="no-print mb-8 flex justify-between items-center bg-white border border-slate-200 p-4 rounded-2xl shadow-sm">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-green-500 shrink-0"></span>
                <span class="text-xs font-bold text-slate-700">MOU Resmi Terverifikasi</span>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.dashboard') }}#mous" class="px-4 py-2 border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-xs font-semibold transition-all">Kembali ke Admin</a>
                <button onclick="window.print()" class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white rounded-xl text-xs font-bold shadow-md transition-all flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 17h2a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h2m2 4h6a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2zm8-12V5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v4"></path></svg>
                    Cetak MOU (PDF)
                </button>
            </div>
        </div>

        <!-- Document Paper -->
        <div class="paper rounded-3xl p-8 md:p-16 border border-slate-200 relative">
            <!-- Green Integrity Shield Check -->
            <div class="absolute top-10 right-10 flex flex-col items-center">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=95x95&data={{ urlencode(route('mou.view', $mou->verification_token)) }}" alt="QR Code Verifikasi" class="w-20 h-20 border border-slate-100 p-1 bg-white rounded-lg">
                <span class="text-[8px] font-extrabold uppercase tracking-widest text-green-600 mt-2 text-center bg-green-50 px-2 py-0.5 rounded-full border border-green-200">ASLI TERVERIFIKASI</span>
            </div>

            <!-- Header -->
            <div class="border-b-2 border-slate-900 pb-6 mb-8 pr-28">
                <h1 class="legal-header text-xl md:text-2xl font-bold uppercase text-slate-900 tracking-wide">PT AMV STUDIO DEVELOPMENT</h1>
                <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold mt-1">Enterprise Architecture & Software Engineering Solutions</p>
                <div class="text-[10px] text-slate-400 mt-1">Cirebon, Jawa Barat, Indonesia • contact@amv.com • amv.com</div>
            </div>

            <!-- Title -->
            <div class="text-center my-8">
                <h2 class="legal-header text-base md:text-lg font-bold uppercase tracking-widest text-slate-900 decoration-1 underline underline-offset-4">MEMORANDUM OF UNDERSTANDING</h2>
                <div class="text-xs text-slate-500 font-bold mt-1">NO. DOKUMEN: {{ $mou->mou_number }}</div>
            </div>

            <!-- Legal Agreement Content -->
            <div class="space-y-6 text-xs md:text-sm text-slate-700 leading-loose text-justify font-sans mt-8">
                <p>
                    Pada hari ini, <strong>{{ $mou->created_at->format('d F Y') }}</strong>, para pihak yang bertanda tangan di bawah ini telah bersepakat penuh untuk mengikatkan diri dalam kerja sama strategis yang didasari asas saling menguntungkan dan menjunjung tinggi kode etik profesional.
                </p>

                <p class="font-bold text-slate-900 text-center uppercase tracking-wider my-6">
                    PERJANJIAN KERJA SAMA:<br>
                    <span class="underline">{{ $mou->title }}</span>
                </p>

                <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-100 leading-loose whitespace-pre-wrap text-slate-800">
                    {{ $mou->content }}
                </div>

                <p>
                    Demikian kesepakatan Memorandum of Understanding ini dibuat dalam rangkap asli untuk dipergunakan sebagaimana mestinya, dengan kekuatan hukum digital yang sah sejak penandatanganan diselesaikan.
                </p>
            </div>

            <!-- Signatures -->
            <div class="mt-16 pt-8 border-t border-slate-100 grid grid-cols-2 gap-8">
                <!-- Pihak 1 -->
                <div class="flex flex-col justify-between h-48">
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">Pihak Pertama,</span>
                        <strong class="text-slate-800 text-xs block mt-1">PT AMV Studio Development</strong>
                    </div>
                    <div>
                        <div class="w-32 h-16 border-b border-dashed border-slate-300 flex items-center justify-center text-slate-300 italic font-serif text-xs">
                            Certified Enterprise
                        </div>
                        <span class="text-[10px] text-slate-500 font-bold block mt-2">Direktur Utama AMV Studio</span>
                    </div>
                </div>

                <!-- Pihak 2 -->
                <div class="flex flex-col justify-between h-48">
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">Pihak Kedua,</span>
                        <strong class="text-slate-800 text-xs block mt-1">{{ $mou->company_name }}</strong>
                    </div>
                    <div>
                        <div class="h-16 flex items-center">
                            @if($mou->is_signed)
                                <img src="{{ $mou->signature_data }}" alt="Tanda Tangan Klien" class="h-14 object-contain">
                            @else
                                <span class="text-xs text-amber-500 font-bold italic">Belum Ditandatangani</span>
                            @endif
                        </div>
                        <span class="text-[10px] text-slate-500 font-bold block mt-2">{{ $mou->client_name }}</span>
                    </div>
                </div>
            </div>

            <!-- Security Footer -->
            <div class="mt-16 pt-6 border-t border-slate-100 text-[10px] text-slate-400 flex flex-col md:flex-row justify-between items-center gap-4">
                <span>Dokumen ini diterbitkan secara elektronik oleh sistem PT AMV Studio Development.</span>
                <span class="font-mono text-[9px] bg-slate-50 px-3 py-1 rounded-full border border-slate-100">Secured HASH ID: {{ sha1($mou->verification_token) }}</span>
            </div>
        </div>
    </div>
</body>
</html>
