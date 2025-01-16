<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'blog';

    // Khóa chính
    protected $primaryKey = 'MaBlog';

    // Tắt timestamps nếu không sử dụng
    public $timestamps = false;


    // Các cột được phép gán giá trị hàng loạt
    protected $fillable = [
        'MaTK',
        'NgayDang',
        'TacGia',
        'MaDanhMucBlog',
        'NoiDung',
        'TieuDe',
        'Slug',
        'TrangThai',
    ];

    // Liên kết với bảng Tài Khoản
    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'MaTK', 'MaTK');
    }
    // Liên kết với bảng Danh Mục Blog
    public function danhMucBlog()
    {
        return $this->belongsTo(DanhMucBlog::class, 'MaDanhMucBlog', 'MaDanhMucBlog');
    }
    public function sach()
    {
        return $this->belongsTo(Sach::class, 'MaSach', 'MaSach');
    }
}
