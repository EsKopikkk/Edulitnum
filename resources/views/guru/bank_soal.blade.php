<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Soal | Edulitnum</title>

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
            <a href="/guru/dashboard" class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all group {{ request()->is('guru/dashboard') ? 'sidebar-active text-white' : 'text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5' }}">
                <svg class="w-6 h-6 {{ request()->is('guru/dashboard') ? '' : 'group-hover:rotate-12 transition-transform' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <a href="{{ route('modul.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all group {{ request()->routeIs('modul.*') ? 'sidebar-active text-white' : 'text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5' }}">
                <svg class="w-6 h-6 {{ request()->routeIs('modul.*') ? '' : 'group-hover:rotate-12 transition-transform' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Modul Materi
            </a>

            <a href="{{ route('soal.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all group {{ request()->routeIs('soal.*') ? 'sidebar-active text-white' : 'text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5' }}">
                <svg class="w-6 h-6 {{ request()->routeIs('soal.*') ? '' : 'group-hover:rotate-12 transition-transform' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Materi Saya
            </a>

            <a href="{{ route('guru.leaderboard') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all group {{ request()->routeIs('guru.leaderboard') ? 'sidebar-active text-white' : 'text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5' }}">
                <svg class="w-6 h-6 {{ request()->routeIs('guru.leaderboard') ? '' : 'group-hover:rotate-12 transition-transform' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
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
                <h1 class="text-2xl font-black text-edu-dark">Materi Saya 📚</h1>
                <p class="text-sm text-gray-400 font-medium">Kelola bank soal literasi dan numerasi untuk muridmu.</p>
            </div>
            <div class="flex items-center gap-4 bg-edu-orange p-2 pr-6 rounded-3xl shadow-lg shadow-edu-orange/20">
                <div class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center font-black text-edu-orange">
                    {{ substr(Auth::user()->name ?? 'G', 0, 1) }}
                </div>
                <span class="text-white font-bold text-sm tracking-tight">Guru Aktif</span>
            </div>
        </header>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-2xl font-bold flex items-center gap-3 shadow-sm">
                <span class="text-xl">✅</span> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] p-6 lg:p-8 border border-white shadow-xl shadow-black/5 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-edu-orange/5 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10">
                <h3 class="text-xl font-black text-edu-dark flex items-center gap-3">
                    <span class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-xl shadow-sm">📥</span> 
                    Import Soal Massal
                </h3>
                <p class="text-sm text-gray-400 font-medium mt-2">Punya puluhan soal di Excel? Upload langsung di sini biar cepat!</p>
                
                <a href="{{ asset('template_soal.xlsx') }}" download class="inline-flex items-center gap-2 mt-4 text-xs font-bold text-edu-blue bg-edu-blue/10 px-4 py-2 rounded-lg hover:bg-edu-blue hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download Template Excel
                </a>
            </div>

            <form action="{{ route('soal.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto relative z-10">
                @csrf
                <div class="relative w-full sm:w-auto">
                    <input type="file" name="file_excel" accept=".xlsx, .xls, .csv" required
                        class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-3 file:px-5
                        file:rounded-xl file:border-0
                        file:text-xs file:font-black file:uppercase file:tracking-widest
                        file:bg-edu-orange/10 file:text-edu-orange
                        hover:file:bg-edu-orange hover:file:text-white transition-all cursor-pointer bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 p-2 focus:outline-none focus:border-edu-orange">
                </div>

                <button type="submit" class="w-full sm:w-auto bg-edu-dark text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-edu-orange hover:shadow-lg hover:-translate-y-1 transition-all shrink-0">
                    🚀 UPLOAD
                </button>
            </form>
        </div>

        <div class="flex-1 bg-white rounded-[3rem] p-8 border border-white shadow-xl shadow-black/5 flex flex-col overflow-hidden">
            
            <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
                <h3 class="font-black text-xl text-edu-dark">Daftar Soal</h3>
                
                <div class="flex items-center gap-3">
                    @if(count($soal) > 0)
                        <form action="{{ route('soal.deleteAllGlobal') }}" method="POST" onsubmit="return confirm('⚠️ PERINGATAN KERAS!\nApakah Anda yakin ingin menghapus SELURUH soal yang ada di Bank Soal? Data tidak bisa dikembalikan!');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all text-xs font-black px-5 py-3.5 rounded-2xl border border-red-100 shadow-sm flex items-center gap-2">
                                🗑️ HAPUS SEMUA SOAL
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('soal.create') }}" class="bg-edu-orange text-white px-6 py-3.5 rounded-2xl font-black text-xs hover:-translate-y-1 hover:shadow-lg hover:shadow-edu-orange/30 transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        TAMBAH SOAL
                    </a>
                </div>
            </div>

            <div class="flex-1 overflow-auto rounded-2xl border-2 border-gray-50">
                <table class="w-full text-left border-collapse min-w-max">
                    <thead>
                        <tr class="bg-gray-50 border-b-2 border-gray-100">
                            <th class="p-4 text-[11px] font-black text-gray-400 uppercase tracking-widest text-center w-16">No</th>
                            <th class="p-4 text-[11px] font-black text-gray-400 uppercase tracking-widest">Pertanyaan</th>
                            <th class="p-4 text-[11px] font-black text-gray-400 uppercase tracking-widest">Modul</th> 
                            <th class="p-4 text-[11px] font-black text-gray-400 uppercase tracking-widest text-center">Kategori</th>
                            <th class="p-4 text-[11px] font-black text-gray-400 uppercase tracking-widest text-center">Fase</th>
                            <th class="p-4 text-[11px] font-black text-gray-400 uppercase tracking-widest text-center">Kunci</th>
                            <th class="p-4 text-[11px] font-black text-gray-400 uppercase tracking-widest text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($soal as $index => $s)
                        <tr class="border-b border-gray-50 hover:bg-orange-50/30 transition-colors group">
                            <td class="p-4 text-center font-bold text-gray-400">{{ $index + 1 }}</td>
                            <td class="p-4 text-sm font-medium text-edu-dark">
                                {{ \Illuminate\Support\Str::limit($s->pertanyaan, 50) }}
                            </td>
                            <td class="p-4 text-xs font-bold text-edu-blue">
                                {{ $s->modul->judul ?? 'Belum Ada Modul' }}
                            </td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 rounded-lg text-xs font-bold {{ strtolower($s->kategori) == 'literasi' ? 'bg-blue-50 text-edu-blue' : 'bg-orange-50 text-edu-orange' }}">
                                    {{ ucfirst($s->kategori) }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 rounded-lg text-xs font-bold bg-gray-100 text-gray-500">
                                    Fase {{ strtoupper($s->fase) }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <div class="w-8 h-8 mx-auto rounded-xl bg-green-50 flex items-center justify-center font-black text-green-500 border border-green-100">
                                    {{ $s->kunci_jawaban }}
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('soal.edit', $s->id) }}" class="p-2 bg-edu-blue/10 text-edu-blue rounded-xl hover:bg-edu-blue hover:text-white transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('soal.destroy', $s->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus soal ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-12 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <p class="font-medium">Belum ada soal. Yuk buat soal pertamamu!</p>
                                </div>
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