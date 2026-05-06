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
        $request->validate([
            'pertanyaan'    => 'required|string',
            'kategori'      => 'required|in:literasi,numerasi',
            'fase'          => 'required|in:A,B,C',
            'pilihan_a'     => 'required|string',
            'pilihan_b'     => 'required|string',
            'pilihan_c'     => 'required|string',
            'pilihan_d'     => 'required|string',
            'kunci_jawaban' => 'required|in:A,B,C,D',
        ]);

        Soal::create($request->all());

        return redirect()->route('soal.index')->with('success', 'Soal berhasil ditambahkan!');
    }

    public function edit(Soal $soal)
    {
        return view('guru.edit_soal', compact('soal'));
    }

    public function update(Request $request, Soal $soal)
    {
        $request->validate([
            'pertanyaan'    => 'required|string',
            'kategori'      => 'required|in:literasi,numerasi',
            'fase'          => 'required|in:A,B,C',
            'pilihan_a'     => 'required|string',
            'pilihan_b'     => 'required|string',
            'pilihan_c'     => 'required|string',
            'pilihan_d'     => 'required|string',
            'kunci_jawaban' => 'required|in:A,B,C,D',
        ]);

        $soal->update($request->all());

        return redirect()->route('soal.index')->with('success', 'Soal berhasil diperbarui!');
    }

    public function destroy(Soal $soal)
    {
        $soal->delete();
        return redirect()->route('soal.index')->with('success', 'Soal berhasil dihapus!');
    }
}