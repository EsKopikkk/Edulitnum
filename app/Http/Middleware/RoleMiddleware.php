<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    // Tambahkan ...$roles agar bisa menerima lebih dari 1 role (contoh: role:admin,guru)
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login DAN role-nya ada di dalam daftar yang diizinkan
        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
            return $next($request); // Silakan masuk!
        }

        // Kalau melanggar, tangkap role aslinya
        $userRole = Auth::user()->role;

        // Tendang balik ke dashboard masing-masing sesuai role aslinya!
        return redirect()->route($userRole . '.dashboard')
            ->with('error', 'Akses ditolak! Anda tidak memiliki izin ke halaman tersebut.');
    }
}