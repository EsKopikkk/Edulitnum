<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\ForcePretestMiddleware; // <-- 1. Kita panggil namespace satpam baru di sini

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 2. Daftarkan nama panggilan untuk satpam-satpam kita di sini
        $middleware->alias([
            'role' => RoleMiddleware::class, // Bawaan tim kamu
            'force.pretest' => ForcePretestMiddleware::class, // <-- Tambahan satpam pengunci pretest kita
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
