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
        Schema::create('voucher', function (Blueprint $table) {
            $table->string('MaVoucher', 50)->primary();
            $table->string('TenVoucher', 50);
            $table->integer('GiamGia');
            $table->dateTime('NgayBatDau');
            $table->dateTime('NgayKetThuc');
            $table->integer('GiaTriToiThieu')->nullable()->default(0);
            $table->integer('SoLuong');
            $table->integer('TrangThai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher');
    }
};
