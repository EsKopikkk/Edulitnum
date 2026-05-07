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

    // Fungsi untuk menghapus akun
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Akun berhasil dihapus!');
    }
}