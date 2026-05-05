<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kelas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('kelas.update', $kelas->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Kelas</label>
                        <input type="text" name="nama_kelas" 
                               value="{{ $kelas->nama_kelas }}"
                               class="w-full border rounded p-2 mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Fase</label>
                        <select name="fase" class="w-full border rounded p-2 mt-1" required>
                            @foreach(['A', 'B', 'C'] as $fase)
                                <option value="{{ $fase }}" 
                                    {{ $kelas->fase == $fase ? 'selected' : '' }}>
                                    Fase {{ $fase }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Guru</label>
                        <select name="guru_id" class="w-full border rounded p-2 mt-1" required>
                            @foreach($guru as $g)
                                <option value="{{ $g->id }}"
                                    {{ $kelas->guru_id == $g->id ? 'selected' : '' }}>
                                    {{ $g->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" 
                            class="bg-blue-500 text-white px-4 py-2 rounded">
                        Update
                    </button>
                    <a href="{{ route('kelas.index') }}" 
                       class="bg-gray-400 text-white px-4 py-2 rounded ml-2">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>