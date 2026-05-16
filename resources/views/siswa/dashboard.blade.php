<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markas Penyelam | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&family=Poppins:wght@500;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow-x: hidden;
            background-image: url('{{ asset("images/bg-underwater.png") }}');
            background-size: cover;
            background-position: center bottom;
            background-attachment: fixed;
            background-color: #E0F2FE;
        }

        h1, h2, h3, h4 {
            font-family: 'Montserrat', sans-serif;
        }

        /* Glassmorphism Lembut transparan seperti Box Login */
        .glass-panel {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 2px solid rgba(255, 255, 255, 0.6);
        }

        /* Tombol Efek 3D Kinetik khas Game Konsol */
        .btn-3d-orange {
            background-color: #E87F24;
            box-shadow: 0 10px 0 0 #B55A0A, 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .btn-3d-orange:hover {
            transform: translateY(4px);
            box-shadow: 0 6px 0 0 #B55A0A, 0 15px 20px -5px rgba(0, 0, 0, 0.15);
        }
        .btn-3d-orange:active {
            transform: translateY(10px);
            box-shadow: 0 0px 0 0 #B55A0A;
        }

        .btn-3d-blue {
            background-color: #3B82F6;
            box-shadow: 0 10px 0 0 #1D4ED8, 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .btn-3d-blue:hover {
            transform: translateY(4px);
            box-shadow: 0 6px 0 0 #1D4ED8, 0 15px 20px -5px rgba(0, 0, 0, 0.15);
        }
        .btn-3d-blue:active {
            transform: translateY(10px);
            box-shadow: 0 0px 0 0 #1D4ED8;
        }

        /* Animasi Gelembung Air Latar Belakang */
        .bubble {
            position: absolute;
            bottom: -50px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            animation: rise linear infinite;
            pointer-events: none;
        }
        @keyframes rise {
            0% { transform: translateY(0) scale(1); opacity: 0; }
            10% { opacity: 0.8; }
            90% { opacity: 0.4; }
            100% { transform: translateY(-110vh) scale(1.4); opacity: 0; }
        }

        .animate-float {
            animation: float-slow 4s infinite ease-in-out;
        }
        @keyframes float-slow {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(3deg); }
        }
    </style>
</head>

