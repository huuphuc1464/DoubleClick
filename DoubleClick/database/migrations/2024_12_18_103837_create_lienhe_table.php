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
            $table->integer('MaLienHe')->primary();
            $table->integer('MaKH')->nullable()->index('fk_lienhe_taikhoankh');
            $table->integer('MaNV')->nullable()->index('fk_lienhe_taikhoannv');
            $table->string('HoTen', 100);
            $table->string('SDT', 11);
            $table->string('Email', 50);
            $table->text('NoiDung');
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
