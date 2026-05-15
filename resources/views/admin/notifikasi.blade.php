@extends('layouts.admin')

@section('title', 'Notifikasi | Edulitnum')
@section('page_title') <span class="text-edu-orange">Notifikasi</span> @endsection
@section('page_subtitle', 'Guru yang request reset password.')

@section('content')
    <div class="bg-white/60 backdrop-blur-md p-10 rounded-[40px] border border-white shadow-xl shadow-black/5">
        @if($resetRequests->isEmpty())
            <div class="text-center py-16">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <p class="text-gray-400 text-lg font-semibold">Tidak ada notifikasi</p>
                <p class="text-gray-300 text-sm mt-2">Semua guru sudah di-reset password-nya</p>
            </div>
        @else
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 text-xs uppercase tracking-widest border-b border-gray-100">
                        <th class="pb-4 font-black">Nama Guru</th>
                        <th class="pb-4 font-black">Email</th>
                        <th class="pb-4 font-black text-center">Aksi Sudah Dilakukan</th>
                        <th class="pb-4 font-black text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-semibold">
                    @foreach($resetRequests as $user)
                        <tr class="border-b border-gray-50/50 hover:bg-white/40 transition-colors" id="notif-row-{{ $user->id }}">
                            <td class="py-5 text-edu-dark">{{ $user->name }}</td>
                            <td class="py-5 text-gray-600">{{ $user->email }}</td>
                            <td class="py-5 text-center">
                                <button type="button" class="text-2xl hover:scale-110 transition-transform" title="Tandai sudah selesai" onclick="markAsDone({{ $user->id }})">
                                    ✅
                                </button>
                            </td>
                            <td class="py-5 text-right flex justify-end items-center gap-2">
                                <a href="{{ route('admin.akun.edit', $user->id) }}"
                                    class="px-4 py-2 bg-edu-orange text-white hover:bg-edu-dark rounded-xl shadow-sm transition-all text-xs font-bold">
                                    Reset Password
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        async function markAsDone(userId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                             document.querySelector('input[name="_token"]')?.value;

            try {
                const response = await fetch(`/admin/notifikasi/${userId}/selesai`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({})
                });

                if (response.ok) {
                    // Hapus row dari tabel
                    const row = document.getElementById(`notif-row-${userId}`);
                    if (row) {
                        row.style.opacity = '0';
                        row.style.transition = 'opacity 0.3s ease';
                        setTimeout(() => row.remove(), 300);
                    }

                    // Reload halaman untuk update badge
                    setTimeout(() => location.reload(), 500);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal menandai notifikasi');
            }
        }
    </script>
@endsection
