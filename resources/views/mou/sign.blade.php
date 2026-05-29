<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Signature MOU | PT AMV Studio Development</title>
    <!-- Outfit Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
        }
        .paper {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            background: #ffffff;
            color: #1e293b;
        }
        .legal-header {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="min-h-screen py-12 px-4 flex justify-center items-center">
    <div class="max-w-4xl w-full">
        <!-- Logo Header -->
        <div class="text-center mb-8">
            <h1 class="text-white font-extrabold text-2xl tracking-wider">PT AMV STUDIO DEVELOPMENT</h1>
            <p class="text-purple-400 text-xs uppercase tracking-widest font-bold mt-1">Sistem Dokumen & E-Signature Legal</p>
        </div>

        <!-- Document Paper -->
        <div class="paper rounded-3xl overflow-hidden p-8 md:p-12 mb-8 relative">
            <!-- Decorative legal seal -->
            <div class="absolute top-8 right-8 border-4 border-purple-200/50 rounded-full w-24 h-24 flex items-center justify-center font-bold text-slate-300 text-[10px] tracking-widest uppercase select-none text-center transform rotate-12 pointer-events-none">
                PT AMV<br>STUDIO
            </div>

            <!-- MOU Header -->
            <div class="border-b-2 border-slate-900 pb-6 mb-8 text-center">
                <h2 class="legal-header text-xl md:text-2xl font-bold uppercase tracking-wide text-slate-900">MEMORANDUM OF UNDERSTANDING</h2>
                <div class="text-xs text-slate-500 font-bold mt-1">NO. DOKUMEN: {{ $mou->mou_number }}</div>
            </div>

            <!-- Document Content -->
            <div class="space-y-6 text-sm leading-relaxed text-slate-700">
                <p class="font-bold text-slate-900 text-center text-base underline mb-6">
                    {{ $mou->title }}
                </p>

                <p>
                    Kami yang bertanda tangan di bawah ini menyepakati perjanjian kerja sama strategis yang diterbitkan oleh <strong>PT AMV Studio Development</strong> (Pihak Pertama) bersama <strong>{{ $mou->company_name }}</strong> (Pihak Kedua).
                </p>

                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 font-sans text-slate-800 leading-loose whitespace-pre-wrap">
                    {{ $mou->content }}
                </div>

                <p>
                    Kedua belah pihak menyetujui seluruh butir kesepakatan di atas dan membubuhkan tanda tangan secara digital dengan penuh tanggung jawab demi kelancaran visi bersama.
                </p>
            </div>

            <!-- Sign Section -->
            <div class="mt-12 pt-8 border-t border-slate-100 grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Pihak 1 (PT AMV Studio) -->
                <div class="text-center md:text-left flex flex-col justify-between h-48">
                    <div>
                        <span class="text-xs text-slate-400 font-bold uppercase tracking-wider block">Pihak Pertama,</span>
                        <strong class="text-slate-800 text-sm block mt-1">PT AMV Studio Development</strong>
                    </div>
                    <div>
                        <div class="w-40 h-16 border-b border-dashed border-slate-300 mx-auto md:mx-0 flex items-center justify-center text-slate-300 italic font-serif text-sm">
                            Certified Enterprise
                        </div>
                        <span class="text-xs text-slate-500 font-bold block mt-2">Direktur Utama AMV Studio</span>
                    </div>
                </div>

                <!-- Pihak 2 (Klien) -->
                <div class="text-center md:text-left flex flex-col justify-between h-48">
                    <div>
                        <span class="text-xs text-slate-400 font-bold uppercase tracking-wider block">Pihak Kedua,</span>
                        <strong class="text-slate-800 text-sm block mt-1">{{ $mou->company_name }}</strong>
                    </div>
                    <div>
                        <div class="w-full flex justify-center md:justify-start">
                            @if($mou->is_signed)
                                <img src="{{ $mou->signature_data }}" alt="Tanda Tangan Klien" class="h-20 object-contain">
                            @else
                                <button onclick="openSignatureModal()" class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center gap-1.5 animate-pulse">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 1 1 3.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    Bubuhi Tanda Tangan
                                </button>
                            @endif
                        </div>
                        <span class="text-xs text-slate-500 font-bold block mt-2">{{ $mou->client_name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SIGNATURE MODAL PAD -->
    <dialog id="signature-modal" class="rounded-3xl p-6 border border-slate-200 max-w-md w-full bg-white shadow-2xl relative">
        <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center border-b border-slate-100 pb-2">
                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Gambar Tanda Tangan Digital Anda</h3>
                <button onclick="closeSignatureModal()" class="text-slate-400 hover:text-slate-600 text-lg font-bold">&times;</button>
            </div>
            
            <p class="text-[11px] text-slate-500">Silakan gunakan mouse atau layar sentuh ponsel Anda untuk menggambar tanda tangan resmi di dalam kotak berikut.</p>

            <div class="border-2 border-dashed border-slate-200 rounded-2xl overflow-hidden bg-slate-50 relative h-48">
                <canvas id="sig-canvas" class="w-full h-full block cursor-crosshair"></canvas>
            </div>

            <form action="{{ route('mou.sign.submit', $mou->verification_token) }}" method="POST" id="signature-form" onsubmit="return prepareSignatureForm(event)">
                @csrf
                <input type="hidden" name="signature_data" id="signature_data_input">
                
                <div class="flex gap-2">
                    <button type="button" onclick="clearCanvas()" class="w-1/3 py-2 border border-slate-200 text-slate-600 font-semibold text-xs rounded-xl hover:bg-slate-50 transition-all">Bersihkan</button>
                    <button type="submit" class="w-2/3 py-2 bg-purple-600 hover:bg-purple-500 text-white font-bold text-xs rounded-xl shadow-md transition-all">Tanda Tangani Perjanjian</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        const sigModal = document.getElementById('signature-modal');
        const canvas = document.getElementById('sig-canvas');
        const ctx = canvas.getContext('2d');
        let drawing = false;

        function openSignatureModal() {
            sigModal.showModal();
            // Match canvas width/height to its client dimensions
            canvas.width = canvas.parentElement.clientWidth;
            canvas.height = canvas.parentElement.clientHeight;
            
            // Canvas styling
            ctx.strokeStyle = '#6b21a8'; // Purple ink
            ctx.lineWidth = 3;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
        }

        function closeSignatureModal() {
            sigModal.close();
        }

        // Draw Logic
        canvas.addEventListener('mousedown', (e) => {
            drawing = true;
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY);
        });

        canvas.addEventListener('mousemove', (e) => {
            if (!drawing) return;
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
        });

        canvas.addEventListener('mouseup', () => { drawing = false; });
        canvas.addEventListener('mouseleave', () => { drawing = false; });

        // Touch support for mobiles
        canvas.addEventListener('touchstart', (e) => {
            drawing = true;
            const touch = e.touches[0];
            const rect = canvas.getBoundingClientRect();
            ctx.beginPath();
            ctx.moveTo(touch.clientX - rect.left, touch.clientY - rect.top);
            e.preventDefault();
        });

        canvas.addEventListener('touchmove', (e) => {
            if (!drawing) return;
            const touch = e.touches[0];
            const rect = canvas.getBoundingClientRect();
            ctx.lineTo(touch.clientX - rect.left, touch.clientY - rect.top);
            ctx.stroke();
            e.preventDefault();
        });

        canvas.addEventListener('touchend', () => { drawing = false; });

        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        function prepareSignatureForm(e) {
            // Check if canvas is blank
            const blank = document.createElement('canvas');
            blank.width = canvas.width;
            blank.height = canvas.height;
            if (canvas.toDataURL() === blank.toDataURL()) {
                alert("Silakan bubuhi tanda tangan Anda sebelum menekan tombol simpan.");
                e.preventDefault();
                return false;
            }
            
            // Set hidden value
            document.getElementById('signature_data_input').value = canvas.toDataURL('image/png');
            return true;
        }
    </script>
</body>
</html>
