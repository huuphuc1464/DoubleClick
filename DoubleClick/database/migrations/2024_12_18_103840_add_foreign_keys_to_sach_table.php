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
        Schema::table('sach', function (Blueprint $table) {
            $table->foreign(['MaLoai'], 'FK_Sach_LoaiSach')->references(['MaLoai'])->on('loaisach')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sach', function (Blueprint $table) {
            $table->dropForeign('FK_Sach_LoaiSach');
        });
    }
};
