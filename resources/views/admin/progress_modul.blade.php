@extends('layouts.admin')

@section('title', 'Progress Modul | Edulitnum')
@section('page_title') Progress <span class="text-edu-orange">{{ $modul->judul }}</span> @endsection
@section('page_subtitle', 'Tracking progress siswa untuk modul ini')

@section('content')
<div class="w-full space-y-8">
    <a href="{{ route('admin.kelas.modul', $kelas->id) }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-edu-orange font-black text-xs uppercase tracking-widest transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Modul
    </a>

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white/60 backdrop-blur-md p-8 rounded-[40px] border border-white shadow-xl shadow-black/5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 font-semibold text-sm uppercase">Total Siswa</p>
                    <h3 class="text-4xl font-black text-edu-dark mt-2">{{ $siswaDiKelas->count() }}</h3>
                </div>
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center">
                    <span class="text-2xl">👥</span>
                </div>
            </div>
        </div>

        <div class="bg-white/60 backdrop-blur-md p-8 rounded-[40px] border border-white shadow-xl shadow-black/5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 font-semibold text-sm uppercase">Sudah Dibuka</p>
                    <h3 class="text-4xl font-black text-edu-dark mt-2">{{ $progress->filter(fn($p) => $p->viewed_at)->count() }}</h3>
                </div>
                <div class="w-16 h-16 bg-yellow-50 rounded-2xl flex items-center justify-center">
                    <span class="text-2xl">👁</span>
                </div>
            </div>
        </div>

        <div class="bg-white/60 backdrop-blur-md p-8 rounded-[40px] border border-white shadow-xl shadow-black/5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 font-semibold text-sm uppercase">Selesai</p>
                    <h3 class="text-4xl font-black text-edu-dark mt-2">{{ $progress->filter(fn($p) => $p->status === 'completed')->count() }}</h3>
                </div>
                <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center">
                    <span class="text-2xl">✅</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Progress --}}
    <div class="bg-white/60 backdrop-blur-md p-10 rounded-[40px] border border-white shadow-xl shadow-black/5">
        <h3 class="text-xl font-black text-edu-dark mb-6">Progress Siswa</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="text-gray-400 text-xs uppercase tracking-widest border-b border-gray-100">
                        <th class="pb-4 font-black">Nama Siswa</th>
                        <th class="pb-4 font-black">NIS</th>
                        <th class="pb-4 font-black text-center">Status</th>
                        <th class="pb-4 font-black text-center">Dibuka</th>
                        <th class="pb-4 font-black text-center">Selesai</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-semibold">
                    @foreach($siswaDiKelas as $siswa)
                        @php
                            $p = $progress->get($siswa->user_id);
                            $statusColor = $p?->status === 'completed' ? 'bg-green-50 text-green-600' : ($p?->viewed_at ? 'bg-yellow-50 text-yellow-600' : 'bg-gray-50 text-gray-400');
                            $statusLabel = $p?->status === 'completed' ? '✅ Selesai' : ($p?->viewed_at ? '👁 Dibuka' : '⏳ Belum');
                        @endphp
                        <tr class="border-b border-gray-50/50 hover:bg-white/40 transition-colors">
                            <td class="py-4 text-edu-dark">{{ $siswa->user->name }}</td>
                            <td class="py-4 text-gray-600">{{ $siswa->user->nis ?? '-' }}</td>
                            <td class="py-4 text-center">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $statusColor }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="py-4 text-center text-gray-500">
                                @if($p?->viewed_at)
                                    {{ $p->viewed_at->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="py-4 text-center text-gray-500">
                                @if($p?->completed_at)
                                    {{ $p->completed_at->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
