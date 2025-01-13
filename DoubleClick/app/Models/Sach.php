<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sach extends Model
{
    protected $table = 'sach';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $primaryKey = 'MaSach';
    protected $fillable = [
        'MaLoai',
        'TenSach',
        'TenNCC',
        'Slug',
        'TenTG',
        'TenBoSach',
        'NXB',
        'ISBN',
        'AnhDaiDien',
        'MoTa',
        'GiaNhap',
        'GiaBan',
        'KhuyenMai',
        'SoLuongTon',
        'TrangThai'
    ];
    public $timestamps = false;
    public function loaiSach()
    {
        return $this->belongsTo(LoaiSach::class, 'MaLoai');
    }

    public function chiTietHoaDon()
    {
        return $this->hasMany(ChiTietHoaDon::class, 'MaSach');
    }
    public function banner()
    {
        return $this->belongsTo(Banner::class, 'MaSach');
    }
}
