@extends('layouts.admin')

@section('title', 'Detail Kelas | Edulitnum')

@section('page_title')
    Detail Kelas <span class="text-edu-orange">{{ $kelas->nama_kelas }}</span>
@endsection

@section('content')
<div class="w-full space-y-8 font-poppins">
    {{-- Navigasi Kembali --}}
    <a href="{{ route('kelas.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-edu-orange font-black text-xs uppercase tracking-widest transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Manajemen Kelas
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Kolom Kiri: Info Guru & Statistik --}}
        <div class="space-y-6">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-white">
                <h4 class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-4">Guru Pengampu</h4>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-edu-orange/10 rounded-2xl flex items-center justify-center text-edu-orange font-bold text-xl">
                        {{ substr($kelas->guru->name ?? '?', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-edu-dark">{{ $kelas->guru->name ?? 'Belum Ditentukan' }} </p>
                        <p class="text-xs text-gray-400">Wali Kelas / Fasilitator</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Daftar Siswa --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-white overflow-hidden">
                <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                    <h4 class="font-black text-edu-dark uppercase tracking-tighter text-lg">Daftar Siswa</h4>
                    <span class="px-4 py-1 bg-edu-blue text-white text-[10px] font-black rounded-full uppercase">
                        {{ $kelas->siswa->count() }} Orang 
                    </span>
                </div>
                
                <table class="w-full">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="px-8 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Lengkap</th>
                            <th class="px-8 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($kelas->siswa as $s)
                            <tr class="hover:bg-gray-50/30 transition-colors">
                                <td class="px-8 py-5 font-bold text-edu-dark">{{ $s->user->name ?? 'Siswa Tanpa Nama' }}</td>
                                <td class="px-8 py-5 text-right">
                                    <button class="text-xs font-black text-gray-300 hover:text-red-500 uppercase tracking-widest transition-colors">Keluarkan</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-8 py-20 text-center text-gray-400 font-medium italic">
                                    Belum ada siswa yang bergabung di kelas ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection