<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru Dashboard | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'edu-orange': '#E87F24',
                        'edu-dark-orange': '#C66A1B',
                        'edu-blue': '#73A5CA',
                        'edu-bg': '#FEFDDF',
                        'edu-dark': '#1A202C',
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FEFDDF; overflow-x: hidden; }
        h1, h2, h3 { font-family: 'Montserrat', sans-serif; }

        .orange-glass {
            background: rgba(232, 127, 36, 0.05);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(232, 127, 36, 0.1);
        }

        .sidebar-active {
            background: #E87F24;
            box-shadow: 0 10px 20px rgba(232, 127, 36, 0.3);
            transform: scale(1.05);
        }

        .blob {
            position: fixed;
            width: 400px;
            height: 400px;
            background: #E87F24;
            filter: blur(100px);
            opacity: 0.1;
            z-index: -1;
            border-radius: 50%;
        }
    </style>
</head>
<body class="min-h-screen flex p-4 md:p-6 gap-6">

    <div class="blob -top-20 -left-20"></div>
    <div class="blob -bottom-20 -right-20" style="background: #73A5CA;"></div>

    <aside class="w-72 bg-white/80 backdrop-blur-xl rounded-[3rem] shadow-2xl shadow-edu-orange/10 p-8 flex flex-col border border-white">
        <div class="flex items-center gap-4 mb-12">
            <div class="w-12 h-12 bg-edu-orange rounded-2xl flex items-center justify-center shadow-lg animate-bounce duration-[3s]">
                <span class="text-white font-black text-2xl">E</span>
            </div>
            <div>
                <span class="text-edu-dark font-black text-xl tracking-tighter block">GURU</span>
                <span class="text-edu-orange font-bold text-xs uppercase tracking-widest">Portal Panel</span>
            </div>
        </div>

        <nav class="flex-1 space-y-3">
            <a href="#" class="flex items-center gap-4 px-5 py-4 sidebar-active text-white rounded-2xl font-bold transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <!-- Link ke Bank Soal -->
            <a href="{{ route('soal.index') }}" class="flex items-center gap-4 px-5 py-4 text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5 rounded-2xl font-bold transition-all group">
                <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Materi Saya
            </a>
            <!-- Link ke Leaderboard -->
            <a href="{{ route('guru.leaderboard') }}" class="flex items-center gap-4 px-5 py-4 text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5 rounded-2xl font-bold transition-all group">
                <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Nilai Siswa
            </a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button class="w-full flex items-center gap-4 px-5 py-4 text-red-400 hover:bg-red-50 rounded-2xl font-bold transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Log Out
            </button>
        </form>
    </aside>

    <main class="flex-1 flex flex-col gap-6">

        <header class="w-full bg-white/60 backdrop-blur-md rounded-[2.5rem] p-6 flex justify-between items-center border border-white">
            <div class="px-4">
                <h1 class="text-2xl font-black text-edu-dark">Semangat Mengajar, <span class="text-edu-orange">{{ Auth::user()->name }}!</span> 🍎</h1>
                <p class="text-sm text-gray-400 font-medium">Hari ini adalah hari yang luar biasa untuk berbagi ilmu.</p>
            </div>
            <div class="flex items-center gap-4 bg-edu-orange p-2 pr-6 rounded-3xl shadow-lg shadow-edu-orange/20">
                <div class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center font-black text-edu-orange">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <span class="text-white font-bold text-sm tracking-tight">Guru Aktif</span>
            </div>
        </header>

        <div class="flex-1 grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-gradient-to-br from-edu-orange to-edu-dark-orange rounded-[3rem] p-10 text-white relative overflow-hidden shadow-2xl shadow-edu-orange/30">
                    <div class="relative z-10 max-w-md">
                        <h2 class="text-3xl font-black mb-4 leading-tight">Siapkan Materi Numerasi Seru Sekarang!</h2>
                        <p class="text-white/80 text-sm mb-8 font-medium">Anak-anak sangat menantikan tantangan koding baru dari Bapak/Ibu Guru.</p>
                        <a href="{{ route('soal.create') }}" class="inline-block bg-white text-edu-orange px-8 py-4 rounded-2xl font-black text-sm hover:scale-110 transition-transform active:scale-95 shadow-xl">
    + BUAT SOAL BARU
</a>
                    </div>
                    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                </div>

                <div class="grid grid-cols-3 gap-6">
                    <div class="bg-white rounded-[2.5rem] p-6 border border-white text-center group hover:border-edu-orange transition-all">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Total Siswa</p>
                        <h4 class="text-3xl font-black text-edu-dark group-hover:text-edu-orange transition-colors">48</h4>
                    </div>
                    <div class="bg-white rounded-[2.5rem] p-6 border border-white text-center group hover:border-edu-blue transition-all">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Tugas Selesai</p>
                        <h4 class="text-3xl font-black text-edu-dark group-hover:text-edu-blue transition-colors">12</h4>
                    </div>
                    <div class="bg-white rounded-[2.5rem] p-6 border border-white text-center group hover:border-edu-orange transition-all">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Poin Kelas</p>
                        <h4 class="text-3xl font-black text-edu-dark group-hover:text-edu-orange transition-colors">2.4k</h4>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-[3rem] p-8 border border-white shadow-xl shadow-black/5 h-full">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="font-black text-edu-dark">Ranking Kelas</h3>
                        <svg class="w-6 h-6 text-edu-orange" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-edu-orange flex items-center justify-center font-black text-white shadow-lg">1</div>
                            <div class="flex-1">
                                <p class="text-sm font-black text-edu-dark leading-none">Ahmad Fauzan</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">980 Poin</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 opacity-70">
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center font-black text-gray-500">2</div>
                            <div class="flex-1">
                                <p class="text-sm font-black text-edu-dark leading-none">Siti Aminah</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">945 Poin</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 opacity-70">
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center font-black text-gray-500">3</div>
                            <div class="flex-1">
                                <p class="text-sm font-black text-edu-dark leading-none">Budi Pratama</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">890 Poin</p>
                            </div>
                        </div>
                    </div>

                   <a href="{{ route('guru.leaderboard') }}" class="block text-center w-full mt-10 py-4 border-2 border-dashed border-gray-100 rounded-2xl text-gray-400 font-bold text-xs hover:border-edu-orange hover:text-edu-orange transition-all">
    LIHAT SELURUH SISWA
</a>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
