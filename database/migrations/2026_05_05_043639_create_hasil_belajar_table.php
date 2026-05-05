<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('hasil_belajar', function (Blueprint $table) {
        $table->id(); // Primary Key

        // Foreign Key ke tabel users
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        // Foreign Key ke tabel soal
        $table->foreignId('soal_id')->constrained('soals')->onDelete('cascade');

        // Boolean: 1 jika benar, 0 jika salah
        $table->boolean('is_benar');

        // Waktu pengerjaan (menggunakan timestamp agar lebih standar Laravel)
        $table->timestamp('waktu_pengerjaan')->useCurrent();

        $table->timestamps();
    });
}
};
