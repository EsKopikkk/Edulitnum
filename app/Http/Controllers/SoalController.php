<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index()
    {
        $soal = Soal::all();
        return view('guru.bank_soal', compact('soal'));
    }

    public function create()
    {
        return view('guru.buat_soal');
    }

    public function store(Request $request)
    {
        // Tambahkan validasi untuk pilihan jawaban dan kunci
        $request->validate([
            'pertanyaan' => 'required|string',
            'kategori' => 'required|in:literasi,numerasi',
            'fase' => 'required|in:A,B,C',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'kunci_jawaban' => 'required|in:A,B,C,D',
        ]);

        Soal::create([
            'pertanyaan' => $request->pertanyaan,
            'kategori' => $request->kategori,
            'fase' => $request->fase,
            'pilihan_a' => $request->pilihan_a,
            'pilihan_b' => $request->pilihan_b,
            'pilihan_c' => $request->pilihan_c,
            'pilihan_d' => $request->pilihan_d,
            'kunci_jawaban' => $request->kunci_jawaban,
            'status_validasi' => false,
        ]);

        return redirect()->route('soal.index')->with('success', 'Soal berhasil ditambahkan!');
    }

    public function edit(Soal $soal)
    {
        return view('guru.edit_soal', compact('soal'));
    }

    public function update(Request $request, Soal $soal)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'kategori' => 'required|in:literasi,numerasi',
            'fase' => 'required|in:A,B,C',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'kunci_jawaban' => 'required|in:A,B,C,D',
        ]);

        $soal->update($request->all());

        return redirect()->route('soal.index')->with('success', 'Soal berhasil diupdate!');
    }

    public function destroy(Soal $soal)
    {
        $soal->delete();
        return redirect()->route('soal.index')->with('success', 'Soal berhasil dihapus!');
    }
}