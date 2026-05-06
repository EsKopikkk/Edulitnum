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
            'pertanyaan' => 'required|string',
            'kategori' => 'required|in:literasi,numerasi',
            'fase' => 'required|in:A,B,C',
        ]);

        Soal::create([
            'pertanyaan' => $request->pertanyaan,
            'kategori' => $request->kategori,
            'fase' => $request->fase,
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