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

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required',
            'kelas_id'  => 'required',
            'deskripsi' => 'required',
            'isi_materi' => 'required', // Kolom baru
            'soal_numerik' => 'nullable', // Kolom baru
            'jenis_modul' => 'required', // Kolom baru
            'gambar'    => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'gambar_konten' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();

        // 1. Simpan Gambar Sampul (Luar)
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('modul_sampul', 'public');
        }

        // 2. Simpan Gambar Isi (Materi)
        if ($request->hasFile('gambar_konten')) {
            $data['gambar_konten'] = $request->file('gambar_konten')->store('modul_konten', 'public');
        }

        Modul::create($data);
        return redirect()->back()->with('success', 'Materi Berhasil Dibuat! 🚀✨');
    }

   public function show($id)
{
    // Ambil data modul beserta kelas dan daftar soalnya
    $modul = Modul::with(['kelas', 'soals'])->findOrFail($id);
    
    return view('guru.show_modul', compact('modul'));
}

    public function destroy($id)
    {
        Modul::destroy($id);
        return redirect()->back()->with('success', 'Modul berhasil dihapus! 🗑️');
    }
}