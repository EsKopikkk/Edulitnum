<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Modul;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SoalImport; 

class SoalController extends Controller
{
    // Menampilkan Bank Soal
    public function index()
    {
        $soal = Soal::with('modul')->latest()->get(); 
        return view('guru.bank_soal', compact('soal'));
    }

    // Menampilkan Form Buat Soal
    public function create()
    {
        $moduls = Modul::all(); 
        return view('guru.buat_soal', compact('moduls'));
    }

    // Menyimpan Soal Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'modul_id'      => 'required|exists:moduls,id',
            'pertanyaan'    => 'required',
            'kategori'      => 'required',
            'fase'          => 'required',
            'pilihan_a'     => 'required',
            'pilihan_b'     => 'required',
            'pilihan_c'     => 'required',
            'pilihan_d'     => 'required',
            'kunci_jawaban' => 'required',
        ]);

        Soal::create($request->all());

        return redirect()->route('soal.index')->with('success', 'Soal berhasil ditambahkan!');
    }

    // Menampilkan Form Edit Soal
    public function edit($id)
    {
        $soal = Soal::findOrFail($id); 
        $moduls = Modul::all(); 
        return view('guru.edit_soal', compact('soal', 'moduls'));
    }

    // Menyimpan Perubahan
    public function update(Request $request, $id)
    {
        $request->validate([
            'modul_id'      => 'required|exists:moduls,id',
            'pertanyaan'    => 'required',
            'kategori'      => 'required',
            'fase'          => 'required',
            'pilihan_a'     => 'required',
            'pilihan_b'     => 'required',
            'pilihan_c'     => 'required',
            'pilihan_d'     => 'required',
            'kunci_jawaban' => 'required',
        ]);

        $soal = Soal::findOrFail($id);
        $soal->update($request->all());

        return redirect()->route('soal.index')->with('success', 'Data soal berhasil diubah! ✏️');
    }

    // Menghapus Soal
    public function destroy($id)
    {
        Soal::destroy($id);
        return redirect()->route('soal.index')->with('success', 'Soal berhasil dihapus! 🗑️');
    }

    // Leaderboard
    public function leaderboard()
    {
        $rankings = [
            ['nama' => 'Ahmad Fauzan', 'skor' => 98, 'fase' => 'A', 'waktu' => '12:30'],
            ['nama' => 'Siti Aminah', 'skor' => 88, 'fase' => 'A', 'waktu' => '14:20'],
            ['nama' => 'Budi Pratama', 'skor' => 75, 'fase' => 'A', 'waktu' => '15:10'],
        ];

        return view('guru.leaderboard', compact('rankings'));
    }

    // Import Excel
    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new SoalImport, $request->file('file_excel'));

        return redirect()->back()->with('success', 'Ratusan soal berhasil mendarat! 🚀');
    }
}