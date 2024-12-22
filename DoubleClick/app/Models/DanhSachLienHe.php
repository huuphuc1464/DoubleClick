<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhSachLienHe extends Model
{
    use HasFactory;

    protected $table = 'danhSachLienHe';

    protected $fillable = [
    'name',
    'email',
    'phone',
    'message',
    'status', // Thêm dòng này
];

}
