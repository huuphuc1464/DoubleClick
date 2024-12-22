<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DanhSachLienHe;

class DanhSachLienHeSeeder extends Seeder
{
    public function run()
    {
        // Dữ liệu mẫu
        DanhSachLienHe::create([
            'name' => 'Nguyễn Văn A',       // Tên người dùng
            'email' => 'nguyenvana@example.com', // Email
            'phone' => '0901234567',       // SĐT
            'message' => 'Xin chào, tôi cần hỗ trợ về đơn hàng.', // Nội dung
        ]);

        DanhSachLienHe::create([
            'name' => 'Trần Thị B',
            'email' => 'tranthib@example.com',
            'phone' => '0912345678',
            'message' => 'Hỏi về thông tin sách "Lược sử loài người".',
        ]);

        DanhSachLienHe::create([
            'name' => 'Lê Văn C',
            'email' => 'levanc@example.com',
            'phone' => '0987654321',
            'message' => 'Tôi muốn biết thêm thông tin về sản phẩm mới.',
        ]);
    }
}
