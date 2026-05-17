<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Modul | Edulitnum</title>

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
            <div class="w-12 h-12 bg-edu-orange rounded-2xl flex items-center justify-center shadow-lg">
                <span class="text-white font-black text-2xl">E</span>
            </div>
            <div>
                <span class="text-edu-dark font-black text-xl tracking-tighter block">GURU</span>
                <span class="text-edu-orange font-bold text-xs uppercase tracking-widest">Portal Panel</span>
            </div>
        </div>

        <nav class="flex-1 space-y-3">
            <a href="/guru/dashboard" class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all group text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5">
                <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <a href="{{ route('modul.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all group sidebar-active text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Modul Materi
            </a>

            <a href="{{ route('soal.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all group text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5">
                <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Materi Saya
            </a>

            <a href="{{ route('guru.leaderboard') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl font-bold transition-all group text-gray-400 hover:text-edu-orange hover:bg-edu-orange/5">
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

    <main class="flex-1 flex flex-col gap-6 w-full overflow-hidden">

        <header class="w-full bg-white/60 backdrop-blur-md rounded-[2.5rem] p-6 flex justify-between items-center border border-white shadow-sm">
            <div class="px-4">
                <h1 class="text-2xl font-black text-edu-dark tracking-tight">Edit Modul Petualangan ✏️</h1>
                <p class="text-sm text-gray-400 font-medium">Perbarui data modul sesuai dengan isi form pembuatan baru.</p>
            </div>
            <a href="{{ route('modul.index') }}" class="bg-gray-100 hover:bg-gray-200 text-edu-dark px-6 py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest transition-all">
                ⬅️ KEMBALI
            </a>
        </header>

        <div class="flex-1 bg-white rounded-[3rem] p-8 lg:p-10 border border-white shadow-xl shadow-black/5 overflow-auto">
            
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-2xl font-bold mb-6 shadow-sm">
                    <p class="text-sm font-black uppercase tracking-wider mb-2">⚠️ Gagal Menyimpan! Periksa Input Berikut:</p>
                    <ul class="list-disc list-inside text-xs font-medium space-y-1 text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('modul.update', $modul->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-4xl">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Pilih Kelas</label>
                        <select name="kelas_id" required
                            class="w-full bg-gray-50 text-edu-dark p-4 rounded-2xl border-2 border-gray-100 font-bold focus:outline-none focus:border-edu-orange focus:bg-white transition-all cursor-pointer">
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id', $modul->kelas_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas ?? $k->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Kategori Modul</label>
                        <select name="jenis_modul" required
                            class="w-full bg-gray-50 text-edu-dark p-4 rounded-2xl border-2 border-gray-100 font-bold focus:outline-none focus:border-edu-orange focus:bg-white transition-all cursor-pointer">
                            <option value="literasi" {{ old('jenis_modul', strtolower($modul->jenis_modul)) == 'literasi' ? 'selected' : '' }}>Literasi Samudera</option>
                            <option value="numerasi" {{ old('jenis_modul', strtolower($modul->jenis_modul)) == 'numerasi' ? 'selected' : '' }}>Numerasi Samudera</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Tingkatan Fase</label>
                        <select name="fase"
                            class="w-full bg-gray-50 text-edu-dark p-4 rounded-2xl border-2 border-gray-100 font-bold focus:outline-none focus:border-edu-orange focus:bg-white transition-all cursor-pointer">
                            <option value="a" {{ old('fase', strtolower($modul->fase)) == 'a' ? 'selected' : '' }}>Fase A (Kelas 1-2 SD)</option>
                            <option value="b" {{ old('fase', strtolower($modul->fase)) == 'b' ? 'selected' : '' }}>Fase B (Kelas 3-4 SD)</option>
                            <option value="c" {{ old('fase', strtolower($modul->fase)) == 'c' ? 'selected' : '' }}>Fase C (Kelas 5-6 SD)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Judul Modul</label>
                    <input type="text" name="judul" value="{{ old('judul', $modul->judul) }}" required placeholder="Masukkan judul materi..."
                        class="w-full bg-gray-50 text-edu-dark p-4 rounded-2xl border-2 border-gray-100 font-bold focus:outline-none focus:border-edu-orange focus:bg-white transition-all">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Deskripsi Singkat (Tampil di Menu Utama)</label>
                    <p class="text-xs text-gray-400 font-medium mb-2">Teks pendek ringkasan cerita pemancing minat baca siswa.</p>
                    <textarea name="deskripsi" rows="3" required placeholder="Tulis deskripsi pendek kartu modul di sini..."
                        class="w-full bg-gray-50 text-edu-dark p-4 rounded-2xl border-2 border-gray-100 font-medium focus:outline-none focus:border-edu-orange focus:bg-white transition-all leading-relaxed">{{ old('deskripsi', $modul->deskripsi) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Isi Materi / Cerita Petualangan Lengkap</label>
                    <p class="text-xs text-gray-400 font-medium mb-2">Narasi lengkap materi petualangan bawah laut Edulitnum.</p>
                    <textarea name="isi_materi" rows="8" required placeholder="Tuliskan isi materi lengkap di sini..."
                        class="w-full bg-gray-50 text-edu-dark p-4 rounded-2xl border-2 border-gray-100 font-medium focus:outline-none focus:border-edu-orange focus:bg-white transition-all leading-relaxed">{{ old('isi_materi', $modul->isi_materi) }}</textarea>
                </div>

                <div class="p-6 bg-orange-50/60 rounded-[2rem] border border-orange-100 relative overflow-hidden">
                    <div class="absolute -right-5 -bottom-5 text-6xl opacity-10 select-none">✍️</div>
                    <label class="block text-xs font-black uppercase tracking-widest text-orange-500 mb-2">⭐ Soal Tantangan Akhir Modul (Esai Bebas)</label>
                    <p class="text-xs text-gray-400 font-medium mb-3">Pertanyaan esai terbuka di akhir halaman modul untuk melatih critical thinking anak-anak.</p>
                    <textarea name="soal_numerik" rows="3" placeholder="Masukkan pertanyaan esai kritis..."
                        class="w-full bg-white text-edu-dark p-4 rounded-2xl border-2 border-orange-100 font-medium focus:outline-none focus:border-edu-orange transition-all leading-relaxed">{{ old('soal_numerik', $modul->soal_numerik) }}</textarea>
                </div>

                <div class="pt-4 flex flex-col sm:flex-row gap-4">
                    <button type="submit" class="bg-edu-orange text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-edu-dark-orange hover:shadow-xl hover:shadow-edu-orange/20 transition-all">
                        💾 SIMPAN PERUBAHAN MODUL
                    </button>
                    <a href="{{ route('modul.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-500 px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all flex items-center justify-center">
                        BATAL
                    </a>
                </div>

            </form>

        </div>
    </main>

</body>
</html>