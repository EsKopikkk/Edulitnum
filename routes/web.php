<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Khusus Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/akun', [UserController::class, 'index'])->name('admin.akun.index');
    Route::post('/admin/akun', [UserController::class, 'store'])->name('admin.akun.store');
    Route::delete('/admin/akun/{id}', [UserController::class, 'destroy'])->name('admin.akun.destroy');
});
require __DIR__.'/auth.php';
