<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misi Tantangan Awal | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/TextPlugin.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;700;900&family=Poppins:wght@500;700;800&display=swap" rel="stylesheet">

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
            overflow: hidden;
        }
        .font-kids { font-family: 'Fredoka', sans-serif; }

        .soal-card { display: none; opacity: 0; transform: scale(0.98); }
        .soal-card.active { display: block; }

        .glass-panel {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 2px solid rgba(255, 255, 255, 0.6);
        }

        .option-btn {
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 5px 0 0 #E2E8F0;
        }
        .option-btn:hover { transform: translateY(-2px); }
        .option-btn:active { transform: translateY(3px); box-shadow: 0 0px 0 0 #E2E8F0; }

        .peer:checked + .option-btn {
            background-color: #E87F24 !important;
            color: white !important;
            border-color: white !important;
            box-shadow: 0 2px 0 0 #B55A0A !important;
            transform: translateY(3px);
        }

        .timer-svg { transform: rotate(-90deg); }
        #timer-circle {
            transition: stroke-dashoffset 1s linear;
            stroke-dasharray: 125.6;
            stroke-dashoffset: 0;
        }

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
<body class="w-screen h-screen flex flex-col relative select-none overflow-hidden">

    <div class="fixed inset-0 z-0 pointer-events-none" id="bubbles-container"></div>

    <nav class="p-3 glass-panel shadow-md border-b-2 border-white/40 z-40 mx-4 my-2 rounded-full relative shrink-0">
        <div class="max-w-6xl mx-auto flex items-center justify-between gap-4">

            <div class="flex items-center gap-2 font-black text-blue-950 font-kids tracking-wide text-base shrink-0">
                🤿 <span>MISI AWAL</span>
            </div>

            <div class="flex-1 max-w-lg mx-2 text-center">
                <div class="flex justify-between mb-0.5 px-2">
                    <span id="soal-counter" class="text-[11px] font-black text-blue-950/60 uppercase tracking-wider">Misi 1 / {{ count($daftarSoal) }}</span>
                    <span class="text-[11px] font-black text-edu-orange uppercase tracking-wider">Oksigen Berenang</span>
                </div>
                <div class="w-full bg-white/60 h-3 rounded-full border-2 border-white shadow-inner overflow-hidden">
                    <div id="progress-bar" class="bg-gradient-to-r from-amber-400 to-edu-yellow h-full rounded-full shadow-lg transition-all duration-700" style="width: 0%"></div>
                </div>
            </div>

            <div class="relative w-12 h-12 flex items-center justify-center shrink-0 bg-white/80 rounded-full border border-white shadow-inner">
                <svg class="timer-svg w-12 h-12 absolute">
                    <circle cx="24" cy="24" r="20" stroke="rgba(0,0,0,0.05)" stroke-width="4" fill="none" />
                    <circle id="timer-circle" cx="24" cy="24" r="20" stroke="#E87F24" stroke-width="4" fill="none" stroke-linecap="round" />
                </svg>
                <span id="timer-text" class="absolute font-black text-blue-950 text-sm font-kids">30</span>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center p-4 md:px-8 md:pb-6 relative z-10 min-h-0">
        <form id="exam-form" action="{{ route('siswa.pretest.simpan') }}" method="POST" class="max-w-5xl w-full">
            @csrf

            @foreach($daftarSoal as $index => $soal)
            <div class="soal-card glass-panel rounded-[32px] p-5 md:p-8 shadow-xl border-4 border-white {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}" data-text="{{ $soal->pertanyaan }}">

                <div class="flex flex-col lg:flex-row gap-6 lg:gap-8 items-center">

                    <div class="lg:w-1/2 text-center lg:text-left w-full">
                        <div class="inline-block bg-white/80 text-blue-950 border border-white px-4 py-1 rounded-full font-black text-[11px] uppercase tracking-widest mb-3 shadow-sm">
                            @if(strtolower($soal->kategori) === 'literasi') 🐙 @else 🦈 @endif Misi {{ $soal->kategori }}
                        </div>
                        <h2 id="text-target-{{ $index }}" class="text-xl md:text-3xl font-black text-blue-950 leading-snug font-kids min-h-[90px] lg:min-h-[145px] drop-shadow-sm flex items-center justify-center lg:justify-start"></h2>
                    </div>

                    <div class="lg:w-1/2 w-full grid grid-cols-1 gap-2.5">
                        @foreach(['a', 'b', 'c', 'd'] as $opsi)
                        <label class="option-item-{{ $index }} opacity-0 translate-x-10 cursor-pointer block">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $opsi }}" class="peer hidden" required>
                            <div class="option-btn bg-white/90 border-2 border-white p-3.5 rounded-xl flex items-center gap-3 shadow-sm hover:bg-white text-blue-950">
                                <div class="w-8 h-8 bg-amber-400 text-white rounded-lg flex items-center justify-center font-black text-base shrink-0 shadow-sm font-kids">
                                    {{ strtoupper($opsi) }}
                                </div>
                                <span class="font-bold text-base md:text-lg leading-tight">
                                    {{ $soal->{'pilihan_'.$opsi} }}
                                </span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <input type="hidden" name="sisa_waktu[{{ $soal->id }}]" id="sisa-waktu-{{ $index }}" value="30">

                <div class="mt-5 flex justify-between items-center border-t-2 border-white/30 pt-4">
                    @if($index > 0)
                        <button type="button" onclick="prevSoal({{ $index }})" class="text-blue-950/60 font-black flex items-center gap-1.5 hover:text-edu-orange transition-all font-kids text-xs bg-white/40 px-3 py-1.5 rounded-full border border-white/50">
                            <span>⬅️</span> KEMBALI
                        </button>
                    @else <div></div> @endif

                    @if($index < count($daftarSoal) - 1)
                        <button type="button" onclick="nextSoal({{ $index }})" class="bg-edu-orange hover:bg-orange-600 border-2 border-white text-white px-8 py-3.5 rounded-full font-black text-base shadow-md transition-all shadow-orange-600/20 active:scale-95 font-kids tracking-wide">
                            LANJUTKAN 🚀
                        </button>
                    @else
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 border-2 border-white text-white px-12 py-3.5 rounded-full font-black text-lg shadow-md transition-all shadow-blue-600/20 active:scale-95 font-kids tracking-wide animate-bounce">
                            SELESAI 🏁
                        </button>
                    @endif
                </div>
            </div>
            @endforeach
        </form>
    </main>

    <div id="welcome-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-blue-950/60 backdrop-blur-md">
        <div id="modal-box" class="glass-panel max-w-md w-full bg-white/95 rounded-[2.5rem] p-8 text-center border-4 border-white shadow-2xl scale-0 opacity-0 relative">
            <div class="text-6xl mb-4 select-none animate-bounce">🚢</div>
            <h2 class="text-2xl md:text-3xl font-black text-blue-950 font-kids mb-2 tracking-wide">Selamat Datang, <br>Penyelam Cilik!</h2>
            <p class="text-blue-900 font-bold text-sm leading-relaxed max-w-xs mx-auto mb-6">
                Sebelum kita bisa berenang melihat terumbu karang dan bermain game, ayo ikuti <span class="text-edu-orange">Misi Penyelaman Pertama</span> ini dulu ya! 🤿✨
            </p>
            <button type="button" onclick="closeWelcomeModal()" class="w-full py-4 bg-edu-orange hover:bg-orange-600 active:translate-y-1 text-white font-black text-base rounded-2xl shadow-[0_5px_0_0_#B55A0A] hover:shadow-[0_3px_0_0_#B55A0A] transition-all border-2 border-white font-kids tracking-wide">
                SIAP, AYO MELUNCUR! 🚀
            </button>
        </div>
    </div>

    <script>
        gsap.registerPlugin(TextPlugin);
        const totalSoal = {{ count($daftarSoal) }};
        let timeLeft = 30;
        let timerId = null;
        let currentActiveIndex = 0;

        function startTimer() {
            timeLeft = 30;
            const circle = document.getElementById('timer-circle');
            const text = document.getElementById('timer-text');

            clearInterval(timerId);
            timerId = setInterval(() => {
                timeLeft--;
                text.innerText = timeLeft;

                const hiddenInput = document.getElementById(`sisa-waktu-${currentActiveIndex}`);
                if (hiddenInput) {
                    hiddenInput.value = timeLeft;
                }

                const offset = 125.6 - (timeLeft / 30) * 125.6;
                circle.style.strokeDashoffset = offset;

                if (timeLeft <= 5) {
                    circle.style.stroke = "#EF4444";
                    gsap.to(text, { scale: 1.15, repeat: 1, yoyo: true, duration: 0.2 });
                } else {
                    circle.style.stroke = "#E87F24";
                }

                if (timeLeft <= 0) {
                    clearInterval(timerId);
                    if (hiddenInput) hiddenInput.value = 0;
                    alert("Waktu habis! Ayo penyelam cilik, segera pilih jawabanmu.");
                }
            }, 1000);
        }

        function animateSoal(index) {
            const card = document.querySelector(`.soal-card[data-index="${index}"]`);
            const text = card.getAttribute('data-text');
            const target = `#text-target-${index}`;
            const options = `.option-item-${index}`;

            startTimer();

            const tl = gsap.timeline();
            tl.fromTo(card, { opacity: 0, scale: 0.97 }, { opacity: 1, scale: 1, duration: 0.35 })
              .to(target, { duration: text.length * 0.025, text: text, ease: "none" })
              .to(options, { opacity: 1, x: 0, stagger: 0.06, duration: 0.35, ease: "back.out(1.4)" }, "-=0.1");
        }

        window.onload = () => {
            updateProgress(1);
            gsap.to("#modal-box", { scale: 1, opacity: 1, duration: 0.5, ease: "back.out(1.2)" });
        };

        function closeWelcomeModal() {
            gsap.to("#welcome-modal", { opacity: 0, duration: 0.3, onComplete: () => {
                document.getElementById("welcome-modal").style.display = "none";
                animateSoal(0);
            }});
        }

        function nextSoal(idx) {
            const current = document.querySelector(`.soal-card[data-index="${idx}"]`);
            const checked = current.querySelector('input[type="radio"]:checked');

            if (!checked) {
                gsap.to(current, { x: 8, repeat: 5, yoyo: true, duration: 0.04 });
                return;
            }

            const next = document.querySelector(`.soal-card[data-index="${idx + 1}"]`);
            gsap.to(current, { opacity: 0, x: -20, duration: 0.2, onComplete: () => {
                current.classList.remove('active');
                next.classList.add('active');
                currentActiveIndex = idx + 1;
                updateProgress(idx + 2);
                animateSoal(idx + 1);
            }});
        }

        function prevSoal(idx) {
            const current = document.querySelector(`.soal-card[data-index="${idx}"]`);
            const prev = document.querySelector(`.soal-card[data-index="${idx - 1}"]`);

            gsap.to(current, { opacity: 0, x: 20, duration: 0.2, onComplete: () => {
                current.classList.remove('active');
                prev.classList.add('active');
                currentActiveIndex = idx - 1;
                updateProgress(idx);
                animateSoal(idx - 1);
            }});
        }

        function updateProgress(step) {
            const percent = (step / totalSoal) * 100;
            gsap.to('#progress-bar', { width: percent + '%', duration: 0.6 });
            document.getElementById('soal-counter').innerText = `Misi ${step} / ${totalSoal}`;
        }

        const bubblesContainer = document.getElementById('bubbles-container');
        for (let i = 0; i < 12; i++) {
            let bubble = document.createElement('div');
            bubble.classList.add('bubble');
            let size = Math.random() * 16 + 6;
            bubble.style.width = size + 'px';
            bubble.style.height = size + 'px';
            bubble.style.left = Math.random() * 100 + '%';
            bubble.style.animationDuration = Math.random() * 4 + 6 + 's';
            bubble.style.animationDelay = Math.random() * 3 + 's';
            bubblesContainer.appendChild(bubble);
        }
    </script>
</body>
</html>
