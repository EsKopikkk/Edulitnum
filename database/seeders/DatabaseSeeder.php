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

        // --- 2. SEED DATA GURU ---
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

        // --- 3. SEED DATA SISWA (Format NIS Berkode Kelas) ---
        $siswas = [
            ['name' => 'Akmal', 'kelas' => 'A', 'number' => '001'], // NIS:   
            ['name' => 'Ojhy',  'kelas' => 'A', 'number' => '002'], // NIS: EDA002
            ['name' => 'Riyadhy','kelas' => 'B', 'number' => '001'], // NIS: EDB001
            ['name' => 'Yunita', 'kelas' => 'B', 'number' => '002'], // NIS: EDB002
            ['name' => 'Astri',  'kelas' => 'B', 'number' => '003'], // NIS: EDB003
        ];

        foreach ($siswas as $data) {
            User::create([
                'name' => $data['name'],
                'email' => strtolower($data['name']) . '@edulitnum.test',
                'nis' => 'ED' . $data['kelas'] . $data['number'],
                'password' => $password,
                'role' => 'siswa',
            ]);
        }

        // --- 4. PANGGIL SOAL SEEDER ---
        $this->call([
            SoalSeeder::class,
        ]);
    }
}
