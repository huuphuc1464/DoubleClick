<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiSach extends Model
{
    protected $table = 'loaisach';
    protected $primaryKey = 'MaLoai';
    protected $fillable = [
        'TenLoai',
        'SlugLoai',
        'MoTa',
        'TrangThai'
    ];

    public function sach()
    {
        return $this->hasMany(Sach::class, 'MaLoai');
    }
}
