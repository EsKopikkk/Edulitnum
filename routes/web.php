<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ModulController;


// ==========================================
// 1. RUTE PUBLIK
// ==========================================
Route::get('/', function () {
    return view('welcome_edulitnum');
})->name('welcome_edulitnum');

// RUTE KHUSUS LOGIN SISWA (BARU)
Route::get('/login-siswa', function () {
    return view('login_siswa');
})->middleware('guest')->name('login.siswa');

// ==========================================
// 2. RUTE UMUM (Wajib Login)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// 3. RUTE KHUSUS ADMIN
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // Kelola Akun User
    Route::resource('akun', UserController::class)->names('admin.akun');

    // Kelola Kelas & Modul
    Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
    Route::get('/kelas/{id}/modul', [KelasController::class, 'manageModul'])->name('admin.kelas.modul');

    // Kelola Siswa di dalam Kelas
    Route::get('/kelas/{kelas}/siswa', [KelasController::class, 'kelolaSiswa'])->name('kelas.siswa');
    Route::post('/kelas/{kelas}/siswa', [KelasController::class, 'tambahSiswa'])->name('kelas.siswa.tambah');
    Route::delete('/kelas/{kelas_id}/siswa/{user_id}', [KelasController::class, 'hapusSiswa'])->name('kelas.siswa.hapus');
});




// ==========================================
// 4. RUTE KHUSUS GURU
// ==========================================
Route::middleware(['auth', 'role:guru'])->prefix('guru')->group(function () {
    // Dashboard & Leaderboard
    Route::get('/dashboard', [DashboardController::class, 'guru'])->name('guru.dashboard');
    Route::get('/leaderboard', [SoalController::class, 'leaderboard'])->name('guru.leaderboard');

    // Fitur Import Excel
    Route::post('/soal/import', [SoalController::class, 'import'])->name('soal.import');

    // Resource Soal & Modul
    Route::resource('soal', SoalController::class);
    Route::resource('modul', ModulController::class);
});

// ==========================================
// 5. RUTE KHUSUS SISWA (Sudah Dilindungi Satpam)
// ==========================================
Route::middleware(['auth', 'role:siswa', 'force.pretest'])->prefix('siswa')->name('siswa.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'siswa'])->name('dashboard');
    Route::get('/pretest', [UjianController::class, 'index'])->name('pretest');
    Route::post('/pretest/simpan', [UjianController::class, 'simpanJawaban'])->name('pretest.simpan');
    Route::get('/pretest/selesai', [UjianController::class, 'selesai'])->name('pretest.selesai'); // Sesuaikan jika nama rutenya berbeda di timmu

    Route::get('/game', [GameController::class, 'index'])->name('game.index');
    Route::get('/game/play/{tipe}', [GameController::class, 'play'])->name('game.play');
    Route::get('/modul/{kategori}', [ModulController::class, 'siswaShow'])->name('modul.show');
    Route::post('/game/save-score', [UjianController::class, 'saveScore'])->name('game.save-score');
});
// ==========================================
// 6. AUTH ROUTES
// ==========================================
require __DIR__.'/auth.php';
