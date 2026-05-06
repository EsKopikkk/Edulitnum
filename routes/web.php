<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\DashboardController;

// 1. Halaman Muka (Landing Page)
Route::get('/', function () {
    return view('welcome_edulitnum');
});

// 2. Custom Route Login (Menampilkan Form Glassmorphism yang baru dibuat)
Route::get('/login', function () {
    return view('auth.login'); // Mengarah ke resources/views/auth/login.blade.php
})->name('login');

// 3. Halaman Dashboard - Wajib Login Dulu
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/guru/dashboard', [DashboardController::class, 'guru'])->name('guru.dashboard');
    Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])->name('siswa.dashboard');
});

// 4. Rute Profile (Bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 5. Rute Khusus Admin (Manajemen Akun)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/akun', [UserController::class, 'index'])->name('admin.akun.index');
    Route::post('/admin/akun', [UserController::class, 'store'])->name('admin.akun.store');
    Route::delete('/admin/akun/{id}', [UserController::class, 'destroy'])->name('admin.akun.destroy');
});

// 6. Rute Kelas
Route::middleware(['auth'])->group(function () {
    Route::resource('kelas', KelasController::class);
});

// 7. Rute Soal
Route::middleware(['auth'])->group(function () {
    Route::resource('soal', SoalController::class);
});

// Memuat rute autentikasi bawaan Breeze
// Catatan: Jika di dalam auth.php ada rute GET login, rute di atas akan menimpanya.
require __DIR__.'/auth.php';
