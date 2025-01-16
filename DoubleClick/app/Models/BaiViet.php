<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    protected $table = 'baiviet';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $primaryKey = 'MaBaiViet';
    protected $fillable = [
        'MaBaiViet',
        'TenBaiViet',
        'DanhMucBV',
        'NoiDungBig',
        'NoiDungSmall',
        'Image1',
        'Image2',
        'NgayDang',
        'TenTacGia'
    ];
}
