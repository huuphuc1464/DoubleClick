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
        Schema::create('danhgia', function (Blueprint $table) {
            $table->integer('MaSach')->index('fk_danhgia_sach');
            $table->integer('MaTK');
            $table->integer('SoSao')->nullable();
            $table->string('DanhGia')->nullable();
            $table->dateTime('NgayDang');

            $table->primary(['MaTK', 'MaSach']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danhgia');
    }
};