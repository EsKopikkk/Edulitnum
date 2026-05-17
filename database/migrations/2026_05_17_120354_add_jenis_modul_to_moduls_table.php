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
        // Menambahkan jenis modul (literasi/numerasi) setelah kelas_id
        $table->string('jenis_modul')->default('numerasi')->after('kelas_id');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('moduls', function (Blueprint $table) {
            //
        });
    }
};
