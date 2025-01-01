<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiKhoan extends Model
{
    // Chỉ định tên bảng
    protected $table = 'taikhoan';
    protected $primaryKey = 'MaTK';
    public $timestamps = false;
    protected $fillable = [
        'MaTK',
        'TenTK',
        'GioiTinh',
        'NgaySinh',
        'Email',
        'SDT',
        'DiaChi',
        'Image',
        'Username',
        'Password',
        'MaRole',
        'TrangThai'
    ];
    public function role()
    {
        return $this->belongsTo(Role::class, 'MaRole', 'MaRole');
    }
}
