<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\ResetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // Fungsi untuk mean halaman kelola akun beserta datanya
    public function index()
    {
        // Ambil semua data user kecuali yang role-nya admin (agar admin tidak menghapus dirinya sendiri)
        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.kelola_akun', compact('users'));
    }

    // Fungsi untuk menampilkan notifikasi password reset
    public function notifikasi()
    {
        $resetRequests = User::where('reset_password_requested', true)->get();
        return view('admin.notifikasi', compact('resetRequests'));
    }

    // Fungsi untuk menyimpan akun baru ke database
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:siswa,guru'],
        ];

        // Validasi NIS hanya jika role adalah siswa
        if ($request->role === 'siswa') {
            $rules['nis'] = ['required', 'string', 'unique:users,nis'];
        }

        $request->validate($rules);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ];

        // Tambahkan NIS jika role siswa
        if ($request->role === 'siswa') {
            $userData['nis'] = $request->nis;
        }

        User::create($userData);

        return back()->with('success', 'Akun berhasil ditambahkan!');
    }

    public function create()
    {
        // Panggil file form tambah data (tidak perlu pakai .blade.php)
        return view('admin.tambah_akun');
    }
    // 1. Fungsi untuk MENAMPILKAN halaman form edit
    public function edit($id)
    {
        // Cari user berdasarkan ID yang diklik
        $user = User::findOrFail($id);

        // Lempar data user tersebut ke halaman view 'edit_akun'
        return view('admin.edit_akun', compact('user'));
    }

    // 2. Fungsi untuk MENYIMPAN data yang sudah diedit ke database
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:admin,guru,siswa'],
        ];

        // Validasi NIS hanya jika role adalah siswa
        if ($request->role === 'siswa') {
            $rules['nis'] = ['required', 'string', 'unique:users,nis,' . $user->id];
        }

        // Validasi password jika diisi
        if ($request->filled('password')) {
            $rules['password'] = ['required', 'string', 'min:8'];
        }

        $request->validate($rules);

        $updateData = [
            'name' => $request->name,
            'role' => $request->role,
        ];

        // Tambahkan NIS jika role siswa
        if ($request->role === 'siswa') {
            $updateData['nis'] = $request->nis;
        } else {
            $updateData['nis'] = null;
        }

        // Update password jika diisi
        $passwordUpdated = false;
        if ($request->filled('password')) {
            $updateData['password'] = $request->password;
            $passwordUpdated = true;

            // Jika user request reset password, kirim email
            if ($user->reset_password_requested) {
                try {
                    Mail::to($user->email)->send(new ResetPasswordNotification($user, $request->password));
                } catch (\Exception $e) {
                    \Log::error('Email gagal dikirim: ' . $e->getMessage());
                }
            }
        }

        // Update data di database
        $user->update($updateData);

        // Refresh user object dari database untuk get updated values
        $user->refresh();

        // Kembalikan ke halaman tabel dengan pesan sukses
        if ($passwordUpdated && isset($updateData['reset_password_requested']) && $updateData['reset_password_requested'] === false) {
            return redirect()->route('admin.akun.index')->with('success', 'Password berhasil di-update dan email telah dikirim ke ' . $user->email);
        }

        return redirect()->route('admin.akun.index')->with('success', 'Data user berhasil diperbarui!');
    }
    // Fungsi untuk menandai notifikasi sudah selesai
    public function markNotificationDone($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'reset_password_requested' => false,
            'reset_password_requested_at' => null,
        ]);

        return response()->json(['success' => true, 'message' => 'Notifikasi sudah ditandai selesai!']);
    }

    // Fungsi untuk menghapus akun
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Akun berhasil dihapus!');
    }
}