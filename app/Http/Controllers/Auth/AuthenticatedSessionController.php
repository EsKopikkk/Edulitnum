<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * MENAMPILKAN HALAMAN LOGIN (Method yang Error tadi)
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * MEMPROSES LOGIN & REDIRECT BERDASARKAN ROLE
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Memastikan pengecekan role tidak peka huruf besar/kecil
        $role = strtolower($user->role);

if ($role === 'admin') {
    return redirect(route('admin.dashboard'));
} elseif ($role === 'guru') {
    return redirect(route('guru.dashboard'));
} elseif ($role === 'siswa') {
    return redirect(route('siswa.dashboard'));
}

        return redirect()->intended('/');
    }

    /**
     * LOGOUT
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
