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
        Schema::create('loaisach', function (Blueprint $table) {
            $table->bigIncrements('MaLoai')->primary();
            $table->string('TenLoai', 100);
            $table->string('SlugLoai', 100);
            $table->string('MoTa', 255)->nullable();
            $table->unsignedBigInteger('MaLoaiCha')->nullable();
            $table->integer('TrangThai')->default(1); // 1 = Hoạt động, 0 = Ẩn, 2 = Xóa mềm
            $table->timestamps();

            $table->foreign('MaLoaiCha')->references('MaLoai')->on('loaisach')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loaisach');
    }
};
