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
    Schema::create('soal', function (Blueprint $table) {
        $table->id();
        $table->text('pertanyaan');
        $table->enum('kategori', ['literasi', 'numerasi']);
        $table->enum('fase', ['A', 'B', 'C']);
        $table->boolean('status_validasi')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal');
    }
};
