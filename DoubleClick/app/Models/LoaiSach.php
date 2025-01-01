<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiSach extends Model
{
    use HasFactory;

    protected $table = 'LoaiSach'; // Tên bảng trong cơ sở dữ liệu
    protected $primaryKey = 'MaLoai'; // Khóa chính

    public function sach()
    {
        return $this->hasMany(Sach::class, 'MaLoai', 'MaLoai');
    }
}
