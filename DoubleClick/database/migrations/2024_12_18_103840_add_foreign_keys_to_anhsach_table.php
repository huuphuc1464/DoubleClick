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
        Schema::table('anhsach', function (Blueprint $table) {
            $table->foreign(['MaSach'], 'FK_AnhSach_Sach')->references(['MaSach'])->on('sach')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anhsach', function (Blueprint $table) {
            $table->dropForeign('FK_AnhSach_Sach');
        });
    }
};
