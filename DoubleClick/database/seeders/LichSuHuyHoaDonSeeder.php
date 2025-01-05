<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LichSuHuyHoaDonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lichsuhuyhoadon')->insert([
            [
                'MaHD' => 3,
                'LyDoHuy' => 'Khách hàng thay đổi ý định',
                'NgayHuy' => now(),
                'NguoiHuy' => 'Người bán',
            ],
            [
                'MaHD' => 8,
                'LyDoHuy' => 'Khách hàng thay đổi ý định',
                'NgayHuy' => now(),
                'NguoiHuy' => 'Người mua',
            ],
            [
                'MaHD' => 11,
                'LyDoHuy' => 'Khách hàng thay đổi ý định',
                'NgayHuy' => now(),
                'NguoiHuy' => 'Người bán',
            ],
            [
                'MaHD' => 12,
                'LyDoHuy' => 'Giao hàng trễ hơn thời gian cam kết',
                'NgayHuy' => now(),
                'NguoiHuy' => 'Người mua',
            ],
        ]);
    }
}