<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Edulitnum</title>

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

        @keyframes logo-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-25px); }
        }
        .animate-logo-bounce { animation: logo-bounce 2s infinite ease-in-out; }

        @keyframes shadow-pulse {
            0%, 100% { transform: scale(1.2); opacity: 0.4; filter: blur(4px); }
            50% { transform: scale(0.6); opacity: 0.15; filter: blur(8px); }
        }
        .animate-shadow-pulse { animation: shadow-pulse 2s infinite ease-in-out; }

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
        <a href="{{ route('login') }}" class="flex items-center gap-2 text-edu-dark font-semibold hover:text-edu-orange transition-colors group">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Login
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

                <h2 class="text-3xl font-black text-edu-dark tracking-tighter mt-6">Reset <span class="text-edu-orange">Password</span></h2>
                <p class="text-gray-500 text-sm mt-2 font-medium">Masukkan password baru untuk akun Anda</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 px-4 py-3 bg-red-100 text-red-700 rounded-2xl text-sm font-semibold">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.store') }}" method="POST" class="space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-edu-blue mb-2 ml-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', request('email')) }}" class="input-field w-full px-6 py-4 rounded-2xl text-edu-dark font-semibold" required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-edu-blue mb-2 ml-1">Password Baru</label>
                    <input type="password" name="password" class="input-field w-full px-6 py-4 rounded-2xl text-edu-dark font-semibold" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-edu-blue mb-2 ml-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="input-field w-full px-6 py-4 rounded-2xl text-edu-dark font-semibold" required>
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full py-5 bg-edu-orange text-white font-black text-lg rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.4)] hover:bg-edu-dark transition-all duration-500 transform hover:scale-105 active:scale-95 flex items-center justify-center gap-3 mt-4">
                    RESET PASSWORD
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </button>

            </form>
        </div>

        <p class="text-center mt-8 text-gray-500 text-[10px] font-bold tracking-[0.3em] uppercase opacity-70">
            © 2026 EDULITNUM ECOSYSTEM • BY EDULTIM24
        </p>
    </div>

</body>
</html>
