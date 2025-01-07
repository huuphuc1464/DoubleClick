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
        Schema::create('chitiethoadon', function (Blueprint $table) {
            $table->bigInteger('MaHD')->unsigned();
            $table->bigInteger('MaSach')->unsigned()->index('fk_chitiethoadon_sach');
            $table->decimal('DonGia', 10);
            $table->integer('SLMua');
            $table->string('GhiChu', 100)->nullable();
            $table->decimal('ThanhTien', 10);
            $table->integer('TrangThai');

            $table->primary(['MaHD', 'MaSach']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitiethoadon');
    }
};