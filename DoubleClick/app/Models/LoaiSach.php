<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiSach extends Model
{
    use HasFactory;

    // Tên bảng
    protected $table = 'loaisach';

    // Khóa chính
    protected $primaryKey = 'MaLoai';

    // Tự động tăng khóa chính
    public $incrementing = true;

    // Loại của khóa chính
    protected $keyType = 'int';

    // Các trường có thể thay đổi
    protected $fillable = [
        'TenLoai',
        'SlugLoai',
        'MoTa',
        'TrangThai',
        'MaLoaiCha', // Thêm trường này để hỗ trợ danh mục cha-con
    ];

    // Quan hệ cha (nhiều danh mục con có thể thuộc về một danh mục cha)
    public function parent()
    {
        return $this->belongsTo(LoaiSach::class, 'MaLoaiCha', 'MaLoai');
    }

    // Quan hệ con (một danh mục có thể có nhiều danh mục con)
    public function children()
    {
        return $this->hasMany(LoaiSach::class, 'MaLoaiCha', 'MaLoai');
    }

    // Quan hệ với sách
    public function sach()
    {
        return $this->hasMany(Sach::class, 'MaLoai', 'MaLoai');
    }
}
