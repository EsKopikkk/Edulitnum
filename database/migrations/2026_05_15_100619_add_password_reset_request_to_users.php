<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('reset_password_requested')->default(false)->after('nis');
            $table->timestamp('reset_password_requested_at')->nullable()->after('reset_password_requested');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('reset_password_requested');
            $table->dropColumn('reset_password_requested_at');
        });
    }
};
