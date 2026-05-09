<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misi Tantangan | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/TextPlugin.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'edu-orange': '#E87F24',
                        'edu-yellow': '#FFD93D',
                        'edu-blue': '#73A5CA',
                        'edu-blue-dark': '#5A8EB4',
                        'edu-bg': '#F0F9FF',
                        'edu-dark': '#1A202C',
                    },
                    fontFamily: { 'fredoka': ['Fredoka', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Fredoka', sans-serif; background-color: #F0F9FF; overflow-x: hidden; }
        .soal-card { display: none; }
        .soal-card.active { display: block; }

        .option-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .peer:checked + .option-card {
            background-color: #73A5CA !important;
            color: white !important;
            border-color: #5A8EB4 !important;
            transform: scale(1.05);
        }
        .peer:checked + .option-card span { color: white !important; }
        .peer:checked + .option-card .option-circle { background-color: rgba(255,255,255,0.2); color: white; }

        .cursor { display: inline-block; width: 3px; background-color: #1A202C; margin-left: 3px; }
    </style>
</head>
<body class="min-h-screen flex flex-col relative">

    <nav class="bg-white/80 backdrop-blur-md p-5 shadow-sm sticky top-0 z-50 border-b-4 border-edu-blue/20">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-2 bg-gray-100 px-5 py-2.5 rounded-2xl hover:bg-edu-orange hover:text-white transition-all font-black text-xs tracking-widest">
                🏠 HOME
            </a>

            <div class="flex-1 max-w-md mx-8 text-center">
                <span id="soal-counter" class="text-edu-blue font-black text-sm uppercase tracking-tighter">MISI 1 / {{ count($daftarSoal) }}</span>
                <div class="w-full bg-gray-200 h-3 rounded-full mt-1 border-2 border-white shadow-inner">
                    <div id="progress-bar" class="bg-edu-blue h-full rounded-full transition-all duration-700" style="width: 0%"></div>
                </div>
            </div>
            <div class="w-24"></div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center p-6">
        <form id="exam-form" action="{{ route('siswa.pretest.simpan') }}" method="POST" class="max-w-4xl w-full">
            @csrf

            @foreach($daftarSoal as $index => $soal)
            <div class="soal-card {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}" data-text="{{ $soal->pertanyaan }}" data-animated="false">
                <div class="bg-white rounded-[3.5rem] p-10 md:p-14 shadow-[0_20px_60px_rgba(115,165,202,0.15)] border-4 border-white relative">

                    <div class="flex justify-center -mt-24 mb-12">
                        <div class="bg-white px-8 py-3 rounded-2xl shadow-xl border-2 border-edu-blue/10 font-black text-edu-blue uppercase tracking-widest text-sm flex items-center gap-3">
                            <span class="text-xl">{{ $soal->kategori == 'numerasi' ? '🔢' : '📚' }}</span>
                            {{ strtoupper($soal->kategori) }}
                        </div>
                    </div>

                    <div class="text-center min-h-[120px] mb-12">
                        <h2 id="text-target-{{ $index }}" class="text-2xl md:text-3xl font-bold text-gray-800 leading-snug inline"></h2>
                        <span id="cursor-{{ $index }}" class="cursor text-3xl">|</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach(['a', 'b', 'c', 'd'] as $opsi)
                        <label class="option-item-{{ $index }} opacity-0 translate-y-4 cursor-pointer block">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $opsi }}" class="peer hidden" required>
                            <div class="option-card bg-white border-4 border-edu-blue/5 p-6 rounded-[2rem] flex items-center gap-5 shadow-sm hover:border-edu-blue/30 transition-all">
                                <div class="option-circle w-12 h-12 rounded-2xl bg-edu-blue/10 flex items-center justify-center shrink-0 font-black text-edu-blue text-xl">
                                    {{ strtoupper($opsi) }}
                                </div>
                                <span class="text-gray-800 font-bold text-lg leading-tight">
                                    {{ $soal->{'pilihan_'.$opsi} }}
                                </span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="mt-12 flex justify-between items-center px-4">
                    @if($index > 0)
                    <button type="button" onclick="prevSoal({{ $index }})" class="group bg-white text-edu-blue font-black px-8 py-4 rounded-2xl border-2 border-edu-blue/10 hover:bg-edu-blue hover:text-white transition-all flex items-center gap-3">
                        <span class="group-hover:-translate-x-1 transition-transform">⬅️</span> KEMBALI
                    </button>
                    @else <div></div> @endif

                    @if($index < count($daftarSoal) - 1)
                    <button type="button" onclick="nextSoal({{ $index }})" class="group bg-edu-blue text-white pl-10 pr-6 py-5 rounded-[2.5rem] font-black text-2xl shadow-2xl shadow-edu-blue/40 hover:bg-edu-dark transition-all flex items-center gap-6">
                        LANJUT <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center group-hover:translate-x-2 transition-transform text-sm">➡️</div>
                    </button>
                    @else
                    <button type="submit" class="bg-edu-green text-white px-16 py-6 rounded-[2.5rem] font-black text-3xl shadow-2xl shadow-green-500/30 hover:scale-105 active:scale-95 transition-all bg-[#6BCB77]">
                        🏁 SELESAI
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

        function animateSoal(index) {
            const card = document.querySelector(`.soal-card[data-index="${index}"]`);
            if (!card) return;

            const text = card.getAttribute('data-text');
            const target = `#text-target-${index}`;
            const cursor = `#cursor-${index}`;
            const options = `.option-item-${index}`;

            // Jika sudah pernah tampil, tampilkan instan (Solusi Masuk/Keluar Soal)
            if (card.getAttribute('data-animated') === 'true') {
                gsap.set(target, { text: text });
                gsap.set(cursor, { display: 'none' });
                gsap.set(options, { opacity: 1, y: 0 });
                return;
            }

            // Animasi Mengetik
            gsap.to(target, {
                duration: text.length * 0.03,
                text: text,
                ease: "none",
                onComplete: () => {
                    gsap.to(cursor, { opacity: 0, duration: 0.5 });
                    // Animasi Opsi Muncul Stagger
                    gsap.to(options, {
                        opacity: 1,
                        y: 0,
                        duration: 0.5,
                        stagger: 0.15,
                        ease: "back.out(1.7)"
                    });
                    card.setAttribute('data-animated', 'true');
                }
            });
        }

        window.onload = () => {
            updateProgress(1);
            animateSoal(0);
        };

        function nextSoal(idx) {
            const current = document.querySelector(`.soal-card[data-index="${idx}"]`);
            const inputs = current.querySelectorAll('input[type="radio"]:checked');

            if (inputs.length === 0) {
                // Shake effect jika belum diisi
                gsap.to(current, { x: 10, repeat: 5, yoyo: true, duration: 0.05 });
                return;
            }

            const next = document.querySelector(`.soal-card[data-index="${idx + 1}"]`);
            current.classList.remove('active');
            next.classList.add('active');

            updateProgress(idx + 2);
            animateSoal(idx + 1);
        }

        function prevSoal(idx) {
            const current = document.querySelector(`.soal-card[data-index="${idx}"]`);
            const prev = document.querySelector(`.soal-card[data-index="${idx - 1}"]`);

            current.classList.remove('active');
            prev.classList.add('active');

            updateProgress(idx);
            animateSoal(idx - 1);
        }

        function updateProgress(step) {
            const percent = (step / totalSoal) * 100;
            document.getElementById('progress-bar').style.width = percent + '%';
            document.getElementById('soal-counter').innerText = `MISI ${step} / ${totalSoal}`;
        }
    </script>
</body>
</html>
