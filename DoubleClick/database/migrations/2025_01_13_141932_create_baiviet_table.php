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
        Schema::create('baiviet', function (Blueprint $table) {
            $table->bigIncrements('MaBaiViet')->primary();
            $table->string('TenBaiViet', 100);
            $table->string('DanhMucBV', 100);
            $table->mediumText('NoiDungBig');
            $table->mediumText('NoiDungSmall');
            $table->string('Image1', 100);
            $table->string('Image2', 100);
            $table->dateTime('NgayDang');
            $table->string('TenTacGia', 100);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baiviet');
    }
};
