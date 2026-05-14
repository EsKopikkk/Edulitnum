<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa | Jelajah Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&family=Poppins:wght@400;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow: hidden;
            /* Mencegah layar bisa di-scroll */
            /* INI BAGIAN MEMANGGIL GAMBAR BACKGROUND-NYA */
            background-image: url('{{ asset("images/bg-underwater.png") }}');
            background-size: auto;
            background-position: center bottom;
            background-repeat: no-repeat;
            background-color: #E0F2FE;
            /* Warna cadangan kalau gambar gagal dimuat */
        }

        h1,
        h2 {
            font-family: 'Montserrat', sans-serif;
        }

        /* Glassmorphism Card yang Elegan & Blur */
        .glass-card {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 2px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 25px 50px -12px rgba(0, 50, 100, 0.25);
        }

        /* Form Input */
        .input-field {
            background: rgba(255, 255, 255, 0.85);
            border: 2px solid transparent;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-field:focus {
            border-color: #E87F24;
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(232, 127, 36, 0.2);
            outline: none;
        }

        /* --- ANIMASI GELEMBUNG AIR --- */
        .bubbles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            /* Biar gelembung nggak nutupin tombol saat diklik */
        }

        .bubble {
            position: absolute;
            bottom: -50px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            animation: rise linear infinite;
        }

        @keyframes rise {
            0% {
                transform: translateY(0) scale(1);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 0.8;
            }

            100% {
                transform: translateY(-1200px) scale(1.5);
                opacity: 0;
            }
        }

        /* Ikon Mengambang */
        .animate-float {
            animation: float-slow 4s infinite ease-in-out;
        }

        @keyframes float-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center relative p-6">

    <div class="bubbles" id="bubbles-container"></div>

    <div class="absolute top-8 left-8 z-30">
        <a href="/"
            class="flex items-center gap-2 px-5 py-2.5 bg-white/70 backdrop-blur-md rounded-full text-blue-900 font-bold hover:bg-white hover:text-[#E87F24] hover:shadow-lg transition-all group">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daratan
        </a>
    </div>

    <div class="relative z-20 w-full max-w-md">

        <div class="flex justify-center mb-[-40px] relative z-30 animate-float">
            <div
                class="w-24 h-24 bg-white rounded-full shadow-2xl border-4 border-[#FFC81E] flex items-center justify-center overflow-hidden p-3">
                <img src="{{ asset('images/coin.svg') }}" alt="Koin Edulitnum"
                    class="w-full h-full object-contain drop-shadow-md">
            </div>
        </div>

        <div class="glass-card rounded-[40px] p-10 pt-16">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-black text-blue-950 tracking-tighter">Halo, <span
                        class="text-[#E87F24]">Penyelam!</span></h2>
                <p class="text-blue-800 text-sm mt-2 font-bold">Siap menjelajah ilmu di dasar laut?</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <input type="hidden" name="role" value="siswa">

                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-blue-900 mb-2 ml-2">Nomor
                        Induk Siswa (NIS)</label>
                    <input type="text" name="nis"
                        class="input-field w-full px-6 py-4 rounded-2xl text-blue-950 font-bold placeholder:text-gray-400"
                        placeholder="Masukkan kode pengenal kamu..." required>
                </div>

                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-blue-900 mb-2 ml-2">Kata
                        Sandi Rahasia</label>
                    <input type="password" name="password"
                        class="input-field w-full px-6 py-4 rounded-2xl text-blue-950 font-bold placeholder:text-gray-400"
                        placeholder="Masukkan sandi..." required>
                </div>

                <button type="submit"
                    class="w-full py-5 bg-[#E87F24] text-white font-black text-lg rounded-2xl shadow-[0_10px_20px_rgba(232,127,36,0.3)] hover:bg-[#D66D12] transition-all duration-300 transform hover:-translate-y-1 hover:shadow-[0_15px_30px_rgba(232,127,36,0.4)] active:scale-95 flex items-center justify-center gap-3 mt-8">
                    MULAI MENYELAM
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <script>
        const bubblesContainer = document.getElementById('bubbles-container');
        const bubbleCount = 20; // Jumlah gelembung

        for (let i = 0; i < bubbleCount; i++) {
            let bubble = document.createElement('div');
            bubble.classList.add('bubble');

            // Ukuran acak
            let size = Math.random() * 20 + 10;
            bubble.style.width = size + 'px';
            bubble.style.height = size + 'px';

            // Posisi X acak
            bubble.style.left = Math.random() * 100 + '%';

            // Durasi dan jeda animasi acak biar natural
            bubble.style.animationDuration = Math.random() * 5 + 5 + 's';
            bubble.style.animationDelay = Math.random() * 5 + 's';

            bubblesContainer.appendChild(bubble);
        }
    </script>
</body>

</html>