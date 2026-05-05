<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: white;">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #FEFDDF; min-height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Selamat Datang --}}
            <div class="rounded-lg p-6 mb-6 text-white" style="background-color: #E87F24;">
                <h1 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                <p class="mt-1 text-yellow-100">
                    @if(Auth::user()->role === 'admin') Anda login sebagai Admin
                    @elseif(Auth::user()->role === 'guru') Anda login sebagai Guru
                    @else Anda login sebagai Siswa
                    @endif
                </p>
            </div>

            {{-- Menu Admin --}}
            @if(Auth::user()->role === 'admin')
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('admin.akun.index') }}" 
                   class="rounded-lg p-6 text-white text-center font-semibold text-lg shadow hover:opacity-90"
                   style="background-color: #E87F24;">
                    👤 Kelola Akun
                </a>
                <a href="{{ route('kelas.index') }}" 
                   class="rounded-lg p-6 text-white text-center font-semibold text-lg shadow hover:opacity-90"
                   style="background-color: #FFC81E; color: #333;">
                    🏫 Kelola Kelas
                </a>
            </div>
            @endif

            {{-- Menu Guru --}}
            @if(Auth::user()->role === 'guru')
            <div class="grid grid-cols-2 gap-4">
                <a href="#" 
                   class="rounded-lg p-6 text-white text-center font-semibold text-lg shadow hover:opacity-90"
                   style="background-color: #E87F24;">
                    📝 Bank Soal
                </a>
                <a href="#" 
                   class="rounded-lg p-6 text-center font-semibold text-lg shadow hover:opacity-90"
                   style="background-color: #FFC81E; color: #333;">
                    📊 Progress Siswa
                </a>
            </div>
            @endif

            {{-- Menu Siswa --}}
            @if(Auth::user()->role === 'siswa')
            <div class="grid grid-cols-2 gap-4">
                <a href="#" 
                   class="rounded-lg p-6 text-white text-center font-semibold text-lg shadow hover:opacity-90"
                   style="background-color: #E87F24;">
                    🎮 Game Edukasi
                </a>
                <a href="#" 
                   class="rounded-lg p-6 text-center font-semibold text-lg shadow hover:opacity-90"
                   style="background-color: #73A5CA; color: white;">
                    📈 Progress Saya
                </a>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>