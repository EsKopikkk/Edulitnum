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
            $table->unsignedBigInteger('modul_id')->nullable();
            $table->text('pertanyaan');
            $table->string('kategori');
            $table->string('tipe'); // <--- Hotfix: Kolom tipe wajib ada di sini
            $table->string('pilihan_a');
            $table->string('pilihan_b');
            $table->string('pilihan_c');
            $table->string('pilihan_d');
            $table->string('kunci_jawaban');
            $table->integer('status_validasi')->default(1);
            $table->string('fase');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soal');
    }
};
