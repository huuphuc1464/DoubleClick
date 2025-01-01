<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sach extends Model
{
    use HasFactory;

    protected $table = 'Sach'; // Tên bảng trong cơ sở dữ liệu
    protected $primaryKey = 'MaSach'; // Khóa chính

    public function loaiSach()
    {
        return $this->belongsTo(LoaiSach::class, 'MaLoai', 'MaLoai');
    }
}
