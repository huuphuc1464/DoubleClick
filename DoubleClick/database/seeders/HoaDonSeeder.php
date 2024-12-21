<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HoaDonSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hoadon')->insert([
            [
                'MaHD' => 1,
                'MaTK' => 1,
                'NgayLapHD' => '2024-12-20',
                'SDT' => '0378386495',
                'DiaChi' => '123 Đường ABC, Quận 1, TP. HCM',
                'TienShip' => 20000,
                'TongTien' => 350000,
                'KhuyenMai' => 10,
                'PhuongThucThanhToan' => 'COD',
                'MaVoucher' => null,
                'TrangThai' => 1,
            ],
            [
                'MaHD' => 2,
                'MaTK' => 2,
                'NgayLapHD' => '2024-12-21',
                'SDT' => '0123456789',
                'DiaChi' => '456 Đường DEF, Quận 5, TP. HCM',
                'TienShip' => 30000,
                'TongTien' => 500000,
                'KhuyenMai' => 20,
                'PhuongThucThanhToan' => 'Banking',
                'MaVoucher' => 1,
                'TrangThai' => 0,
            ],
        ]);
    }
}
