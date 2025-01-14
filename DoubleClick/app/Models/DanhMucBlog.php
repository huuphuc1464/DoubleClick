<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMucBlog extends Model
{
    use HasFactory;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'danhmucblog';

    // Khóa chính
    protected $primaryKey = 'MaDanhMucBlog';

    // Tắt timestamps nếu không sử dụng
    public $timestamps = false;

    // Các cột được phép gán giá trị hàng loạt
    protected $fillable = [
        'TenDanhMucBlog',
        'SlugDanhMucBlog',
        'MoTa',
        'TrangThai',
    ];

    // Liên kết với bảng Blog
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'MaDanhMucBlog', 'MaDanhMucBlog');
    }
}
