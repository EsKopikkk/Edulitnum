<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $modul->judul }} | Edulitnum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 
                        'edu-orange': '#E87F24', 
                        'edu-blue': '#73A5CA', 
                        'edu-bg': '#FEFDDF',
                        'edu-dark': '#1A202C',
                        'edu-green': '#4ADE80'
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FEFDDF; }
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="p-4 md:p-10 min-h-screen">

    <div class="max-w-5xl mx-auto space-y-8">
        <a href="{{ route('modul.index') }}" class="inline-flex items-center gap-2 text-edu-orange font-bold hover:translate-x-[-5px] transition-all">
            ⬅️ Kembali ke Daftar Modul
        </a>

        <article class="bg-white rounded-[4rem] shadow-2xl overflow-hidden border-b-[15px] border-edu-blue">
            <div class="h-80 bg-gray-100 relative">
                @if($modul->gambar)
                    <img src="{{ asset('storage/' . $modul->gambar) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-8xl bg-orange-50">📖</div>
                @endif
                <div class="absolute bottom-8 left-8">
                    <span class="bg-edu-orange text-white px-8 py-3 rounded-full font-black text-sm shadow-xl uppercase">
                        🏫 KELAS {{ $modul->kelas->nama_kelas ?? $modul->kelas_id }}
                    </span>
                </div>
            </div>

            <div class="p-10 md:p-16 space-y-8">
                <h1 class="text-4xl md:text-5xl font-black text-gray-800 leading-tight text-center">
                    🌟 {{ $modul->judul }}
                </h1>

                <div class="text-gray-600 leading-relaxed text-lg space-y-8">
                    <p class="text-2xl italic text-gray-400 text-center border-y-2 border-gray-50 py-6">
                        "{!! nl2br(e($modul->deskripsi)) !!}"
                    </p>

                    @if($modul->gambar_konten)
                        <div class="my-12">
                            <img src="{{ asset('storage/' . $modul->gambar_konten) }}" class="w-full rounded-[3rem] shadow-2xl border-[10px] border-white transform rotate-1 hover:rotate-0 transition-transform duration-500">
                            <p class="text-center text-xs font-black text-gray-400 mt-4 uppercase tracking-widest italic">📸 Gambar Ilustrasi Materi</p>
                        </div>
                    @endif
                    
                    <div class="bg-blue-50/50 p-10 rounded-[3rem] border-2 border-dashed border-edu-blue/30">
                        <h3 class="font-black text-edu-blue mb-6 flex items-center gap-3 text-2xl">
                            <span>📖</span> Isi Materi Bacaan:
                        </h3>
                        <div class="text-gray-700 whitespace-pre-line text-xl leading-loose">
                            {{ $modul->isi_materi }}
                        </div>
                    </div>

                    @if($modul->soal_numerik)
                        <div class="p-10 rounded-[3rem] border-2 border-dashed shadow-sm {{ $modul->jenis_modul == 'literasi' ? 'bg-purple-50 border-purple-400/40' : 'bg-amber-50 border-amber-400/40' }}">
                            <h3 class="font-black mb-6 flex items-center gap-3 text-2xl {{ $modul->jenis_modul == 'literasi' ? 'text-purple-600' : 'text-amber-600' }}">
                                <span>{{ $modul->jenis_modul == 'literasi' ? '📖' : '🔢' }}</span> 
                                Tantangan Soal {{ ucfirst($modul->jenis_modul ?? 'Numerasi') }}:
                            </h3>
                            <div class="text-gray-700 whitespace-pre-line text-xl leading-loose font-medium">
                                {{ $modul->soal_numerik }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </article>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="bg-white p-8 rounded-[3rem] shadow-xl border border-white h-fit">
                <h4 class="font-black text-xl text-edu-dark mb-6 flex items-center gap-2">
                    <span class="text-edu-orange">➕</span> Tambah Soal Modul
                </h4>

                <form action="{{ route('soal.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="modul_id" value="{{ $modul->id }}">
                    <input type="hidden" name="fase" value="b">

                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Jenis Kategori Kuis 🤔</label>
                        <select name="kategori" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-sm font-semibold outline-none mt-1" required>
                            <option value="numerasi" {{ $modul->jenis_modul == 'numerasi' ? 'selected' : '' }}>🔢 Kuis Numerasi</option>
                            <option value="literasi" {{ $modul->jenis_modul == 'literasi' ? 'selected' : '' }}>📖 Kuis Literasi</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Pertanyaan Soal ✏️</label>
                        <textarea name="pertanyaan" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-sm outline-none mt-1" placeholder="Tulis soal di sini..." required></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs font-bold text-gray-400">Pilihan A</label>
                            <input type="text" name="pilihan_a" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-2 text-sm outline-none mt-1" required>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400">Pilihan B</label>
                            <input type="text" name="pilihan_b" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-2 text-sm outline-none mt-1" required>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400">Pilihan C</label>
                            <input type="text" name="pilihan_c" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-2 text-sm outline-none mt-1" required>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400">Pilihan D</label>
                            <input type="text" name="pilihan_d" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-2 text-sm outline-none mt-1" required>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Kunci Jawaban Benar</label>
                        <select name="kunci_jawaban" class="w-full bg-green-50 border border-green-200 text-green-700 rounded-xl p-3 text-sm font-bold outline-none mt-1" required>
                            <option value="A">Jawaban A</option>
                            <option value="B">Jawaban B</option>
                            <option value="C">Jawaban C</option>
                            <option value="D">Jawaban D</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-edu-orange text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest shadow-md hover:bg-edu-dark transition-all">
                        🚀 Simpan & Masuk Bank Soal
                    </button>
                </form>
            </div>

            <div class="lg:col-span-2 space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-4 bg-white/40 p-4 rounded-3xl border border-white/60">
                    <h3 class="font-black text-xl md:text-2xl text-edu-dark flex items-center gap-2">
                        🎯 Kumpulan Kuis Modul 
                        <span class="text-xs bg-edu-green text-white px-3 py-1 rounded-full font-black">
                            {{ $modul->soals->count() }} Soal
                        </span>
                    </h3>
                </div>

                @forelse($modul->soals as $index => $soal)
                    <div class="bg-white p-6 rounded-[2rem] border border-white shadow-md space-y-3 relative overflow-hidden">
                        <div class="absolute top-4 right-4 flex items-center gap-2">
                            <span class="text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider {{ $soal->kategori == 'numerasi' ? 'bg-blue-100 text-blue-600' : 'bg-purple-100 text-purple-600' }}">
                                {{ ucfirst($soal->kategori) }}
                            </span>
                            <span class="bg-green-100 text-green-600 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider">
                                🌐 Bank Soal Active
                            </span>
                        </div>

                        <h5 class="font-black text-gray-800 text-lg">Soal #{{ $index + 1 }}</h5>
                        <p class="text-gray-600 font-medium text-sm">{{ $soal->pertanyaan }}</p>
                        
                        <div class="grid grid-cols-2 gap-2 text-xs font-semibold text-gray-500 bg-gray-50 p-3 rounded-xl">
                            <span class="{{ $soal->kunci_jawaban == 'A' ? 'text-green-600 font-bold' : '' }}">A. {{ $soal->pilihan_a }}</span>
                            <span class="{{ $soal->kunci_jawaban == 'B' ? 'text-green-600 font-bold' : '' }}">B. {{ $soal->pilihan_b }}</span>
                            <span class="{{ $soal->kunci_jawaban == 'C' ? 'text-green-600 font-bold' : '' }}">C. {{ $soal->pilihan_c }}</span>
                            <span class="{{ $soal->kunci_jawaban == 'D' ? 'text-green-600 font-bold' : '' }}">D. {{ $soal->pilihan_d }}</span>
                        </div>
                    </div>
                @empty
                    <div class="bg-white/50 border-2 border-dashed border-gray-200 rounded-[2.5rem] p-12 text-center text-gray-400 font-medium text-sm">
                        ❌ Belum ada kuis untuk modul ini. Ayo buat soal pertamamu lewat form di sebelah kiri!
                    </div>
                @endforelse
            </div>

        </div>
    </div>

</body>
</html>