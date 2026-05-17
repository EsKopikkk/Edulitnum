<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\HasilBelajar;
use Illuminate\Support\Facades\DB;

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

        // 1. Ambil data nilai milik siswa yang sedang login
        $hasil = HasilBelajar::where('user_id', $userId)->first();
        $skorPretest = $hasil ? $hasil->skor_pretest : 0;
        $skorLiterasi = $hasil ? $hasil->skor_game_literasi : 0;
        $skorNumerasi = $hasil ? $hasil->skor_game_numerasi : 0;
        $totalXp = $skorPretest + $skorLiterasi + $skorNumerasi;

        // 2. AMBIL DATA REAL TOP PENYELAM (LEADERBOARD)
        // Menggabungkan tabel users dan hasil_belajars, lalu hitung total_xp secara dinamis di query database
        $topPenyelam = User::where('role', 'siswa')
            ->leftJoin('hasil_belajars', 'users.id', '=', 'hasil_belajars.user_id')
            ->select(
                'users.id',
                'users.name',
                DB::raw('COALESCE(hasil_belajars.skor_pretest, 0) +
                          COALESCE(hasil_belajars.skor_game_literasi, 0) +
                          COALESCE(hasil_belajars.skor_game_numerasi, 0) as total_score_xp')
            )
            ->orderBy('total_score_xp', 'desc')
            ->get();

        return view('siswa.dashboard', compact(
            'skorPretest',
            'skorLiterasi',
            'skorNumerasi',
            'totalXp',
            'topPenyelam'
        ));
    }
}
