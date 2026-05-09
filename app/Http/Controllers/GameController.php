<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        // Menampilkan lobby pilihan game
        return view('siswa.game.index');
    }

    public function play($tipe)
    {
        // Masuk ke arena game sesuai tipe (literasi/numerasi)
        return view('siswa.game.play', compact('tipe'));
    }

    public function simpanSkor(Request $request)
    {
        // Logika untuk menyimpan skor/XP game ke database
        // Nanti kita hubungkan dengan progres_siswa
        return response()->json(['status' => 'success', 'message' => 'Skor berhasil disimpan!']);
    }
}
