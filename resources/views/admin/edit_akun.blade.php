@extends('layouts.admin')

@section('title', 'Edit User | Edulitnum')
@section('page_title') Edit <span class="text-edu-orange">User</span> @endsection
@section('page_subtitle', 'Perbarui informasi dan hak akses pengguna.')

@section('content')
<div class="max-w-2xl bg-white/60 backdrop-blur-md p-10 rounded-[40px] border border-white shadow-xl shadow-black/5">

    @if($user->reset_password_requested && ($user->role == 'guru' || $user->role == 'admin'))
        <div class="mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
            <p class="text-yellow-700 font-semibold text-sm">🔔 Guru ini telah meRequest reset password. Reset password di bawah untuk mengirimkan password baru via email.</p>
        </div>
    @endif

    <form id="edit-form" action="{{ route('admin.akun.update', $user->id) }}" method="POST" onsubmit="return handleFormSubmit(event)">
        @csrf
        @method('PUT')
        <div class="mb-6">
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
            <select id="role" name="role" required onchange="togglePasswordField()"
                class="w-full px-5 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-edu-blue focus:ring-0 text-edu-dark font-medium transition-all shadow-sm outline-none cursor-pointer">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="guru" {{ $user->role == 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
            </select>

            @error('role')
                <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div id="nis-field" class="mb-8" style="display: {{ $user->role == 'siswa' ? 'block' : 'none' }};">
            <label for="nis" class="block text-sm font-black text-edu-dark tracking-widest uppercase mb-2">NIS (Nomor Induk Siswa)</label>
            <input type="text" id="nis" name="nis" value="{{ old('nis', $user->nis) }}"
                class="w-full px-5 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-edu-blue focus:ring-0 text-edu-dark font-medium transition-all shadow-sm outline-none"
                placeholder="Masukkan nomor induk siswa">

            @error('nis')
                <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div id="password-field" class="mb-8" style="display: {{ ($user->role == 'guru' || $user->role == 'admin') ? 'block' : 'none' }};">
            <label for="password" class="block text-sm font-black text-edu-dark tracking-widest uppercase mb-2">Password Baru</label>
            <input type="password" id="password" name="password"
                class="w-full px-5 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-edu-blue focus:ring-0 text-edu-dark font-medium transition-all shadow-sm outline-none"
                placeholder="Kosongkan jika tidak ingin mengubah password">
            <p class="text-gray-500 text-xs mt-2">Minimal 8 karakter</p>

            @error('password')
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

{{-- Modal Konfirmasi Pengiriman Email --}}
<div id="confirm-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" onclick="closeConfirmModal()"></div>

    <div class="relative bg-white rounded-[40px] shadow-2xl p-8 w-full max-w-md mx-4 flex flex-col gap-5">
        <div class="text-center mb-4">
            <h3 class="font-black text-edu-dark text-lg">Kirim Email ke Guru?</h3>
            <p class="text-gray-500 text-sm mt-2">Password baru akan dikirim ke:</p>
            <p class="text-edu-orange font-bold mt-1">{{ $user->email }}</p>
        </div>

        <div class="bg-blue-50 p-3 rounded-xl text-xs text-blue-700">
            ⓘ Password ini hanya akan dikirim via email. Pastikan email sudah benar.
        </div>

        <div class="flex gap-3 mt-6">
            <button type="button" onclick="closeConfirmModal()" class="flex-1 px-4 py-3 bg-gray-100 text-gray-500 font-bold rounded-2xl hover:bg-gray-200 transition-all text-sm">
                Batal
            </button>
            <button type="button" onclick="submitForm()" class="flex-1 px-4 py-3 bg-edu-orange text-white font-bold rounded-2xl hover:bg-edu-dark shadow-lg shadow-edu-orange/30 transition-all text-sm">
                Setuju & Simpan
            </button>
        </div>
    </div>
</div>

<script>
    function togglePasswordField() {
        const role = document.getElementById('role').value;
        const passwordField = document.getElementById('password-field');
        const nisField = document.getElementById('nis-field');

        passwordField.style.display = (role === 'guru' || role === 'admin') ? 'block' : 'none';
        nisField.style.display = (role === 'siswa') ? 'block' : 'none';
    }

    function handleFormSubmit(event) {
        const passwordInput = document.getElementById('password').value;
        const resetRequested = {{ $user->reset_password_requested ? 'true' : 'false' }};
        const role = document.getElementById('role').value;
        const userEmail = "{{ $user->email }}";

        // Jika ada password dan guru sudah request reset password
        if (passwordInput && resetRequested && (role === 'guru' || role === 'admin')) {
            event.preventDefault();

            // Gunakan modal HTML yang sudah ada
            document.getElementById('confirm-modal').classList.remove('hidden');
            return false;
        }

        // Jika tidak ada kondisi reset, langsung submit
        return true;
    }

    function submitForm() {
        document.getElementById('confirm-modal').classList.add('hidden');
        document.getElementById('edit-form').submit();
    }

    function closeConfirmModal() {
        document.getElementById('confirm-modal').classList.add('hidden');
    }

    // Close modal ketika klik backdrop
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('confirm-modal');
        const backdrop = modal ? modal.querySelector('[onclick*="closeConfirmModal"]') : null;

        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal.firstChild) {
                    closeConfirmModal();
                }
            });
        }
    });
</script>
@endsection