<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('danhSachLienHe', function (Blueprint $table) {
            $table->id(); // Tự động tạo cột ID tự tăng
            $table->string('name'); // Tên người dùng
            $table->string('email'); // Email
            $table->string('phone'); // Số điện thoại
            $table->text('message'); // Nội dung liên hệ
            $table->timestamps(); // Tự động tạo cột created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('danhSachLienHe');
    }
}
