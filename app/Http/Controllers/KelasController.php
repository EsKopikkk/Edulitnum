<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{

public function index()
{
    // Mengambil data kelas, guru, dan menghitung jumlah siswa secara otomatis
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
}