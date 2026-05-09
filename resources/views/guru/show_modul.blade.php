<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $modul->judul }} | Edulitnum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: { extend: { colors: { 'edu-orange': '#E87F24', 'edu-blue': '#73A5CA', 'edu-dark': '#1A202C' } } }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FEFDDF; }
        h1, h2 { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="p-6 md:p-12">
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('modul.index') }}" class="inline-flex items-center gap-2 text-edu-orange font-bold mb-8 hover:gap-4 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar Modul
        </a>

        <div class="bg-white rounded-[3rem] p-8 md:p-16 shadow-2xl shadow-black/5 border border-white relative overflow-hidden">
            <div class="absolute top-0 right-0 p-8 opacity-10 text-98xl font-black">📖</div>
            
            <span class="bg-blue-50 text-edu-blue text-[10px] font-black px-4 py-2 rounded-full uppercase tracking-widest border border-blue-100">
                Kelas {{ $modul->kelas->nama_kelas ?? $modul->kelas_id }}
            </span>
            
            <h1 class="text-3xl md:text-5xl font-black text-edu-dark mt-6 leading-tight">
                {{ $modul->judul }}
            </h1>
            
            <div class="w-20 h-2 bg-edu-orange rounded-full mt-8 mb-12"></div>

            <div class="prose prose-lg text-gray-600 leading-relaxed font-medium">
                {!! nl2br(e($modul->deskripsi)) !!}
            </div>

            <div class="mt-16 pt-8 border-t border-gray-100 flex justify-between items-center text-xs text-gray-400 font-bold uppercase tracking-widest">
                <span>Edulitnum Reading Mode</span>
                <span>Mochammad Rosiq Rezki Pratama</span>
            </div>
        </div>
    </div>
</body>
</html>