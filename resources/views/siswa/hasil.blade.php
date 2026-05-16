<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misi Berhasil! | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600;700;900&family=Poppins:wght@500;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'edu-orange': '#E87F24',
                        'edu-yellow': '#FFD93D',
                        'edu-blue': '#73A5CA',
                        'edu-dark': '#0F172A',
                    },
                    fontFamily: {
                        'fredoka': ['Fredoka', 'sans-serif'],
                        'poppins': ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('{{ asset("images/bg-underwater.png") }}');
            background-size: cover;
            background-position: center bottom;
            background-attachment: fixed;
            background-color: #E0F2FE;
            overflow: hidden; /* Mengunci scrollbar layar utama */
        }
        .font-kids { font-family: 'Fredoka', sans-serif; }

        .star-anim { display: inline-block; opacity: 0; transform: scale(0); }
        .result-card { opacity: 0; transform: scale(0.9); }

        /* Glassmorphism Card Utama */
        .glass-panel {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 2px solid rgba(255, 255, 255, 0.6);
        }

        /* Peti Emas Tempat Skor */
        .treasure-box {
            background: linear-gradient(135deg, rgba(255,255,255,0.85) 0%, rgba(255,255,255,0.45) 100%);
            border: 4px solid #FFF;
            box-shadow: inset 0 0 20px rgba(255,255,255,0.6), 0 15px 30px rgba(15, 23, 42, 0.1);
        }

        /* Animasi Gelembung Udara */
        .bubble {
            position: absolute;
            bottom: -50px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            animation: rise linear infinite;
            pointer-events: none;
        }
        @keyframes rise {
            0% { transform: translateY(0) scale(1); opacity: 0; }
            10% { opacity: 0.8; }
            90% { opacity: 0.4; }
            100% { transform: translateY(-110vh) scale(1.4); opacity: 0; }
        }
    </style>
