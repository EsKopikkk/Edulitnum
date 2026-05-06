<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Siswa | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

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
            <a href="/guru/dashboard" class="flex items-center gap-4 px-5 py-4 text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5 rounded-2xl font-bold transition-all group">
                <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <a href="{{ route('soal.index') }}" class="flex items-center gap-4 px-5 py-4 text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5 rounded-2xl font-bold transition-all group">
                <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Materi Saya
            </a>
            <a href="{{ route('guru.leaderboard') }}" class="flex items-center gap-4 px-5 py-4 sidebar-active text-white rounded-2xl font-bold transition-all group">
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

        <header class="w-full bg-white/60 backdrop-blur-md rounded-[2.5rem] p-6 flex justify-between items-center border border-white">
            <div class="px-4">
                <h1 class="text-2xl font-black text-edu-dark">Leaderboard Siswa 🏆</h1>
                <p class="text-sm text-gray-400 font-medium">Pantau nilai dan performa belajar murid-muridmu di sini.</p>
            </div>
            <div class="flex items-center gap-4 bg-edu-orange p-2 pr-6 rounded-3xl shadow-lg shadow-edu-orange/20">
                <div class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center font-black text-edu-orange">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <span class="text-white font-bold text-sm tracking-tight">Guru Aktif</span>
            </div>
        </header>

        <div class="flex-1 bg-white rounded-[3rem] p-8 border border-white shadow-xl shadow-black/5 flex flex-col overflow-hidden">
            
            <div class="flex justify-between items-center mb-8">
                <h3 class="font-black text-xl text-edu-dark">Top Performa Kelas</h3>
                <div class="flex gap-2">
                    <select class="bg-gray-50 border-2 border-gray-100 rounded-xl px-4 py-2 text-sm font-bold text-gray-500 outline-none focus:border-edu-orange">
                        <option>Semua Fase</option>
                        <option>Fase A</option>
                        <option>Fase B</option>
                        <option>Fase C</option>
                    </select>
                </div>
            </div>

            <div class="flex-1 overflow-auto rounded-2xl border-2 border-gray-50">
                <table class="w-full text-left border-collapse min-w-max">
                    <thead>
                        <tr class="bg-gray-50 border-b-2 border-gray-100">
                            <th class="p-4 text-[11px] font-black text-gray-400 uppercase tracking-widest text-center w-20">Rank</th>
                            <th class="p-4 text-[11px] font-black text-gray-400 uppercase tracking-widest">Nama Siswa</th>
                            <th class="p-4 text-[11px] font-black text-gray-400 uppercase tracking-widest text-center">Fase</th>
                            <th class="p-4 text-[11px] font-black text-gray-400 uppercase tracking-widest text-center">Waktu Submit</th>
                            <th class="p-4 text-[11px] font-black text-gray-400 uppercase tracking-widest text-center">Skor Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rankings as $index => $r)
                        <tr class="border-b border-gray-50 hover:bg-orange-50/30 transition-colors group">
                            <td class="p-4 text-center font-bold">
                                @if($index == 0) 
                                    <span class="text-2xl" title="Juara 1">🥇</span> 
                                @elseif($index == 1) 
                                    <span class="text-2xl" title="Juara 2">🥈</span> 
                                @elseif($index == 2) 
                                    <span class="text-2xl" title="Juara 3">🥉</span> 
                                @else 
                                    <div class="w-8 h-8 mx-auto rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-black">
                                        {{ $index + 1 }}
                                    </div>
                                @endif
                            </td>
                            <td class="p-4 text-sm font-bold text-edu-dark">
                                {{ $r['nama'] }}
                            </td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 rounded-lg text-xs font-bold bg-gray-100 text-gray-500">
                                    Fase {{ $r['fase'] }}
                                </span>
                            </td>
                            <td class="p-4 text-center text-sm font-medium text-gray-400">
                                {{ $r['waktu'] }} WIB
                            </td>
                            <td class="p-4 text-center">
                                <div class="inline-block px-4 py-2 rounded-xl bg-gradient-to-r from-edu-orange to-edu-dark-orange text-white font-black shadow-md shadow-edu-orange/30">
                                    {{ $r['skor'] }}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-gray-400">
                                <p class="font-medium">Belum ada data nilai tersedia saat ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
        </div>

    </main>

</body>
</html>