<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    // Thiết lập mối quan hệ với bảng taikhoan
    public function taiKhoan()
    {
        return $this->hasMany(TaiKhoan::class, 'MaRole', 'MaRole');
    }
}
