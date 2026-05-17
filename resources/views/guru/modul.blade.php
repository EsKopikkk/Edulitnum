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
                        'edu-blue': '#73A5CA',
                        'edu-green': '#4ADE80',
                        'edu-dark': '#1A202C',
                        'edu-bg': '#FEFDDF',
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FEFDDF; }
        h1, h2, h3 { font-family: 'Montserrat', sans-serif; }
        .kiddy-card { border-bottom-width: 8px; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .kiddy-card:hover { transform: translateY(-10px) scale(1.02); }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8">

    <main class="max-w-7xl mx-auto flex flex-col gap-8">
        
        <header class="w-full bg-white/70 backdrop-blur-md rounded-[2.5rem] p-8 flex justify-between items-center border border-white shadow-xl">
            <div>
                <h1 class="text-3xl font-black text-edu-dark">Modul Kelas 📚✨</h1>
                <p class="text-gray-400 font-medium mt-1">Halo Guru Hebat! Ayo buat materi yang menyenangkan! 🚀</p>
            </div>
            <a href="/guru/dashboard" class="bg-edu-orange text-white px-6 py-3 rounded-2xl font-bold shadow-lg hover:scale-105 transition">
                🏠 Dashboard
            </a>
        </header>

        @if(session('success'))
            <div class="bg-green-100 border-l-8 border-green-500 text-green-700 p-5 rounded-3xl font-bold animate-bounce">
                🎉 {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="bg-white rounded-[3rem] p-10 border border-white shadow-2xl h-fit sticky top-8">
                <h3 class="font-black text-2xl text-edu-dark mb-8 flex items-center gap-3">
                    <span class="p-3 bg-orange-100 text-edu-orange rounded-2xl text-xl">📝</span>
                    Materi Baru
                </h3>

                <form action="{{ route('modul.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-2">Judul Materi ✏️</label>
                        <input type="text" name="judul" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 mt-1 focus:border-edu-orange outline-none" placeholder="Cth: Belajar Perkalian Seru" required>
                    </div>
                    
                    <div>
                        <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-2">Pilih Kelas 🏫</label>
                        <select name="kelas_id" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 mt-1 focus:border-edu-orange outline-none" required>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}">Kelas {{ $k->nama_kelas ?? $k->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-2">Deskripsi Singkat 💡</label>
                        <textarea name="deskripsi" rows="2" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 mt-1 focus:border-edu-orange outline-none resize-none" placeholder="Isi sedikit tentang materinya..." required></textarea>
                    </div>

                    <div>
                        <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-2">Sampul Depan (Card) 🖼️</label>
                        <input type="file" name="gambar" class="w-full bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-3 mt-1 text-sm text-gray-400">
                    </div>

                    <div>
                        <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-2">Ilustrasi Materi (Di Dalam) 🎨</label>
                        <input type="file" name="gambar_konten" class="w-full bg-blue-50 border-2 border-dashed border-edu-blue/20 rounded-2xl p-3 mt-1 text-sm text-gray-400">
                    </div>

                    <button type="submit" class="w-full bg-edu-orange text-white py-5 rounded-3xl font-black text-sm uppercase tracking-widest mt-4 shadow-xl hover:shadow-edu-orange/40 transition-all">
                        🚀 Simpan Materi
                    </button>
                </form>
            </div>

            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($moduls as $m)
                <div class="kiddy-card bg-white rounded-[3.5rem] border border-white shadow-xl overflow-hidden flex flex-col border-edu-blue">
                    <div class="h-48 bg-gray-100 relative">
                        @if($m->gambar)
                            <img src="{{ asset('storage/' . $m->gambar) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-6xl">🎨</div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur-md text-edu-blue text-[10px] font-black px-4 py-2 rounded-full uppercase">
                                🏫 Kelas {{ $m->kelas->nama_kelas ?? $m->kelas_id }}
                            </span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h4 class="font-black text-2xl text-edu-dark mb-2">🌟 {{ $m->judul }}</h4>
                        <p class="text-sm text-gray-400 font-medium line-clamp-2 italic mb-6">"{{ $m->deskripsi }}"</p>
                        
                        <div class="flex gap-3">
                            <a href="{{ route('modul.show', $m->id) }}" class="flex-1 bg-edu-green text-white py-4 rounded-2xl text-xs font-black uppercase text-center hover:bg-green-500 shadow-md">
                                📖 Baca Yuk!
                            </a>
                            <form action="{{ route('modul.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini? 😢');">
                                @csrf @method('DELETE')
                                <button class="bg-red-50 text-red-400 w-12 h-12 flex items-center justify-center rounded-2xl border border-red-100 hover:bg-red-500 hover:text-white transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="md:col-span-2 p-20 text-center border-4 border-dashed border-gray-200 rounded-[4rem]">
                    <span class="text-7xl">📭</span>
                    <h3 class="font-black text-gray-400 mt-4">Belum ada materi seru...</h3>
                </div>
                @endforelse
            </div>
        </div>
    </main>

</body>
</html>