<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Kelas;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function index()
    {
        $moduls = Modul::latest()->get();
        $kelas = Kelas::all();
        return view('guru.modul', compact('moduls', 'kelas'));
    }

    /**
     * Menampilkan halaman modul untuk siswa
     */
    public function siswaShow($kategori = null)
    {
        $user = auth()->user();

        // Ambil kelas siswa
        $kelasSiswa = $user->siswaDetail()->first()?->kelas;

        if (!$kelasSiswa) {
            return view('siswa.modul.belum-kelas');
        }

        // Ambil modul dari kelas siswa
        $moduls = Modul::where('kelas_id', $kelasSiswa->id)->get();

        return view('siswa.modul.literasi', compact('moduls', 'kelasSiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kelas_id' => 'required',
            'deskripsi' => 'required',
        ]);

        Modul::create($request->all());

        return redirect()->back()->with('success', 'Modul materi baru berhasil dibuat! 📚');
    }

    public function destroy($id)
    {
        Modul::destroy($id);
        return redirect()->back()->with('success', 'Modul materi berhasil dihapus! 🗑️');
    }

    public function show($id)
    {
        // Ambil data modul beserta kelasnya
        $modul = Modul::with('kelas')->findOrFail($id);
        
        return view('guru.show_modul', compact('modul'));
    }
}