<body class="min-h-screen relative pb-16">

    <div class="fixed inset-0 z-0 pointer-events-none" id="bubbles-container"></div>

    {{-- NAVIGASI ATAS --}}
    <nav class="relative z-10 glass-panel mx-4 my-4 px-6 py-4 rounded-full flex justify-between items-center shadow-lg">
        <div class="flex items-center gap-3 text-blue-950 font-black text-xl tracking-tight">
            <img src="{{ asset('images/coin.svg') }}" alt="Koin" class="w-8 h-8 animate-spin" style="animation-duration: 8s;">
            <span>JELAJAH EDULITNUM</span>
        </div>

        <div class="flex items-center gap-4">
            <div class="hidden sm:flex items-center gap-2 bg-white/60 px-4 py-1.5 rounded-full border border-white font-bold text-sm text-blue-950">
                ⭐ <span class="text-orange-600">{{ $total_xp ?? 0 }} XP</span> Terkumpul
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-5 py-2.5 bg-red-500 hover:bg-red-600 text-white font-black text-sm rounded-full shadow-[0_4px_0_0_#B91C1C] hover:shadow-[0_2px_0_0_#B91C1C] transition-all border-2 border-white active:translate-y-1">
                    Naik ke Daratan 🚪
                </button>
            </form>
        </div>
    </nav>

    {{-- LAYOUT UTAMA DASHBOARD --}}
    <main class="relative z-10 max-w-6xl mx-auto px-4 mt-6 grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- SISI KIRI: PROFIL, PETI NILAI & LEADERBOARD --}}
        <div class="lg:col-span-1 space-y-6">

            <div class="glass-panel rounded-[40px] p-6 text-center shadow-2xl relative overflow-hidden">
                <div class="w-24 h-24 bg-white rounded-full shadow-md border-4 border-[#FFC81E] flex items-center justify-center mx-auto overflow-hidden p-2 animate-float">
                    <span class="text-5xl">🤿</span>
                </div>
                <h2 class="text-2xl font-black text-blue-950 mt-4 tracking-tight">{{ Auth::user()->name }}</h2>
                <p class="text-blue-800 text-xs font-bold uppercase tracking-wider mt-1">Penyelam Cilik Berbakat</p>

                <div class="mt-4 bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl p-3 text-white font-black shadow-inner">
                    <p class="text-xs uppercase tracking-widest text-yellow-100">Total Energi Kamu</p>
                    <p class="text-3xl tracking-wide">{{ $total_xp ?? 0 }} <span class="text-lg">XP</span></p>
                </div>
            </div>

            <div class="glass-panel rounded-[40px] p-6 shadow-2xl">
                <h3 class="text-lg font-black text-blue-950 mb-4 flex items-center gap-2">
                    📋 <span>Peti Nilai Kamu</span>
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center bg-white/70 p-3 rounded-2xl border border-white/50">
                        <span class="text-sm font-bold text-blue-900">📝 Skor Uji Pretest</span>
                        <span class="px-3 py-1 bg-blue-600 text-white font-black rounded-xl text-sm">{{ $skor_pretest ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center bg-white/70 p-3 rounded-2xl border border-white/50">
                        <span class="text-sm font-bold text-blue-900">🐙 Game Literasi</span>
                        <span class="px-3 py-1 bg-orange-500 text-white font-black rounded-xl text-sm">{{ $skor_literasi ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center bg-white/70 p-3 rounded-2xl border border-white/50">
                        <span class="text-sm font-bold text-blue-900">🦈 Game Numerasi</span>
                        <span class="px-3 py-1 bg-sky-500 text-white font-black rounded-xl text-sm">{{ $skor_numerasi ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <div class="glass-panel rounded-[40px] p-6 shadow-2xl">
                <h3 class="text-lg font-black text-blue-950 mb-4 flex items-center gap-2">
                    🏆 <span>Top Penyelam Kelas</span>
                </h3>
                <div class="space-y-2">
                    <div class="flex items-center justify-between bg-amber-100/80 border-2 border-amber-400 p-3 rounded-2xl">
                        <div class="flex items-center gap-2">
                            <span class="text-xl">🥇</span>
                            <span class="font-bold text-sm text-amber-950">Riyadhy</span>
                        </div>
                        <span class="font-black text-amber-700 text-sm">520 XP</span>
                    </div>
                    <div class="flex items-center justify-between bg-white/80 border-2 border-slate-300 p-3 rounded-2xl">
                        <div class="flex items-center gap-2">
                            <span class="text-xl">🥈</span>
                            <span class="font-bold text-sm text-slate-950">Kamu ({{ Auth::user()->name }})</span>
                        </div>
                        <span class="font-black text-slate-700 text-sm">{{ $total_xp ?? 0 }} XP</span>
                    </div>
                    <div class="flex items-center justify-between bg-amber-600/10 border-2 border-amber-700/30 p-3 rounded-2xl">
                        <div class="flex items-center gap-2">
                            <span class="text-xl">🥉</span>
                            <span class="font-bold text-sm text-amber-900">Ojhy</span>
                        </div>
                        <span class="font-black text-amber-800 text-sm">310 XP</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- SISI KANAN: TOMBOL INTERAKTIF (ZONA PRETEST, GAME, DAN MODUL) --}}
        <div class="lg:col-span-2 space-y-6">

            <div class="text-center lg:text-left">
                <h3 class="text-xl font-black text-blue-950 uppercase tracking-wide">🗺️ Pilih Zona Petualanganmu:</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @if(Auth::user()->is_pretest_done)
                    <div class="bg-slate-200/60 border-2 border-slate-300 p-6 rounded-3xl opacity-70 flex flex-col items-center justify-center text-center shadow-inner">
                        <div class="text-5xl mb-2 filter grayscale">🔒</div>
                        <h3 class="font-black text-slate-500 font-kids text-lg">MISI AWAL SELESAI</h3>
                        <p class="text-xs text-slate-400 font-bold max-w-[200px] mt-1">Kamu sudah menyelami tantangan ini!</p>
                    </div>
                @else
                    <a href="{{ route('siswa.pretest') }}"
                       class="bg-white/90 border-2 border-white p-6 rounded-3xl flex flex-col items-center justify-center text-center shadow-md hover:scale-105 active:translate-y-1 transition-all group">
                        <div class="text-5xl mb-2 group-hover:animate-bounce">🤿</div>
                        <h3 class="font-black text-blue-950 font-kids text-lg">MISI AWAL (PRE-TEST)</h3>
                        <p class="text-xs text-blue-900/60 font-bold max-w-[200px] mt-1">Ayo mulai penyelaman pertamamu!</p>
                    </a>
                @endif

                <a href="{{ route('siswa.game.play', ['tipe' => 'literasi']) }}" class="btn-3d-orange group rounded-[36px] p-6 text-white text-center font-black text-xl border-4 border-white transition-all duration-150 relative overflow-hidden flex flex-col justify-between h-56">
                    <div class="absolute -right-4 -top-4 w-16 h-16 bg-white/10 rounded-full pointer-events-none"></div>
                    <div class="text-5xl transform group-hover:scale-125 group-hover:rotate-6 transition-transform duration-200">🎮</div>
                    <div>
                        <span class="block drop-shadow uppercase tracking-widest text-2xl">Mulai Main Game</span>
                        <span class="block text-xs font-bold text-yellow-100 normal-case mt-1 bg-black/10 rounded-full py-1 px-3 inline-block">Misi Seru Berhadiah XP 💎</span>
                    </div>
                </a>

            </div>

            <div class="glass-panel rounded-[40px] p-6 shadow-2xl">
                <h3 class="text-lg font-black text-blue-950 mb-4 flex items-center gap-2">
                    📖 <span>Buku Panduan Penyelam (Modul Belajar)</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <a href="{{ route('siswa.modul.show', ['kategori' => 'literasi']) }}" class="group flex items-center gap-4 bg-white/80 hover:bg-white border-2 border-orange-200 hover:border-orange-500 rounded-3xl p-4 shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
                        <div class="text-4xl p-2 bg-orange-100 rounded-2xl transform group-hover:scale-110 transition-transform">🐙</div>
                        <div>
                            <h4 class="font-black text-blue-950 text-base">Modul Literasi</h4>
                            <p class="text-xs text-gray-500 font-medium">Belajar membaca & memahami cerita laut.</p>
                        </div>
                    </a>

                    <a href="{{ route('siswa.modul.show', ['kategori' => 'numerasi']) }}" class="group flex items-center gap-4 bg-white/80 hover:bg-white border-2 border-sky-200 hover:border-sky-500 rounded-3xl p-4 shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
                        <div class="text-4xl p-2 bg-sky-100 rounded-2xl transform group-hover:scale-110 transition-transform">🦈</div>
                        <div>
                            <h4 class="font-black text-blue-950 text-base">Modul Numerasi</h4>
                            <p class="text-xs text-gray-500 font-medium">Berhitung angka-angka ajaib samudera.</p>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </main>

    <script>
        const bubblesContainer = document.getElementById('bubbles-container');
        const bubbleCount = 18;

        for (let i = 0; i < bubbleCount; i++) {
            let bubble = document.createElement('div');
            bubble.classList.add('bubble');

            let size = Math.random() * 25 + 8;
            bubble.style.width = size + 'px';
            bubble.style.height = size + 'px';
            bubble.style.left = Math.random() * 100 + '%';

            bubble.style.animationDuration = Math.random() * 6 + 5 + 's';
            bubble.style.animationDelay = Math.random() * 5 + 's';

            bubblesContainer.appendChild(bubble);
        }
    </script>
</body>

</html>
