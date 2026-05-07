<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\DashboardController;

// ==========================================
// 1. RUTE PUBLIK (Bebas Akses Tanpa Login)
// ==========================================
Route::get('/', function () {
    // Sesuaikan 'landing' dengan nama file buatan temanmu (misal: landing.blade.php)
    return view('welcome_edulitnum'); 
})->name('welcome_edulitnum');


// 3. Halaman Dashboard - Wajib Login Dulu
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/guru/dashboard', [DashboardController::class, 'guru'])->name('guru.dashboard');
    Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])->name('siswa.dashboard');
});

// Rute Profil Bawaan Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Khusus Admin (Kelola Akun)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/akun', [UserController::class, 'index'])->name('admin.akun.index');
    Route::post('/admin/akun', [UserController::class, 'store'])->name('admin.akun.store');
    Route::delete('/admin/akun/{id}', [UserController::class, 'destroy'])->name('admin.akun.destroy');
});

// Rute Resource (Kelas & Soal)
Route::middleware(['auth'])->group(function () {
    Route::resource('kelas', KelasController::class);
    Route::resource('soal', SoalController::class);
});

// Tambahkan rute ini untuk Leaderboard
Route::get('/guru/leaderboard', [SoalController::class, 'leaderboard'])->name('guru.leaderboard');

Route::get('/admin/kelas/{id}/modul', [KelasController::class, 'manageModul'])->name('admin.kelas.modul');

// Route untuk melihat detail siswa dan guru di dalam kelas
Route::get('/admin/kelas/{kelas}', [KelasController::class, 'show'])->name('kelas.show');
require __DIR__.'/auth.php';
