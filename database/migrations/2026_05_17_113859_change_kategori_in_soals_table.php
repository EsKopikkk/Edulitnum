<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // KUNCI PERBAIKAN: Ubah 'soals' menjadi 'soal'
        Schema::table('soal', function (Blueprint $table) {
            $table->string('kategori')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soal', function (Blueprint $table) {
            // Kosongkan saja tidak apa-apa
        });
    }
};