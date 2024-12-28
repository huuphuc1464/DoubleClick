<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiKhoan extends Model
{
    use HasFactory;

    // Chỉ định tên bảng
    protected $table = 'taikhoan';
    protected $primaryKey = 'MaTK';
    public $timestamps = false;
    public function Role()
    {
        return $this->belongsTo(Role::class, 'MaRole', 'MaRole');
    }
}