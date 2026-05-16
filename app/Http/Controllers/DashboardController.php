<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\HasilBelajar;

class DashboardController extends Controller
{
    // Halaman Dashboard Admin
    public function admin()
    {
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalGuru = User::where('role', 'guru')->count();
        $penggunaTerbaru = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalSiswa', 'totalGuru', 'penggunaTerbaru'));
    }

    // Halaman Dashboard Guru
    public function guru()
    {
        return view('guru.dashboard');
    }

    // Halaman Dashboard Siswa (Sudah Terintegrasi Database & Perhitungan XP)
    public function siswa()
    {
        $userId = Auth::id();

        // Mengambil record data nilai milik siswa yang sedang login
        $hasil = HasilBelajar::where('user_id', $userId)->first();

        // Menyediakan nilai default 0 jika data record belum dibuat
        $skorPretest = $hasil ? $hasil->skor_pretest : 0;
        $skorLiterasi = $hasil ? $hasil->skor_game_literasi : 0;
        $skorNumerasi = $hasil ? $hasil->skor_game_numerasi : 0;

        // Akumulasi kalkulasi total XP dari penjumlahan ketiga nilai terbesar
        $totalXp = $skorPretest + $skorLiterasi + $skorNumerasi;

        return view('siswa.dashboard', compact(
            'skorPretest',
            'skorLiterasi',
            'skorNumerasi',
            'totalXp'
        ));
    }
}
