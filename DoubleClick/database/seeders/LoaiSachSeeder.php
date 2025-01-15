<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaiSachSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('loaisach')->insert([
            // Danh mục cha
            [
                'MaLoai' => 1,
                'TenLoai' => 'Văn học',
                'SlugLoai' => 'van-hoc',
                'MoTa' => 'Các tác phẩm văn học nổi tiếng',
                'MaLoaiCha' => null, // Đây là danh mục gốc
                'TrangThai' => 1,
            ],
            [
                'MaLoai' => 2,
                'TenLoai' => 'Khoa học',
                'SlugLoai' => 'khoa-hoc',
                'MoTa' => 'Các sách khoa học phổ biến',
                'MaLoaiCha' => null, // Đây là danh mục gốc
                'TrangThai' => 1,
            ],
            [
                'MaLoai' => 3,
                'TenLoai' => 'Kỹ năng sống',
                'SlugLoai' => 'ky-nang-song',
                'MoTa' => 'Sách về phát triển kỹ năng sống',
                'MaLoaiCha' => null, // Đây là danh mục gốc
                'TrangThai' => 1,
            ],
            // Danh mục con của Văn học
            [
                'MaLoai' => 4,
                'TenLoai' => 'Tiểu thuyết',
                'SlugLoai' => 'tieu-thuyet',
                'MoTa' => 'Những tiểu thuyết kinh điển',
                'MaLoaiCha' => 1, // Thuộc Văn học
                'TrangThai' => 1,
            ],
            [
                'MaLoai' => 5,
                'TenLoai' => 'Thơ',
                'SlugLoai' => 'tho',
                'MoTa' => 'Các tập thơ hay',
                'MaLoaiCha' => 1, // Thuộc Văn học
                'TrangThai' => 1,
            ],
            // Danh mục con của Khoa học
            [
                'MaLoai' => 6,
                'TenLoai' => 'Thiên văn học',
                'SlugLoai' => 'thien-van-hoc',
                'MoTa' => 'Sách về các khám phá thiên văn học',
                'MaLoaiCha' => 2, // Thuộc Khoa học
                'TrangThai' => 1,
            ],
            [
                'MaLoai' => 7,
                'TenLoai' => 'Sinh học',
                'SlugLoai' => 'sinh-hoc',
                'MoTa' => 'Sách về các nghiên cứu sinh học',
                'MaLoaiCha' => 2, // Thuộc Khoa học
                'TrangThai' => 1,
            ],
        ]);
    }
}
