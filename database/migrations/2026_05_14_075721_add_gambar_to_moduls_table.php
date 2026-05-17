<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk tambah kolom.
     */
    public function up(): void
    {
        Schema::table('moduls', function (Blueprint $table) {
            // Kode kamu masuk di sini
            $table->string('gambar')->nullable()->after('judul');
        });
    }

    /**
     * Batalkan migrasi (hapus kolom jika rollback).
     */
    public function down(): void
    {
        Schema::table('moduls', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};