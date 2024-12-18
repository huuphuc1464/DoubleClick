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
        Schema::create('hoadon', function (Blueprint $table) {
            $table->integer('MaHD')->primary();
            $table->integer('MaTK')->index('fk_hoadon_taikhoan');
            $table->dateTime('NgayLapHD');
            $table->string('SDT', 11);
            $table->string('DiaChi', 50);
            $table->decimal('TienShip', 10);
            $table->decimal('TongTien', 10);
            $table->decimal('KhuyenMai', 10);
            $table->string('PhuongThucThanhToan', 50);
            $table->string('MaVoucher', 50)->nullable()->index('fk_hoadon_voucher');
            $table->integer('TrangThai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoadon');
    }
};
