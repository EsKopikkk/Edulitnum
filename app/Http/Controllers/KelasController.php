<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{

public function index()
{
    $kelas = Kelas::with('guru')->withCount('siswa')->get();
    return view('admin.kelola_kelas', compact('kelas'));
}

public function manageModul($id)
{
    // Mengambil data kelas tertentu
    $kelas = Kelas::findOrFail($id);
    
    // Mengambil soal dari tabel soal yang fasenya sama dengan fase kelas tersebut [cite: 86-90]
    $moduls = \App\Models\Soal::where('fase', $kelas->fase)->get();

    return view('admin.kelola_modul', compact('kelas', 'moduls'));
}

    public function create()
    {
        $guru = User::where('role', 'guru')->get();
        return view('admin.tambah_kelas', compact('guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'fase' => 'required|in:A,B,C',
            'guru_id' => 'required|exists:users,id',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function edit(Kelas $kelas)
    {
        $guru = User::where('role', 'guru')->get();
        return view('admin.edit_kelas', compact('kelas', 'guru'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'fase' => 'required|in:A,B,C',
            'guru_id' => 'required|exists:users,id',
        ]);

        $kelas->update($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate!');
    }

    public function show(Kelas $kelas)
{
    // Memuat data siswa yang ada di kelas tersebut melalui relasi siswa_detail [cite: 17-20, 82-85]
    $kelas->load(['guru', 'siswa.user']); 
    
    return view('admin.detail_kelas', compact('kelas'));
}
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus!');
    }

    // Tampilkan halaman kelola siswa dalam kelas
public function kelolaSiswa(Kelas $kelas)
{
    $siswaDiKelas = $kelas->siswa()->with('user')->get();
    $semuaSiswa = User::where('role', 'siswa')->get();
    return view('admin.kelola_siswa_kelas', compact('kelas', 'siswaDiKelas', 'semuaSiswa'));
}

// Tambah siswa ke kelas
public function tambahSiswa(Request $request, Kelas $kelas)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    // Cegah duplikat
    $sudahAda = \App\Models\SiswaDetail::where('user_id', $request->user_id)
                    ->where('kelas_id', $kelas->id)->exists();

    if ($sudahAda) {
        return back()->with('error', 'Siswa sudah ada di kelas ini!');
    }

    \App\Models\SiswaDetail::create([
        'user_id' => $request->user_id,
        'kelas_id' => $kelas->id,
    ]);

    return back()->with('success', 'Siswa berhasil ditambahkan ke kelas!');
}

// Hapus siswa dari kelas
public function hapusSiswa($kelas_id, $user_id)
{
    \App\Models\SiswaDetail::where('kelas_id', $kelas_id)
        ->where('user_id', $user_id)->delete();

    return back()->with('success', 'Siswa berhasil dikeluarkan dari kelas!');
}

}