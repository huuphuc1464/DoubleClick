<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichSuHuyHoaDon extends Model
{
    protected $table = 'lichsuhuyhoadon';
    protected $primaryKey = 'MaHuy';
    public $timestamps = false;
    protected $fillable = [
        'MaHD',
        'LyDoHuy',
        'NgayHuy',
        'NguoiHuy'
    ];

    public function hoaDon()
    {
        return $this->belongsTo(HoaDon::class, 'MaHD', 'MaHD');
    }
}
