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
        Schema::table('moduls', function (Blueprint $table) {
            // Menambahkan kolom teks panjang untuk isi materi dan tantangan numerik
            $table->longText('isi_materi')->nullable()->after('deskripsi');
            $table->text('soal_numerik')->nullable()->after('isi_materi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('moduls', function (Blueprint $table) {
            // Drop kolom jika dilakukan rollback
            $table->dropColumn(['isi_materi', 'soal_numerik']);
        });
    }
};