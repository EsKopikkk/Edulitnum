<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kelas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('kelas.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Kelas</label>
                        <input type="text" name="nama_kelas" 
                               class="w-full border rounded p-2 mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Fase</label>
                        <select name="fase" class="w-full border rounded p-2 mt-1" required>
                            <option value="A">Fase A</option>
                            <option value="B">Fase B</option>
                            <option value="C">Fase C</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Guru</label>
                        <select name="guru_id" class="w-full border rounded p-2 mt-1" required>
                            @foreach($guru as $g)
                                <option value="{{ $g->id }}">{{ $g->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" 
                            class="bg-blue-500 text-black px-4 py-2 rounded">
                        Simpan
                    </button>
                    <a href="{{ route('kelas.index') }}" 
                       class="bg-gray-400 text-black px-4 py-2 rounded ml-2">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>