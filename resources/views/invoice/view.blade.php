<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoice_number }} | PT AMV Studio Development</title>
    <!-- Outfit Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            .pb-10 {
                padding-bottom: 0.5rem !important;
            }
            .py-10 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }
            .py-8 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }
            .pt-8 {
                padding-top: 0.5rem !important;
            }
            .mt-4 {
                margin-top: 0.5rem !important;
            }
            .mt-16 {
                margin-top: 1rem !important;
            }
            .p-3 {
                padding: 0.5rem !important;
            }
            .p-4 {
                padding: 0.75rem !important;
            }
            /* Clean line heights */
            p, div {
                line-height: 1.4 !important;
            }
        }
    </style>
</head>
<body class="py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Action bar (No Print) -->
        <div class="no-print mb-8 flex justify-between items-center bg-white border border-slate-200 p-4 rounded-2xl shadow-sm">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-purple-600 shrink-0"></span>
                <span class="text-xs font-bold text-slate-700">Invoice Tagihan Resmi</span>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.dashboard') }}#invoices" class="px-4 py-2 border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-xs font-semibold transition-all">Kembali ke Admin</a>
                <button onclick="window.print()" class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white rounded-xl text-xs font-bold shadow-md transition-all flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 17h2a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h2m2 4h6a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2zm8-12V5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v4"></path></svg>
                    Cetak / Simpan PDF
                </button>
            </div>
        </div>

        <!-- Document Paper -->
        <div class="paper rounded-3xl p-8 md:p-16 border border-slate-200 relative">
            <!-- Header Grid -->
            <div class="grid grid-cols-2 gap-8 border-b border-slate-100 pb-10">
                <div>
                    <h1 class="text-xl md:text-2xl font-extrabold text-slate-900 tracking-wider">PT AMV STUDIO DEVELOPMENT</h1>
                    <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold mt-1">Enterprise Cloud & AI Architecture</p>
                    <p class="text-[10px] text-slate-400 mt-4 leading-relaxed">
                        Cirebon, Jawa Barat, Indonesia<br>
                        contact@amv.com • amv.com
                    </p>
                </div>
                <div class="text-right flex flex-col justify-between items-end">
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">INVOICE</span>
                        <span class="text-lg font-bold text-purple-700 mt-1 block">{{ $invoice->invoice_number }}</span>
                    </div>
                    <div class="text-[10px] text-slate-400 leading-relaxed mt-4">
                        <strong>Tanggal Terbit:</strong> {{ $invoice->issued_date->format('d M Y') }}<br>
                        <strong>Jatuh Tempo:</strong> {{ $invoice->due_date->format('d M Y') }}
                    </div>
                </div>
            </div>

            <!-- Bill To Grid -->
            <div class="grid grid-cols-2 gap-8 py-10 border-b border-slate-100">
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">DITAGIHKAN KEPADA:</span>
                    <strong class="text-slate-800 text-sm block mt-2">{{ $invoice->client_name }}</strong>
                    <span class="text-xs text-slate-500 block mt-1">{{ $invoice->client_email }}</span>
                </div>
                <div class="text-right flex flex-col justify-start items-end">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">STATUS PEMBAYARAN:</span>
                    @if($invoice->status === 'paid')
                    <span class="mt-2 px-3 py-1 rounded-full bg-green-50 text-green-700 border border-green-200 text-xs font-bold uppercase tracking-widest">LUNAS</span>
                    @elseif($invoice->status === 'cancelled')
                    <span class="mt-2 px-3 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200 text-xs font-bold uppercase tracking-widest">DIBATALKAN</span>
                    @else
                    <span class="mt-2 px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold uppercase tracking-widest">MENUNGGU PEMBAYARAN</span>
                    @endif
                </div>
            </div>

            <!-- Items Table -->
            <div class="py-8">
                <table class="w-full text-left border-collapse text-xs md:text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 font-bold border-b border-slate-200">
                            <th class="p-3 uppercase tracking-wider w-8">#</th>
                            <th class="p-3 uppercase tracking-wider">Deskripsi Pekerjaan / Layanan</th>
                            <th class="p-3 uppercase tracking-wider text-center w-20">Qty</th>
                            <th class="p-3 uppercase tracking-wider text-right w-36">Harga Satuan</th>
                            <th class="p-3 uppercase tracking-wider text-right w-36">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($invoice->items as $index => $item)
                        <tr class="hover:bg-slate-50/20">
                            <td class="p-3 text-slate-400 font-medium">{{ $index + 1 }}</td>
                            <td class="p-3 text-slate-700 font-bold">{{ $item['desc'] }}</td>
                            <td class="p-3 text-slate-600 text-center">{{ $item['qty'] }}</td>
                            <td class="p-3 text-slate-600 text-right">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td class="p-3 text-slate-800 font-bold text-right">Rp {{ number_format($item['subtotal'] ?? ($item['qty'] * $item['price']), 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Summary Breakdown -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 border-t border-slate-100 pt-8 mt-4">
                <!-- Payment terms and banking info -->
                <div class="md:col-span-7 space-y-4">
                    <div>
                        <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">METODE PEMBAYARAN:</h4>
                        <div class="mt-2 text-xs text-slate-600 space-y-1">
                            <p><strong>Bank Mandiri</strong> (PT AMV Studio Development)</p>
                            <p>No. Rekening: <strong>132-00-5588-9990</strong></p>
                            <p>Kantor Cabang Pembantu Cirebon Siliwangi</p>
                        </div>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 text-[10px] text-slate-500 leading-relaxed">
                        Harap sertakan nomor invoice pada berita transfer bank. Setelah melakukan transfer, silakan kirimkan bukti transfer pembayaran Anda ke email <strong>finance@amv.com</strong>.
                    </div>
                </div>

                <!-- Grand Total -->
                <div class="md:col-span-5 flex flex-col justify-start items-end space-y-3">
                    <div class="w-full flex justify-between text-xs text-slate-500">
                        <span>Subtotal:</span>
                        <span>Rp {{ number_format($invoice->amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="w-full flex justify-between text-xs text-slate-500 pb-2 border-b border-slate-100">
                        <span>Pajak (0% PPN):</span>
                        <span>Rp 0</span>
                    </div>
                    <div class="w-full flex justify-between text-sm font-extrabold text-slate-900 bg-purple-50 p-4 rounded-2xl border border-purple-100">
                        <span>Total Tagihan:</span>
                        <span class="text-purple-700 text-base">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- QR Verification Footer -->
            <div class="mt-16 pt-8 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-4">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=110x110&data={{ urlencode(route('invoice.verify', $invoice->verification_token)) }}" alt="QR Code Verifikasi" class="w-20 h-20 border border-slate-100 p-1 bg-white rounded-xl shadow-sm shrink-0">
                    <div>
                        <span class="text-[10px] font-extrabold text-green-600 block bg-green-50 border border-green-200 px-2 py-0.5 rounded-full w-max">QR VERIFIKASI KEASLIAN</span>
                        <p class="text-[10px] text-slate-400 mt-1.5 leading-relaxed max-w-sm">Scan QR Code ini menggunakan kamera ponsel untuk memverifikasi keaslian dan status pembayaran invoice ini langsung dari server PT AMV Studio.</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-mono text-slate-400 block">HASH ID: {{ sha1($invoice->verification_token) }}</span>
                    <span class="text-[9px] text-slate-300 block mt-1">Sistem Keuangan Otomatis PT AMV Studio</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
