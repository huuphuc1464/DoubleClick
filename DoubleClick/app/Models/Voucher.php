<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'voucher';

    protected $primaryKey = 'MaVoucher';

    public $timestamps = false;

    protected $fillable = [
        'MaVoucher', 'TenVoucher', 'GiamGia', 'NgayBatDau', 'NgayKetThuc', 'GiaTriToiThieu', 'SoLuong', 'TrangThai'
    ];

    public function hoaDons()
    {
        return $this->hasMany(HoaDon::class, 'MaVoucher', 'MaVoucher');
    }
}
