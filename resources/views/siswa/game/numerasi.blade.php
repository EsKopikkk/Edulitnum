<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Labirin Angka | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700;800&family=Fredoka:wght@500;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'num-teal': '#0EA5E9',
                        'num-blue': '#2563EB',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                        'fredoka': ['Fredoka', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow: hidden; /* Mencegah scrollbar muncul akibat animasi gelembung */
            background-image: url('{{ asset("images/bg-arena-numerasi.png") }}');
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
        }
        .font-kids { font-family: 'Fredoka', sans-serif; }

        /* ==========================================================================
           ANIMASI BACKGROUND GELEMBUNG AIR (PRETEST STYLE)
           ========================================================================== */
        .bubble-container {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
            top: 0;
            left: 0;
            pointer-events: none;
        }
        .bubble {
            position: absolute;
            bottom: -50px;
            background: rgba(255, 255, 255, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.5), 0 2px 10px rgba(255, 255, 255, 0.1);
            animation: floatUp 12s infinite linear;
        }
        @keyframes floatUp {
            0% { transform: translateY(0) scale(1); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-110vh) scale(1.2); opacity: 0; }
        }

        /* Progress Bar Cairan Air Neon */
        .water-progress {
            background: linear-gradient(to right, #34D399, #059669);
            box-shadow: 0 0 15px #34D399, inset 0 2px 4px rgba(255,255,255,0.4);
            transition: width 1s linear;
        }

        /* ==========================================================================
           EFEK GLASSMORPHISM KARTU AIR (WATER CARD EFFECT)
           ========================================================================== */
        .water-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(20px);
            border: 4px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 20px 50px rgba(0, 75, 150, 0.3), inset 0 0 20px rgba(255, 255, 255, 0.3);
        }

        .glass-hud {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 2px solid rgba(14, 165, 233, 0.3);
        }

        /* ==========================================================================
           TOMBOL PILIHAN GANDA 3D JELLY (INTERAKTIF ANAK SD)
           ========================================================================== */
        .btn-jelly-3d {
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.9), rgba(224, 242, 254, 0.9));
            border: 3px solid #0EA5E9;
            box-shadow: 0 6px 0 0 #0284C7, 0 10px 20px rgba(2, 132, 199, 0.2);
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .btn-jelly-3d:hover {
            background: linear-gradient(to bottom, #E0F2FE, #BAE6FD);
            transform: translateY(-4px) scale(1.02); /* Melayang naik sedikit saat didekati mouse */
            border-color: #2563EB;
            box-shadow: 0 10px 0 0 #1D4ED8, 0 15px 25px rgba(29, 78, 216, 0.3);
        }
        .btn-jelly-3d:active {
            transform: translateY(4px) scale(0.98);
            box-shadow: 0 2px 0 0 #1D4ED8, 0 5px 10px rgba(29, 78, 216, 0.2);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between relative select-none h-screen w-screen pb-6">

    {{-- KONTEN GENERATOR GELEMBUNG BELAKANG --}}
    <div class="bubble-container" id="bubble-box"></div>

    {{-- HUD ATAS: TIMER, PROGRESS, & SCORE --}}
    <header class="w-full max-w-5xl mx-auto px-4 pt-4 relative z-10">
        <div class="glass-hud rounded-2xl p-4 flex flex-col md:flex-row items-center justify-between gap-4 shadow-2xl">
            <div class="flex items-center gap-3">
                <span class="text-3xl animate-bounce">🦈</span>
                <div>
                    <h1 class="text-white font-kids font-black text-lg tracking-wide uppercase">LABIRIN ANGKA</h1>
                    <p class="text-emerald-400 text-xs font-bold">Misi: Kalahkan 15 Tantangan Hitung!</p>
                </div>
            </div>

            <div class="w-full md:w-1/2 bg-slate-900/80 rounded-full p-1 border border-white/10 relative overflow-hidden">
                <div id="timer-bar" class="water-progress h-5 rounded-full w-full"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span id="timer-text" class="text-white font-kids font-black text-xs tracking-widest drop-shadow-md">⏱️ 15:00</span>
                </div>
            </div>

            <div class="bg-emerald-600 border-2 border-emerald-400 px-5 py-1.5 rounded-xl shadow-[0_4px_0_0_#047857]">
                <span class="text-white font-kids font-black text-sm tracking-wider">
                    SOAL: <span id="current-index-text">1</span> / 15
                </span>
            </div>
        </div>
    </header>

    {{-- AREA KARTU TANTANGAN SOAL (WATER CARD EFFECT) --}}
    <main class="w-full max-w-3xl mx-auto flex-grow flex items-center justify-center p-4 relative z-10">
        <div class="w-full water-card rounded-[2.5rem] p-6 md:p-8 relative">

            <div class="mb-8 text-center">
                <div id="badge-kategori" class="inline-block bg-sky-500 text-white font-black text-xs px-4 py-1.5 rounded-full uppercase tracking-wider mb-3 shadow-md font-kids">
                    Numerasi
                </div>
                <h2 id="text-pertanyaan" class="text-slate-800 font-bold text-lg md:text-xl leading-relaxed bg-white/50 p-4 rounded-2xl border border-white/40 shadow-inner">
                    Sedang mengumpulkan angka ajaib...
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
                <button onclick="checkJawaban('A')" id="opt-A" class="btn-jelly-3d rounded-2xl py-4 px-6 text-left font-kids font-bold text-base text-slate-700 flex items-center gap-4">
                    <span class="bg-sky-500 text-white w-9 h-9 rounded-xl flex items-center justify-center font-black shadow-md text-lg">A</span>
                    <span id="text-opt-A" class="tracking-wide">Pilihan A</span>
                </button>

                <button onclick="checkJawaban('B')" id="opt-B" class="btn-jelly-3d rounded-2xl py-4 px-6 text-left font-kids font-bold text-base text-slate-700 flex items-center gap-4">
                    <span class="bg-sky-500 text-white w-9 h-9 rounded-xl flex items-center justify-center font-black shadow-md text-lg">B</span>
                    <span id="text-opt-B" class="tracking-wide">Pilihan B</span>
                </button>

                <button onclick="checkJawaban('C')" id="opt-C" class="btn-jelly-3d rounded-2xl py-4 px-6 text-left font-kids font-bold text-base text-slate-700 flex items-center gap-4">
                    <span class="bg-sky-500 text-white w-9 h-9 rounded-xl flex items-center justify-center font-black shadow-md text-lg">C</span>
                    <span id="text-opt-C" class="tracking-wide">Pilihan C</span>
                </button>

                <button onclick="checkJawaban('D')" id="opt-D" class="btn-jelly-3d rounded-2xl py-4 px-6 text-left font-kids font-bold text-base text-slate-700 flex items-center gap-4">
                    <span class="bg-sky-500 text-white w-9 h-9 rounded-xl flex items-center justify-center font-black shadow-md text-lg">D</span>
                    <span id="text-opt-D" class="tracking-wide">Pilihan D</span>
                </button>
            </div>
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="w-full text-center text-white/50 font-fredoka font-bold text-[9px] uppercase tracking-widest relative z-10 pointer-events-none">
        🎮 LABIRIN ANGKA • PETUALANGAN EDULITNUM SEMESTER 4
    </footer>

    {{-- ENGINE UTAMA GAMEPLAY --}}
    <script>
        const dataSoal = @json($daftarSoal);
        const tipeGame = "{{ $tipe }}";

        let currentIndex = 0;
        let jumlahBenar = 0;

        const totalWaktu = 900; // 15 Menit
        let sisaWaktu = totalWaktu;
        let timerInterval;

        // ==========================================================================
        // SCRIPT GENERATOR GELEMBUNG SECARA RANDOM
        // ==========================================================================
        function createBubbles() {
            const bubbleBox = document.getElementById('bubble-box');
            const jumlahGelembung = 25;

            for (let i = 0; i < jumlahGelembung; i++) {
                let bubble = document.createElement('div');
                bubble.classList.add('bubble');

                let ukuran = Math.random() * 35 + 10; // Ukuran bervariasi antara 10px s/d 45px
                let posisiX = Math.random() * 100;
                let delay = Math.random() * 8;
                let durasi = Math.random() * 7 + 6;

                bubble.style.width = ukuran + 'px';
                bubble.style.height = ukuran + 'px';
                bubble.style.left = posisiX + '%';
                bubble.style.animationDelay = delay + 's';
                bubble.style.animationDuration = durasi + 's';

                bubbleBox.appendChild(bubble);
            }
        }

        function startTimer() {
            timerInterval = setInterval(() => {
                sisaWaktu--;

                let menit = Math.floor(sisaWaktu / 60);
                let detik = sisaWaktu % 60;
                detik = detik < 10 ? '0' + detik : detik;

                document.getElementById('timer-text').innerText = `⏱️ ${menit}:${detik}`;

                let persentase = (sisaWaktu / totalWaktu) * 100;
                document.getElementById('timer-bar').style.width = persentase + '%';

                if (persentase < 20) {
                    document.getElementById('timer-bar').style.background = '#EF4444';
                    document.getElementById('timer-bar').style.boxShadow = '0 0 15px #EF4444';
                }

                if (sisaWaktu <= 0) {
                    clearInterval(timerInterval);
                    finishGame(true);
                }
            }, 1000);
        }

        function renderSoal() {
            if (currentIndex >= dataSoal.length) {
                clearInterval(timerInterval);
                finishGame(false);
                return;
            }

            let soalSekarang = dataSoal[currentIndex];

            document.getElementById('current-index-text').innerText = currentIndex + 1;
            document.getElementById('badge-kategori').innerText = soalSekarang.kategori ?? 'Numerasi';
            document.getElementById('text-pertanyaan').innerText = soalSekarang.pertanyaan;
            document.getElementById('text-opt-A').innerText = soalSekarang.pilihan_a;
            document.getElementById('text-opt-B').innerText = soalSekarang.pilihan_b;
            document.getElementById('text-opt-C').innerText = soalSekarang.pilihan_c;
            document.getElementById('text-opt-D').innerText = soalSekarang.pilihan_d;
        }

        function checkJawaban(pilihanSiswa) {
            let soalSekarang = dataSoal[currentIndex];

            if (pilihanSiswa === soalSekarang.kunci_jawaban) {
                jumlahBenar++;
            }

            currentIndex++;
            renderSoal();
        }

        // ==========================================================================
        // LOGIKA BARU BERBASIS DETIK (KOMPETITIF)
        // ==========================================================================
        function finishGame(isTimeUp) {
            // Formula: (Benar x 100) + Sisa Detik Waktu Kerja
            let poinDasar = jumlahBenar * 100;
            let bonusWaktu = sisaWaktu > 0 ? sisaWaktu : 0;
            let skorAkhir = poinDasar + bonusWaktu;

            Swal.fire({
                title: isTimeUp ? 'Waktu Habis! ⏱️' : 'Misi Selesai! 🦈',
                text: 'Menghitung skor petualangan kompetitifmu...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Kirim data ke GameController secara senyap (AJAX)
            fetch("{{ route('siswa.game.simpanSkor') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    tipe: tipeGame,
                    skor: skorAkhir, // Mengirim nilai ribuan kompetitif ke backend
                    waktu_sisa: sisaWaktu
                })
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire({
                    title: 'Selamat, Jawara Berhitung!',
                    html: `<div class="font-kids py-2">
                                <p class="text-base text-slate-600">Kamu berhasil menyelesaikan Misi Labirin Angka!</p>
                                <div class="text-5xl font-black text-blue-600 my-4 tracking-wide drop-shadow-sm">${skorAkhir}</div>
                                <p class="text-[11px] text-slate-400">Rincian: Poin Benar (${poinDasar}) + Bonus Kecepatan (${bonusWaktu} Poin)</p>
                           </div>`,
                    icon: 'success',
                    confirmButtonText: 'Kembali ke Arena Utama 🎮',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('siswa.game.index') }}";
                    }
                });
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Waduh!', 'Gagal mengamankan skor ke server, coba cek jaringan lokal komputer.', 'error');
            });
        }

        window.onload = function() {
            createBubbles(); // Jalankan hujan gelembung melayang
            startTimer();    // Jalankan countdown waktu kerja
            renderSoal();     // Muat lembar soal pertama
        };
    </script>
</body>
</html>
