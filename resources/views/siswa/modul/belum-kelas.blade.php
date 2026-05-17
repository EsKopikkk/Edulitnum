<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul | Edulitnum</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'edu-orange': '#E87F24',
                        'edu-blue': '#73A5CA',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow-x: hidden;
            background-image: url('{{ asset("images/bg-underwater.png") }}');
            background-size: cover;
            background-position: center bottom;
            background-attachment: fixed;
            background-color: #E0F2FE;
        }
        h1 { font-family: 'Fredoka', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">

    <div class="text-center px-6">
        <div class="text-6xl mb-4">🤔</div>
        <h1 class="text-3xl font-black text-gray-800 mb-2">Belum Masuk Kelas</h1>
        <p class="text-gray-600 font-medium mb-6">Kamu harus masuk ke kelas terlebih dahulu untuk melihat modul pembelajaran.</p>
        <p class="text-sm text-gray-500">Hubungi admin atau guru untuk di-masukkan ke kelas.</p>

        <a href="{{ route('siswa.dashboard') }}" class="inline-block mt-6 px-8 py-3 bg-edu-orange text-white font-bold rounded-2xl hover:bg-edu-dark transition-all shadow-lg shadow-orange-500/30">
            ← Kembali ke Dashboard
        </a>
    </div>

</body>
</html>
