<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petualang | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Fredoka:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'edu-orange': '#E87F24',
                        'edu-yellow': '#FFD93D',
                        'edu-blue': '#73A5CA',
                        'edu-green': '#6BCB77',
                        'edu-bg': '#FEFDDF',
                        'edu-dark': '#1A202C',
                    },
                    fontFamily: {
                        'fredoka': ['Fredoka', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FEFDDF; overflow-x: hidden; }
        .font-kids { font-family: 'Fredoka', sans-serif; }

        /* Animasi Floating Super Halus */
        @keyframes float-gentle {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .float-anim { animation: float-gentle 4s ease-in-out infinite; }

        /* Animasi Tombol Utama (Lebih Agresif untuk Menarik Perhatian) */
        @keyframes super-pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(232, 127, 36, 0.7); }
            50% { transform: scale(1.05); box-shadow: 0 0 0 20px rgba(232, 127, 36, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(232, 127, 36, 0); }
        }
        .main-btn-anim { animation: super-pulse 2s infinite; }

        /* Gradient Background */
        .custom-gradient {
            background: linear-gradient(135deg, #E87F24 0%, #FFD93D 100%);
        }

        /* Hover Effect untuk Card */
        .card-interactive {
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .card-interactive:hover {
            transform: translateY(-8px);
        }
    </style>
</head>
<body class="min-h-screen pb-20">

    <nav class="p-6 flex justify-between items-center bg-white/70 backdrop-blur-md sticky top-0 z-50 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-edu-orange rounded-xl flex items-center justify-center shadow-lg transform -rotate-3">
                <span class="text-white font-black text-xl font-kids">E</span>
            </div>
            <span class="text-edu-dark font-black text-xl font-kids tracking-tight">EDULIT<span class="text-edu-orange">NUM</span></span>
        </div>

        <div class="flex items-center gap-4 bg-white px-4 py-2 rounded-2xl border-2 border-edu-orange/5">
            <div class="text-right hidden xs:block">
                <p class="text-[10px] font-bold text-gray-400 uppercase leading-none">Poin Saya</p>
                <p class="text-sm font-black text-edu-dark">{{ $userProgress->total_jawaban_benar ?? 0 }} ⭐</p>
            </div>
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Siswa') }}&background=E87F24&color=fff" class="w-10 h-10 rounded-xl border-2 border-white shadow-sm">
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 mt-10">

        <section class="custom-gradient rounded-[3rem] p-10 md:p-14 text-white relative overflow-hidden shadow-2xl mb-12 border-b-8 border-orange-600/20">
            <div class="relative z-10 text-center md:text-left">
                <h1 class="text-4xl md:text-6xl font-black font-kids mb-4 leading-tight">Halo, {{ explode(' ', Auth::user()->name ?? 'Sobat Petualang')[0] }}! 👋</h1>
                <p class="text-lg md:text-xl font-medium text-white/90 mb-10 max-w-lg">Siap mengalahkan tantangan hari ini dan jadi bintang kelas?</p>

                <div class="flex flex-col sm:flex-row items-center gap-6 justify-center md:justify-start">
                    <a href="{{ route('siswa.pretest') }}" class="main-btn-anim bg-white text-edu-orange px-12 py-5 rounded-[2rem] font-black text-xl shadow-2xl flex items-center gap-3 hover:bg-edu-dark hover:text-white transition-colors group">
                        <span>🚀 MULAI PRE-TEST</span>
                    </a>
                </div>
            </div>

            <div class="absolute right-12 top-1/2 -translate-y-1/2 float-anim hidden lg:block">
                <div class="w-48 h-48 bg-white/20 rounded-[3rem] flex items-center justify-center backdrop-blur-md border-2 border-white/30 text-8xl shadow-inner">
                    📖
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12">

            <div class="lg:col-span-8 space-y-8">
                <h2 class="text-2xl font-black text-edu-dark font-kids flex items-center gap-3">
                    <span class="bg-edu-green/20 p-2 rounded-xl text-2xl">📊</span>
                    Progres Belajarku
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border-b-8 border-edu-blue/20 card-interactive">
                        <div class="flex justify-between items-start mb-4">
                            <div class="text-4xl">📚</div>
                            <span class="text-[10px] font-black bg-edu-blue/10 text-edu-blue px-3 py-1 rounded-full uppercase">Literasi</span>
                        </div>
                        <h3 class="text-xl font-black text-edu-dark mb-1">Kemampuan Membaca</h3>
                        <p class="text-xs text-gray-400 font-bold mb-4">Selesaikan kuis untuk melihat skor</p>
                        <div class="w-full bg-gray-100 rounded-full h-3">
                            <div class="bg-edu-blue h-3 rounded-full" style="width: 45%"></div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border-b-8 border-edu-orange/20 card-interactive">
                        <div class="flex justify-between items-start mb-4">
                            <div class="text-4xl">🧮</div>
                            <span class="text-[10px] font-black bg-edu-orange/10 text-edu-orange px-3 py-1 rounded-full uppercase">Numerasi</span>
                        </div>
                        <h3 class="text-xl font-black text-edu-dark mb-1">Jagoan Berhitung</h3>
                        <p class="text-xs text-gray-400 font-bold mb-4">Ayo tingkatkan skormu!</p>
                        <div class="w-full bg-gray-100 rounded-full h-3">
                            <div class="bg-edu-orange h-3 rounded-full" style="width: 30%"></div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[3rem] shadow-xl border-4 border-white flex flex-col md:flex-row items-center gap-8 card-interactive">
                    <div class="w-32 h-32 bg-edu-green/10 rounded-[2rem] flex items-center justify-center text-6xl shadow-inner shrink-0">🕹️</div>
                    <div class="flex-1 text-center md:text-left">
                        <h3 class="text-2xl font-black text-edu-dark font-kids">Arena Game Edukasi</h3>
                        <p class="text-gray-500 font-medium">Bermain sambil belajar untuk dapatkan XP tambahan!</p>
                    </div>
                    <a href="#" class="px-8 py-4 bg-edu-green text-white rounded-2xl font-black shadow-lg hover:bg-edu-dark transition-all whitespace-nowrap">MAIN SEKARANG</a>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-6">
                <h2 class="text-2xl font-black text-edu-dark font-kids flex items-center gap-3">
                    <span class="bg-edu-yellow/20 p-2 rounded-xl text-2xl">🏆</span>
                    Juara Minggu Ini
                </h2>

                <div class="bg-white rounded-[2.5rem] p-6 shadow-xl border-2 border-white space-y-4">
                    <div class="flex items-center gap-4 p-4 bg-yellow-50 rounded-3xl border border-yellow-100">
                        <span class="text-2xl font-black text-edu-yellow">1</span>
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Fauzan&background=FFD93D&color=fff" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <p class="text-sm font-black text-edu-dark leading-tight">Ahmad Fauzan</p>
                            <p class="text-[10px] font-bold text-edu-orange">2.450 ⭐</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-3xl border border-gray-100">
                        <span class="text-2xl font-black text-gray-300">2</span>
                        <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=73A5CA&color=fff" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <p class="text-sm font-black text-edu-dark leading-tight">Siti Aminah</p>
                            <p class="text-[10px] font-bold text-gray-400">2.100 ⭐</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <div class="fixed bottom-8 right-8 z-50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" title="Keluar" class="w-14 h-14 bg-white text-red-500 rounded-full shadow-2xl border-4 border-white flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            </button>
        </form>
    </div>

</body>
</html>
