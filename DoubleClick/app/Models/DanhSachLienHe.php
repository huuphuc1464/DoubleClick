<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhSachLienHe extends Model
{
    use HasFactory;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'lienhe';

    // Khóa chính của bảng
        protected $primaryKey = 'MaLienHe';

    // Tắt timestamps nếu bảng không có `created_at` và `updated_at`
    public $timestamps = false;

    // Các cột có thể được gán giá trị
    protected $fillable = [
        'HoTen',      // Tên người dùng
        'Email',      // Email
        'SDT',        // Số điện thoại
        'NoiDung',    // Nội dung liên hệ
        'TrangThai',  // Trạng thái liên hệ
    ];
}
