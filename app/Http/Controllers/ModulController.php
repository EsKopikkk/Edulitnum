<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Kelas; // Memanggil data kelas
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function index()
    {
        // Ambil semua modul dan kelas untuk ditampilkan
        $moduls = Modul::latest()->get();
        $kelas = Kelas::all();

        return view('guru.modul', compact('moduls', 'kelas'));
    }

    /**
     * Menampilkan halaman modul literasi khusus siswa
     */
    public function siswaShow()
    {
        // Pastikan kamu punya file blade di resources/views/siswa/modul/literasi.blade.php
        return view('siswa.modul.literasi');
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