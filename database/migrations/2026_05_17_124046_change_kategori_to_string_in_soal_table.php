<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Wajib import ini di atas

return new class extends Migration
{
    public function up(): void
    {
        // Menggunakan query SQL mentah langsung ke MySQL untuk mengubah ENUM menjadi VARCHAR (String)
        DB::statement("ALTER TABLE soal MODIFY COLUMN kategori VARCHAR(255) NULL;");
    }

    public function down(): void
    {
        // Mengembalikan kolom ke format ENUM semula jika di-rollback
        DB::statement("ALTER TABLE soal MODIFY COLUMN kategori ENUM('literasi', 'numerasi') NULL;");
    }
};
