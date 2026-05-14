<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edulitnum - Inovasi Literasi & Numerasi</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'edu-orange': '#E87F24',
                        'edu-yellow': '#FFC81E',
                        'edu-blue': '#73A5CA',
                        'edu-bg': '#FEFDDF',
                        'edu-dark': '#1A202C',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FEFDDF;
            overflow-x: hidden;
        }

        h1 {
            font-family: 'Montserrat', sans-serif;
        }

        /* Background Blob Animation */
        .blob {
            position: fixed;
            border-radius: 30%;
            filter: blur(80px);
            z-index: 0;
            animation: float 15s infinite alternate ease-in-out;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(15%, 10%) scale(1.3);
            }
        }

        .header-custom {
            background: rgba(115, 165, 202, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(115, 165, 202, 0.2);
        }

        .btn-glow {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-glow:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(232, 127, 36, 0.3);
        }

        .shimmer-text {
            background: linear-gradient(90deg, #1A202C, #E87F24, #1A202C);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine 5s linear infinite;
        }

        @keyframes shine {
            to {
                background-position: 200% center;
            }
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center relative">

    <div class="blob w-[600px] h-[600px] bg-edu-yellow/20 -top-20 -left-20"></div>
    <div class="blob w-[500px] h-[500px] bg-edu-blue/20 -bottom-20 -right-20" style="animation-delay: -5s;"></div>

    <header class="fixed top-6 w-[92%] z-50 header-custom px-10 py-6 rounded-full shadow-lg">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-edu-orange rounded-xl flex items-center justify-center shadow-lg rotate-3">
                    <span class="text-white font-black text-xl">E</span>
                </div>
                <span class="text-4xl font-black text-edu-dark tracking-tighter">Edu<span
                        class="text-edu-orange">litnum</span></span>
            </div>

            <div class="hidden md:block">
                <span
                    class="text-[10px] font-extrabold tracking-[0.3em] uppercase text-edu-orange bg-white/40 px-5 py-2 rounded-full border border-edu-orange/20">
                    Platform Digital SD
                </span>
            </div>
        </div>
    </header>

    <main
        class="relative z-10 text-center px-6 pt-48 pb-20 max-w-7xl mx-auto flex flex-col items-center justify-center min-h-screen">
        <div class="space-y-8">
            <div class="space-y-4">
                <h2 class="text-edu-blue font-bold tracking-[0.5em] text-sm uppercase animate-pulse">Edukasi Tanpa Batas
                </h2>
                <h1 class="text-6xl md:text-8xl font-black text-edu-dark leading-none tracking-tighter">
                    Halo Sobat <span class="shimmer-text">Edulitnum!</span><br>
                    Siap Berpetualang?
                </h1>
                <p class="text-gray-500 text-lg md:text-2xl max-w-2xl mx-auto font-light leading-relaxed">
                    Selamat datang kembali di platform literasi dan numerasi digital. Mari lanjutkan petualangan
                    menuntut ilmu hari ini.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-8">

                <a href="{{ route('login') }}"
                    class="px-8 py-4 bg-[#E87F24] text-white font-bold rounded-full shadow-lg shadow-orange-500/30 hover:bg-[#D66D12] hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
                    Get Started
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>

                <a href="{{ route('login.siswa') }}"
                    class="px-8 py-4 bg-white border-2 border-[#73A5CA] text-[#73A5CA] font-bold rounded-full shadow-lg hover:bg-[#73A5CA] hover:text-white hover:-translate-y-1 transition-all duration-300 flex items-center gap-2 group">
                    Masuk sebagai Siswa
                    <img src="{{ asset('images/coin.svg') }}" alt="Koin"
                        class="w-6 h-6 group-hover:rotate-12 transition-transform">
                </a>

            </div>
        </div>
    </main>

    <footer class="absolute bottom-1 w-full text-center z-20">
        <div class="flex flex-col items-center gap-2">
            <div class="flex gap-6 text-gray-400 text-xs font-semibold tracking-widest uppercase mb-4">
                <span class="hover:text-edu-orange cursor-pointer transition-colors">Digital Literacy</span>
                <span class="text-edu-yellow">•</span>
                <span class="hover:text-edu-blue cursor-pointer transition-colors">Numeracy Game</span>
                <span class="text-edu-yellow">•</span>
                <span class="hover:text-edu-orange cursor-pointer transition-colors">Expert System</span>
            </div>
            <p class="text-gray-400 text-[10px] font-medium tracking-tighter opacity-50">
                © 2026 EDULITNUM ECOSYSTEM. POWERED BY EDULTIM24.
            </p>
        </div>
    </footer>

</body>

</html>