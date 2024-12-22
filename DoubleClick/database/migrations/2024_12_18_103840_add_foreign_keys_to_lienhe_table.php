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
        Schema::table('lienhe', function (Blueprint $table) {
            $table->foreign(['MaKH'], 'FK_LienHe_TaiKhoanKH')->references(['MaTK'])->on('taikhoan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MaNV'], 'FK_LienHe_TaiKhoanNV')->references(['MaTK'])->on('taikhoan')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lienhe', function (Blueprint $table) {
            $table->dropForeign('FK_LienHe_TaiKhoanKH');
            $table->dropForeign('FK_LienHe_TaiKhoanNV');
        });
    }
};
