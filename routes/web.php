<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\GameController;

// ==========================================
// 1. RUTE PUBLIK (Bebas Akses Tanpa Login)
// ==========================================
Route::get('/', function () {
    return view('welcome_edulitnum');
})->name('welcome_edulitnum');

// ==========================================
// 2. RUTE UMUM (Wajib Login, Role Bebas)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// 3. RUTE KHUSUS ADMIN SAJA
// ==========================================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // -- Kelola Akun User --
    Route::get('/admin/akun', [UserController::class, 'index'])->name('admin.akun.index');
    Route::get('/admin/akun/create', [UserController::class, 'create'])->name('admin.akun.create');
    Route::post('/admin/akun', [UserController::class, 'store'])->name('admin.akun.store');
    Route::get('/admin/akun/{id}/edit', [UserController::class, 'edit'])->name('admin.akun.edit');
    Route::put('/admin/akun/{id}', [UserController::class, 'update'])->name('admin.akun.update');
    Route::delete('/admin/akun/{id}', [UserController::class, 'destroy'])->name('admin.akun.destroy');

    // -- Kelola Kelas & Modul (Sekarang DIKUNCI HANYA UNTUK ADMIN) --
    Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
    Route::get('/admin/kelas/{id}/modul', [KelasController::class, 'manageModul'])->name('admin.kelas.modul');
    Route::get('/admin/kelas/{kelas}', [KelasController::class, 'show'])->name('kelas.show');

    // -- Kelola Siswa di dalam Kelas --
    Route::get('/kelas/{kelas}/siswa', [KelasController::class, 'kelolaSiswa'])->name('kelas.siswa');
    Route::post('/kelas/{kelas}/siswa', [KelasController::class, 'tambahSiswa'])->name('kelas.siswa.tambah');
    Route::delete('/kelas/{kelas_id}/siswa/{user_id}', [KelasController::class, 'hapusSiswa'])->name('kelas.siswa.hapus');
});

// HAPUS GRUP "RUTE GABUNGAN" KARENA SUDAH DIPINDAH SEMUA KE ATAS

// ==========================================
// 4. RUTE KHUSUS GURU SAJA
// ==========================================
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', [DashboardController::class, 'guru'])->name('guru.dashboard');
    Route::get('/guru/leaderboard', [SoalController::class, 'leaderboard'])->name('guru.leaderboard');

    // Asumsi Guru yang berhak mengelola Bank Soal
    Route::resource('soal', SoalController::class);
});

// ==========================================
// 5. RUTE KHUSUS SISWA SAJA
// ==========================================
Route::middleware(['auth', 'role:siswa'])->group(function () {
    // Rute Dashboard Siswa yang sudah ada
    Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])->name('siswa.dashboard');

    // Tambahkan Rute Fitur Pre-test (Tugas Anggota 4)
    Route::get('/siswa/pretest', [UjianController::class, 'index'])->name('siswa.pretest');
    Route::post('/siswa/pretest/simpan', [UjianController::class, 'simpanJawaban'])->name('siswa.pretest.simpan');
    Route::get('/siswa/pretest/selesai', [UjianController::class, 'selesai'])->name('siswa.pretest.selesai');

    // routes/web.php

Route::middleware(['auth', 'role:siswa'])->group(function () {
    // Dashboard dan Pretest
    Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])->name('siswa.dashboard');
    Route::get('/siswa/pretest', [UjianController::class, 'index'])->name('siswa.pretest.index');

    // Pastikan Bagian Game Ini ADA dan NAMANYA Sesuai
    Route::get('/siswa/game', [GameController::class, 'index'])->name('siswa.game.index');
    Route::get('/siswa/game/play/{tipe}', [GameController::class, 'play'])->name('siswa.game.play');
});
});


require __DIR__.'/auth.php';
