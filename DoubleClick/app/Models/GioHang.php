<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    use HasFactory;

    protected $table = 'giohang'; // Tên bảng trong DB
    protected $fillable = ['MaTK', 'MaSach', 'SLMua'];
    public function sach()
    {
        return $this->belongsTo(Sach::class, 'MaSach', 'MaSach');
    }
}
