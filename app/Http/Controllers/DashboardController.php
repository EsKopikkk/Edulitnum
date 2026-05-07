<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function admin()
    {
        
        // Mengambil statistik nyata dari database
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalGuru = User::where('role', 'guru')->count();
        
        // Mengambil 5 pengguna terbaru yang baru bergabung
        $penggunaTerbaru = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalSiswa', 'totalGuru', 'penggunaTerbaru'));
        }

    public function guru()
    {
        return view('guru.dashboard');
    }

    public function siswa()
    {
        return view('siswa.dashboard');
    }

    
}
