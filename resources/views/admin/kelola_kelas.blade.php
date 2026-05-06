<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Kelas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('kelas.create') }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                    + Tambah Kelas
                </a>

                <table class="w-full mt-4 border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">No</th>
                            <th class="p-3 text-left">Nama Kelas</th>
                            <th class="p-3 text-left">Fase</th>
                            <th class="p-3 text-left">Guru</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kelas as $index => $k)
                        <tr class="border-t">
                            <td class="p-3">{{ $index + 1 }}</td>
                            <td class="p-3">{{ $k->nama_kelas }}</td>
                            <td class="p-3">Fase {{ $k->fase }}</td>
                            <td class="p-3">{{ $k->guru->name ?? '-' }}</td>
                            <td class="p-3">
                                <a href="{{ route('kelas.edit', $k->id) }}" 
                                   class="bg-yellow-400 text-white px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('kelas.destroy', $k->id) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 text-white px-3 py-1 rounded"
                                            onclick="return confirm('Yakin hapus?')">
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
</x-app-layout>