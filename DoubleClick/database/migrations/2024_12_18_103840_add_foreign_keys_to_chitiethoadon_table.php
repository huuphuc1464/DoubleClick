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
        Schema::table('chitiethoadon', function (Blueprint $table) {
            $table->foreign(['MaHD'], 'FK_ChiTietHoaDon_HoaDon')->references(['MaHD'])->on('hoadon')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MaSach'], 'FK_ChiTietHoaDon_Sach')->references(['MaSach'])->on('sach')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chitiethoadon', function (Blueprint $table) {
            $table->dropForeign('FK_ChiTietHoaDon_HoaDon');
            $table->dropForeign('FK_ChiTietHoaDon_Sach');
        });
    }
};
