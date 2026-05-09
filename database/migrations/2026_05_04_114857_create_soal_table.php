<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soal', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan');
            $table->enum('kategori', ['literasi', 'numerasi']);
            $table->enum('fase', ['A', 'B', 'C']);

            // Kolom untuk Pilihan Ganda & Kunci
            $table->string('pilihan_a');
            $table->string('pilihan_b');
            $table->string('pilihan_c');
            $table->string('pilihan_d');
            $table->string('kunci_jawaban');

            $table->boolean('status_validasi')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soal');
    }
};
