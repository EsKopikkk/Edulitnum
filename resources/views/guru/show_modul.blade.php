<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $modul->judul }} | Edulitnum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 'edu-orange': '#E87F24', 'edu-blue': '#73A5CA', 'edu-bg': '#FEFDDF' }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FEFDDF; }
        h1 { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="p-4 md:p-10 min-h-screen">

    <div class="max-w-4xl mx-auto">
        <a href="{{ route('modul.index') }}" class="inline-flex items-center gap-2 text-edu-orange font-bold mb-8 hover:translate-x-[-5px] transition-all">
            ⬅️ Kembali ke Daftar Modul
        </a>

        <article class="bg-white rounded-[4rem] shadow-2xl overflow-hidden border-b-[15px] border-edu-blue">
            
            <div class="h-80 bg-gray-100 relative">
                @if($modul->gambar)
                    <img src="{{ asset('storage/' . $modul->gambar) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-8xl">📖</div>
                @endif
                <div class="absolute bottom-8 left-8">
                    <span class="bg-edu-orange text-white px-8 py-3 rounded-full font-black text-sm shadow-xl shadow-edu-orange/40 uppercase">
                        🏫 KELAS {{ $modul->kelas->nama_kelas ?? $modul->kelas_id }}
                    </span>
                </div>
            </div>

            <div class="p-10 md:p-16">
                <h1 class="text-4xl md:text-6xl font-black text-gray-800 leading-tight mb-8 text-center">
                    🌟 {{ $modul->judul }}
                </h1>

                <div class="text-gray-600 leading-relaxed text-lg">
                    <p class="text-2xl italic text-gray-400 mb-12 text-center border-y-2 border-gray-50 py-6">
                        "{{ $modul->deskripsi }}"
                    </p>

                    @if($modul->gambar_konten)
                        <div class="my-12">
                            <img src="{{ asset('storage/' . $modul->gambar_konten) }}" 
                                 class="w-full rounded-[3rem] shadow-2xl border-[10px] border-white transform rotate-1 hover:rotate-0 transition-transform duration-500">
                            <p class="text-center text-xs font-black text-gray-400 mt-6 uppercase tracking-widest italic">
                                📸 Ayo amati gambar di atas baik-baik ya!
                            </p>
                        </div>
                    @endif
                    
                    <div class="bg-blue-50 p-10 rounded-[3rem] border-2 border-dashed border-edu-blue/30 mt-8">
                        <h3 class="font-black text-edu-blue mb-6 flex items-center gap-3 text-2xl">
                            <span>📖</span> Mari Belajar!
                        </h3>
                        <div class="text-gray-700 whitespace-pre-line text-xl leading-loose">
                            {{-- Simulasi isi lengkap --}}
                            Selamat datang di materi <b>{{ $modul->judul }}</b>! 
                            
                            Anak-anak hebat, silakan pelajari gambar ilustrasi dan penjelasan di atas ya. Jangan lupa untuk tetap fokus dan semangat! 🚀
                        </div>
                    </div>
                </div>

                <div class="mt-16 flex flex-wrap justify-center gap-6">
                    <button onclick="window.print()" class="bg-gray-100 text-gray-600 px-10 py-5 rounded-3xl font-bold hover:bg-gray-200 transition-all flex items-center gap-3">
                        🖨️ Cetak
                    </button>
                    <a href="{{ route('soal.index') }}" class="bg-edu-orange text-white px-10 py-5 rounded-3xl font-black shadow-xl shadow-edu-orange/30 hover:scale-110 transition-all flex items-center gap-3">
                        🎯 Lanjut ke Soal
                    </a>
                </div>
            </div>
        </article>
    </div>

</body>
</html>