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
        Schema::create('moduls', function (Blueprint $table) {
            $table->id();
            // Menyambungkan modul ini dengan kelas tertentu
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade'); 
            $table->string('judul'); // Contoh: "Bab 1: Puisi"
            $table->text('deskripsi')->nullable();
            $table->string('file_materi')->nullable(); // Untuk upload PDF/Gambar materi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moduls');
    }
};
