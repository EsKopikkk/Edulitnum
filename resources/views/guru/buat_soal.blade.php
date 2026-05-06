<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: white;">Buat Soal Baru</h2>
    </x-slot>

    <div class="py-12" style="background-color: #FEFDDF; min-height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6" style="border: 1px solid #FFC81E;">
                <form method="POST" action="{{ route('soal.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" style="color: #E87F24;">Pertanyaan</label>
                        <textarea name="pertanyaan" rows="4"
                                  class="w-full border rounded p-2"
                                  style="border-color: #FFC81E;" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" style="color: #E87F24;">Kategori</label>
                        <select name="kategori" class="w-full border rounded p-2" style="border-color: #FFC81E;" required>
                            <option value="literasi">Literasi</option>
                            <option value="numerasi">Numerasi</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" style="color: #E87F24;">Fase</label>
                        <select name="fase" class="w-full border rounded p-2" style="border-color: #FFC81E;" required>
                            <option value="A">Fase A</option>
                            <option value="B">Fase B</option>
                            <option value="C">Fase C</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block font-semibold mb-2" style="color: #E87F24;">Pilihan Jawaban</label>
                        @foreach(['A','B','C','D'] as $p)
                        <div class="flex items-center mb-2 gap-2">
                            <input type="radio" name="kunci_jawaban" value="{{ $pilihan }}" required>
                            <span class="font-bold w-6">{{ $pilihan }}.</span>
                            <input type="text" name="pilihan_{{ strtolower($pilihan) }}"
                                   class="flex-1 border rounded p-2"
                                   style="border-color: #FFC81E;"
                                   placeholder="Isi pilihan {{ $pilihan }}" required>
                        </div>
                        @endforeach
                        <p class="text-sm text-gray-500 mt-1">* Pilih bulatan radio untuk menandai kunci jawaban yang benar.</p>
                    </div>
                    <button type="submit"
                            class="px-6 py-2 rounded text-white font-semibold"
                            style="background-color: #E87F24;">
                        Simpan Soal
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