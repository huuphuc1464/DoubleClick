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
        Schema::create('chitietphieunhap', function (Blueprint $table) {
            $table->bigInteger('MaPN')->unsigned();
            $table->bigInteger('MaSach')->unsigned()->index('fk_chitietphieunhap_sach');
            $table->integer('SLNhap');
            $table->decimal('DonGia', 10);
            $table->string('GhiChu', 100)->nullable();

            $table->primary(['MaPN', 'MaSach']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietphieunhap');
    }
};