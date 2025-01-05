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
        Schema::create('lichsuhuyhoadon', function (Blueprint $table) {
            $table->id('MaHuy');
            $table->integer('MaHD');
            $table->string('LyDoHuy', 255);
            $table->dateTime('NgayHuy')->default(now());
            $table->string('NguoiHuy', 50);
            // Khóa ngoại
            $table->foreign('MaHD')
                ->references('MaHD')
                ->on('hoadon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lichsuhuyhoadon');
    }
};
