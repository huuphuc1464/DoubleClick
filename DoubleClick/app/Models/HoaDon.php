<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $table = 'hoadon';
    protected $primaryKey = 'MaHD';
    protected $fillable = [
        'MaTK',
        'NgayLapHD',
        'SDT',
        'DiaChi',
        'TienShip',
        'TongTien',
        'KhuyenMai',
        'PhuongThucThanhToan',
        'MaVoucher',
        'TrangThai'
    ];

    public function chiTietHoaDon()
    {
        return $this->hasMany(chiTietHoaDon::class, 'MaHD');
    }
    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'MaTK', 'MaTK');
    }
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'MaVoucher', 'MaVoucher');
    }
}

