@extends('layouts.admin')

@section('title', 'Kelola Kelas | Edulitnum')
@section('page_title') Kelola <span class="text-edu-orange">Kelas</span> @endsection
@section('page_subtitle', 'Atur kelas, fase, dan data siswa di sini.')

@section('content')

{{-- Notifikasi sukses --}}
@if(session('success'))
<div class="mb-6 flex items-center gap-3 px-5 py-4 bg-green-50 text-green-700 font-semibold rounded-2xl border border-green-200/60 shadow-sm">
    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    {{ session('success') }}
</div>
@endif

{{-- Header Bar: Ringkasan & Tombol Tambah --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

    {{-- Info ringkasan jumlah kelas --}}
    <div class="flex items-center gap-4">
        <div class="w-14 h-14 bg-edu-orange/10 rounded-2xl flex items-center justify-center border border-edu-orange/20">
            <svg class="w-7 h-7 text-edu-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
        </div>
        <div>
            <p class="text-2xl font-black text-edu-dark" style="font-family: 'Montserrat', sans-serif;">
                {{ $kelas->count() }} <span class="text-edu-orange">Kelas</span>
            </p>
            <p class="text-xs text-gray-400 font-semibold uppercase tracking-widest">Total Terdaftar</p>
        </div>
    </div>

    {{-- Tombol Buat Kelas --}}
    <a href="{{ route('kelas.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3 bg-edu-orange text-white font-bold rounded-2xl shadow-lg shadow-edu-orange/30 hover:-translate-y-1 hover:shadow-xl hover:shadow-edu-orange/40 transition-all duration-300 text-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
        </svg>
        Buat Kelas Baru
    </a>
</div>

{{-- Filter Fase (opsional UI enhancement) --}}
<div class="flex items-center gap-2 mb-8 flex-wrap">
    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mr-1">Filter Fase:</span>
    <button onclick="filterFase('semua')" id="btn-semua"
        class="fase-btn px-4 py-1.5 rounded-xl text-xs font-bold border border-edu-orange bg-edu-orange text-white transition-all">
        Semua
    </button>
    <button onclick="filterFase('A')" id="btn-A"
        class="fase-btn px-4 py-1.5 rounded-xl text-xs font-bold border border-edu-blue/40 text-edu-blue hover:bg-edu-blue hover:text-white transition-all">
        Fase A
    </button>
    <button onclick="filterFase('B')" id="btn-B"
        class="fase-btn px-4 py-1.5 rounded-xl text-xs font-bold border border-edu-blue/40 text-edu-blue hover:bg-edu-blue hover:text-white transition-all">
        Fase B
    </button>
    <button onclick="filterFase('C')" id="btn-C"
        class="fase-btn px-4 py-1.5 rounded-xl text-xs font-bold border border-edu-blue/40 text-edu-blue hover:bg-edu-blue hover:text-white transition-all">
        Fase C
    </button>
</div>

{{-- Grid Kartu Kelas --}}
<div id="kelas-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($kelas as $k)
    <div class="kelas-card group relative bg-white/60 backdrop-blur-md rounded-[28px] border border-white/80 shadow-lg shadow-black/5 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-black/10 transition-all duration-300"
         data-fase="{{ $k->fase }}">

        {{-- Badge Fase --}}
        <div class="absolute top-5 right-5">
            <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-xl
                @if($k->fase == 'A') bg-edu-orange/10 text-edu-orange border border-edu-orange/20
                @elseif($k->fase == 'B') bg-edu-blue/10 text-edu-blue border border-edu-blue/20
                @else bg-purple-100 text-purple-500 border border-purple-200
                @endif">
                Fase {{ $k->fase }}
            </span>
        </div>

        <div class="p-7">
            {{-- Ikon Kelas --}}
            <div class="w-12 h-12 bg-edu-orange/10 text-edu-orange rounded-2xl flex items-center justify-center mb-5 group-hover:bg-edu-orange group-hover:text-white transition-all duration-300 border border-edu-orange/15">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>

            {{-- Nama Kelas --}}
            <h3 class="text-xl font-black text-edu-dark mb-1 tracking-tight pr-20" style="font-family: 'Montserrat', sans-serif;">
                {{ $k->nama_kelas }}
            </h3>

            {{-- Guru Pengampu --}}
            <div class="flex items-center gap-2 mt-2 mb-5">
                <div class="w-6 h-6 rounded-full bg-edu-blue/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-edu-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="text-sm text-gray-500 font-medium">{{ $k->guru->name ?? 'Belum ada guru' }}</span>
            </div>

            {{-- Divider --}}
            <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent mb-5"></div>

            {{-- Footer: Jumlah Siswa + Aksi --}}
            <div class="flex items-center justify-between">

                {{-- Jumlah Siswa --}}
                <div class="flex items-center gap-2">
                    <div class="flex -space-x-1.5">
                        @for($i = 0; $i < min(3, $k->siswa->count()); $i++)
                        <div class="w-6 h-6 rounded-full bg-edu-blue/30 border-2 border-white flex items-center justify-center text-[8px] font-black text-edu-blue">
                            {{ chr(65 + $i) }}
                        </div>
                        @endfor
                    </div>
                    <div>
                        <p class="text-sm font-black text-edu-dark leading-none">{{ $k->siswa->count() }}</p>
                        <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider">Siswa</p>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex items-center gap-1">
                    {{-- Tombol Kelola Siswa --}}
                    <a href="{{ route('admin.kelas.siswa', $k->id) }}"
                       class="w-9 h-9 rounded-xl bg-green-50 text-green-600 hover:bg-green-600 hover:text-white flex items-center justify-center transition-all duration-200 border border-green-200/60"
                       title="Kelola Siswa">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </a>

                    {{-- Tombol Kelola Modul --}}
                    <a href="{{ route('admin.kelas.modul', $k->id) }}"
                       class="w-9 h-9 rounded-xl bg-purple-50 text-purple-600 hover:bg-purple-600 hover:text-white flex items-center justify-center transition-all duration-200 border border-purple-200/60"
                       title="Kelola Modul">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </a>

                    {{-- Tombol Detail --}}
                    @if(Route::has('kelas.show'))
                    <a href="{{ route('kelas.show', $k->id) }}"
                       class="w-9 h-9 rounded-xl bg-edu-blue/10 text-edu-blue hover:bg-edu-blue hover:text-white flex items-center justify-center transition-all duration-200 border border-edu-blue/20"
                       title="Detail">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </a>
                    @endif

                    {{-- Tombol Edit --}}
                    <a href="{{ route('kelas.edit', $k->id) }}"
                       class="w-9 h-9 rounded-xl bg-edu-orange/10 text-edu-orange hover:bg-edu-orange hover:text-white flex items-center justify-center transition-all duration-200 border border-edu-orange/20"
                       title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </a>

                    {{-- Tombol Hapus - trigger custom modal --}}
                    <button type="button"
                            onclick="bukaModalHapusKelas('{{ $k->id }}', '{{ addslashes($k->nama_kelas) }}')"
                            class="w-9 h-9 rounded-xl bg-red-50 text-red-400 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all duration-200 border border-red-200/60"
                            title="Hapus">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                    {{-- Form hapus tersembunyi --}}
                    <form id="form-hapus-kelas-{{ $k->id }}"
                          action="{{ route('kelas.destroy', $k->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>

    @empty
    {{-- State Kosong --}}
    <div class="col-span-3">
        <div class="flex flex-col items-center justify-center py-20 bg-white/40 backdrop-blur-md rounded-[28px] border border-white/70">
            <div class="w-20 h-20 bg-edu-orange/10 rounded-3xl flex items-center justify-center mb-5 border border-edu-orange/15">
                <svg class="w-10 h-10 text-edu-orange/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <p class="text-edu-dark font-black text-lg mb-1" style="font-family: 'Montserrat', sans-serif;">Belum Ada Kelas</p>
            <p class="text-gray-400 text-sm mb-6">Mulai dengan membuat kelas pertama kamu.</p>
            <a href="{{ route('kelas.create') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-edu-orange text-white font-bold rounded-2xl shadow-lg shadow-edu-orange/30 hover:-translate-y-1 transition-all duration-300 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Kelas Pertama
            </a>
        </div>
    </div>
    @endforelse
</div>

{{-- Script Filter Fase --}}
<script>
    function filterFase(fase) {
        const cards = document.querySelectorAll('.kelas-card');
        const btns = document.querySelectorAll('.fase-btn');

        // Reset semua tombol
        btns.forEach(btn => {
            btn.classList.remove('bg-edu-orange', 'text-white', 'border-edu-orange', 'bg-edu-blue', 'text-white', 'border-edu-blue');
            btn.classList.add('border-edu-blue/40', 'text-edu-blue');
        });

        // Aktifkan tombol yang dipilih
        const activeBtn = document.getElementById('btn-' + fase);
        activeBtn.classList.remove('border-edu-blue/40', 'text-edu-blue');
        activeBtn.classList.add('bg-edu-orange', 'text-white', 'border-edu-orange');

        // Filter kartu
        cards.forEach(card => {
            if (fase === 'semua' || card.dataset.fase === fase) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>

{{-- ===== CUSTOM DELETE MODAL - KELAS ===== --}}
<div id="modal-hapus-kelas"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden"
     onclick="if(event.target===this) tutupModalHapusKelas()">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
    <div class="relative w-full max-w-md bg-white rounded-[32px] shadow-2xl p-8 modal-kelas-panel">
        <div class="flex justify-center mb-5">
            <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center border border-red-100">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
        </div>
        <h3 class="text-center text-xl font-black text-gray-800 mb-2" style="font-family:'Montserrat',sans-serif;">Hapus Kelas?</h3>
        <p class="text-center text-sm text-gray-400 font-medium mb-1">Kamu akan menghapus kelas:</p>
        <p class="text-center text-base font-black text-orange-500 mb-5" id="modal-nama-kelas">—</p>
        <p class="text-center text-xs text-gray-400 mb-8">
            Semua data siswa dalam kelas ini juga akan terpengaruh.<br>
            Tindakan ini <span class="font-bold text-red-400">tidak bisa dibatalkan</span>.
        </p>
        <div class="flex gap-3">
            <button onclick="tutupModalHapusKelas()"
                class="flex-1 py-3 rounded-2xl bg-gray-100 text-gray-600 font-bold hover:bg-gray-200 transition-all text-sm">
                Batal
            </button>
            <button onclick="konfirmasiHapusKelas()"
                class="flex-1 py-3 rounded-2xl bg-red-500 text-white font-bold hover:bg-red-600 active:scale-95 transition-all text-sm shadow-lg shadow-red-500/30">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes modalKelasIn {
        from { opacity: 0; transform: scale(0.9) translateY(20px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .modal-kelas-panel { animation: modalKelasIn 0.25s cubic-bezier(.16,1,.3,1) both; }
</style>

<script>
    let targetKelasFormId = null;
    function bukaModalHapusKelas(kelasId, namaKelas) {
        targetKelasFormId = 'form-hapus-kelas-' + kelasId;
        document.getElementById('modal-nama-kelas').textContent = namaKelas;
        const modal = document.getElementById('modal-hapus-kelas');
        modal.classList.remove('hidden');
        const panel = modal.querySelector('.modal-kelas-panel');
        panel.style.animation = 'none'; panel.offsetHeight; panel.style.animation = '';
    }
    function tutupModalHapusKelas() {
        document.getElementById('modal-hapus-kelas').classList.add('hidden');
        targetKelasFormId = null;
    }
    function konfirmasiHapusKelas() {
        if (targetKelasFormId) document.getElementById(targetKelasFormId).submit();
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') tutupModalHapusKelas(); });
</script>

@endsection