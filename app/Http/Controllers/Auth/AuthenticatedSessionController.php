<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * MEMPROSES LOGIN (NIS ATAU NAME) & REDIRECT BERDASARKAN ROLE
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Tentukan Kredensial (Pakai NIS atau Name)
        $credentials = [];
        $loginField = '';

        // Jika request datang dari form Siswa (ada input 'nis')
        if ($request->has('nis') && $request->filled('nis')) {
            $request->validate([
                'nis' => ['required', 'string'],
                'password' => ['required', 'string'],
            ]);
            $credentials = ['nis' => $request->nis, 'password' => $request->password];
            $loginField = 'nis';
        }
        // Jika request datang dari form Admin/Guru (ada input 'name')
        else {
            $request->validate([
                'name' => ['required', 'string'],
                'password' => ['required', 'string'],
            ]);
            $credentials = ['name' => $request->name, 'password' => $request->password];
            $loginField = 'name';
        }

        // 2. Coba Lakukan Login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            $role = strtolower($user->role);

            // ==========================================
            // 🛡️ SATPAM LAPIS DUA: VALIDASI PINTU MASUK
            // ==========================================

            // A. Jika lewat pintu Siswa (NIS), tapi role BUKAN siswa
            if ($loginField === 'nis' && $role !== 'siswa') {
                Auth::logout(); // Batalkan login secara paksa
                return back()->withErrors([
                    'nis' => 'Akses ditolak! Halaman ini khusus untuk Siswa.',
                ])->onlyInput('nis');
            }

            // B. Jika lewat pintu Reguler (Name), tapi role ADALAH siswa
            if ($loginField === 'name' && $role === 'siswa') {
                Auth::logout(); // Batalkan login secara paksa
                return back()->withErrors([
                    'name' => 'Akses ditolak! Siswa harap login melalui halaman Pelaut (Pantai).',
                ])->onlyInput('name');
            }
            // ==========================================

            // 3. Jika pintunya benar, perbarui sesi untuk keamanan
            $request->session()->regenerate();

            // 4. Arahkan ke Dashboard masing-masing
            if ($role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($role === 'guru') {
                return redirect()->intended(route('guru.dashboard'));
            } elseif ($role === 'siswa') {
                return redirect()->intended(route('siswa.dashboard'));
            }

            return redirect()->intended('/');
        }

        // 5. Jika Gagal Login (Sandi salah / Akun tidak ada)
        return back()->withErrors([
            $loginField => 'Mohon maaf, kredensial yang dimasukkan tidak cocok.',
        ])->onlyInput($loginField);
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