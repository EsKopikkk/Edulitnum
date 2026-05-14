<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

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
        body { font-family: 'Poppins', sans-serif; background-color: #FEFDDF; overflow-x: hidden; }
        h1, h2 { font-family: 'Montserrat', sans-serif; }

        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            animation: float 15s infinite alternate ease-in-out;
        }
        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(15%, 10%) scale(1.3); }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.2);
        }

        .input-field {
            background: rgba(255, 255, 255, 0.7);
            border: 2px solid transparent;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .input-field:focus {
            border-color: #73A5CA;
            background: white;
            outline: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        /* Animasi Logo Memantul */
        @keyframes logo-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-25px); }
        }
        .animate-logo-bounce { animation: logo-bounce 2s infinite ease-in-out; }

        /* Animasi Bayangan di Lantai (Dibuat Lebih Tegas) */
        @keyframes shadow-pulse {
            0%, 100% { transform: scale(1.2); opacity: 0.4; filter: blur(4px); }
            50% { transform: scale(0.6); opacity: 0.15; filter: blur(8px); }
        }
        .animate-shadow-pulse { animation: shadow-pulse 2s infinite ease-in-out; }

        /* Animasi Kotak Berputar */
        @keyframes box-rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .animate-box-rotate { animation: box-rotate 8s infinite linear; }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center relative p-6">

    <div class="blob w-[500px] h-[500px] bg-edu-yellow/30 -top-20 -left-20"></div>
    <div class="blob w-[500px] h-[500px] bg-edu-blue/20 -bottom-20 -right-20" style="animation-delay: -5s;"></div>

    <div class="absolute top-10 left-10 z-20">
        <a href="/" class="flex items-center gap-2 text-edu-dark font-semibold hover:text-edu-orange transition-colors group">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>
    </div>

    <div class="relative z-10 w-full max-w-md">
        <div class="glass-card rounded-[40px] p-10 md:p-12">

            <div class="text-center mb-10 relative">
                <div class="relative w-20 h-28 mx-auto flex flex-col items-center justify-between">

                    <div class="relative w-16 h-16 animate-logo-bounce z-10">
                        <div class="absolute inset-0 bg-edu-orange rounded-2xl animate-box-rotate shadow-lg"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-white font-black text-3xl select-none" style="font-family: 'Montserrat', sans-serif;">E</span>
                        </div>
                    </div>

                    <div class="w-12 h-2 bg-black rounded-full absolute bottom-4 animate-shadow-pulse"></div>
                </div>

                <h2 class="text-3xl font-black text-edu-dark tracking-tighter mt-6">Login <span class="text-edu-orange">Sobat!</span></h2>
                <p class="text-gray-500 text-sm mt-2 font-medium">Masukkan datamu dengan benar ya!</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-edu-blue mb-2 ml-1">Nama Lengkap</label>
                    <input type="text" id="name-input" name="name" placeholder="" class="input-field w-full px-6 py-4 rounded-2xl text-edu-dark font-semibold placeholder:text-gray-400" required>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-edu-blue mb-2 ml-1">Kata Sandi</label>
                    <input type="password" id="pass-input" name="password" placeholder="" class="input-field w-full px-6 py-4 rounded-2xl text-edu-dark font-semibold" required>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-edu-blue mb-2 ml-1">Aku adalah...</label>
                    <div class="relative">
                        <select name="role" class="input-field w-full px-6 py-4 rounded-2xl text-edu-dark font-semibold appearance-none cursor-pointer">
                            <option value="guru">Guru</option>
                            <option value="admin">Admin</option>
                        </select>
                        <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-edu-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full py-5 bg-edu-orange text-white font-black text-lg rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.4)] hover:bg-edu-dark transition-all duration-500 transform hover:scale-105 active:scale-95 flex items-center justify-center gap-3 mt-4">
                    MASUK SEKARANG
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </button>

            </form>
        </div>

        <p class="text-center mt-8 text-gray-500 text-[10px] font-bold tracking-[0.3em] uppercase opacity-70">
            © 2026 EDULITNUM ECOSYSTEM • BY EDULTIM24
        </p>
    </div>

    <script>
        const inputs = [
            { el: document.getElementById('name-input'), fullText: 'Siapa nama lengkap kamu? . . .' },
            { el: document.getElementById('pass-input'), fullText: 'Masukkan kata sandi rahasiamu . . .' }
        ];

        let index = 0;
        let isTyping = true;

        function syncTypewriter() {
            if (!isTyping) return;
            const anyActive = inputs.some(input => document.activeElement === input.el || input.el.value.length > 0);
            if (anyActive) {
                inputs.forEach(input => input.el.placeholder = input.fullText);
                setTimeout(syncTypewriter, 500);
                return;
            }
            inputs.forEach(input => {
                input.el.placeholder = input.fullText.slice(0, index);
            });
            index++;
            if (index > inputs[0].fullText.length) {
                index = 0;
                setTimeout(syncTypewriter, 2500);
            } else {
                setTimeout(syncTypewriter, 100);
            }
        }
        syncTypewriter();
        inputs.forEach(input => {
            input.el.addEventListener('focus', () => { index = input.fullText.length; });
            input.el.addEventListener('blur', () => { if(input.el.value === "") index = 0; });
        });
    </script>
</body>
</html>
