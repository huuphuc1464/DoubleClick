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
        Schema::table('hoadon', function (Blueprint $table) {
            $table->foreign(['MaTK'], 'FK_HoaDon_TaiKhoan')->references(['MaTK'])->on('taikhoan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MaVoucher'], 'FK_HoaDon_Voucher')->references(['MaVoucher'])->on('voucher')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hoadon', function (Blueprint $table) {
            $table->dropForeign('FK_HoaDon_TaiKhoan');
            $table->dropForeign('FK_HoaDon_Voucher');
        });
    }
};
