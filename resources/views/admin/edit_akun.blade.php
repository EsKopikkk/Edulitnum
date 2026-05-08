@extends('layouts.admin')

@section('title', 'Edit User | Edulitnum')
@section('page_title') Edit <span class="text-edu-orange">User</span> @endsection
@section('page_subtitle', 'Perbarui informasi dan hak akses pengguna.')

@section('content')
<div class="max-w-2xl bg-white/60 backdrop-blur-md p-10 rounded-[40px] border border-white shadow-xl shadow-black/5">
    
    <form action="{{ route('admin.akun.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT') <div class="mb-6">
            <label for="name" class="block text-sm font-black text-edu-dark tracking-widest uppercase mb-2">Nama Pengguna</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                class="w-full px-5 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-edu-blue focus:ring-0 text-edu-dark font-medium transition-all shadow-sm outline-none" 
                placeholder="Masukkan nama lengkap">
            
            @error('name')
                <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-8">
            <label for="role" class="block text-sm font-black text-edu-dark tracking-widest uppercase mb-2">Role / Peran</label>
            <select id="role" name="role" required
                class="w-full px-5 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-edu-blue focus:ring-0 text-edu-dark font-medium transition-all shadow-sm outline-none cursor-pointer">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="guru" {{ $user->role == 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
            </select>
            
            @error('role')
                <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-8 py-4 bg-edu-orange text-white font-black rounded-2xl shadow-lg shadow-edu-orange/30 hover:-translate-y-1 transition-all">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.akun.index') }}" class="px-8 py-4 bg-white text-gray-500 font-bold rounded-2xl hover:bg-gray-50 transition-all shadow-sm">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection