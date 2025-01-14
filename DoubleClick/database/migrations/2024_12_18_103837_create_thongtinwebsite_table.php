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
        Schema::create('thongtinwebsite', function (Blueprint $table) {
            $table->integer('ID');
            $table->string('DiaChi', 100);
            $table->string('Website', 50);
            $table->string('MoTa', 500);
            $table->string('MoiGoi', 500);
            $table->string('SDT', 11);
            $table->string('Email', 50);
            $table->string('Logo', 100);
            $table->string('Image', 100);
            $table->string('Video', 100);
            $table->string('Facebook', 100)->nullable();
            $table->string('Instagram', 100)->nullable();
            $table->string('Twitter', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thongtinwebsite');
    }
};
