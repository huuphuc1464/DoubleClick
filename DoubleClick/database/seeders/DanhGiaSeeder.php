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
                'MaTK' => 2,
                'SoSao' => 5,
                'DanhGia' => 'Một cuốn sách tuyệt vời!',
                'NgayDang' => '2024-12-01 10:00:00',
            ],
            [
                'MaSach' => 2,
                'MaTK' => 2,
                'SoSao' => 4,
                'DanhGia' => 'Tác phẩm kinh điển, rất hay!',
                'NgayDang' => '2024-12-02 14:30:00',
            ],
            [
                'MaSach' => 3,
                'MaTK' => 2,
                'SoSao' => 3,
                'DanhGia' => 'Câu chuyện hơi dài nhưng rất ý nghĩa.',
                'NgayDang' => '2024-12-03 09:15:00',
            ],
            [
                'MaSach' => 4,
                'MaTK' => 2,
                'SoSao' => 5,
                'DanhGia' => 'Tuyệt vời, cảm động.',
                'NgayDang' => '2024-12-04 18:45:00',
            ],
            [
                'MaSach' => 5,
                'MaTK' => 1,
                'SoSao' => 4,
                'DanhGia' => 'Tuy nhiên hơi khó hiểu đối với người không chuyên.',
                'NgayDang' => '2024-12-05 22:00:00',
            ],
        ]);
        //
    }
}
