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
        Schema::create('dsyeuthich', function (Blueprint $table) {
            $table->bigInteger('MaTK')->unsigned();
            $table->bigInteger('MaSach')->unsigned()->index('fk_dsyeuthich_sach');

            $table->primary(['MaTK', 'MaSach']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dsyeuthich');
    }
};