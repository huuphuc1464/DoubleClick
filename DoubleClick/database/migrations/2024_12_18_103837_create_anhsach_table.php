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
        Schema::create('anhsach', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->bigInteger('MaSach')->unsigned()->index('fk_anhsach_sach');
            $table->string('HinhAnh', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anhsach');
    }
};