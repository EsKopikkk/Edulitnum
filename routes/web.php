<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\KelasController; // Dipindah ke atas agar rapi

// 1. Halaman Muka (Landing Page) - Bebas diakses tanpa login
Route::get('/', function () {
    return view('welcome');
});

// 2. Halaman Dashboard - Wajib Login Dulu
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Rute Profile (Bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Rute Khusus Admin (Manajemen Akun)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/akun', [UserController::class, 'index'])->name('admin.akun.index');
    Route::post('/admin/akun', [UserController::class, 'store'])->name('admin.akun.store');
    Route::delete('/admin/akun/{id}', [UserController::class, 'destroy'])->name('admin.akun.destroy');
});

// 5. Rute Kelas
Route::middleware(['auth'])->group(function () {
    Route::resource('kelas', KelasController::class);
});

// 6. Rute Soal
Route::middleware(['auth'])->group(function () {
    Route::resource('soal', SoalController::class);
});

// Memuat rute autentikasi bawaan Breeze (Login, Register, dll)
require __DIR__.'/auth.php';