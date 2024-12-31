<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    protected $table = 'chitiethoadon';
    protected $primaryKey = null;
    public $incrementing = false;  // Chỉ định rằng MaHD và MaSach là khóa chính kết hợp
    protected $fillable = [
        'MaHD',
        'MaSach',
        'DonGia',
        'SLMua',
        'GhiChu',
        'ThanhTien',
        'TrangThai'
    ];


    public function hoaDon()
    {
        return $this->belongsTo(HoaDon::class, 'MaHD');
    }

    public function sach()
    {
        return $this->belongsTo(Sach::class, 'MaSach');
    }
}
