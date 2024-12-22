<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('danhSachLienHe', function (Blueprint $table) {
        $table->string('status')->default('Chưa xử lý')->after('message');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('danhSachLienHe', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
