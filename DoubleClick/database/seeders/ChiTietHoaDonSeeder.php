<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietHoaDonSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('chitiethoadon')->insert([
            [
                'MaHD' => 1,
                'MaSach' => 1,
                'DonGia' => 120000,
                'SLMua' => 2,
                'ThanhTien' => 240000,
                'GhiChu' => null, // Ghi chú để null
                'TrangThai' => 1,
            ],
            [
                'MaHD' => 1,
                'MaSach' => 2,
                'DonGia' => 110000,
                'SLMua' => 1,
                'ThanhTien' => 110000,
                'GhiChu' => null, // Ghi chú để null
                'TrangThai' => 1,
            ],
            [
                'MaHD' => 2,
                'MaSach' => 3,
                'DonGia' => 200000,
                'SLMua' => 2,
                'ThanhTien' => 400000,
                'GhiChu' => null, // Ghi chú để null
                'TrangThai' => 0,
            ],
        ]);
    }
}
