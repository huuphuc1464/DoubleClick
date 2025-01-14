<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    protected $table = 'danhgia';
    protected $fillable = ['MaTK', 'MaSach', 'SoSao', 'DanhGia', 'NgayDang'];
    protected $primaryKey = ['MaSach', 'MaTK'];
    public $incrementing = false;

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(TaiKhoan::class, 'MaTK', 'MaTK'); // 'MaTK' là khóa ngoại trong bảng 'danhgia'
    }

}