</head>
<body class="w-screen h-screen flex items-center justify-center p-4 md:p-8 relative overflow-hidden">

    <div class="fixed inset-0 z-0 pointer-events-none" id="bubbles-container"></div>

    {{-- KARTU HASIL UTAMA (Ukuran max-w-3xl agar ramping & pas di tengah monitor) --}}
    <div class="result-card max-w-3xl w-full glass-panel rounded-[3rem] p-6 md:p-8 shadow-2xl border-4 border-white relative z-10 overflow-visible">

        <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-amber-400 border-2 border-white px-8 py-2 rounded-xl shadow-lg -rotate-1 z-20 font-kids text-white font-black tracking-wide text-base whitespace-nowrap">
            ⚓ MISI PENYELAMAN SELESAI!
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center relative z-10">

            <div class="text-center md:text-left w-full flex flex-col justify-center">
                <div id="main-emoji" class="text-[5.5rem] md:text-[6.5rem] mb-1 drop-shadow-2xl select-none">🏆</div>

                <h1 class="text-2xl md:text-3xl font-black text-blue-950 mb-1.5 leading-tight font-kids">
                    Luar Biasa, <br>
                    <span class="text-edu-orange drop-shadow-sm">{{ explode(' ', Auth::user()->name ?? 'Petualang')[0] }}!</span>
                </h1>

                <p class="text-blue-900 font-bold text-sm max-w-xs mx-auto md:mx-0 leading-relaxed">
                    Kamu bergerak cepat bak lumba-lumba! Nilaimu sudah digabungkan dengan bonus kecepatan menjawabmu. 🐬⚡
                </p>

                <div class="mt-5 flex flex-col sm:flex-row gap-2.5 justify-center md:justify-start">
                    <a href="{{ route('siswa.dashboard') }}"
                       class="px-5 py-3 bg-edu-orange hover:bg-orange-600 active:translate-y-0.5 text-white text-center font-black text-xs rounded-xl shadow-[0_4px_0_0_#B55A0A] hover:shadow-[0_2px_0_0_#B55A0A] transition-all border-2 border-white font-kids tracking-wide whitespace-nowrap">
                        🏠 BERANDA PENYELAM
                    </a>
                    <a href="{{ route('siswa.game.index') }}"
                       class="px-5 py-3 bg-sky-500 hover:bg-sky-600 active:translate-y-0.5 text-white text-center font-black text-xs rounded-xl shadow-[0_4px_0_0_#0284C7] hover:shadow-[0_2px_0_0_#0284C7] transition-all border-2 border-white font-kids tracking-wide whitespace-nowrap">
                        🎮 MULAI BERMAIN
                    </a>
                </div>
            </div>

            <div class="w-full max-w-xs md:max-w-none mx-auto">
                <div class="treasure-box rounded-[2rem] p-5 md:p-6 text-center relative overflow-hidden">

                    <p class="text-blue-950 font-black uppercase tracking-widest text-xs font-kids mb-1 opacity-80">
                        💎 Skor Kecepatan Kamu 💎
                    </p>

                    <div class="relative inline-block">
                        <h2 id="skor-text" class="text-[5rem] md:text-[6rem] font-black text-blue-950 leading-none font-kids drop-shadow-sm">0</h2>
                        <span class="absolute -top-1 -right-5 text-lg font-black text-blue-950/40 font-kids">pts</span>
                    </div>

                    <div class="mt-4 flex justify-center gap-2 bg-white/40 py-2.5 px-4 rounded-xl border border-white/50 shadow-inner">
                        @php
                            if ($skor >= 81) { $bintang = 5; }
                            elseif ($skor >= 61) { $bintang = 4; }
                            elseif ($skor >= 41) { $bintang = 3; }
                            elseif ($skor >= 21) { $bintang = 2; }
                            else { $bintang = 1; }
                        @endphp
                        @for($i=0; $i < 5; $i++)
                            <span class="star-anim text-3xl md:text-4xl {{ $i < $bintang ? 'text-amber-400' : 'text-slate-400 grayscale' }} drop-shadow-md select-none">⭐</span>
                        @endfor
                    </div>

                    <p class="mt-3.5 font-bold text-xs text-blue-950 tracking-wide leading-tight min-h-[32px] flex items-center justify-center">
                        @if($bintang === 5) 👑 Potensi Luar Biasa! Kamu Penyelam Jenius & Cepat! ✨
                        @elseif($bintang === 4) 🐳 Keren Banget! Respon Pintar Bak Lumba-Lumba! 🎉
                        @elseif($bintang === 3) 🐙 Bagus! Kamu Berbakat, Terus Asah Kecepatanmu! 💪
                        @elseif($bintang === 2) 🐢 Cukup Oke! Ayo Berenang Lebih Cepat Lagi! 🔥
                        @else 🐚 Tetap Semangat! Samudera Ilmu Menunggumu Belajar! ❤️
                        @endif
                    </p>
                </div>
            </div>

        </div>
    </div>

    <script>
        window.onload = () => {
            const finalSkor = {{ $skor }};

            // 1. Animasi Kartu Zoom Masuk
            gsap.to(".result-card", {
                scale: 1,
                opacity: 1,
                duration: 0.6,
                ease: "back.out(1.1)",
                onComplete: () => {
                    triggerConfetti();

                    // 2. Efek Angka Menggelinding
                    let obj = { val: 0 };
                    gsap.to(obj, {
                        val: finalSkor,
                        duration: 1.5,
                        ease: "power2.out",
                        onUpdate: function() {
                            document.getElementById('skor-text').innerHTML = Math.ceil(obj.val);
                        },
                        onComplete: () => {
                            // 3. Letupan Bintang
                            gsap.to(".star-anim", {
                                opacity: 1,
                                scale: 1,
                                stagger: 0.08,
                                duration: 0.4,
                                ease: "elastic.out(1.2, 0.6)"
                            });
                        }
                    });
                }
            });

            // Efek Mengambang Avatar Piala
            gsap.to("#main-emoji", {
                y: -8,
                rotation: 2,
                repeat: -1,
                yoyo: true,
                duration: 2.3,
                ease: "sine.inOut"
            });
        };

        function triggerConfetti() {
            const end = Date.now() + 1500;
            const colors = ['#E87F24', '#FFD93D', '#73A5CA', '#3B82F6'];

            (function frame() {
                confetti({
                    particleCount: 2,
                    angle: 60,
                    spread: 45,
                    origin: { x: 0.1, y: 0.65 },
                    colors: colors
                });
                confetti({
                    particleCount: 2,
                    angle: 120,
                    spread: 45,
                    origin: { x: 0.91, y: 0.65 },
                    colors: colors
                });

                if (Date.now() < end) {
                    requestAnimationFrame(frame);
                }
            }());
        }

        // Generator Gelebung Air
        const bubblesContainer = document.getElementById('bubbles-container');
        for (let i = 0; i < 10; i++) {
            let bubble = document.createElement('div');
            bubble.classList.add('bubble');
            let size = Math.random() * 16 + 6;
            bubble.style.width = size + 'px';
            bubble.style.height = size + 'px';
            bubble.style.left = Math.random() * 100 + '%';
            bubble.style.animationDuration = Math.random() * 4 + 6 + 's';
            bubble.style.animationDelay = Math.random() * 2 + 's';
            bubblesContainer.appendChild(bubble);
        }
    </script>
</body>
</html>
