<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Keaslian Invoice | PT AMV Studio Development</title>
    <!-- Outfit Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
        }
        .verified-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="min-h-screen flex justify-center items-center py-12 px-4">
    <div class="max-w-md w-full text-center">
        <!-- Verified Card -->
        <div class="verified-card rounded-3xl p-8 shadow-2xl relative overflow-hidden">
            <!-- Top Green Shield Seal -->
            <div class="w-20 h-20 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 border border-green-200 shadow-md">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0 1 12 2.944a11.955 11.955 0 0 1-8.618 3.04A12.02 12.02 0 0 0 3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>

            <!-- Verification Heading -->
            <h2 class="text-slate-900 font-extrabold text-lg uppercase tracking-wider">Keaslian Terverifikasi</h2>
            <span class="text-[10px] bg-green-100 text-green-700 font-extrabold tracking-widest uppercase px-3 py-1 rounded-full border border-green-200 mt-2 inline-block">Secured System</span>
            
            <p class="text-xs text-slate-500 mt-4 leading-relaxed">
                Dokumen keuangan ini terdaftar secara resmi di dalam database aman <strong>PT AMV Studio Development</strong>. Rincian data di bawah ini adalah sah dan akurat.
            </p>

            @if($invoice)
                <!-- Invoice Info Grid -->
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 mt-6 text-left text-xs space-y-3.5">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-400 font-bold uppercase tracking-wider text-[9px]">Nomor Invoice</span>
                        <strong class="text-slate-800 font-bold">{{ $invoice->invoice_number }}</strong>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-400 font-bold uppercase tracking-wider text-[9px]">Klien / Perusahaan</span>
                        <strong class="text-slate-800 font-bold">{{ $invoice->client_name }}</strong>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-400 font-bold uppercase tracking-wider text-[9px]">Tanggal Jatuh Tempo</span>
                        <strong class="text-slate-700 font-bold">{{ $invoice->due_date->format('d F Y') }}</strong>
                    </div>
                    <div class="flex justify-between items-center pt-2.5 border-t border-slate-200">
                        <span class="text-slate-400 font-bold uppercase tracking-wider text-[9px]">Total Nominal Tagihan</span>
                        <strong class="text-purple-700 text-sm font-extrabold">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</strong>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-400 font-bold uppercase tracking-wider text-[9px]">Status Transaksi</span>
                        @if($invoice->status === 'paid')
                            <span class="px-2 py-0.5 rounded bg-green-50 text-green-700 border border-green-200 font-extrabold text-[9px] uppercase">Lunas / Paid</span>
                        @elseif($invoice->status === 'cancelled')
                            <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 border border-slate-200 font-extrabold text-[9px] uppercase">Dibatalkan</span>
                        @else
                            <span class="px-2 py-0.5 rounded bg-amber-50 text-amber-700 border border-amber-200 font-extrabold text-[9px] uppercase">Menunggu Pembayaran</span>
                        @endif
                    </div>
                </div>

                <!-- Secure cryptographic seal -->
                <div class="mt-6 text-[9px] text-slate-400 font-mono flex justify-center gap-1">
                    <span>SEAL HASH:</span>
                    <span>{{ sha1($invoice->verification_token) }}</span>
                </div>
            @else
                <!-- Invalid Token -->
                <div class="bg-red-50 text-red-700 rounded-2xl p-4 border border-red-100 mt-6 text-xs font-semibold leading-relaxed">
                    Token verifikasi tidak valid atau dokumen tidak terdaftar. Harap waspada terhadap upaya penipuan / pemalsuan dokumen.
                </div>
            @endif
        </div>

        <p class="text-slate-400 text-[10px] mt-6 leading-relaxed">
            PT AMV Studio Development berkomitmen terhadap keamanan, transparansi, dan integritas arsitektur digital Indonesia.
        </p>
    </div>
</body>
</html>
