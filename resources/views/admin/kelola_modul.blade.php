@extends('layouts.admin')

@section('title', 'Daftar Modul | Edulitnum')
@section('page_title') Modul <span class="text-edu-orange">{{ $kelas->nama_kelas }}</span> @endsection
@section('page_subtitle', 'Materi Literasi & Numerasi Fase ' . $kelas->fase)

@section('content')
<div class="w-full space-y-8 font-poppins">
    <a href="{{ route('kelas.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-edu-orange font-black text-xs uppercase tracking-widest transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Kelas
    </a>

    <div class="grid grid-cols-1 gap-6">
        @forelse($moduls as $m)
            <div class="bg-white p-8 rounded-[2.5rem] shadow-[0_15px_40px_rgba(0,0,0,0.05)] border border-white flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="flex-1">
                    <span class="inline-block px-4 py-1.5 {{ $m->kategori == 'literasi' ? 'bg-blue-50 text-blue-500' : 'bg-orange-50 text-orange-500' }} text-[10px] font-black rounded-full uppercase tracking-widest mb-3">
                        {{ $m->kategori }} [cite: 89]
                    </span>
                    <h4 class="text-xl font-bold text-edu-dark leading-tight">{{ $m->pertanyaan }}</h4> [cite: 88]
                </div>
                
                <div class="flex items-center gap-3">
                    <button class="px-6 py-3 bg-gray-50 text-gray-400 font-bold rounded-xl hover:text-edu-orange hover:bg-orange-50 transition-all text-xs uppercase">Edit</button>
                    <button class="px-6 py-3 bg-gray-50 text-gray-400 font-bold rounded-xl hover:text-red-500 hover:bg-red-50 transition-all text-xs uppercase">Hapus</button>
                </div>
            </div>
        @empty
            <div class="py-24 px-10 bg-white/40 border-4 border-dashed border-white rounded-[4rem] text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-gray-300 uppercase tracking-tighter">Belum ada materi</h3>
                <p class="text-gray-400 font-medium mt-2">Materi untuk Fase {{ $kelas->fase }} belum tersedia di Bank Soal.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection