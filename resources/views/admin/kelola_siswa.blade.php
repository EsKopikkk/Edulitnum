@extends('layouts.admin')

@section('title', 'Kelola Siswa Kelas | Edulitnum')
@section('page_title') Siswa <span class="text-edu-orange">{{ $kelas->nama_kelas }}</span> @endsection
@section('page_subtitle', 'Kelola daftar siswa dalam kelas ini.')

@section('content')

@if(session('success'))
<div class="mb-6 px-6 py-4 bg-green-100 text-green-700 font-semibold rounded-2xl border border-green-200">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-6 px-6 py-4 bg-red-100 text-red-700 font-semibold rounded-2xl border border-red-200">
    {{ session('error') }}
</div>
@endif

{{-- Form Tambah Siswa --}}
<div class="bg-white/60 backdrop-blur-md p-8 rounded-[32px] border border-white shadow-xl mb-8">
    <h2 class="text-lg font-black text-edu-dark mb-4">Tambah Siswa ke Kelas</h2>
    <form method="POST" action="{{ route('kelas.siswa.tambah', $kelas->id) }}" class="flex gap-4">
        @csrf
        <select name="user_id" class="flex-1 rounded-2xl border border-gray-200 px-4 py-3 focus:outline-none focus:border-edu-blue" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($semuaSiswa as $siswa)
                <option value="{{ $siswa->id }}">{{ $siswa->name }} ({{ $siswa->email }})</option>
            @endforeach
        </select>
        <button type="submit" class="px-6 py-3 bg-edu-blue text-white font-bold rounded-2xl hover:-translate-y-1 transition-all">
            Tambahkan
        </button>
    </form>
</div>

{{-- Tabel Daftar Siswa --}}
<div class="bg-white/60 backdrop-blur-md p-8 rounded-[32px] border border-white shadow-xl">
    <h2 class="text-lg font-black text-edu-dark mb-6">Daftar Siswa ({{ $siswaDiKelas->count() }} orang)</h2>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-gray-400 uppercase text-xs border-b border-gray-200">
                <th class="pb-3">#</th>
                <th class="pb-3">Nama</th>
                <th class="pb-3">Email</th>
                <th class="pb-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswaDiKelas as $i => $detail)
            <tr class="border-b border-gray-100 hover:bg-white/50 transition">
                <td class="py-4 text-gray-400">{{ $i + 1 }}</td>
                <td class="py-4 font-semibold text-edu-dark">{{ $detail->user->name }}</td>
                <td class="py-4 text-gray-500">{{ $detail->user->email }}</td>
                <td class="py-4">
                    <form action="{{ route('kelas.siswa.hapus', [$kelas->id, $detail->user_id]) }}" method="POST" onsubmit="return confirm('Keluarkan siswa ini dari kelas?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 font-bold hover:text-red-600 transition-colors">Keluarkan</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="py-8 text-center text-gray-400">Belum ada siswa di kelas ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    <a href="{{ route('kelas.index') }}" class="text-edu-blue font-bold hover:text-edu-orange transition-colors">← Kembali ke Kelola Kelas</a>
</div>
@endsection