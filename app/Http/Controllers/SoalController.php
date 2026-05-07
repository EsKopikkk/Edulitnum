<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    // Menampilkan Bank Soal
    public function index()
    {
        $soal = Soal::latest()->get(); 
        return view('guru.bank_soal', compact('soal'));
    }

    // Menampilkan Form Buat Soal
    public function create()
    {
        return view('guru.buat_soal');
    }

    // Menyimpan Soal Baru ke Database
    public function store(Request $request)
    {
        // SUDAH DIPERBAIKI: Menggunakan opsi_a, opsi_b, dst sesuai database
        $request->validate([
            'pertanyaan' => 'required',
            'kategori' => 'required',
            'fase' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'kunci_jawaban' => 'required',
        ]);

        Soal::create($request->all());

        return redirect()->route('soal.index')->with('success', 'Soal berhasil ditambahkan!');
    }

    // Menampilkan Leaderboard
    public function leaderboard()
    {
        // Data dummy untuk testing UI
        $rankings = [
            ['nama' => 'Ahmad Fauzan', 'skor' => 98, 'fase' => 'A', 'waktu' => '12:30'],
            ['nama' => 'Siti Aminah', 'skor' => 88, 'fase' => 'A', 'waktu' => '14:20'],
            ['nama' => 'Budi Pratama', 'skor' => 75, 'fase' => 'A', 'waktu' => '15:10'],
        ];

        return view('guru.leaderboard', compact('rankings'));
    }
}