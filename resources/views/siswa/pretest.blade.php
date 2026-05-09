<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misi Tantangan | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/TextPlugin.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'edu-orange': '#E87F24',
                        'edu-yellow': '#FFD93D',
                        'edu-blue': '#73A5CA',
                        'edu-bg': '#FEFDDF',
                        'edu-dark': '#1A202C',
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
        body { font-family: 'Poppins', sans-serif; background-color: #FEFDDF; overflow: hidden; }
        .font-kids { font-family: 'Fredoka', sans-serif; }

        .soal-card { display: none; opacity: 0; }
        .soal-card.active { display: block; }

        /* Tombol Jawaban Gaya Game */
        .option-btn {
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-bottom-width: 6px;
        }
        .option-btn:hover { transform: translateY(-3px); }
        .option-btn:active { transform: translateY(3px); border-bottom-width: 2px; }

        .peer:checked + .option-btn {
            background-color: #E87F24 !important;
            color: white !important;
            border-color: #C66A1E !important;
            transform: translateY(3px);
            border-bottom-width: 2px;
        }

        /* Timer Circle Animation */
        .timer-svg { transform: rotate(-90deg); }
        #timer-circle {
            transition: stroke-dashoffset 1s linear;
            stroke-dasharray: 283;
            stroke-dashoffset: 0;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <nav class="p-6 bg-white/80 backdrop-blur-md shadow-sm border-b-4 border-edu-orange/10 z-40">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <a href="{{ route('siswa.dashboard') }}" class="font-black text-edu-orange hover:scale-105 transition-all flex items-center gap-2">
                <span class="text-2xl">🏠</span> <span class="hidden md:block">MENU UTAMA</span>
            </a>

            <div class="flex-1 max-w-xl mx-10 text-center">
                <div class="flex justify-between mb-2">
                    <span id="soal-counter" class="text-xs font-black text-edu-dark/40 uppercase tracking-widest">Misi 1 / {{ count($daftarSoal) }}</span>
                    <span class="text-xs font-black text-edu-orange uppercase tracking-widest">Progress</span>
                </div>
                <div class="w-full bg-edu-yellow/20 h-4 rounded-full border-2 border-white shadow-inner overflow-hidden">
                    <div id="progress-bar" class="bg-edu-yellow h-full rounded-full shadow-lg transition-all duration-700" style="width: 0%"></div>
                </div>
            </div>

            <div class="relative w-16 h-16 flex items-center justify-center">
                <svg class="timer-svg w-16 h-16">
                    <circle cx="32" cy="32" r="28" stroke="#f3f4f6" stroke-width="6" fill="none" />
                    <circle id="timer-circle" cx="32" cy="32" r="28" stroke="#E87F24" stroke-width="6" fill="none" stroke-linecap="round" />
                </svg>
                <span id="timer-text" class="absolute font-black text-edu-dark text-lg font-kids">30</span>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center p-8 relative">
        <form id="exam-form" action="{{ route('siswa.pretest.simpan') }}" method="POST" class="max-w-6xl w-full">
            @csrf

            @foreach($daftarSoal as $index => $soal)
            <div class="soal-card {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}" data-text="{{ $soal->pertanyaan }}">

                <div class="flex flex-col lg:flex-row gap-10 items-center">

                    <div class="lg:w-1/2 text-center lg:text-left">
                        <div class="inline-block bg-edu-blue/10 text-edu-blue px-6 py-2 rounded-full font-black text-xs uppercase tracking-widest mb-6">
                           ✨ Misi {{ $soal->kategori }}
                        </div>
                        <h2 id="text-target-{{ $index }}" class="text-3xl md:text-5xl font-black text-edu-dark leading-tight font-kids mb-8"></h2>
                    </div>

                    <div class="lg:w-1/2 w-full grid grid-cols-1 gap-4">
                        @foreach(['a', 'b', 'c', 'd'] as $opsi)
                        <label class="option-item-{{ $index }} opacity-0 translate-x-10 cursor-pointer block">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $opsi }}" class="peer hidden" required>
                            <div class="option-btn bg-white border-2 border-gray-100 p-6 rounded-3xl flex items-center gap-6 shadow-sm">
                                <div class="w-12 h-12 bg-edu-yellow/20 rounded-2xl flex items-center justify-center font-black text-edu-orange text-xl shrink-0">
                                    {{ strtoupper($opsi) }}
                                </div>
                                <span class="text-gray-700 font-bold text-xl leading-snug">
                                    {{ $soal->{'pilihan_'.$opsi} }}
                                </span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="mt-16 flex justify-between items-center max-w-6xl mx-auto border-t-2 border-edu-orange/5 pt-10">
                    @if($index > 0)
                        <button type="button" onclick="prevSoal({{ $index }})" class="text-edu-dark/40 font-black flex items-center gap-3 hover:text-edu-orange transition-all">
                            <span>⬅️</span> SEBELUMNYA
                        </button>
                    @else <div></div> @endif

                    @if($index < count($daftarSoal) - 1)
                        <button type="button" onclick="nextSoal({{ $index }})" class="bg-edu-orange text-white px-12 py-5 rounded-[2rem] font-black text-xl shadow-xl shadow-edu-orange/30 hover:bg-edu-dark transition-all">
                            LANJUTKAN 🚀
                        </button>
                    @else
                        <button type="submit" class="bg-edu-blue text-white px-20 py-6 rounded-[2rem] font-black text-3xl shadow-xl shadow-edu-blue/30 hover:bg-edu-dark transition-all">
                            SELESAI 🏁
                        </button>
                    @endif
                </div>
            </div>
            @endforeach
        </form>
    </main>

    <script>
        gsap.registerPlugin(TextPlugin);
        const totalSoal = {{ count($daftarSoal) }};
        let timeLeft = 30;
        let timerId = null;

        // --- Logika Timer ---
        function startTimer() {
            timeLeft = 30;
            const circle = document.getElementById('timer-circle');
            const text = document.getElementById('timer-text');

            clearInterval(timerId);
            timerId = setInterval(() => {
                timeLeft--;
                text.innerText = timeLeft;

                // Animasi Stroke Circle
                const offset = 283 - (timeLeft / 30) * 283;
                circle.style.strokeDashoffset = offset;

                if (timeLeft <= 5) {
                    circle.style.stroke = "#EF4444"; // Berubah merah saat mau habis
                    gsap.to(text, { scale: 1.2, repeat: 1, yoyo: true, duration: 0.2 });
                } else {
                    circle.style.stroke = "#E87F24";
                }

                if (timeLeft <= 0) {
                    clearInterval(timerId);
                    alert("Waktu habis! Ayo segera pilih jawabanmu.");
                }
            }, 1000);
        }

        // --- Animasi Soal ---
        function animateSoal(index) {
            const card = document.querySelector(`.soal-card[data-index="${index}"]`);
            const text = card.getAttribute('data-text');
            const target = `#text-target-${index}`;
            const options = `.option-item-${index}`;

            startTimer(); // Reset timer tiap ganti soal

            const tl = gsap.timeline();
            tl.fromTo(card, { opacity: 0, scale: 0.95 }, { opacity: 1, scale: 1, duration: 0.5 })
              .to(target, { duration: text.length * 0.04, text: text, ease: "none" })
              .to(options, { opacity: 1, x: 0, stagger: 0.1, duration: 0.5, ease: "back.out(1.7)" }, "-=0.2");
        }

        window.onload = () => {
            updateProgress(1);
            animateSoal(0);
        };

        function nextSoal(idx) {
            const current = document.querySelector(`.soal-card[data-index="${idx}"]`);
            const checked = current.querySelector('input[type="radio"]:checked');

            if (!checked) {
                gsap.to(current, { x: 10, repeat: 5, yoyo: true, duration: 0.05 });
                return;
            }

            const next = document.querySelector(`.soal-card[data-index="${idx + 1}"]`);
            gsap.to(current, { opacity: 0, x: -30, duration: 0.3, onComplete: () => {
                current.classList.remove('active');
                next.classList.add('active');
                updateProgress(idx + 2);
                animateSoal(idx + 1);
            }});
        }

        function prevSoal(idx) {
            const current = document.querySelector(`.soal-card[data-index="${idx}"]`);
            const prev = document.querySelector(`.soal-card[data-index="${idx - 1}"]`);

            gsap.to(current, { opacity: 0, x: 30, duration: 0.3, onComplete: () => {
                current.classList.remove('active');
                prev.classList.add('active');
                updateProgress(idx);
                animateSoal(idx - 1);
            }});
        }

        function updateProgress(step) {
            const percent = (step / totalSoal) * 100;
            gsap.to('#progress-bar', { width: percent + '%', duration: 1 });
            document.getElementById('soal-counter').innerText = `Misi ${step} / ${totalSoal}`;
        }
    </script>
</body>
</html>
