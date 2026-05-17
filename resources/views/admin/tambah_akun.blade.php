@extends('layouts.admin')

@section('title', 'Tambah User Baru | Edulitnum')
@section('page_title') Tambah <span class="text-edu-orange">User</span> @endsection
@section('page_subtitle', 'Daftarkan Admin, Guru, atau Siswa baru ke dalam sistem.')

@section('content')
<div class="max-w-2xl bg-white/60 backdrop-blur-md p-10 rounded-[40px] border border-white shadow-xl shadow-black/5">
    
    <!-- Formulir mengarah ke fungsi STORE -->
    <form action="{{ route('admin.akun.store') }}" method="POST">
        @csrf

        <!-- Input Nama -->
        <div class="mb-6">
            <label for="name" class="block text-sm font-black text-edu-dark tracking-widest uppercase mb-2">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                class="w-full px-5 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-edu-blue focus:ring-0 text-edu-dark font-medium transition-all shadow-sm outline-none" 
                placeholder="Masukkan nama lengkap">
            @error('name') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Input Email -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-black text-edu-dark tracking-widest uppercase mb-2">Alamat Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                class="w-full px-5 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-edu-blue focus:ring-0 text-edu-dark font-medium transition-all shadow-sm outline-none" 
                placeholder="contoh@edulitnum.com">
            @error('email') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Input Password -->
        <div class="mb-6">
            <label for="password" class="block text-sm font-black text-edu-dark tracking-widest uppercase mb-2">Password</label>
            <input type="password" id="password" name="password" required
                class="w-full px-5 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-edu-blue focus:ring-0 text-edu-dark font-medium transition-all shadow-sm outline-none" 
                placeholder="Minimal 8 karakter">
            @error('password') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Pilihan Role -->
        <div class="mb-8">
            <label for="role" class="block text-sm font-black text-edu-dark tracking-widest uppercase mb-2">Role / Peran</label>
            <select id="role" name="role" required
                class="w-full px-5 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-edu-blue focus:ring-0 text-edu-dark font-medium transition-all shadow-sm outline-none cursor-pointer"
                onchange="toggleNisField()">
                <option value="" disabled selected>Pilih peran pengguna...</option>
                <option value="admin">Admin</option>
                <option value="guru">Guru</option>
                <option value="siswa">Siswa</option>
            </select>
            @error('role') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Input NIS (hanya untuk siswa) -->
        <div class="mb-8 hidden" id="nis-field">
            <label for="nis" class="block text-sm font-black text-edu-dark tracking-widest uppercase mb-2">Nomor Induk Siswa (NIS)</label>
            <input type="text" id="nis" name="nis" value="{{ old('nis') }}"
                class="w-full px-5 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-edu-blue focus:ring-0 text-edu-dark font-medium transition-all shadow-sm outline-none"
                placeholder="Masukkan NIS siswa">
            @error('nis') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center gap-4">
            <button type="submit" class="px-8 py-4 bg-edu-orange text-white font-black rounded-2xl shadow-lg shadow-edu-orange/30 hover:-translate-y-1 transition-all">
                Simpan Data
            </button>
            <a href="{{ route('admin.akun.index') }}" class="px-8 py-4 bg-white text-gray-500 font-bold rounded-2xl hover:bg-gray-50 transition-all shadow-sm">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    function toggleNisField() {
        const role = document.getElementById('role').value;
        const nisField = document.getElementById('nis-field');

        if (role === 'siswa') {
            nisField.classList.remove('hidden');
        } else {
            nisField.classList.add('hidden');
        }
    }
</script>
@endsection