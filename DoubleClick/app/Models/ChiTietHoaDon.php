<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    use HasFactory;

    protected $table = 'chitiethoadon'; // Tên bảng
    protected $primaryKey = 'MaHD'; // Khóa chính

    public function hoaDon()
    {
        return $this->belongsTo(HoaDon::class, 'MaHD');
    }

    public function sach()
    {
        return $this->belongsTo(Sach::class, 'MaSach');
    }
}
