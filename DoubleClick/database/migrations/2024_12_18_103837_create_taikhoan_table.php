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
        Schema::create('taikhoan', function (Blueprint $table) {
            $table->integer('MaTK')->primary();
            $table->string('TenKH', 50);
            $table->string('GioiTinh', 3);
            $table->date('NgaySinh');
            $table->string('Email', 100)->unique('email');
            $table->string('SDT', 11);
            $table->string('DiaChi', 50);
            $table->string('Image', 100);
            $table->string('Username', 30);
            $table->string('Password', 100);
            $table->integer('MaRole')->index('fk_taikhoan_role');
            $table->integer('TrangThai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taikhoan');
    }
};