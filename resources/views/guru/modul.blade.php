<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Materi | Edulitnum</title>

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
                <h1 class="text-2xl font-black text-edu-dark">Modul Kelas 📚</h1>
                <p class="text-sm text-gray-400 font-medium">Buat materi bacaan sebelum siswa mengerjakan kuis.</p>
            </div>
            <div class="flex items-center gap-4 bg-edu-orange p-2 pr-6 rounded-3xl shadow-lg shadow-edu-orange/20">
                <div class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center font-black text-edu-orange">
                    {{ substr(Auth::user()->name ?? 'G', 0, 1) }}
                </div>
                <span class="text-white font-bold text-sm tracking-tight">Guru Aktif</span>
            </div>
        </header>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-2xl font-bold shadow-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-[2.5rem] p-8 border border-white shadow-xl h-fit lg:sticky lg:top-6 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-edu-orange/5 rounded-full blur-2xl pointer-events-none"></div>
                
                <h3 class="font-black text-xl text-edu-dark mb-6 relative z-10 flex items-center gap-2">
                    <span class="w-8 h-8 bg-orange-100 text-edu-orange rounded-lg flex items-center justify-center text-sm">➕</span>
                    Buat Modul Baru
                </h3>

                <form action="{{ route('modul.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 relative z-10">
                    @csrf
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Judul Modul</label>
                        <input type="text" name="judul" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-medium mt-1 focus:border-edu-orange focus:outline-none transition-colors" placeholder="Cth: Bab 1 Puisi" required>
                    </div>
                    
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Pilih Kelas</label>
                        <div class="relative">
                            <select name="kelas_id" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-medium mt-1 appearance-none cursor-pointer focus:border-edu-orange focus:outline-none transition-colors" required>
                                @if($kelas->isEmpty())
                                    <option value="" disabled selected>Belum ada kelas (Tambahkan kelas di database)</option>
                                @else
                                    <option value="" disabled selected>-- Klik Pilih Kelas --</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}">Kelas {{ $k->nama_kelas ?? $k->id }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none mt-1">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Deskripsi/Isi Singkat</label>
                        <textarea name="deskripsi" rows="3" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-medium mt-1 focus:border-edu-orange focus:outline-none transition-colors resize-none" placeholder="Materi tentang..." required></textarea>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">📎 File Materi (PDF, Doc, PPT, Gambar)</label>
                        <input type="file" name="file_materi" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-medium mt-1 focus:border-edu-orange focus:outline-none transition-colors cursor-pointer" accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.jpeg,.png">
                        <p class="text-xs text-gray-400 mt-2">Ukuran max: 10MB (Opsional)</p>
                    </div>

                    <button type="submit" class="w-full bg-edu-orange text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest mt-4 hover:-translate-y-1 hover:shadow-lg hover:shadow-edu-orange/30 transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        Simpan Modul
                    </button>
                </form>
            </div>

            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                @forelse($moduls as $m)
                <div class="bg-white p-6 rounded-[2.5rem] border border-white shadow-xl shadow-black/5 flex flex-col justify-between group hover:-translate-y-2 transition-transform duration-300">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-14 h-14 bg-edu-blue/10 text-edu-blue rounded-2xl flex items-center justify-center text-3xl group-hover:scale-110 transition-transform">📖</div>
                            <span class="bg-gray-50 border border-gray-100 text-gray-500 text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-sm">
                                Kelas {{ $m->kelas->nama_kelas ?? $m->kelas_id }}
                            </span>
                        </div>
                        <h4 class="font-black text-xl text-edu-dark leading-tight">{{ $m->judul }}</h4>
                        <p class="text-sm text-gray-400 mt-2 line-clamp-2 font-medium">{{ $m->deskripsi }}</p>
                    </div>
                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('modul.show', $m->id) }}" class="flex-1 bg-edu-blue/10 text-edu-blue py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-edu-blue hover:text-white transition-colors border border-edu-blue/20 text-center">
    Lihat Isi
</a>
                        
                        <form action="{{ route('modul.destroy', $m->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus modul ini?');">
                            @csrf @method('DELETE')
                            <button class="bg-red-50 text-red-500 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition-colors border border-red-100" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="md:col-span-2 bg-white/50 backdrop-blur-sm border-2 border-dashed border-gray-200 rounded-[3rem] p-16 flex flex-col items-center justify-center text-center">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-sm mb-4">
                        <span class="text-4xl opacity-50">📭</span>
                    </div>
                    <h3 class="font-black text-gray-400 text-lg">Belum Ada Modul</h3>
                    <p class="text-sm text-gray-400 mt-1">Gunakan form di samping untuk membuat materi pertamamu.</p>
                </div>
                @endforelse
            </div>

        </div>

    </main>

</body>
</html>