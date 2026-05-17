<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arena Game | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700;800&family=Fredoka:wght@500;700;900&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'edu-blue': '#1E40AF',
                        'edu-orange': '#EA580C',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                        'fredoka': ['Fredoka', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow-x: hidden;
            background-image: url('{{ asset("images/bg-arena-full.jpg") }}');
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            background-color: #0B1528;
        }
        .font-kids { font-family: 'Fredoka', sans-serif; }

        /* ==========================================================================
           SISTEM PAPAN GANTUNG PREMIUM (REALISTIS & KINETIK)
           ========================================================================== */

        /* Container utama pembungkus tali dan papan */
        .wood-hanging-container {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 50;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform-origin: top center; /* Poros ayunan terkunci pas di langit-langit atas */
            animation: dropAndBounceBoard 1.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        /* 1. Tali Penambat Atas (Menjulur dari langit-langit monitor) */
        .wood-rope-line {
            width: 8px;
            height: 32px;
            background: linear-gradient(to right, #78350F, #451A03, #78350F); /* Tekstur warna tali serat rami */
            box-shadow: inset 0 0 4px rgba(0,0,0,0.4), 2px 4px 6px rgba(0,0,0,0.3);
            border-radius: 2px;
        }

        /* 2. Cincin Pengait (Menghubungkan tali dengan papan kayu di bawahnya) */
        .wood-iron-ring {
            width: 20px;
            height: 20px;
            border: 4px solid #94a3b8; /* Tekstur besi abu-abu metalik */
            border-radius: 50%;
            margin-top: -4px;
            margin-bottom: -6px;
            position: relative;
            z-index: 2;
            background-color: #475569;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }

        /* 3. Komponen Utama Papan Kayu */
        .wood-navbar {
            background: linear-gradient(to bottom, #B45309, #78350F);
            box-shadow: 0 8px 0 0 #451A03, 0 20px 30px rgba(0, 0, 0, 0.6);
            border: 4px solid #FEF3C7; /* Pinggiran kayu krem cerah */
            transform: translateY(0);
            transition: box-shadow 0.2s ease, transform 0.15s ease;
            position: relative;
            z-index: 1;
        }

        /* Efek klik membal kebawah yang presisi tanpa mengganggu sumbu X */
        .wood-navbar:active {
            transform: translateY(4px);
            box-shadow: 0 4px 0 0 #451A03, 0 10px 15px rgba(0, 0, 0, 0.5);
        }

        /* Kelas pemicu yang akan diinjeksikan via JavaScript saat diklik */
        .trigger-swing-action {
            animation: swingRealisticBoard 0.85s ease-in-out infinite;
        }

        /* ==========================================================================
           ANIMASI KEYFRAMES NATIVE
           ========================================================================== */

        /* Animasi Papan Jatuh dan Membal Halus saat Load awal */
        @keyframes dropAndBounceBoard {
            0% { transform: translate(-50%, -150px); }
            60% { transform: translate(-50%, 6px); }
            80% { transform: translate(-50%, -8px); }
            100% { transform: translate(-50%, 0); }
        }

        /* Animasi Goyang Papan Tali Ayun dari Poros Atas */
        @keyframes swingRealisticBoard {
            0% { transform: translateX(-50%) rotate(0deg); }
            20% { transform: translateX(-50%) rotate(7deg); }
            40% { transform: translateX(-50%) rotate(-5deg); }
            60% { transform: translateX(-50%) rotate(3deg); }
            80% { transform: translateX(-50%) rotate(-1.5deg); }
            100% { transform: translateX(-50%) rotate(0deg); }
        }

        /* Animasi Karakter Mengapung di Dalam Air (Asinkron) */
        .portal-float-left { animation: floatSubsea1 4.8s infinite ease-in-out; }
        .portal-float-right { animation: floatSubsea2 4.4s infinite ease-in-out; }
        @keyframes floatSubsea1 { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
        @keyframes floatSubsea2 { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }

        /* Efek Hover Lingkaran Portal */
        .portal-interactive { transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .portal-interactive:hover { transform: scale(1.04); filter: drop-shadow(0 25px 35px rgba(56, 189, 248, 0.45)); }
        .portal-interactive:active { transform: scale(0.97); }

        /* Gelembung Efek Atmosfer */
        .bubble { position: absolute; bottom: -60px; background: linear-gradient(to top right, rgba(255, 255, 255, 0.35), rgba(255, 255, 255, 0.1)); border-radius: 50%; animation: bubbleRiseUp linear infinite; pointer-events: none; box-shadow: inset -1px -1px 4px rgba(255,255,255,0.2); }
        @keyframes bubbleRiseUp { 0% { transform: translateY(0) scale(1); opacity: 0; } 10% { opacity: 0.7; } 90% { opacity: 0.3; } 100% { transform: translateY(-115vh) scale(1.3); opacity: 0; } }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between relative select-none">

    <div class="fixed inset-0 z-0 pointer-events-none" id="bubbles-container"></div>

    {{-- ==========================================================================
       HEADER: PAPAN BERANDA GANTUNG TERSTRUKTUR BENAR
       ========================================================================== --}}
    <header class="wood-hanging-container" id="main-hanging-header">
        <div class="flex justify-between w-44 px-4">
            <div class="flex flex-col items-center">
                <div class="wood-rope-line"></div>
                <div class="wood-iron-ring"></div>
            </div>
            <div class="flex flex-col items-center">
                <div class="wood-rope-line"></div>
                <div class="wood-iron-ring"></div>
            </div>
        </div>

        <a href="{{ route('siswa.dashboard') }}"
           id="btn-trigger-beranda"
           class="wood-navbar px-12 py-3 rounded-b-2xl flex flex-col items-center justify-center gap-0.5 group">

            <h1 class="font-fredoka font-black text-sm md:text-base text-amber-100 uppercase tracking-widest drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                ARENA GAME LAUT
            </h1>

            <div class="text-[10px] font-poppins font-bold text-amber-200/80 uppercase tracking-wider bg-black/20 px-3 py-0.5 rounded-full border border-amber-900/40 flex items-center gap-1 group-hover:text-white transition-colors">
                <span>🏠</span> KEMBALI KE BERANDA
            </div>
        </a>
    </header>

    {{-- ==========================================================================
       KONTEN UTAMA: DUA PORTAL JUMBO SEIMBANG SIMETRIS
       ========================================================================== --}}
    <main class="w-full max-w-7xl mx-auto flex-grow flex items-center justify-center pt-36 pb-12 px-6 md:px-12 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-16 items-center justify-center w-full">

            <div class="flex items-center justify-center portal-float-left w-full">
                <a href="{{ route('siswa.game.play', ['tipe' => 'literasi']) }}" class="portal-interactive block w-full max-w-[450px] xl:max-w-[500px] aspect-square">
                    <img src="{{ asset('images/portal-literasi.png') }}"
                         alt="Portal Jelajah Literasi"
                         class="w-full h-full object-contain filter drop-shadow-[0_20px_35px_rgba(0,0,0,0.45)]">
                </a>
            </div>

            <div class="flex items-center justify-center portal-float-right w-full">
                <a href="{{ route('siswa.game.play', ['tipe' => 'numerasi']) }}" class="portal-interactive block w-full max-w-[450px] xl:max-w-[500px] aspect-square">
                    <img src="{{ asset('images/portal-numerasi.png') }}"
                         alt="Portal Jelajah Numerasi"
                         class="w-full h-full object-contain filter drop-shadow-[0_20px_35px_rgba(0,0,0,0.45)]">
                </a>
            </div>

        </div>
    </main>

    {{-- ==========================================================================
       FOOTER WATERMARK TIM
       ========================================================================== --}}
    <footer class="w-full text-center text-white/30 font-fredoka font-bold text-[9px] uppercase tracking-widest pb-3 relative z-10 pointer-events-none">
        ⚓ JELAJAH EDULITNUM • MENYELAM DI DASAR LAUT ⚓
    </footer>

    {{-- ==========================================================================
       SCRIPTS KONTROL INTERAKTIF
       ========================================================================== --}}
    <script>
        // Interseptor Klik Tombol Papan Beranda Untuk Efek Goyang Alami
        document.getElementById('btn-trigger-beranda').addEventListener('click', function(event) {
            event.preventDefault(); // Mengunci pemindahan halaman instan bawaan tag <a>

            const urlTujuan = this.getAttribute('href');
            const elemenPapan = document.getElementById('main-hanging-header');

            // Suntikkan kelas animasi goyang ayunan rami
            elemenPapan.classList.add('trigger-swing-action');

            // Dialokasikan jeda 800ms agar anak-anak bisa melihat papan kayu berayun mantap sebelum dialihkan
            setTimeout(() => {
                window.location.href = urlTujuan;
            }, 800);
        });

        // Konstruktor Generator Gelembung Laut Otomatis
        const boxBubbles = document.getElementById('bubbles-container');
        const jumlahGelembung = 16;

        for (let idx = 0; idx < jumlahGelembung; idx++) {
            let elBubble = document.createElement('div');
            elBubble.classList.add('bubble');

            let diameter = Math.random() * 20 + 6;
            elBubble.style.width = diameter + 'px';
            elBubble.style.height = diameter + 'px';
            elBubble.style.left = Math.random() * 100 + '%';
            elBubble.style.animationDuration = Math.random() * 6 + 5 + 's';
            elBubble.style.animationDelay = Math.random() * 4 + 's';
            elBubble.style.bottom = '-' + (Math.random() * 100 + 50) + 'px';

            boxBubbles.appendChild(elBubble);
        }
    </script>
</body>
</html>
