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

                <div class="text-center mt-6">
                    <button type="button" onclick="openForgotPasswordModal()" class="text-edu-orange font-semibold text-sm hover:text-edu-dark transition-colors">
                        Lupa Password?
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center mt-8 text-gray-500 text-[10px] font-bold tracking-[0.3em] uppercase opacity-70">
            © 2026 EDULITNUM ECOSYSTEM • BY EDULTIM24
        </p>
    </div>

    <!-- Modal Lupa Password -->
    <div id="forgot-password-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" onclick="closeForgotPasswordModal()"></div>

        <div class="relative bg-white rounded-[40px] shadow-2xl p-8 w-full max-w-md mx-4 flex flex-col gap-5">
            <div class="text-center mb-4">
                <h3 class="font-black text-edu-dark text-lg">Lupa Password?</h3>
                <p class="text-gray-500 text-sm mt-2">Masukkan nama Anda untuk request reset password</p>
            </div>

            <div id="success-message" class="hidden p-4 bg-green-100 text-green-700 rounded-2xl text-sm font-bold">
                ✅ Request berhasil! Admin akan segera mereset password Anda.
            </div>

            <form id="forgot-password-form" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-edu-blue mb-2 ml-1">Nama Lengkap</label>
                    <input type="text" name="name" id="forgot-name" placeholder="Masukkan nama lengkap Anda"
                        class="input-field w-full px-6 py-3 rounded-2xl text-edu-dark font-semibold border-2 border-transparent focus:border-edu-blue" required>
                    <span id="error-message" class="text-red-500 text-xs mt-2 font-semibold hidden"></span>
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeForgotPasswordModal()" class="flex-1 px-4 py-3 bg-gray-100 text-gray-500 font-bold rounded-2xl hover:bg-gray-200 transition-all text-sm">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-3 bg-edu-orange text-white font-bold rounded-2xl hover:bg-edu-dark shadow-lg shadow-edu-orange/30 transition-all text-sm">
                        Request Reset
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openForgotPasswordModal() {
            document.getElementById('forgot-password-modal').classList.remove('hidden');
            document.getElementById('forgot-name').focus();
        }

        function closeForgotPasswordModal() {
            document.getElementById('forgot-password-modal').classList.add('hidden');
            document.getElementById('forgot-name').value = '';
            document.getElementById('error-message').classList.add('hidden');
            document.getElementById('success-message').classList.add('hidden');
        }

        document.getElementById('forgot-password-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const name = document.getElementById('forgot-name').value;
            const errorMsg = document.getElementById('error-message');
            const successMsg = document.getElementById('success-message');

            try {
                const response = await fetch('{{ route("password.request.submit") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({ name: name })
                });

                const data = await response.json();

                if (data.success) {
                    errorMsg.classList.add('hidden');
                    successMsg.classList.remove('hidden');
                    document.getElementById('forgot-password-form').style.display = 'none';

                    setTimeout(() => {
                        closeForgotPasswordModal();
                        document.getElementById('forgot-password-form').style.display = 'block';
                    }, 3000);
                } else {
                    successMsg.classList.add('hidden');
                    errorMsg.textContent = data.message || 'Nama guru tidak ditemukan';
                    errorMsg.classList.remove('hidden');
                }
            } catch (error) {
                errorMsg.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                errorMsg.classList.remove('hidden');
            }
        });

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
