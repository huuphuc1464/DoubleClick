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
        Schema::create('lienhe', function (Blueprint $table) {
            $table->bigIncrements('MaLienHe')->primary();
            $table->bigInteger('MaKH')->unsigned()->nullable()->index('fk_lienhe_taikhoankh');
            $table->bigInteger('MaNV')->unsigned()->nullable()->index('fk_lienhe_taikhoannv');
            $table->string('HoTen', 30);
            $table->string('SDT', 10);
            $table->string('Email', 50);
            $table->string('NoiDung', 500);
            $table->integer('TrangThai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lienhe');
    }
};
