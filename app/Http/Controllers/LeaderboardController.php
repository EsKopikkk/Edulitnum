<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    // Mengambil data urutan siswa berdasarkan XP tertinggi
    private function getTopPenyelamData()
    {
        // Menggunakan get() terlebih dahulu, lalu diurutkan lewat Collection Laravel biar kebal dari eror Accessor database
        return User::where('role', 'siswa')
            ->get()
            ->sortByDesc('total_score_xp');
    }

    // Render komponen otomatis untuk SISI SISWA
    public function renderSiswa()
    {
        $topPenyelam = $this->getTopPenyelamData();
        return view('siswa.partials.leaderboard_content', compact('topPenyelam'));
    }

    // Render komponen otomatis untuk SISI GURU
    public function renderGuru()
    {
        $topPenyelam = $this->getTopPenyelamData();
        return view('guru.partials.leaderboard_content', compact('topPenyelam'));
    }
}