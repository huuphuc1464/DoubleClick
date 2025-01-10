<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LienHeSeeder extends Seeder
{
    public function run()
    {
        // Dữ liệu mẫu
        DB::table('lienhe')->insert([
            [
                'MaLienHe' => 1,
                'MaKH' => null, // Không có khách hàng liên kết
                'MaNV' => null, // Không có nhân viên liên kết
                'HoTen' => 'Nguyễn Văn A',
                'SDT' => '0901234567',
                'Email' => 'nguyenvana@gmail.com',
                'NoiDung' => 'Xin chào, tôi cần hỗ trợ về đơn hàng.',
                'TrangThai' => 1, // trạng thái 1 là "đã xử lý"
            ],
            [
                'MaLienHe' => 2,
                'MaKH' => null,
                'MaNV' => null,
                'HoTen' => 'Trần Thị B',
                'SDT' => '0912345678',
                'Email' => 'tranthib@gmail.com',
                'NoiDung' => 'Hỏi về thông tin sách "Lược sử loài người".',
                'TrangThai' => 2, //trạng thái 2 là "chưa xử lý"
            ],
            [
                'MaLienHe' => 3,
                'MaKH' => null,
                'MaNV' => null,
                'HoTen' => 'Lê Văn C',
                'SDT' => '0987654321',
                'Email' => 'levanc@gmail.com',
                'NoiDung' => 'Tôi muốn biết thêm thông tin về sản phẩm mới.',
                'TrangThai' => 0, // trạng thái 0 là đang xử lý
            ],
        ]);
    }
}
