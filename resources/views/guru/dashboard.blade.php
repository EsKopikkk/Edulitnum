<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght=700;800&family=Poppins:wght=300;400;500;600&display=swap" rel="stylesheet">

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
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; }

        .sidebar-active {
            background: #E87F24;
            box-shadow: 0 10px 20px rgba(232, 127, 36, 0.3);
            transform: scale(1.03);
        }

        .blob {
            position: fixed;
            width: 400px;
            height: 400px;
            background: #E87F24;
            filter: blur(120px);
            opacity: 0.08;
            z-index: -1;
            border-radius: 50%;
        }
        
        .premium-gradient {
            background: linear-gradient(135deg, #E87F24 0%, #F19E38 100%);
        }
    </style>
</head>
<body class="min-h-screen flex p-4 md:p-6 gap-6">

    @php
        // ===================================================================
        // PROSES DATA REAL-TIME KEBAL EROR (MENGGUNAKAN AMAN ACCESSOR)
        // ===================================================================
        $semuaSiswa = \App\Models\User::where('role', 'siswa')->get();
        
        // 1. Total Siswa Real-time
        $realtimeTotalSiswa = $semuaSiswa->count();
        
        // 2. Tugas Selesai Real-time (Siswa yang sudah menuntaskan Pretest)
        $realtimeTugasSelesai = \App\Models\User::where('role', 'siswa')->where('is_pretest_done', true)->count();
        
        // 3. Total Poin Kelas Real-time (Akumulasi seluruh XP siswa)
        $totalPoinRaw = $semuaSiswa->sum('total_score_xp');
        $realtimePoinKelas = $totalPoinRaw >= 1000 ? round($totalPoinRaw / 1000, 1) . 'k' : $totalPoinRaw;

        // 4. Ranking 3 Besar untuk Papan Sebelah Kanan
        $top3Penyelam = $semuaSiswa->sortByDesc('total_score_xp')->take(3);
    @endphp

    <div class="blob -top-20 -left-20"></div>
    <div class="blob -bottom-20 -right-20" style="background: #73A5CA;"></div>

    <aside class="w-72 bg-white/80 backdrop-blur-xl rounded-[3rem] shadow-2xl shadow-edu-orange/10 p-8 flex flex-col border border-white shrink-0">
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
            <a href="/guru/dashboard" class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all group sidebar-active text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <a href="{{ route('modul.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all group text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Modul Materi
            </a>

            <a href="{{ route('soal.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all group text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Materi Saya
            </a>

            <a href="{{ route('guru.leaderboard') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all group text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
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

    <main class="flex-1 flex flex-col gap-6 w-full overflow-hidden">

        <header class="w-full bg-white/60 backdrop-blur-md rounded-[2.5rem] p-6 flex justify-between items-center border border-white shadow-sm">
            <div class="px-4">
                <h1 class="text-2xl font-black text-edu-dark tracking-tight">Semangat Mengajar, Ibu Sarah! 🍎</h1>
                <p class="text-sm text-gray-400 font-medium">Hari ini adalah hari yang luar biasa untuk berbagi ilmu.</p>
            </div>
            <div class="flex items-center gap-4 bg-white border-2 border-gray-100 p-2 pr-6 rounded-3xl shadow-sm">
                <div class="w-10 h-10 bg-edu-orange rounded-2xl flex items-center justify-center font-black text-white shadow-md">
                    I
                </div>
                <span class="text-edu-dark font-bold text-sm tracking-tight">Guru Aktif</span>
            </div>
        </header>

        <div class="flex-1 grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <div class="lg:col-span-8 flex flex-col gap-6 w-full">
                
                <div class="premium-gradient rounded-[3rem] p-8 lg:p-10 text-white relative overflow-hidden shadow-2xl shadow-edu-orange/20 border border-white/20 group">
                    <div class="absolute -right-10 -bottom-10 w-44 h-44 bg-white/10 rounded-full blur-xl group-hover:scale-125 transition-transform duration-700"></div>
                    <div class="relative z-10 max-w-md">
                        <span class="bg-white/20 text-white font-bold text-[10px] uppercase tracking-widest px-3 py-1 rounded-full border border-white/10 backdrop-blur-sm">Aktivitas Modul</span>
                        <h2 class="text-3xl font-black mt-4 leading-tight tracking-tight">Siapkan Materi Numerasi & Literasi Seru Sekarang!</h2>
                        <p class="text-white/80 text-xs font-medium mt-2 leading-relaxed">Anak-anak sangat menantikan tantangan koding dan kuis petualangan bawah laut yang baru dari Anda.</p>
                        <a href="{{ route('soal.create') }}" class="mt-6 px-6 py-3.5 bg-white text-edu-orange font-black text-xs uppercase tracking-wider rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transition-all inline-block">
                            + Buat Soal Baru
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    
                    <div class="bg-white rounded-[2.5rem] p-6 border border-white shadow-xl shadow-black/5 flex items-center gap-5 hover:scale-105 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-3xl flex items-center justify-center text-2xl shadow-inner group-hover:bg-blue-500 group-hover:text-white transition-all duration-300">
                            👥
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Total Siswa</p>
                            <h3 class="text-3xl font-black text-edu-dark mt-0.5">{{ $realtimeTotalSiswa }}</h3>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] p-6 border border-white shadow-xl shadow-black/5 flex items-center gap-5 hover:scale-105 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-green-50 text-green-500 rounded-3xl flex items-center justify-center text-2xl shadow-inner group-hover:bg-green-500 group-hover:text-white transition-all duration-300">
                            ✅
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Tugas Selesai</p>
                            <h3 class="text-3xl font-black text-edu-dark mt-0.5">{{ $realtimeTugasSelesai }}</h3>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] p-6 border border-white shadow-xl shadow-black/5 flex items-center gap-5 hover:scale-105 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-amber-50 text-amber-500 rounded-3xl flex items-center justify-center text-2xl shadow-inner group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                            🏆
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Poin Kelas</p>
                            <h3 class="text-3xl font-black text-edu-dark mt-0.5">{{ $realtimePoinKelas }}</h3>
                        </div>
                    </div>

                </div>
            </div>

            <div class="lg:col-span-4 w-full">
                <div class="bg-white rounded-[2.5rem] p-6 lg:p-8 border border-white shadow-xl shadow-black/5 flex flex-col h-fit">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-black text-base text-edu-dark tracking-tight uppercase tracking-wider text-gray-400">Ranking Kelas</h3>
                        <span class="text-xl text-orange-400 animate-pulse">⭐</span>
                    </div>

                    <div class="space-y-4" id="live-dashboard-ranking">
                        @forelse($top3Penyelam as $index => $penyelam)
                            <div class="flex items-center justify-between border-b border-gray-50 pb-3 last:border-0 last:pb-0 group">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-black text-sm transition-all group-hover:scale-110
                                        {{ $index == 0 ? 'bg-edu-orange text-white shadow-md shadow-edu-orange/30' : 'bg-gray-100 text-gray-500 border border-gray-200' }}">
                                        {{ $index + 1 }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-sm text-edu-dark tracking-tight group-hover:text-edu-orange transition-colors">{{ $penyelam->name }}</h4>
                                        <p class="text-[10px] font-black text-gray-400 mt-0.5 uppercase tracking-wider">
                                            {{ $penyelam->total_score_xp ?? 0 }} Poin
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-xs font-bold text-gray-400 uppercase tracking-widest">
                                Belum ada penyelam aktif 🌊
                            </div>
                        @endforelse
                    </div>

                    <a href="{{ route('guru.leaderboard') }}" class="mt-6 w-full py-4 bg-gray-50 hover:bg-edu-orange border-2 border-dashed border-gray-200 hover:border-transparent rounded-2xl text-center font-black text-[11px] text-gray-400 hover:text-white uppercase tracking-widest transition-all block shadow-inner">
                        Lihat Seluruh Siswa
                    </a>
                </div>
            </div>

        </div>

    </main>

</body>
</html>