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

    // Request Reset Password dari Halaman Login (AJAX)
    Route::post('password-request-submit', function (\Illuminate\Http\Request $request) {
        $request->validate(['name' => 'required|string']);

        $user = \App\Models\User::where('name', $request->name)->where('role', 'guru')->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Nama guru tidak ditemukan'
            ]);
        }

        if ($user->reset_password_requested) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan request reset password. Tunggu admin untuk mereset.'
            ]);
        }

        $user->update([
            'reset_password_requested' => true,
            'reset_password_requested_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Request reset password berhasil dikirim ke admin'
        ]);
    })->name('password.request.submit');

    // Forgot Password & Reset Password Routes
    Route::get('forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('forgot-password', function (\Illuminate\Http\Request $request) {
        $request->validate(['email' => 'required|email']);

        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        $token = \Illuminate\Support\Str::random(64);
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['email' => $request->email, 'token' => \Illuminate\Support\Facades\Hash::make($token), 'created_at' => now()]
        );

        \Illuminate\Support\Facades\Mail::send('emails.reset-password', ['user' => $user, 'token' => $token], function ($mail) use ($user) {
            $mail->to($user->email)->subject('Link Reset Password Edulitnum');
        });

        return back()->with('status', 'Link reset password telah dikirim ke email Anda!');
    })->name('password.email');

    Route::get('reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('reset-password', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $resetToken = \Illuminate\Support\Facades\DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetToken || !\Illuminate\Support\Facades\Hash::check($request->token, $resetToken->token)) {
            return back()->withErrors(['token' => 'Token reset password tidak valid atau telah expired']);
        }

        $user = \App\Models\User::where('email', $request->email)->first();
        $user->update(['password' => \Illuminate\Support\Facades\Hash::make($request->password)]);

        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Password berhasil direset! Silakan login dengan password baru.');
    })->name('password.store');
});

Route::middleware('auth')->group(function () {
    // Fitur keluar (Logout)
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
