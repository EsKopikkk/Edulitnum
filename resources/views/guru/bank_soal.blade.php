<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: white;">
            Bank Soal
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #FEFDDF; min-height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6" style="border: 1px solid #FFC81E;">

                @if(session('success'))
                    <div class="p-3 rounded mb-4 text-white" style="background-color: #E87F24;">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('soal.create') }}"
                   class="inline-block px-4 py-2 rounded mb-4 text-white font-semibold"
                   style="background-color: #E87F24;">
                    + Tambah Soal
                </a>

                <table class="w-full mt-4 border">
                    <thead>
                        <tr style="background-color: #FFC81E;">
                            <th class="p-3 text-left">No</th>
                            <th class="p-3 text-left">Pertanyaan</th>
                            <th class="p-3 text-left">Kategori</th>
                            <th class="p-3 text-left">Fase</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($soal as $index => $s)
                        <tr class="border-t">
                            <td class="p-3">{{ $index + 1 }}</td>
                            <td class="p-3">{{ Str::limit($s->pertanyaan, 50) }}</td>
                            <td class="p-3">{{ ucfirst($s->kategori) }}</td>
                            <td class="p-3">Fase {{ $s->fase }}</td>
                            <td class="p-3">
                                @if($s->status_validasi)
                                    <span class="px-2 py-1 rounded text-white text-sm" style="background-color: #73A5CA;">Tervalidasi</span>
                                @else
                                    <span class="px-2 py-1 rounded text-white text-sm bg-gray-400">Belum</span>
                                @endif
                            </td>
                            <td class="p-3">
                                <a href="{{ route('soal.edit', $s->id) }}"
                                   class="px-3 py-1 rounded text-white text-sm"
                                   style="background-color: #FFC81E; color: #333;">Edit</a>
                                <form action="{{ route('soal.destroy', $s->id) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 rounded text-white text-sm bg-red-500"
                                            onclick="return confirm('Yakin hapus soal ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center text-gray-500">Belum ada soal.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>