<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ForcePretestMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Hanya periksa jika pengguna yang login adalah seorang siswa
        if ($user && $user->role === 'siswa') {

            // KONDISI 1: Jika BELUM pernah pretest, tapi mau buka dashboard/menu lain
            if (!$user->is_pretest_done && !$request->routeIs('siswa.pretest*')) {
                // Paksa lempar ke halaman pretest
                return redirect()->route('siswa.pretest');
            }

            // KONDISI 2: Jika SUDAH pernah pretest, tapi iseng ketik URL pretest lagi
            if ($user->is_pretest_done && $request->routeIs('siswa.pretest*')) {
                // Blokir, lempar balik ke dashboard siswa
                return redirect()->route('siswa.dashboard')->with('error', 'Kamu sudah menyelesaikan misi awal ini!');
            }
        }

        return $next($request);
    }
}
