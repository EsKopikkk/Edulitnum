@extends('layouts.admin')

@section('title', 'Manajemen User | Edulitnum')
@section('page_title') Manajemen <span class="text-edu-orange">User</span> @endsection
@section('page_subtitle', 'Kelola data seluruh Admin, Guru, dan Siswa.')

@section('content')
<div class="flex justify-end mb-8">
    <button class="px-6 py-3 bg-edu-orange text-white font-bold rounded-2xl shadow-lg shadow-edu-orange/30 hover:-translate-y-1 transition-all flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah User
    </button>
</div>

<div class="bg-white/60 backdrop-blur-md p-10 rounded-[40px] border border-white shadow-xl shadow-black/5">
    <table class="w-full text-left">
        <thead>
            <tr class="text-gray-400 text-xs uppercase tracking-widest border-b border-gray-100">
                <th class="pb-4 font-black">Nama Pengguna</th>
                <th class="pb-4 font-black">Role</th>
                <th class="pb-4 font-black">Status</th>
                <th class="pb-4 font-black text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm font-semibold">
            {{-- Asumsi data dilempar dari UserController dengan nama variabel $users --}}
            @foreach($users as $user)
            <tr class="border-b border-gray-50/50 hover:bg-white/40 transition-colors">
                <td class="py-5 text-edu-dark">{{ $user->name }}</td>
                <td class="py-5">
                    @if($user->role == 'admin')
                        <span class="px-3 py-1 bg-edu-orange/10 text-edu-orange rounded-full text-[10px] tracking-widest uppercase">ADMIN</span>
                    @elseif($user->role == 'guru')
                        <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-[10px] tracking-widest uppercase">GURU</span>
                    @else
                        <span class="px-3 py-1 bg-edu-blue/10 text-edu-blue rounded-full text-[10px] tracking-widest uppercase">SISWA</span>
                    @endif
                </td>
                <td class="py-5"><span class="w-2 h-2 rounded-full bg-green-500 inline-block mr-2 shadow-[0_0_8px_rgba(34,197,94,0.6)]"></span>Online</td>
                <td class="py-5 text-right">
                    <button class="px-4 py-2 bg-white text-gray-500 hover:bg-edu-blue hover:text-white rounded-xl shadow-sm transition-all text-xs font-bold mr-2">Edit</button>
                    <button class="px-4 py-2 bg-white text-red-500 hover:bg-red-500 hover:text-white rounded-xl shadow-sm transition-all text-xs font-bold">Hapus</button>
                </td>
            </tr> 
            @endforeach
        </tbody>
    </table>
</div>
@endsection