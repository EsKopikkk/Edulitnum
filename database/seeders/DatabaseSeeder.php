<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        // --- 1. SEED DATA ADMIN ---
        User::create([
            'name' => 'Admin Edulitnum',
            'email' => 'admin@edulitnum.test',
            'password' => $password,
            'role' => 'admin',
        ]);

        // --- 2. SEED DATA GURU (Random) ---
        $gurus = ['Pak Budi', 'Ibu Sarah', 'Pak Andi'];
        foreach ($gurus as $namaGuru) {
            $email = strtolower(str_replace(' ', '', $namaGuru)) . '@edulitnum.test';
            User::create([
                'name' => $namaGuru,
                'email' => $email,
                'password' => $password,
                'role' => 'guru',
            ]);
        }

        // --- 3. SEED DATA SISWA (Manual sesuai permintaan) ---
        $siswas = ['Akmal', 'Ojhy', 'Riyadhy', 'Yunita', 'Astri'];
        foreach ($siswas as $namaSiswa) {
            User::create([
                'name' => $namaSiswa,
                'email' => strtolower($namaSiswa) . '@edulitnum.test',
                'password' => $password,
                'role' => 'siswa',
            ]);
        }

        // --- 4. PANGGIL SOAL SEEDER (Tugas Member 4) ---
        // Pastikan class SoalSeeder sudah kamu buat sebelumnya
        $this->call([
            SoalSeeder::class,
        ]);
    }
}
