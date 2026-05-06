<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petualangan Edulitnum | Siswa</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Poppins:wght@400;600;700&family=Fredoka:wght@400;600;700&display=swap" rel="stylesheet">

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

        /* Animasi Melayang */
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(2deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .float-anim { animation: float 4s ease-in-out infinite; }

        /* Animasi Berdenyut */
        @keyframes pulse-custom {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(232, 127, 36, 0.7); }
            70% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(232, 127, 36, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(232, 127, 36, 0); }
        }
        .pulse-anim { animation: pulse-custom 2s infinite; }

        .card-island {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
        }
        .card-island:hover {
            transform: scale(1.05) translateY(-10px);
        }

        .custom-gradient {
            background: linear-gradient(135deg, #E87F24 0%, #FFD93D 100%);
        }
    </style>
</head>
<body class="min-h-screen pb-10">

    <nav class="p-6 flex justify-between items-center bg-white/50 backdrop-blur-md sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-edu-orange rounded-2xl flex items-center justify-center shadow-lg transform -rotate-6">
                <span class="text-white font-black text-2xl font-kids">E</span>
            </div>
            <span class="text-edu-dark font-black text-2xl font-kids tracking-tight">EDULIT<span class="text-edu-orange">NUM</span></span>
        </div>

        <div class="flex items-center gap-6">
            <div class="hidden md:flex items-center gap-4 bg-white px-5 py-2 rounded-full shadow-sm border-2 border-edu-orange/10">
                <div class="text-right">
                    <p class="text-[10px] font-bold text-gray-400 uppercase leading-none">Level 5</p>
                    <p class="text-sm font-black text-edu-dark">Penjelajah Handal</p>
                </div>
                <div class="w-10 h-10 bg-edu-yellow rounded-full flex items-center justify-center shadow-inner">
                    <span class="text-edu-dark font-black text-xs">⭐ 12</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-black text-edu-dark leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] font-bold text-edu-green uppercase">Online</p>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=E87F24&color=fff" class="w-12 h-12 rounded-2xl border-4 border-white shadow-md">
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 mt-8">

        <section class="custom-gradient rounded-[3rem] p-8 md:p-12 text-white relative overflow-hidden shadow-2xl mb-12">
            <div class="relative z-10">
                <h1 class="text-3xl md:text-5xl font-black font-kids mb-4 leading-tight">Halo, Sobat Petualang! 👋</h1>
                <p class="text-lg md:text-xl font-medium text-white/90 mb-8 max-w-xl">Ayo kumpulkan bintang hari ini dengan menyelesaikan misi Literasi dan Numerasi!</p>

                <div class="flex flex-wrap gap-4">
                    <button class="bg-white text-edu-orange px-8 py-4 rounded-2xl font-black text-sm pulse-anim flex items-center gap-2">
                        🚀 MULAI PRE-TEST
                    </button>
                    <button class="bg-edu-dark/20 backdrop-blur-md text-white px-8 py-4 rounded-2xl font-black text-sm hover:bg-edu-dark/40 transition-all border border-white/20">
                        📊 LIHAT PROGRESKU
                    </button>
                </div>
            </div>

            <div class="absolute right-10 top-10 float-anim hidden lg:block">
                <div class="w-40 h-40 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-lg border border-white/30 text-6xl">
                    🎮
                </div>
            </div>
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        </section>

        <h2 class="text-2xl font-black text-edu-dark font-kids mb-8 flex items-center gap-3">
            <span class="bg-edu-yellow w-10 h-10 flex items-center justify-center rounded-xl shadow-md">🗺️</span>
            Pilih Misimu Hari Ini
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div class="card-island bg-white p-4 rounded-[3.5rem] shadow-xl border-b-8 border-edu-blue/20">
                <div class="bg-edu-blue/10 rounded-[3rem] p-8 h-full flex flex-col items-center text-center">
                    <div class="text-7xl mb-6 float-anim">📖</div>
                    <h3 class="text-2xl font-black text-edu-dark font-kids mb-3">Pulau Literasi</h3>
                    <p class="text-sm text-gray-500 font-medium mb-8">Baca cerita seru dan temukan harta karun kata-kata!</p>
                    <div class="w-full bg-white rounded-full h-4 mb-6 p-1">
                        <div class="bg-edu-blue h-full rounded-full w-[60%]"></div>
                    </div>
                    <button class="w-full py-4 bg-edu-blue text-white rounded-2xl font-black shadow-lg shadow-edu-blue/30 hover:bg-edu-dark transition-colors uppercase tracking-widest text-xs">
                        Masuk Ke Pulau
                    </button>
                </div>
            </div>

            <div class="card-island bg-white p-4 rounded-[3.5rem] shadow-xl border-b-8 border-edu-orange/20">
                <div class="bg-edu-orange/10 rounded-[3rem] p-8 h-full flex flex-col items-center text-center">
                    <div class="text-7xl mb-6 float-anim" style="animation-delay: 1s">🧮</div>
                    <h3 class="text-2xl font-black text-edu-dark font-kids mb-3">Lembah Numerasi</h3>
                    <p class="text-sm text-gray-500 font-medium mb-8">Taklukkan angka dan jadilah jagoan matematika!</p>
                    <div class="w-full bg-white rounded-full h-4 mb-6 p-1">
                        <div class="bg-edu-orange h-full rounded-full w-[40%]"></div>
                    </div>
                    <button class="w-full py-4 bg-edu-orange text-white rounded-2xl font-black shadow-lg shadow-edu-orange/30 hover:bg-edu-dark transition-colors uppercase tracking-widest text-xs">
                        Mulai Tantangan
                    </button>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-2xl font-black text-edu-dark font-kids flex items-center gap-3">
                    <span class="bg-edu-green w-10 h-10 flex items-center justify-center rounded-xl shadow-md">🕹️</span>
                    Game Edukasi
                </h2>
                <p class="text-gray-400 text-sm font-bold italic ml-14">Bermain sambil belajar koding!</p>
            </div>
            <button class="text-edu-blue font-black text-xs hover:underline uppercase tracking-widest">Semua Game</button>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="group bg-white p-4 rounded-[2.5rem] shadow-lg hover:shadow-2xl transition-all border-2 border-transparent hover:border-edu-green">
                <div class="bg-edu-green/10 rounded-[2rem] aspect-square flex items-center justify-center text-5xl group-hover:scale-110 transition-transform mb-4 relative overflow-hidden">
                    🎮
                    <div class="absolute inset-0 bg-gradient-to-t from-edu-green/20 to-transparent"></div>
                </div>
                <h4 class="font-black text-edu-dark text-center text-sm">Labirin Koding</h4>
                <p class="text-[10px] text-center text-gray-400 font-bold uppercase mt-1">+50 XP</p>
            </div>

            <div class="group bg-white p-4 rounded-[2.5rem] shadow-lg hover:shadow-2xl transition-all border-2 border-transparent hover:border-edu-blue">
                <div class="bg-edu-blue/10 rounded-[2rem] aspect-square flex items-center justify-center text-5xl group-hover:scale-110 transition-transform mb-4 relative overflow-hidden">
                    🧩
                    <div class="absolute inset-0 bg-gradient-to-t from-edu-blue/20 to-transparent"></div>
                </div>
                <h4 class="font-black text-edu-dark text-center text-sm">Puzzle Literasi</h4>
                <p class="text-[10px] text-center text-gray-400 font-bold uppercase mt-1">+30 XP</p>
            </div>

            <div class="group bg-white p-4 rounded-[2.5rem] shadow-lg hover:shadow-2xl transition-all border-2 border-transparent hover:border-edu-yellow">
                <div class="bg-edu-yellow/10 rounded-[2rem] aspect-square flex items-center justify-center text-5xl group-hover:scale-110 transition-transform mb-4 relative overflow-hidden">
                    🚀
                    <div class="absolute inset-0 bg-gradient-to-t from-edu-yellow/20 to-transparent"></div>
                </div>
                <h4 class="font-black text-edu-dark text-center text-sm">Roket Angka</h4>
                <p class="text-[10px] text-center text-gray-400 font-bold uppercase mt-1">+40 XP</p>
            </div>

            <div class="bg-gray-100 p-4 rounded-[2.5rem] shadow-none border-2 border-dashed border-gray-300 opacity-50">
                <div class="bg-gray-200 rounded-[2rem] aspect-square flex items-center justify-center text-5xl mb-4">
                    🔒
                </div>
                <h4 class="font-black text-gray-400 text-center text-sm">Segera Datang</h4>
                <p class="text-[10px] text-center text-gray-300 font-bold uppercase mt-1">Level 10</p>
            </div>
        </div>

    </main>

    <div class="fixed bottom-10 right-10">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-white text-red-500 w-16 h-16 rounded-full shadow-2xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all group border-4 border-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            </button>
        </form>
    </div>

</body>
</html>
