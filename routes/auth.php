<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Menampilkan halaman login kustom kita
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    // Proses masuk (Logika redirect role ada di sini)
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Tetap simpan register jika ingin digunakan di awal
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    // Fitur keluar (Logout)
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
