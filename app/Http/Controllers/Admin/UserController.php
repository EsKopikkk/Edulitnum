<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Fungsi untuk mean halaman kelola akun beserta datanya
    public function index()
    {
        // Ambil semua data user kecuali yang role-nya admin (agar admin tidak menghapus dirinya sendiri)
        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.kelola_akun', compact('users'));
    }

    // Fungsi untuk menyimpan akun baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:siswa,guru'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

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

        // Validasi data yang masuk
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:admin,guru,siswa'],
        ]);

        // Update data di database
        $user->update([
            'name' => $request->name,
            'role' => $request->role,
        ]);

        // Kembalikan ke halaman tabel dengan pesan sukses
        return redirect()->route('admin.akun.index')->with('success', 'Data user berhasil diperbarui!');
    }
    // Fungsi untuk menghapus akun
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Akun berhasil dihapus!');
    }
}