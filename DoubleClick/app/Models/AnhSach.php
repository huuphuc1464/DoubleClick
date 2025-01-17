<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnhSach extends Model
{
    use HasFactory;

    // Tên bảng tương ứng trong cơ sở dữ liệu
    protected $table = 'anhsach';

    // Khóa chính của bảng
    protected $primaryKey = 'id';

    // Các cột có thể được gán giá trị hàng loạt (mass assignable)
    protected $fillable = [
        'MaSach',
        'HinhAnh',
    ];

    // Tắt tự động thêm timestamps (created_at, updated_at) nếu không có trong bảng
    public $timestamps = false;

    /**
     * Định nghĩa mối quan hệ với bảng `Sach`
     * Một ảnh thuộc về một sách.
     */
    public function sach()
    {
        return $this->belongsTo(Sach::class, 'MaSach', 'MaSach');
    }
}
