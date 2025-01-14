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
        Schema::create('danhmucblog', function (Blueprint $table) {
            $table->bigIncrements('MaDanhMucBlog')->primary();
            $table->string('TenDanhMucBlog', 20);
            $table->string('SlugDanhMucBlog', 100);
            $table->string('MoTa', 70)->nullable();
            $table->integer('TrangThai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_muc_blogs');
    }
};
