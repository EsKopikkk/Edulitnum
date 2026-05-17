<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hanya panggil UserSeeder (dia handle semua user dengan benar)
        // dan SoalSeeder (soal)
        $this->call([
            UserSeeder::class,
            SoalSeeder::class,
        ]);
    }
}


/**
 * Panggil UserSeeder dan SoalSeeder
 * (User sudah di-handle di UserSeeder, jadi tidak perlu bikin manual di sini)
 */