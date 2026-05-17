<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan tabel dulu untuk berjaga-jaga
        // User::truncate();

        $users = [
            ['email' => 'admin@edulitnum.test', 'name' => 'Admin Edulitnum', 'role' => 'admin', 'nis' => null],
            ['email' => 'pakbudi@edulitnum.test', 'name' => 'Pak Budi Subianto', 'role' => 'guru', 'nis' => null],
            ['email' => 'ibusarah@edulitnum.test', 'name' => 'Ibu Sarah', 'role' => 'guru', 'nis' => null],
            ['email' => 'pakandi@edulitnum.test', 'name' => 'Pak Andi', 'role' => 'guru', 'nis' => null],
            ['email' => 'akmal@edulitnum.test', 'name' => 'Akmal', 'role' => 'siswa', 'nis' => 'EDB101'],
            ['email' => 'riyadhy@edulitnum.test', 'name' => 'Riyadhy', 'role' => 'siswa', 'nis' => 'EDA101'],
            ['email' => 'yunita@edulitnum.test', 'name' => 'Yunita', 'role' => 'siswa', 'nis' => 'EDA102'],
            ['email' => 'astri@edulitnum.test', 'name' => 'Astri', 'role' => 'siswa', 'nis' => 'EDB102'],
        ];

        // Ganti bagian foreach yang lama dengan ini:
        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']], // Ini kuncinya: cek dulu emailnya!
                [
                    'name' => $userData['name'],
                    'role' => $userData['role'],
                    'nis' => $userData['nis'],
                    'password' => Hash::make('password123'),
                    'is_pretest_done' => false,
                    'reset_password_requested' => false,
                ]
            );
        }
    }
}