<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaiSachSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('loaisach')->insert([
            [
                'MaLoai' => 1,
                'TenLoai' => 'Văn học',
                'SlugLoai' => 'van-hoc',
                'TrangThai' => 1,
            ],
            [
                'MaLoai' => 2,
                'TenLoai' => 'Khoa học',
                'SlugLoai' => 'khoa-hoc',
                'TrangThai' => 1,
            ],
            [
                'MaLoai' => 3,
                'TenLoai' => 'Kỹ năng sống',
                'SlugLoai' => 'ky-nang-song',
                'TrangThai' => 1,
            ],
        ]);
    }
}
