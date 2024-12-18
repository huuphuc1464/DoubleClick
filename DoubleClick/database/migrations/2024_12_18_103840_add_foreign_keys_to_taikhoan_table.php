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
        Schema::table('taikhoan', function (Blueprint $table) {
            $table->foreign(['MaRole'], 'FK_TaiKhoan_Role')->references(['MaRole'])->on('role')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taikhoan', function (Blueprint $table) {
            $table->dropForeign('FK_TaiKhoan_Role');
        });
    }
};
