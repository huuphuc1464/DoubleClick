<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthTaiKhoan extends Authenticatable
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

    // Tùy chỉnh trường dùng để xác thực
    public function getAuthIdentifierName()
    {
        return 'Email';
    }

    // Liên kết với Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'MaRole', 'MaRole');
    }
}
