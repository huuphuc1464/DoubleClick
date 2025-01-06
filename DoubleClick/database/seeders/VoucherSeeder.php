<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('voucher')->insert([
            [
                'MaVoucher' => "GIAMGIA50",
                'TenVoucher' => 'Giảm giá 50%',
                'GiamGia' => 50,
                'NgayBatDau' => '2024-12-01',
                'NgayKetThuc' => '2024-12-31',
                'GiaTriToiThieu' => 300000,
                'SoLuong' => 10,
                'TrangThai' => 1,
            ],
            [
                'MaVoucher' => "GIAM20",
                'TenVoucher' => 'Giảm giá 20%',
                'GiamGia' => 20,
                'NgayBatDau' => '2024-12-15',
                'NgayKetThuc' => '2024-12-25',
                'GiaTriToiThieu' => 200000,
                'SoLuong' => 5,
                'TrangThai' => 1,
            ],
        ]);
    }
}
