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
        Schema::create('sach', function (Blueprint $table) {
            $table->bigIncrements('MaSach')->primary();
            $table->bigInteger('MaLoai')->unsigned()->index('fk_sach_loaisach');
            $table->string('TenSach', 50);
            $table->string('TenNCC', 50)->nullable();
            $table->string('Slug', 100);
            $table->string('TenTG', 50)->nullable();
            $table->string('TenBoSach', 100)->nullable();
            $table->integer('NXB');
            $table->string('ISBN', 50);
            $table->string('AnhDaiDien', 100);
            $table->string('MoTa', 100)->nullable();
            $table->decimal('GiaNhap', 10);
            $table->decimal('GiaBan', 10);
            $table->decimal('KhuyenMai', 5)->default(0);
            $table->decimal('SoLuongTon', 10);
            $table->integer('TrangThai');
            $table->integer('luot_xem')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sach');
    }
};
