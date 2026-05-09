<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arena Game | Edulitnum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Fredoka:wght@400;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: { colors: { 'edu-blue': '#73A5CA', 'edu-orange': '#E87F24', 'edu-dark': '#1A202C', 'edu-bg': '#FEFDDF' }, fontFamily: { 'poppins': ['Poppins', 'sans-serif'], 'fredoka': ['Fredoka', 'sans-serif'] } } } }
    </script>
    <style> body { font-family: 'Poppins', sans-serif; background-color: #FEFDDF; } </style>
</head>
<body class="p-8 md:p-14 min-h-screen">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h1 class="text-4xl font-black text-edu-dark font-fredoka uppercase tracking-tight">🎮 ARENA <span class="text-edu-blue">GAME</span></h1>
                <p class="text-gray-500 font-bold">Pilih tantanganmu hari ini!</p>
            </div>
            <a href="{{ route('siswa.dashboard') }}" class="bg-white px-6 py-3 rounded-2xl shadow-lg font-black text-edu-dark hover:bg-edu-orange hover:text-white transition-all text-xs tracking-widest uppercase">🏠 Beranda</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="bg-white p-6 rounded-[3.5rem] shadow-2xl border-b-[12px] border-edu-blue/20 hover:-translate-y-2 transition-all">
                <div class="bg-edu-blue/10 rounded-[3rem] p-12 text-center">
                    <div class="text-[8rem] mb-6 drop-shadow-xl">📖</div>
                    <h3 class="text-3xl font-black text-edu-dark font-fredoka mb-4">Pengejar Huruf</h3>
                    <p class="text-gray-500 font-medium mb-10">Tangkap huruf dan susun menjadi kata!</p>
                    <a href="{{ route('siswa.game.play', 'literasi') }}" class="block w-full py-5 bg-edu-blue text-white rounded-2xl font-black text-xl shadow-lg shadow-edu-blue/30">MAIN SEKARANG</a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[3.5rem] shadow-2xl border-b-[12px] border-edu-orange/20 hover:-translate-y-2 transition-all">
                <div class="bg-edu-orange/10 rounded-[3rem] p-12 text-center">
                    <div class="text-[8rem] mb-6 drop-shadow-xl">🚀</div>
                    <h3 class="text-3xl font-black text-edu-dark font-fredoka mb-4">Roket Angka</h3>
                    <p class="text-gray-500 font-medium mb-10">Hancurkan rintangan dengan matematika!</p>
                    <a href="{{ route('siswa.game.play', 'numerasi') }}" class="block w-full py-5 bg-edu-orange text-white rounded-2xl font-black text-xl shadow-lg shadow-edu-orange/30">COMING SOON</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
