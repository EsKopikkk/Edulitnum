<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel | Edulitnum')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

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
        body { font-family: 'Poppins', sans-serif; background-color: #FEFDDF; }
        h1, h2, h3 { font-family: 'Montserrat', sans-serif; }
        .sidebar-glass { background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(15px); border-right: 1px solid rgba(255, 255, 255, 0.5); }
    </style>
</head>

<body class="min-h-screen flex">

    <aside class="w-72 sidebar-glass fixed h-screen z-50 p-6 flex flex-col">
        <div class="flex items-center gap-3 mb-12 px-2">
            <div class="w-10 h-10 bg-edu-orange rounded-xl flex items-center justify-center shadow-lg shadow-edu-orange/20">
                <span class="text-white font-black text-xl">E</span>
            </div>
            <span class="text-edu-dark font-black text-xl tracking-tighter">ADMIN<span class="text-edu-orange">PANEL</span></span>
        </div>

        <nav class="flex-1 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-4 {{ Request::routeIs('admin.dashboard') ? 'bg-edu-orange text-white rounded-2xl font-bold shadow-lg shadow-edu-orange/30' : 'text-gray-500 hover:text-edu-blue hover:bg-white/50 rounded-2xl font-semibold' }} transition-all group">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.akun.index') }}" class="flex items-center gap-4 px-4 py-4 {{ Request::routeIs('admin.akun.*') ? 'bg-edu-orange text-white rounded-2xl font-bold shadow-lg shadow-edu-orange/30' : 'text-gray-500 hover:text-edu-blue hover:bg-white/50 rounded-2xl font-semibold group-hover:rotate-12' }} transition-all group">
                <svg class="w-6 h-6 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                Manajemen User
            </a>
            <a href="{{ route('kelas.index') }}" class="flex items-center gap-4 px-4 py-4 {{ Request::routeIs('kelas.*') ? 'bg-edu-orange text-white rounded-2xl font-bold shadow-lg shadow-edu-orange/30' : 'text-gray-500 hover:text-edu-blue hover:bg-white/50 rounded-2xl font-semibold group-hover:rotate-12' }} transition-all group">
                <svg class="w-6 h-6 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                Kelas & Materi
            </a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button class="w-full flex items-center gap-4 px-4 py-4 text-red-500 hover:bg-red-50 rounded-2xl font-bold transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                Keluar
            </button>
        </form>
    </aside>

    <main class="flex-1 ml-72 p-10">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-black text-edu-dark tracking-tighter">@yield('page_title')</h1>
                <p class="text-gray-500 font-medium">@yield('page_subtitle')</p>
            </div>
            <div class="flex items-center gap-6">
                {{-- Notification Bell --}}
                @php
                    $notificationCount = $notificationCount ?? 0;
                    $resetRequests = $resetRequests ?? collect();
                @endphp
                <div class="relative">
                    <a href="{{ route('admin.notifikasi') }}" class="relative p-2 hover:bg-white/50 rounded-xl transition-all inline-flex">
                        <svg class="w-6 h-6 text-edu-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        {{-- Red Dot Indicator --}}
                        @if($notificationCount > 0)
                            <span class="absolute top-1 right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
                        @endif
                    </a>
                </div>

                <div class="text-right">
                    <p class="text-edu-dark font-bold text-sm leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-edu-blue font-bold text-[10px] uppercase tracking-widest mt-1">{{ Auth::user()->role }}</p>
                </div>
                <div class="w-12 h-12 bg-white rounded-2xl shadow-sm border border-white flex items-center justify-center overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=73A5CA&color=fff" alt="Profile">
                </div>
            </div>
        </header>


        @yield('content')

    </main>

</body>
</html>