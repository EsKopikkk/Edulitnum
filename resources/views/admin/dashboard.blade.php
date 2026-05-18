@extends('layouts.admin')

@section('title', 'Dashboard | Edulitnum')
@section('page_title', 'Halo, ' . Auth::user()->name . '!')
@section('page_subtitle', 'Selamat datang di pusat kendali Edulitnum.')

@section('content')
    <style>
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
@endsection