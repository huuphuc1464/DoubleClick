<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiKhoan extends Model
{
    use HasFactory;

    // Chỉ định tên bảng
    protected $table = 'taikhoan';
    protected $fillable = [
        'TenKH', 'GioiTinh', 'NgaySinh', 'Email', 'SDT', 'DiaChi', 'Image', 'Username', 'Password', 'MaRole', 'TrangThai'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (isset($model->Password)) {
                $model->Password = bcrypt($model->Password); // Mã hóa mật khẩu
            }
        });
    }
}
