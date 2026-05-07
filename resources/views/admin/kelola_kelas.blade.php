@extends('layouts.admin')

@section('title', 'Kelola Kelas | Edulitnum')
@section('page_title') Kelola <span class="text-edu-orange">Kelas</span> @endsection
@section('page_subtitle', 'Materi dan ruang belajar literasi & numerasi.')

@section('content')
<div class="flex justify-end mb-8">
    <button class="px-6 py-3 bg-edu-blue text-white font-bold rounded-2xl shadow-lg shadow-edu-blue/30 hover:-translate-y-1 transition-all flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Buat Kelas Baru
    </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    {{-- Asumsi data dilempar dari KelasController dengan nama variabel $kelas --}}
    @foreach($kelas as $k)
    <div class="bg-white/60 backdrop-blur-md p-8 rounded-[32px] border border-white shadow-xl shadow-black/5 hover:translate-y-[-5px] transition-transform duration-300 group">
        <div class="w-14 h-14 bg-edu-orange/10 text-edu-orange rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
        </div>
        <h3 class="text-2xl font-black text-edu-dark mb-2">{{ $k->nama_kelas }}</h3>
        <p class="text-gray-500 font-medium text-sm mb-6">{{ $k->deskripsi ?? 'Belum ada deskripsi materi.' }}</p>
        
        <div class="flex justify-between items-center pt-6 border-t border-gray-200/50">
            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                32 Siswa
            </div>
            <button class="text-edu-blue font-bold text-sm hover:text-edu-orange transition-colors">
                Kelola Modul →
            </button>
        </div>
    </div>
    @endforeach
</div>
@endsection