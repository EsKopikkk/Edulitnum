<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misi Berhasil! | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'edu-orange': '#E87F24',
                        'edu-yellow': '#FFD93D',
                        'edu-blue': '#73A5CA',
                        'edu-green': '#6BCB77',
                        'edu-bg': '#F0F9FF',
                        'edu-dark': '#1A202C',
                    },
                    fontFamily: { 'fredoka': ['Fredoka', 'sans-serif'] }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Fredoka', sans-serif; background-color: #F0F9FF; overflow: hidden; }
        .star-anim { display: inline-block; opacity: 0; transform: scale(0); }
        .result-card { opacity: 0; transform: scale(0.9); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-8 md:p-12">

    <div class="result-card max-w-6xl w-full bg-white rounded-[4rem] p-8 md:p-12 shadow-[0_40px_100px_rgba(115,165,202,0.25)] border-[12px] border-white relative">

        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-edu-yellow px-10 py-3 rounded-2xl shadow-xl border-4 border-white -rotate-2 z-20">
            <span class="text-edu-dark font-black text-2xl uppercase tracking-widest italic">MISI SELESAI!</span>
        </div>

        <div class="flex flex-col lg:flex-row items-center gap-12 relative z-10">

            <div class="flex-1 text-center lg:text-left">
                <div id="main-emoji" class="text-[10rem] mb-4 drop-shadow-2xl">🏆</div>
                <h1 class="text-5xl font-black text-edu-dark mb-4 leading-tight">Luar Biasa, <br><span class="text-edu-orange">{{ explode(' ', Auth::user()->name ?? 'Petualang')[0] }}!</span></h1>
                <p class="text-gray-500 font-bold text-xl max-w-md">Kamu sudah membuktikan bahwa kamu adalah petualang yang cerdas hari ini!</p>

                <div class="mt-10 flex flex-wrap gap-4 justify-center lg:justify-start">
                    <a href="{{ route('siswa.dashboard') }}"
                       class="bg-edu-orange text-white px-8 py-5 rounded-3xl font-black text-lg shadow-xl shadow-edu-orange/30 hover:scale-105 active:scale-95 transition-all flex items-center gap-3">
                       🏠 BERANDA
                    </a>
                    <a href="{{ route('siswa.game.index') }}"
                       class="bg-edu-blue text-white px-8 py-5 rounded-3xl font-black text-lg shadow-xl shadow-edu-blue/30 hover:scale-105 active:scale-95 transition-all flex items-center gap-3">
                       🎮 MAIN GAME
                    </a>
                </div>
            </div>

            <div class="flex-1 w-full">
                <div class="bg-gradient-to-br from-edu-blue/10 to-edu-blue/30 rounded-[4rem] p-12 text-center border-4 border-white shadow-inner relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl"></div>

                    <p class="text-edu-blue-dark font-black uppercase tracking-widest text-lg mb-4">Total Skor</p>
                    <div class="relative inline-block">
                        <h2 id="skor-text" class="text-[10rem] font-black text-edu-blue leading-none drop-shadow-sm">0</h2>
                        <span class="absolute -top-4 -right-8 text-4xl font-black text-edu-blue/40">pts</span>
                    </div>

                    <div class="mt-10 flex justify-center gap-4">
                        @php
                            $bintang = ($skor >= 80) ? 5 : (($skor >= 60) ? 4 : (($skor >= 40) ? 3 : 2));
                        @endphp
                        @for($i=0; $i < 5; $i++)
                            <span class="star-anim text-6xl {{ $i < $bintang ? 'text-edu-yellow' : 'text-gray-200' }} drop-shadow-md">⭐</span>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = () => {
            const finalSkor = {{ $skor }};

            // 1. Animasi Kartu Muncul (Zoom In Effect)
            gsap.to(".result-card", {
                scale: 1,
                opacity: 1,
                duration: 1,
                ease: "back.out(1.2)",
                onComplete: () => {
                    triggerConfetti();

                    // 2. Animasi Skor
                    let obj = { val: 0 };
                    gsap.to(obj, {
                        val: finalSkor,
                        duration: 2.5,
                        ease: "power3.out",
                        onUpdate: function() {
                            document.getElementById('skor-text').innerHTML = Math.ceil(obj.val);
                        },
                        onComplete: () => {
                            // 3. Bintang Muncul
                            gsap.to(".star-anim", {
                                opacity: 1,
                                scale: 1,
                                stagger: 0.15,
                                duration: 0.8,
                                ease: "elastic.out(1, 0.5)"
                            });
                        }
                    });
                }
            });

            // Animasi Emoji Floating
            gsap.to("#main-emoji", {
                y: -15,
                rotation: 5,
                repeat: -1,
                yoyo: true,
                duration: 2,
                ease: "sine.inOut"
            });
        };

        function triggerConfetti() {
            const end = Date.now() + 3000;
            const colors = ['#E87F24', '#FFD93D', '#73A5CA', '#6BCB77'];

            (function frame() {
                confetti({
                    particleCount: 4,
                    angle: 60,
                    spread: 55,
                    origin: { x: 0, y: 0.6 },
                    colors: colors
                });
                confetti({
                    particleCount: 4,
                    angle: 120,
                    spread: 55,
                    origin: { x: 1, y: 0.6 },
                    colors: colors
                });

                if (Date.now() < end) {
                    requestAnimationFrame(frame);
                }
            }());
        }
    </script>
</body>
</html>
