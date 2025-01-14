<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DanhGiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('danhgia')->insert([
            [
                'MaSach' => 1,
                'MaTK' => 1,
                'SoSao' => 5,
                'DanhGia' => 'Cuốn sách rất đặc biệt!',
                'NgayDang' => '2025-01-01 10:00:00',
            ],
            [
                'MaSach' => 1,
                'MaTK' => 2,
                'SoSao' => 4,
                'DanhGia' => 'Tác phẩm rất cuốn hút!',
                'NgayDang' => '2025-01-02 14:00:00',
            ],
            [
                'MaSach' => 3,
                'MaTK' => 3,
                'SoSao' => 3,
                'DanhGia' => 'Câu chuyện rất ý nghĩa.',
                'NgayDang' => '2025-01-03 09:30:00',
            ],
            [
                'MaSach' => 4,
                'MaTK' => 4,
                'SoSao' => 5,
                'DanhGia' => 'Tuyệt vời, cảm động!',
                'NgayDang' => '2025-01-04 18:30:00',
            ],
            [
                'MaSach' => 5,
                'MaTK' => 5,
                'SoSao' => 4,
                'DanhGia' => 'Hơi khó hiểu nhưng đáng đọc.',
                'NgayDang' => '2025-01-05 22:00:00',
            ],
            [
                'MaSach' => 6,
                'MaTK' => 6,
                'SoSao' => 5,
                'DanhGia' => 'Cuốn sách đầy cảm hứng.',
                'NgayDang' => '2025-01-06 12:00:00',
            ],
            [
                'MaSach' => 7,
                'MaTK' => 7,
                'SoSao' => 3,
                'DanhGia' => 'Không đủ sức cuốn hút.',
                'NgayDang' => '2025-01-07 14:30:00',
            ],
            [
                'MaSach' => 8,
                'MaTK' => 8,
                'SoSao' => 4,
                'DanhGia' => 'Một vài chi tiết chưa hợp lý.',
                'NgayDang' => '2025-01-08 08:30:00',
            ],
            [
                'MaSach' => 9,
                'MaTK' => 9,
                'SoSao' => 5,
                'DanhGia' => 'Rất đáng đọc lại!',
                'NgayDang' => '2025-01-09 13:00:00',
            ],
            [
                'MaSach' => 10,
                'MaTK' => 10,
                'SoSao' => 3,
                'DanhGia' => 'Có vài đoạn hơi chán.',
                'NgayDang' => '2025-01-10 16:30:00',
            ],


        ]);
        //
    }
}
