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
        Schema::table('chitietphieunhap', function (Blueprint $table) {
            $table->foreign(['MaPN'], 'FK_ChiTietPhieuNhap_PhieuNhap')->references(['MaPN'])->on('phieunhap')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MaSach'], 'FK_ChiTietPhieuNhap_Sach')->references(['MaSach'])->on('sach')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chitietphieunhap', function (Blueprint $table) {
            $table->dropForeign('FK_ChiTietPhieuNhap_PhieuNhap');
            $table->dropForeign('FK_ChiTietPhieuNhap_Sach');
        });
    }
};
