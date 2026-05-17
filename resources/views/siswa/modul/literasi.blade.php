<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Pembelajaran | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Fredoka:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'edu-orange': '#E87F24',
                        'edu-yellow': '#FFD93D',
                        'edu-blue': '#73A5CA',
                        'edu-green': '#6BCB77',
                        'edu-bg': '#FEFDDF',
                        'edu-dark': '#1A202C',
                    },
                    fontFamily: {
                        'fredoka': ['Fredoka', 'sans-serif'],
                        'poppins': ['Poppins', 'sans-serif'],
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
        h1, h2, h3 { font-family: 'Fredoka', sans-serif; }

        .glass-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body class="min-h-screen pb-20">

    {{-- Navbar --}}
    <nav class="p-6 flex justify-between items-center bg-white/70 backdrop-blur-md sticky top-0 z-50 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-edu-orange rounded-xl flex items-center justify-center shadow-lg transform -rotate-3">
                <span class="text-white font-black text-xl font-fredoka">E</span>
            </div>
            <span class="text-edu-dark font-black text-xl font-fredoka tracking-tight">EDULIT<span class="text-edu-orange">NUM</span></span>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('siswa.dashboard') }}" class="px-4 py-2 bg-edu-orange/10 text-edu-orange hover:bg-edu-orange hover:text-white font-bold rounded-xl transition-all text-sm">
                ← Kembali
            </a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 mt-10">

        {{-- Header --}}
        <div class="mb-10">
            <h1 class="text-4xl font-black text-edu-dark mb-2">📚 Modul Pembelajaran</h1>
            <p class="text-gray-500 font-medium">Kelas: <span class="font-bold text-edu-orange">{{ $kelasSiswa->nama_kelas }}</span></p>
        </div>

        {{-- List Modul --}}
        <div class="space-y-6">
            @forelse($moduls as $modul)
                <div class="glass-card p-8 rounded-[2.5rem] shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                    <div class="flex items-start justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-3xl">📖</span>
                                <h3 class="text-2xl font-black text-edu-dark">{{ $modul->judul }}</h3>
                            </div>

                            @if($modul->deskripsi)
                                <p class="text-gray-600 font-medium mb-4">{{ $modul->deskripsi }}</p>
                            @endif

                            <div class="flex items-center gap-4 text-sm text-gray-500 font-semibold">
                                <span>📅 {{ $modul->created_at->format('d M Y') }}</span>
                                @if($modul->file_materi)
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"/>
                                        </svg>
                                        📎 Ada File
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Action Button --}}
                        <div class="flex flex-col gap-3">
                            @if($modul->file_materi)
                                <a href="{{ asset('storage/' . $modul->file_materi) }}" target="_blank"
                                    class="px-6 py-3 bg-edu-blue text-white font-bold rounded-2xl hover:bg-edu-dark transition-all text-sm whitespace-nowrap">
                                    ⬇️ Download Materi
                                </a>
                            @else
                                <button disabled class="px-6 py-3 bg-gray-200 text-gray-400 font-bold rounded-2xl text-sm cursor-not-allowed">
                                    Belum ada file
                                </button>
                            @endif

                            <button onclick="markAsViewed({{ $modul->id }})"
                                class="px-6 py-3 bg-edu-orange text-white font-bold rounded-2xl hover:bg-edu-dark transition-all text-sm">
                                ✅ Tandai Sudah Dibaca
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="glass-card py-20 px-10 rounded-[2.5rem] border-4 border-dashed border-white/40 text-center">
                    <div class="text-6xl mb-4">📚</div>
                    <h3 class="text-2xl font-black text-gray-400 mb-2">Belum Ada Modul</h3>
                    <p class="text-gray-600 font-medium">Guru akan membuat modul pembelajaran segera. Tunggu sebentar ya!</p>
                </div>
            @endforelse
        </div>

    </main>

    {{-- Toast Notification --}}
    <div id="toast" class="fixed bottom-6 right-6 px-6 py-4 bg-green-500 text-white rounded-2xl shadow-xl font-bold opacity-0 transition-opacity duration-300 pointer-events-none">
        ✅ Berhasil ditandai sudah dibaca
    </div>

    <script>
        function markAsViewed(modulId) {
            // Show toast notification
            const toast = document.getElementById('toast');
            toast.classList.remove('opacity-0');
            toast.classList.add('opacity-100');

            // Hide after 3 seconds
            setTimeout(() => {
                toast.classList.remove('opacity-100');
                toast.classList.add('opacity-0');
            }, 3000);

            // TODO: Implement update progress ke database dengan AJAX
        }
    </script>

</body>
</html>
