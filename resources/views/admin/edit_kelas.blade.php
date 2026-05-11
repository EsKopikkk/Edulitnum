@extends('layouts.admin')

@section('title', 'Edit Kelas | Edulitnum')
@section('page_title') Edit <span class="text-edu-orange">Kelas</span> @endsection
@section('page_subtitle', 'Perbarui informasi kelas yang sudah ada.')

@section('content')

<div class="max-w-2xl">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 mb-8 text-sm">
        <a href="{{ route('kelas.index') }}" class="text-gray-400 hover:text-edu-orange font-semibold transition-colors">
            Kelola Kelas
        </a>
        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-edu-dark font-bold">Edit Kelas</span>
    </div>

    {{-- Card Form --}}
    <div class="bg-white/60 backdrop-blur-md rounded-[28px] border border-white/80 shadow-lg shadow-black/5 p-8">

        {{-- Header Card --}}
        <div class="flex items-center gap-4 mb-8">
            <div class="w-12 h-12 bg-edu-orange/10 rounded-2xl flex items-center justify-center border border-edu-orange/20">
                <svg class="w-6 h-6 text-edu-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-black text-edu-dark tracking-tight" style="font-family: 'Montserrat', sans-serif;">
                    {{ $kelas->nama_kelas }}
                </h2>
                <p class="text-xs text-gray-400 font-semibold">ID Kelas #{{ $kelas->id }} &middot; Fase {{ $kelas->fase }}</p>
            </div>
        </div>

        {{-- Divider --}}
        <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent mb-8"></div>

        {{-- Form --}}
        <form method="POST" action="{{ route('kelas.update', $kelas->id) }}">
            @csrf
            @method('PUT')

            {{-- Nama Kelas --}}
            <div class="mb-6">
                <label class="block text-xs font-black text-edu-dark uppercase tracking-widest mb-2">
                    Nama Kelas
                </label>
                <input
                    type="text"
                    name="nama_kelas"
                    value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                    placeholder="Contoh: Kelas 1A"
                    required
                    class="w-full px-4 py-3.5 rounded-2xl border-2 border-gray-200/70 bg-white/80 text-edu-dark font-semibold text-sm placeholder-gray-300
                           focus:outline-none focus:border-edu-orange focus:bg-white focus:shadow-[0_0_0_4px_rgba(232,127,36,0.10)]
                           transition-all duration-200"
                >
                @error('nama_kelas')
                    <p class="mt-1.5 text-xs text-red-500 font-semibold flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Fase --}}
            <div class="mb-6">
                <label class="block text-xs font-black text-edu-dark uppercase tracking-widest mb-2">
                    Fase
                </label>
                <div class="relative">
                    <select
                        name="fase"
                        required
                        class="w-full px-4 py-3.5 rounded-2xl border-2 border-gray-200/70 bg-white/80 text-edu-dark font-semibold text-sm appearance-none
                               focus:outline-none focus:border-edu-orange focus:bg-white focus:shadow-[0_0_0_4px_rgba(232,127,36,0.10)]
                               transition-all duration-200 cursor-pointer"
                    >
                        @foreach(['A', 'B', 'C'] as $fase)
                            <option value="{{ $fase }}" {{ old('fase', $kelas->fase) == $fase ? 'selected' : '' }}>
                                Fase {{ $fase }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
                @error('fase')
                    <p class="mt-1.5 text-xs text-red-500 font-semibold flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Guru --}}
            <div class="mb-8">
                <label class="block text-xs font-black text-edu-dark uppercase tracking-widest mb-2">
                    Guru Pengampu
                </label>
                <div class="relative">
                    <select
                        name="guru_id"
                        required
                        class="w-full px-4 py-3.5 rounded-2xl border-2 border-gray-200/70 bg-white/80 text-edu-dark font-semibold text-sm appearance-none
                               focus:outline-none focus:border-edu-orange focus:bg-white focus:shadow-[0_0_0_4px_rgba(232,127,36,0.10)]
                               transition-all duration-200 cursor-pointer"
                    >
                        <option value="" disabled>-- Pilih Guru --</option>
                        @foreach($guru as $g)
                            <option value="{{ $g->id }}" {{ old('guru_id', $kelas->guru_id) == $g->id ? 'selected' : '' }}>
                                {{ $g->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
                @error('guru_id')
                    <p class="mt-1.5 text-xs text-red-500 font-semibold flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Divider --}}
            <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent mb-7"></div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-7 py-3.5 bg-edu-orange text-white font-bold rounded-2xl shadow-lg shadow-edu-orange/30
                           hover:-translate-y-0.5 hover:shadow-xl hover:shadow-edu-orange/40 active:translate-y-0 transition-all duration-200 text-sm"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>

                <a
                    href="{{ route('kelas.index') }}"
                    class="inline-flex items-center gap-2 px-7 py-3.5 bg-white text-gray-500 font-bold rounded-2xl border-2 border-gray-200/70
                           hover:border-gray-300 hover:text-edu-dark hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 text-sm"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>

@endsection