<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
        $firstGuruId = null;

        foreach ($gurus as $namaGuru) {
            $email = strtolower(str_replace(' ', '', $namaGuru)) . '@edulitnum.test';
            $guru = User::create([
                'name' => $namaGuru,
                'email' => $email,
                'password' => $password,
                'role' => 'guru',
            ]);

            // Ambil ID dari guru pertama (Pak Budi) untuk dijadikan Wali Kelas default di seeder kelas
            if (!$firstGuruId) {
                $firstGuruId = $guru->id;
            }
        }

        // --- 3. SEED DATA KELAS (Ditaruh setelah Guru karena wajib mengisi 'guru_id') ---
        DB::table('kelas')->insertOrIgnore([
            ['id' => 1, 'nama_kelas' => '3-A', 'guru_id' => $firstGuruId, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_kelas' => '3-B', 'guru_id' => $firstGuruId, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_kelas' => '4-A', 'guru_id' => $firstGuruId, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nama_kelas' => '4-B', 'guru_id' => $firstGuruId, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // --- 4. SEED DATA SISWA (Format NIS Berkode Kelas) ---
        $siswas = [
            ['name' => 'Akmal', 'kelas' => 'A', 'number' => '001'], // NIS: EDA001
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

        // --- 5. PANGGIL SOAL SEEDER ---
        $this->call([
            UserSeeder::class,
            SoalSeeder::class,
        ]);
    }
}