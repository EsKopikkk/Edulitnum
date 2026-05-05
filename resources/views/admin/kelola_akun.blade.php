<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Akun Guru & Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Pemberitahuan Sukses -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Kotak Formulir Tambah Akun -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Tambah Akun Baru</h3>
                    <form action="{{ route('admin.akun.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="name" value="Nama Lengkap" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="password" value="Password" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="role" value="Role / Peran" />
                            <select id="role" name="role" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="siswa">Siswa</option>
                                <option value="guru">Guru</option>
                            </select>
                        </div>
                        <x-primary-button>Simpan Akun</x-primary-button>
                    </form>
                </div>
            </div>

            <!-- Kotak Tabel Daftar Akun -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Daftar Akun Terdaftar</h3>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-200 px-4 py-2">Nama</th>
                                    <th class="border border-gray-200 px-4 py-2">Email</th>
                                    <th class="border border-gray-200 px-4 py-2">Role</th>
                                    <th class="border border-gray-200 px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="border border-gray-200 px-4 py-2">{{ $user->name }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $user->email }}</td>
                                    <td class="border border-gray-200 px-4 py-2 capitalize">{{ $user->role }}</td>
                                    <td class="border border-gray-200 px-4 py-2 text-center">
                                        <form action="{{ route('admin.akun.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>