<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\KelasController;

<<<<<<< HEAD
// ==========================================
// 1. RUTE PUBLIK (Bebas Akses Tanpa Login)
// ==========================================
=======
// 1. Halaman Muka (Landing Page)
>>>>>>> 8f8a515ec1727aecd46fa915fb2decff91418109
Route::get('/', function () {
    // Sesuaikan 'landing' dengan nama file buatan temanmu (misal: landing.blade.php)
    return view('welcome_edulitnum'); 
})->name('welcome_edulitnum');

<<<<<<< HEAD

// ==========================================
// 2. RUTE TERKUNCI (Wajib Login)
// ==========================================
=======
// 2. Custom Route Login (Menampilkan Form Glassmorphism yang baru dibuat)
Route::get('/login', function () {
    return view('auth.login'); // Mengarah ke resources/views/auth/login.blade.php
})->name('login');

// 3. Halaman Dashboard - Wajib Login Dulu
>>>>>>> 8f8a515ec1727aecd46fa915fb2decff91418109
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

<<<<<<< HEAD
// Rute Profil Bawaan Breeze
=======
// 4. Rute Profile (Bawaan Breeze)
>>>>>>> 8f8a515ec1727aecd46fa915fb2decff91418109
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

<<<<<<< HEAD
// Rute Khusus Admin (Kelola Akun)
=======
// 5. Rute Khusus Admin (Manajemen Akun)
>>>>>>> 8f8a515ec1727aecd46fa915fb2decff91418109
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/akun', [UserController::class, 'index'])->name('admin.akun.index');
    Route::post('/admin/akun', [UserController::class, 'store'])->name('admin.akun.store');
    Route::delete('/admin/akun/{id}', [UserController::class, 'destroy'])->name('admin.akun.destroy');
});

<<<<<<< HEAD
// Rute Resource (Kelas & Soal)
Route::middleware(['auth'])->group(function () {
    Route::resource('kelas', KelasController::class);
    Route::resource('soal', SoalController::class);
});

// Otentikasi Bawaan Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';
=======
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
>>>>>>> 8f8a515ec1727aecd46fa915fb2decff91418109
