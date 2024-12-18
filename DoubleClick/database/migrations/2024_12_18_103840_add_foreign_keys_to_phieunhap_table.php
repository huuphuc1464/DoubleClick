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
        Schema::table('phieunhap', function (Blueprint $table) {
            $table->foreign(['MaTK'], 'FK_PhieuNhap_TaiKhoan')->references(['MaTK'])->on('taikhoan')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phieunhap', function (Blueprint $table) {
            $table->dropForeign('FK_PhieuNhap_TaiKhoan');
        });
    }
};
