@extends('layouts.admin')

@section('title', 'Kelola Kelas | Edulitnum')
@section('page_title') Kelola <span class="text-edu-orange">Kelas</span> @endsection
@section('page_subtitle', 'Materi dan ruang belajar literasi & numerasi.')

@section('content')
<div class="space-y-10"> {{-- Memberikan jarak antar elemen vertikal --}}
    
    {{-- Button Area --}}
    <div class="flex items-center">
        <a href="{{ route('kelas.create') }}" 
           class="inline-flex px-8 py-4 bg-edu-blue text-white font-black rounded-2xl shadow-xl shadow-edu-blue/20 hover:-translate-y-1 hover:bg-edu-dark transition-all duration-300 items-center gap-3 text-sm tracking-wide">
            <div class="w-6 h-6 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            </div>
            BUAT KELAS BARU
        </a>
    </div>

    {{-- Grid Area --}}
    {{-- grid-cols-1 (HP), grid-cols-2 (Tablet), grid-cols-3 (Laptop) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($kelas as $k)
        
        <div class="bg-white/60 backdrop-blur-md p-8 rounded-[40px] border border-white shadow-[0_20px_50px_rgba(0,0,0,0.1)] hover:translate-y-[-8px] transition-all duration-500 group relative overflow-hidden">
            
            {{-- Aksesoris Pemanis di pojok card --}}
            <div class="absolute -top-4 -right-4 w-24 h-24 bg-edu-orange/5 rounded-full blur-2xl group-hover:bg-edu-orange/10 transition-colors"></div>

            {{-- Icon Section --}}
            <div class="w-16 h-16 bg-edu-orange/10 text-edu-orange rounded-[20px] flex items-center justify-center mb-6 group-hover:bg-edu-orange group-hover:text-white transition-all duration-500 shadow-inner">
                <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>

{{-- Bagian Jumlah Siswa --}}
<div class="flex flex-col">
    <span class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-1">Kapasitas</span>
    <span class="text-base font-bold text-edu-blue">{{ $k->siswa_count }} Siswa</span>
</div>

            {{-- Text Section --}}
            <div class="relative z-10">
                <h3 class="text-xl font-black text-edu-dark mb-2 tracking-tighter uppercase group-hover:text-edu-orange transition-colors">
                    {{ $k->nama_kelas }}
                </h3>
                <p class="text-gray-400 font-medium text-sm leading-relaxed mb-8">
                    {{ $k->deskripsi ?? 'Ayo mulai susun materi literasi dan numerasi yang seru untuk kelas ini!' }}
                </p>
                
                {{-- Footer Card --}}
                <div class="flex justify-between items-center pt-6 border-t border-gray-100">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">Kapasitas</span>
                        <span class="text-sm font-bold text-edu-blue">32 Siswa</span>
                    </div>
                    
<a href="{{ route('admin.kelas.modul', $k->id) }}" class="inline-flex items-center gap-2 py-3 px-6 bg-gray-50 rounded-2xl text-edu-dark font-black text-xs hover:bg-edu-orange hover:text-white transition-all group/btn shadow-sm">
    Kelola Modul
    <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
</a>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
</div>
@endsection