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
        Schema::create('blog', function (Blueprint $table) {
            $table->bigIncrements('MaBlog');
            $table->bigInteger('MaTK')->unsigned()->index('fk_blog_taikhoan');
            $table->dateTime('NgayDang');
            $table->string('TacGia', 50);
            $table->bigInteger('MaDanhMucBlog')->nullable()->unsigned()->index('fk_blog_danhmucblog');
            $table->text('NoiDung'); 
            $table->text('TieuDe'); 
            $table->text('SubTieuDe')->nullable();
            $table->string('AnhBlog', 255)->nullable(); 
            $table->string('Slug', 255)->unique(); 
            $table->integer('TrangThai')->default(1); // Trạng thái bài viết
           

            // Khóa ngoại
            $table->foreign('MaTK')->references('MaTK')->on('taikhoan')->onDelete('cascade');
            $table->foreign('MaDanhMucBlog')
                    ->references('MaDanhMucBlog') // Cột tham chiếu
                    ->on('danhmucblog')          // Bảng tham chiếu
                    ->onDelete('set null');  
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
