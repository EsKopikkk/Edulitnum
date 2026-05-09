<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petualangan Huruf | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Fredoka:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'edu-orange': '#E87F24',
                        'edu-blue': '#73A5CA',
                        'edu-yellow': '#FFD93D',
                        'edu-dark': '#1A202C',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                        'fredoka': ['Fredoka', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FEFDDF; overflow: hidden; touch-action: none; }
        canvas { background: white; border-radius: 3rem; box-shadow: 0 40px 100px -20px rgba(0,0,0,0.1); border: 10px solid white; cursor: none; }
        .game-font { font-family: 'Fredoka', sans-serif; }
        .hidden { display: none; }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4">

    <div class="w-full max-w-5xl flex justify-between items-center mb-8 px-6">
        <div class="flex gap-4">
            <div class="bg-white px-6 py-2 rounded-2xl shadow-sm border-2 border-edu-blue/10">
                <p class="text-[10px] font-black text-gray-400 uppercase leading-none mb-1 tracking-widest text-poppins">Level</p>
                <p id="ui-level" class="text-xl font-black text-edu-orange">1</p>
            </div>
            <div class="bg-white px-6 py-2 rounded-2xl shadow-sm border-2 border-edu-blue/10">
                <p class="text-[10px] font-black text-gray-400 uppercase leading-none mb-1 tracking-widest text-poppins">Skor</p>
                <p id="ui-score" class="text-xl font-black text-edu-blue">0</p>
            </div>
        </div>
        <a href="{{ route('siswa.game.index') }}" class="bg-edu-dark text-white px-8 py-3 rounded-2xl font-black shadow-lg hover:bg-red-500 transition-all text-xs uppercase tracking-widest text-poppins">Keluar</a>
    </div>

    <div class="relative">
        <div id="target-banner" class="absolute left-1/2 -translate-x-1/2 bg-edu-dark text-white px-10 py-5 rounded-[2.5rem] shadow-2xl z-20 border-4 border-white text-center min-w-[300px]">
            <p id="level-title" class="text-[10px] font-black text-edu-yellow uppercase mb-1 tracking-[0.2em]">LEVEL 1</p>
            <div id="target-word-display" class="text-4xl md:text-5xl font-black tracking-[0.3em] game-font uppercase">_ _ _ _</div>
        </div>

        <canvas id="gameCanvas"></canvas>

        <div id="overlay" class="absolute inset-0 flex flex-col items-center justify-center z-30 rounded-[3rem] hidden">
            <div id="overlay-content" class="text-center p-10">
                <div id="overlay-emoji" class="text-9xl mb-6">🎮</div>
                <h2 id="overlay-title" class="text-white text-5xl font-black game-font mb-4 tracking-tight">Siap Main?</h2>
                <p id="overlay-desc" class="text-white/60 font-medium mb-10 max-w-sm mx-auto uppercase tracking-widest text-xs leading-relaxed"></p>
                <button id="overlay-btn" onclick="handleOverlayClick()" class="bg-edu-orange text-white px-16 py-6 rounded-full font-black text-2xl shadow-2xl hover:scale-105 active:scale-95 transition-all uppercase tracking-widest">
                    MULAI MAIN
                </button>
            </div>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');
        canvas.width = 900;
        canvas.height = 550;

        const sdWords = ["AYAM", "BOLA", "BUKU", "IKAN", "KAKI", "MATA", "NASI", "ROTI", "SAPI", "TOPI", "MEJA", "TAS", "DAUN", "GIGI", "KERA"];
        const levels = {
            1: { target: 2, speed: [1.5, 2.2], spawn: 0.015 },
            2: { target: 3, speed: [1.8, 2.5], spawn: 0.02 },
            3: { target: 3, speed: [2.0, 2.8], spawn: 0.025 },
            4: { target: 4, speed: [2.2, 3.2], spawn: 0.03 },
            5: { target: 5, speed: [2.5, 3.5], spawn: 0.035 }
        };

        let gameState = 'START';
        let isWordFocus = false;
        let currentLevel = 1;
        let score = 0;
        let solvedCount = 0;
        let currentWord = "";
        let missingChar = "";
        let letters = [];
        let player = { x: 405, y: 440, w: 90, h: 90, dx: 0, speed: 13, color: '#73A5CA' };
        const namaSiswa = "{{ explode(' ', Auth::user()->name ?? 'Petualang')[0] }}";

        // Inisialisasi awal
        window.onload = () => {
            showOverlay("🎮", "Siap Main?", `Halo ${namaSiswa}, lengkapi kata yang hilang ya!`, "MULAI MAIN");
        };

        function setNextWord() {
            letters = []; // Reset arena setiap kata baru
            currentWord = sdWords[Math.floor(Math.random() * sdWords.length)];
            const idx = Math.floor(Math.random() * currentWord.length);
            missingChar = currentWord[idx];
            const display = currentWord.split('').map((c, i) => i === idx ? '_' : c).join(' ');

            document.getElementById('target-word-display').innerText = display;
            showWordFocus();
        }

        function showWordFocus() {
            isWordFocus = true;
            const banner = document.getElementById('target-banner');

            gsap.fromTo(banner, { y: -100, scale: 1 }, {
                y: 200, scale: 1.8, duration: 1, ease: "back.out(1.7)",
                onComplete: () => {
                    setTimeout(() => {
                        gsap.to(banner, { y: 20, scale: 1, duration: 0.7, ease: "power2.inOut", onComplete: () => {
                            isWordFocus = false;
                            if(gameState === 'PLAY') animate();
                        }});
                    }, 2000);
                }
            });
        }

        function drawPlayer() {
            ctx.fillStyle = player.color;
            ctx.beginPath(); ctx.roundRect(player.x, player.y, player.w, player.h, 25); ctx.fill();
            ctx.fillStyle = "white";
            ctx.beginPath(); ctx.arc(player.x+30, player.y+35, 10, 0, Math.PI*2); ctx.arc(player.x+60, player.y+35, 10, 0, Math.PI*2); ctx.fill();
            ctx.fillStyle = "#1A202C";
            ctx.beginPath(); ctx.arc(player.x+30+(player.dx*0.4), player.y+35, 5, 0, Math.PI*2); ctx.arc(player.x+60+(player.dx*0.4), player.y+35, 5, 0, Math.PI*2); ctx.fill();
        }

        function animate() {
            if (gameState !== 'PLAY' || isWordFocus) return;

            ctx.clearRect(0, 0, canvas.width, canvas.height);
            player.x += player.dx;
            if (player.x < 0) player.x = 0;
            if (player.x + player.w > canvas.width) player.x = canvas.width - player.w;
            drawPlayer();

            const ld = levels[currentLevel];
            if (Math.random() < ld.spawn) {
                const isTarget = Math.random() > 0.7;
                const char = isTarget ? missingChar : "ABCDEFGHIJKLMNOPQRSTUVWXYZ"[Math.floor(Math.random()*26)];
                letters.push({
                    char, x: Math.random() * (canvas.width - 60) + 30, y: -50,
                    speed: ld.speed[0] + Math.random() * (ld.speed[1] - ld.speed[0])
                });
            }

            letters.forEach((l, i) => {
                ctx.font = "900 45px Fredoka"; ctx.textAlign = "center";
                ctx.fillStyle = "#1A202C"; ctx.fillText(l.char, l.x, l.y);
                l.y += l.speed;

                if (l.y > player.y && l.y < player.y + player.h && l.x > player.x && l.x < player.x + player.w) {
                    if (l.char === missingChar) {
                        score += 25; solvedCount++;
                        player.color = '#6BCB77';
                        if (solvedCount >= ld.target) {
                            if (currentLevel < 5) levelUp(); else winGame();
                        } else { setNextWord(); }
                    } else {
                        score = Math.max(0, score - 10);
                        player.color = '#EF4444';
                        gsap.to(canvas, { x: 6, repeat: 3, yoyo: true, duration: 0.05, onComplete: () => gsap.set(canvas, {x:0}) });
                    }
                    document.getElementById('ui-score').innerText = score;
                    letters.splice(i, 1);
                    setTimeout(() => player.color = '#73A5CA', 300);
                }
                if (l.y > canvas.height) letters.splice(i, 1);
            });
            requestAnimationFrame(animate);
        }

        function levelUp() {
            gameState = 'PAUSE';
            currentLevel++; solvedCount = 0;
            showOverlay("🆙", "Level Naik!", `Hebat ${namaSiswa}! Lanjut ke Level ${currentLevel}`, "LANJUT");
        }

        function winGame() {
            gameState = 'WIN';
            const overlay = document.getElementById('overlay');

            document.getElementById('overlay-emoji').innerText = "👑";
            document.getElementById('overlay-title').innerText = `Selamat, ${namaSiswa}!`;
            document.getElementById('overlay-desc').innerText = `Kamu berhasil menamatkan misi! \n Skor Akhir: ${score}`;
            const btn = document.getElementById('overlay-btn');
            btn.innerText = "AMBIL HADIAH";
            btn.onclick = () => window.location.href = "{{ route('siswa.dashboard') }}";

            overlay.classList.remove('hidden');
            gsap.fromTo(overlay,
                { opacity: 0, backgroundColor: "rgba(26, 32, 44, 0)" },
                {
                    opacity: 1,
                    backgroundColor: "rgba(26, 32, 44, 0.95)",
                    duration: 0.8,
                    onComplete: () => triggerVictoryConfetti()
                }
            );
            gsap.fromTo("#overlay-content", { scale: 0.5 }, { scale: 1, duration: 1, ease: "back.out(1.7)" });
        }

        function triggerVictoryConfetti() {
            const end = Date.now() + 5000;
            const colors = ['#E87F24', '#FFD93D', '#73A5CA', '#6BCB77'];
            (function frame() {
                confetti({ particleCount: 3, angle: 60, spread: 55, origin: { x: 0, y: 0.8 }, colors: colors, zIndex: 100 });
                confetti({ particleCount: 3, angle: 120, spread: 55, origin: { x: 1, y: 0.8 }, colors: colors, zIndex: 100 });
                if (Date.now() < end) requestAnimationFrame(frame);
            }());
        }

        function showOverlay(emoji, title, desc, btnText) {
            const overlay = document.getElementById('overlay');
            document.getElementById('overlay-emoji').innerText = emoji;
            document.getElementById('overlay-title').innerText = title;
            document.getElementById('overlay-desc').innerText = desc;
            document.getElementById('overlay-btn').innerText = btnText;

            overlay.classList.remove('hidden');
            gsap.fromTo(overlay, { opacity: 0, backgroundColor: "rgba(26, 32, 44, 0)" }, { opacity: 1, backgroundColor: "rgba(26, 32, 44, 0.95)", duration: 0.5 });
        }

        function handleOverlayClick() {
            gameState = 'PLAY';
            document.getElementById('ui-level').innerText = currentLevel;
            document.getElementById('level-title').innerText = `LEVEL ${currentLevel}`;
            setNextWord();
            gsap.to("#overlay", { opacity: 0, duration: 0.4, onComplete: () => document.getElementById('overlay').classList.add('hidden') });
        }

        window.onkeydown = (e) => {
            if (e.key === 'ArrowLeft') player.dx = -player.speed;
            if (e.key === 'ArrowRight') player.dx = player.speed;
        };
        window.onkeyup = () => player.dx = 0;
    </script>
</body>
</html>
