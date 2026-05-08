@extends('layouts.admin')

@section('title', 'Manajemen User | Edulitnum')
@section('page_title') Manajemen <span class="text-edu-orange">User</span> @endsection
@section('page_subtitle', 'Kelola data seluruh Admin, Guru, dan Siswa.')

@section('content')
    <div class="flex justify-end mb-8">
        <a href="{{ route('admin.akun.create') }}"
            class="px-6 py-3 bg-edu-orange text-white font-bold rounded-2xl shadow-lg shadow-edu-orange/30 hover:-translate-y-1 transition-all flex items-center gap-2">
            + Tambah User
        </a>
    </div>

    <div class="bg-white/60 backdrop-blur-md p-10 rounded-[40px] border border-white shadow-xl shadow-black/5">
        <table class="w-full text-left">
            <thead>
                <tr class="text-gray-400 text-xs uppercase tracking-widest border-b border-gray-100">
                    <th class="pb-4 font-black">Nama Pengguna</th>
                    <th class="pb-4 font-black">Role</th>
                    <th class="pb-4 font-black text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm font-semibold">
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
                        <td class="py-5 text-right flex justify-end items-center">
                            <a href="{{ route('admin.akun.edit', $user->id) }}"
                                class="px-4 py-2 bg-white text-gray-500 hover:bg-edu-blue hover:text-white rounded-xl shadow-sm transition-all text-xs font-bold mr-2 inline-block">
                                Edit
                            </a>

                            {{-- Tombol hapus: trigger modal --}}
                            <button type="button"
                                onclick="openDeleteModal('{{ $user->id }}', '{{ $user->name }}')"
                                class="px-4 py-2 bg-white text-red-500 hover:bg-red-500 hover:text-white rounded-xl shadow-sm transition-all text-xs font-bold">
                                Hapus
                            </button>

                            {{-- Form hapus (di-submit via JS) --}}
                            <form id="delete-form-{{ $user->id }}"
                                action="{{ route('admin.akun.destroy', $user->id) }}"
                                method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ===== MODAL KONFIRMASI HAPUS ===== --}}
    <div id="delete-modal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden"
        onclick="closeDeleteModal(event)">

        {{-- Backdrop blur --}}
        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>

        {{-- Card modal --}}
        <div class="relative bg-white rounded-[2rem] shadow-2xl p-8 w-full max-w-sm mx-4 flex flex-col items-center gap-5 font-poppins">

            {{-- Icon warning --}}
            <div class="w-16 h-16 rounded-2xl bg-red-50 flex items-center justify-center">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0a1 1 0 01-1-1V5a1 1 0 011-1h6a1 1 0 011 1v1a1 1 0 01-1 1H9z" />
                </svg>
            </div>

            {{-- Teks --}}
            <div class="text-center">
                <h3 class="font-black text-edu-dark text-lg mb-1">Hapus Pengguna?</h3>
                <p class="text-gray-400 text-sm">Anda akan menghapus akun <span id="modal-user-name" class="font-bold text-edu-dark"></span>. Tindakan ini tidak dapat dibatalkan.</p>
            </div>

            {{-- Tombol aksi --}}
            <div class="flex gap-3 w-full">
                <button onclick="closeDeleteModal()"
                    class="flex-1 px-4 py-3 bg-gray-100 text-gray-500 font-bold rounded-2xl hover:bg-gray-200 transition-all text-sm">
                    Batal
                </button>
                <button onclick="confirmDelete()"
                    class="flex-1 px-4 py-3 bg-red-500 text-white font-bold rounded-2xl hover:bg-red-600 shadow-lg shadow-red-500/30 transition-all text-sm">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        let deleteTargetId = null;

        function openDeleteModal(userId, userName) {
            deleteTargetId = userId;
            document.getElementById('modal-user-name').textContent = userName;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal(event) {
            if (event && event.target !== document.getElementById('delete-modal')) return;
            document.getElementById('delete-modal').classList.add('hidden');
            deleteTargetId = null;
        }

        function confirmDelete() {
            if (deleteTargetId) {
                document.getElementById('delete-form-' + deleteTargetId).submit();
            }
        }
    </script>
@endsection