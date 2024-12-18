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
        Schema::table('giohang', function (Blueprint $table) {
            $table->foreign(['MaSach'], 'FK_GioHang_Sach')->references(['MaSach'])->on('sach')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MaTK'], 'FK_GioHang_TaiKhoan')->references(['MaTK'])->on('taikhoan')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('giohang', function (Blueprint $table) {
            $table->dropForeign('FK_GioHang_Sach');
            $table->dropForeign('FK_GioHang_TaiKhoan');
        });
    }
};
