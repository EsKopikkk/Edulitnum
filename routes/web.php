<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\KelasController;

// ==========================================
// 1. RUTE PUBLIK (Bebas Akses Tanpa Login)
// ==========================================
Route::get('/', function () {
    // Sesuaikan 'landing' dengan nama file buatan temanmu (misal: landing.blade.php)
    return view('welcome_edulitnum'); 
})->name('welcome_edulitnum');


// ==========================================
// 2. RUTE TERKUNCI (Wajib Login)
// ==========================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

// Otentikasi Bawaan Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';
