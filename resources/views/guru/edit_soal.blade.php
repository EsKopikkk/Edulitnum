<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: white;">
            Edit Soal
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #FEFDDF; min-height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6" style="border: 1px solid #FFC81E;">
                <form method="POST" action="{{ route('soal.update', $soal->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" style="color: #E87F24;">Pertanyaan</label>
                        <textarea name="pertanyaan" rows="4"
                                  class="w-full border rounded p-2"
                                  style="border-color: #FFC81E;" required>{{ $soal->pertanyaan }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" style="color: #E87F24;">Kategori</label>
                        <select name="kategori" class="w-full border rounded p-2" style="border-color: #FFC81E;" required>
                            <option value="literasi" {{ $soal->kategori == 'literasi' ? 'selected' : '' }}>Literasi</option>
                            <option value="numerasi" {{ $soal->kategori == 'numerasi' ? 'selected' : '' }}>Numerasi</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" style="color: #E87F24;">Fase</label>
                        <select name="fase" class="w-full border rounded p-2" style="border-color: #FFC81E;" required>
                            @foreach(['A','B','C'] as $fase)
                            <option value="{{ $fase }}" {{ $soal->fase == $fase ? 'selected' : '' }}>Fase {{ $fase }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                            class="px-6 py-2 rounded text-white font-semibold"
                            style="background-color: #E87F24;">
                        Update Soal
                    </button>
                    <a href="{{ route('soal.index') }}"
                       class="ml-2 px-6 py-2 rounded text-white font-semibold bg-gray-400">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>