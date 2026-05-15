@extends('layouts.admin')

@section('title', 'Kelola Modul | Edulitnum')
@section('page_title') Modul <span class="text-edu-orange">{{ $kelas->nama_kelas }}</span> @endsection
@section('page_subtitle', 'Kelola materi pembelajaran untuk kelas ini')

@section('content')
<div class="w-full space-y-8">
    <a href="{{ route('kelas.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-edu-orange font-black text-xs uppercase tracking-widest transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Kelas
    </a>

    {{-- Form Tambah Modul --}}
    <div class="bg-white/60 backdrop-blur-md p-10 rounded-[40px] border border-white shadow-xl shadow-black/5">
        <h3 class="text-xl font-black text-edu-dark mb-6">Tambah Modul Baru</h3>

        <form action="{{ route('admin.kelas.modul.tambah', $kelas->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-black text-edu-dark uppercase mb-2">Judul Modul</label>
                <input type="text" name="judul" required
                    class="w-full px-5 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-edu-blue focus:ring-0 text-edu-dark font-medium transition-all shadow-sm outline-none"
                    placeholder="Contoh: Bab 1 - Puisi Modern">
                @error('judul')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-black text-edu-dark uppercase mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                    class="w-full px-5 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-edu-blue focus:ring-0 text-edu-dark font-medium transition-all shadow-sm outline-none"
                    placeholder="Deskripsi singkat tentang modul ini"></textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-black text-edu-dark uppercase mb-2">File Materi (PDF/Gambar)</label>
                <input type="file" name="file_materi" accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.jpeg,.png"
                    class="w-full px-5 py-4 rounded-2xl bg-white border-2 border-transparent focus:border-edu-blue focus:ring-0 text-edu-dark font-medium transition-all shadow-sm outline-none">
                <p class="text-gray-500 text-xs mt-2">Ukuran maksimal: 10MB (PDF, DOC, PPT, JPG, PNG)</p>
                @error('file_materi')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="px-8 py-4 bg-edu-orange text-white font-black rounded-2xl shadow-lg shadow-edu-orange/30 hover:-translate-y-1 transition-all">
                + Tambah Modul
            </button>
        </form>
    </div>

    {{-- Daftar Modul --}}
    <div class="bg-white/60 backdrop-blur-md p-10 rounded-[40px] border border-white shadow-xl shadow-black/5">
        <h3 class="text-xl font-black text-edu-dark mb-6">Daftar Modul ({{ $moduls->count() }})</h3>

        @if($moduls->isEmpty())
            <div class="py-16 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <p class="text-gray-400 text-lg font-semibold">Belum ada modul</p>
                <p class="text-gray-300 text-sm mt-2">Tambahkan modul di atas untuk mulai</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($moduls as $modul)
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 hover:border-edu-orange transition-colors flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div class="flex-1">
                            <h4 class="font-bold text-edu-dark text-lg">{{ $modul->judul }}</h4>
                            @if($modul->deskripsi)
                                <p class="text-gray-500 text-sm mt-1">{{ Str::limit($modul->deskripsi, 100) }}</p>
                            @endif
                            @if($modul->file_materi)
                                <p class="text-gray-400 text-xs mt-2 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                                    📎 Ada file terlampir
                                </p>
                            @endif
                        </div>

                        <div class="flex items-center gap-2 w-full md:w-auto">
                            <a href="{{ route('admin.kelas.modul.progress', [$kelas->id, $modul->id]) }}"
                                class="flex-1 md:flex-none px-4 py-2 bg-blue-50 text-blue-600 font-bold rounded-xl hover:bg-blue-100 transition-all text-xs uppercase">
                                👁 Lihat Progress
                            </a>
                            <form action="{{ route('admin.kelas.modul.hapus', [$kelas->id, $modul->id]) }}" method="POST" class="flex-1 md:flex-none" onsubmit="return confirm('Hapus modul ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-2 bg-red-50 text-red-600 font-bold rounded-xl hover:bg-red-100 transition-all text-xs uppercase">
                                    🗑 Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
