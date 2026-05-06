<?php

namespace App\Http\Controllers;

use App\Models\Soal; // Pastikan ini sesuai nama model temanmu
use Illuminate\Http\Request;

class SoalController extends Controller
{
    // Menampilkan Bank Soal
    public function index()
    {
        $semua_soal = Soal::all();
        return view('guru.bank_soal', compact('semua_soal'));
    }

    // Menampilkan Form Buat Soal
    public function create()
    {
        return view('guru.buat_soal');
    }

    // Menyimpan Soal Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'jawaban_benar' => 'required',
        ]);

        Soal::create($request->all());

        return redirect()->route('soal.index')->with('success', 'Soal berhasil ditambahkan!');
    }
}