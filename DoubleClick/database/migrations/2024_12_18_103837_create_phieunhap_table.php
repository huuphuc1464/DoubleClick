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
        Schema::create('phieunhap', function (Blueprint $table) {
            $table->integer('MaPN')->primary();
            $table->integer('MaTK')->index('fk_phieunhap_taikhoan');
            $table->dateTime('NgayNhap');
            $table->string('GhiChu', 100)->nullable();
            $table->decimal('TongTien', 10);
            $table->integer('TrangThai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieunhap');
    }
};
