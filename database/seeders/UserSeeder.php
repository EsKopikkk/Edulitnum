<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar semua user berdasarkan database Bos Lead
        $users = [
            // ================= ADMIN =================
            [
                'email' => 'admin@edulitnum.test',
                'name' => 'Admin Edulitnum',
                'role' => 'admin',
                'nis' => null,
            ],
            // ================= GURU =================
            [
                'email' => 'pakbudi@edulitnum.test',
                'name' => 'Pak Budi Subianto',
                'role' => 'guru',
                'nis' => null,
            ],
            [
                'email' => 'ibusarah@edulitnum.test',
                'name' => 'Ibu Sarah',
                'role' => 'guru',
                'nis' => null,
            ],
            [
                'email' => 'pakandi@edulitnum.test',
                'name' => 'Pak Andi',
                'role' => 'guru',
                'nis' => null,
            ],
            // ================= SISWA =================
            [
                'email' => 'akmal@edulitnum.test',
                'name' => 'Akmal',
                'role' => 'siswa',
                'nis' => 'EDB101',
            ],
            [
                'email' => 'riyadhy@edulitnum.test',
                'name' => 'Riyadhy',
                'role' => 'siswa',
                'nis' => 'EDA101',
            ],
            [
                'email' => 'yunita@edulitnum.test',
                'name' => 'Yunita',
                'role' => 'siswa',
                'nis' => 'EDA102',
            ],
            [
                'email' => 'astri@edulitnum.test',
                'name' => 'Astri',
                'role' => 'siswa',
                'nis' => 'EDB102',
            ],
        ];

        // Looping untuk memasukkan data ke tabel
        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']], // Cari berdasarkan email agar tidak dobel
                [
                    'name' => $userData['name'],
                    'role' => $userData['role'],
                    'nis' => $userData['nis'],
                    'password' => Hash::make('password123'), // Semua password diseragamkan dulu
                ]
            );
        }
    }
}