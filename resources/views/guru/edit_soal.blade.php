<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Soal | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'edu-orange': '#E87F24',
                        'edu-blue': '#73A5CA',
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

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #E87F24;
            box-shadow: 0 0 0 4px rgba(232, 127, 36, 0.1);
        }
    </style>
</head>
<body class="min-h-screen flex p-4 md:p-6 gap-6">

    <aside class="w-72 bg-white/80 backdrop-blur-xl rounded-[3rem] shadow-2xl p-8 flex flex-col border border-white shrink-0">
        <div class="flex items-center gap-4 mb-12">
            <div class="w-12 h-12 bg-edu-orange rounded-2xl flex items-center justify-center shadow-lg">
                <span class="text-white font-black text-2xl">E</span>
            </div>
            <div>
                <span class="text-edu-dark font-black text-xl tracking-tighter block">GURU</span>
                <span class="text-edu-orange font-bold text-xs uppercase tracking-widest">Edit Mode</span>
            </div>
        </div>
        <nav class="flex-1 space-y-3">
             <a href="{{ route('soal.index') }}" class="flex items-center gap-4 px-5 py-4 text-gray-400 hover:text-edu-orange font-bold transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col gap-6">
        <header class="w-full bg-white/60 backdrop-blur-md rounded-[2.5rem] p-6 flex justify-between items-center border border-white">
            <div class="px-4">
                <h1 class="text-2xl font-black text-edu-dark">Edit Soal ✏️</h1>
                <p class="text-sm text-gray-400 font-medium">Perbarui pertanyaan atau ganti keterhubungan modul.</p>
            </div>
        </header>

        <div class="flex-1 bg-white rounded-[3rem] p-8 lg:p-10 border border-white shadow-xl shadow-black/5">
            <form method="POST" action="{{ route('soal.update', $soal->id) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-8">
                    <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Hubungkan ke Modul Materi</label>
                    <select name="modul_id" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 text-edu-dark font-medium cursor-pointer transition-all" required>
                        <option value="" disabled>-- Pilih Modul Materi --</option>
                        @foreach($moduls as $m)
                            <option value="{{ $m->id }}" {{ $soal->modul_id == $m->id ? 'selected' : '' }}>
                                {{ $m->judul }} (Kelas {{ $m->kelas->nama_kelas ?? $m->kelas_id }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-8">
                    <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Pertanyaan</label>
                    <textarea name="pertanyaan" rows="3" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 text-edu-dark font-medium transition-all" required>{{ $soal->pertanyaan }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Kategori Soal</label>
                        <select name="kategori" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 text-edu-dark font-medium cursor-pointer transition-all" required>
                            <option value="literasi" {{ $soal->kategori == 'literasi' ? 'selected' : '' }}>📚 Literasi</option>
                            <option value="numerasi" {{ $soal->kategori == 'numerasi' ? 'selected' : '' }}>🧮 Numerasi</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Fase Kelas</label>
                        <select name="fase" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 text-edu-dark font-medium cursor-pointer transition-all" required>
                            <option value="A" {{ $soal->fase == 'A' ? 'selected' : '' }}>Fase A (Kelas 1-2)</option>
                            <option value="B" {{ $soal->fase == 'B' ? 'selected' : '' }}>Fase B (Kelas 3-4)</option>
                            <option value="C" {{ $soal->fase == 'C' ? 'selected' : '' }}>Fase C (Kelas 5-6)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-10">
                    <div class="flex items-center gap-2 mb-4">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest block">Pilihan Jawaban</label>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach(['A','B','C','D'] as $p)
                        @php $field = 'pilihan_' . strtolower($p); @endphp
                        <div class="flex items-center gap-4 bg-gray-50 p-2 pr-4 rounded-2xl border-2 border-gray-100 hover:border-edu-orange/30 transition-colors group">
                            <div class="pl-4">
                                <input type="radio" name="kunci_jawaban" value="{{ $p }}" 
                                    {{ $soal->kunci_jawaban == $p ? 'checked' : '' }}
                                    class="w-5 h-5 text-edu-orange focus:ring-edu-orange border-gray-300 cursor-pointer" required>
                            </div>
                            <div class="w-8 h-8 rounded-xl bg-white flex items-center justify-center font-black text-gray-400 group-hover:text-edu-orange shadow-sm">
                                {{ $p }}
                            </div>
                            <input type="text" name="{{ $field }}" value="{{ $soal->$field }}" 
                                class="flex-1 bg-transparent border-none p-2 text-edu-dark font-medium focus:ring-0" required>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex gap-4 pt-6 border-t border-gray-100">
                    <button type="submit" class="bg-edu-orange text-white px-8 py-4 rounded-2xl font-black text-sm hover:-translate-y-1 hover:shadow-lg hover:shadow-edu-orange/30 transition-all">
                        UPDATE SOAL
                    </button>
                    <a href="{{ route('soal.index') }}" class="bg-gray-100 text-gray-500 px-8 py-4 rounded-2xl font-black text-sm hover:bg-gray-200 transition-colors flex items-center justify-center">
                        BATAL
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>