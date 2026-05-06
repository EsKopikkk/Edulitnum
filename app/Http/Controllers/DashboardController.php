<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('Admin.dashboard');
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
