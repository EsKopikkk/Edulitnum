<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Edulitnum</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'edu-orange': '#E87F24',
                        'edu-blue': '#73A5CA',
                        'edu-bg': '#FEFDDF',
                        'edu-dark': '#1A202C',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FEFDDF;
        }

        h1,
        h2,
        h3 {
            font-family: 'Montserrat', sans-serif;
        }

        .sidebar-glass {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(15px);
            border-right: 1px solid rgba(255, 255, 255, 0.5);
        }

        .stat-card {
            background: white;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="min-h-screen flex">

    <aside class="w-72 sidebar-glass fixed h-screen z-50 p-6 flex flex-col">
        <div class="flex items-center gap-3 mb-12 px-2">
            <div
                class="w-10 h-10 bg-edu-orange rounded-xl flex items-center justify-center shadow-lg shadow-edu-orange/20">
                <span class="text-white font-black text-xl">E</span>
            </div>
            <span class="text-edu-dark font-black text-xl tracking-tighter">ADMIN<span
                    class="text-edu-orange">PANEL</span></span>
        </div>

        <nav class="flex-1 space-y-2">
            <a href="#"
                class="flex items-center gap-4 px-4 py-4 bg-edu-orange text-white rounded-2xl font-bold shadow-lg shadow-edu-orange/30 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.akun.index') }}"
                class="flex items-center gap-4 px-4 py-4 text-gray-500 hover:text-edu-blue hover:bg-white/50 rounded-2xl font-semibold transition-all group">
                <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Manajemen User
            </a>
            <a href="{{ route('kelas.index') }}"
                class="flex items-center gap-4 px-4 py-4 text-gray-500 hover:text-edu-blue hover:bg-white/50 rounded-2xl font-semibold transition-all group">
                <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Kelas & Materi
            </a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button
                class="w-full flex items-center gap-4 px-4 py-4 text-red-500 hover:bg-red-50 rounded-2xl font-bold transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Keluar
            </button>
        </form>
    </aside>

    <main class="flex-1 ml-72 p-10">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-black text-edu-dark tracking-tighter">Halo, <span
                        class="text-edu-orange">Admin!</span></h1>
                <p class="text-gray-500 font-medium">Selamat datang di pusat kendali Edulitnum.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-edu-dark font-bold text-sm leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-edu-blue font-bold text-[10px] uppercase tracking-widest mt-1">Super Admin</p>
                </div>
                <div
                    class="w-12 h-12 bg-white rounded-2xl shadow-sm border border-white flex items-center justify-center overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=73A5CA&color=fff" alt="Profile">
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            <div class="stat-card p-8 rounded-[32px] border border-white relative overflow-hidden group">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-edu-orange/5 rounded-full group-hover:scale-150 transition-transform duration-500">
                </div>
                <p class="text-gray-400 font-bold text-xs uppercase tracking-[0.2em] mb-2">Total Siswa</p>
                <h3 class="text-4xl font-black text-edu-dark">{{ number_format($totalSiswa, 0, ',', '.') }}</h3>
                <div class="mt-4 flex items-center gap-2 text-green-500 text-xs font-bold">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" />
                    </svg>
                    +12% Bulan ini
                </div>
            </div>

            <div class="stat-card p-8 rounded-[32px] border border-white relative overflow-hidden group">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-edu-blue/5 rounded-full group-hover:scale-150 transition-transform duration-500">
                </div>
                <p class="text-gray-400 font-bold text-xs uppercase tracking-[0.2em] mb-2">Total Guru</p>
                <h3 class="text-4xl font-black text-edu-dark">{{ number_format($totalGuru, 0, ',', '.') }}</h3>
                <p class="mt-4 text-gray-400 text-xs font-medium italic">Semua Aktif</p>
            </div>

            <div class="stat-card p-8 rounded-[32px] border border-white relative overflow-hidden group">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-edu-orange/5 rounded-full group-hover:scale-150 transition-transform duration-500">
                </div>
                <p class="text-gray-400 font-bold text-xs uppercase tracking-[0.2em] mb-2">Aktivitas Hari Ini</p>
                <h3 class="text-4xl font-black text-edu-dark">85%</h3>
                <div class="mt-4 w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-edu-orange h-full w-[85%] rounded-full"></div>
                </div>
            </div>
        </div>

        <div class="bg-white/60 backdrop-blur-md p-10 rounded-[40px] border border-white shadow-xl shadow-black/5">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-black text-edu-dark tracking-tight">Pengguna Terbaru</h3>
            </div>
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 text-xs uppercase tracking-widest border-b border-gray-100">
                        <th class="pb-4 font-black">Nama</th>
                        <th class="pb-4 font-black">Role</th>
                        <th class="pb-4 font-black">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-semibold">
                    @forelse($penggunaTerbaru as $user)
                        <tr class="border-b border-gray-50/50">
                            <td class="py-5 text-edu-dark">{{ $user->name }}</td>

                            <td class="py-5">
                                <span class="px-3 py-1 bg-edu-blue/10 text-edu-blue rounded-full text-[10px] uppercase">
                                    {{ $user->role }}
                                </span>
                            </td>

                            <td class="py-5">
                                <span class="w-2 h-2 rounded-full bg-green-500 inline-block mr-2"></span>Terdaftar
                            </td>

                           
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-5 text-center text-gray-400 italic">Belum ada data siswa yang
                                terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>

</html>