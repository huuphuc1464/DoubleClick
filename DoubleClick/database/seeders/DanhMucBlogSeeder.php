<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DanhMucBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('danhmucblog')->insert([
            [
                'TenDanhMucBlog' => 'Công nghệ',
                'SlugDanhMucBlog' => 'cong-nghe',
                'MoTa' => 'Tin tức về công nghệ mới nhất',
                'TrangThai' => 1,
            ],
            [
                'TenDanhMucBlog' => 'Kinh doanh',
                'SlugDanhMucBlog' => 'kinh-doanh',
                'MoTa' => 'Chia sẻ kiến thức kinh doanh',
                'TrangThai' => 1,
            ],
            [
                'TenDanhMucBlog' => 'Sức khỏe',
                'SlugDanhMucBlog' => 'suc-khoe',
                'MoTa' => 'Cẩm nang sức khỏe và đời sống',
                'TrangThai' => 1,
            ],
            [
                'TenDanhMucBlog' => 'Giáo dục',
                'SlugDanhMucBlog' => 'giao-duc',
                'MoTa' => 'Thông tin về giáo dục và học tập',
                'TrangThai' => 1,
            ],
            [
                'TenDanhMucBlog' => 'Du lịch',
                'SlugDanhMucBlog' => 'du-lich',
                'MoTa' => 'Kinh nghiệm và hướng dẫn du lịch',
                'TrangThai' => 1,
            ],
            [
                'TenDanhMucBlog' => 'Bài viết',
                'SlugDanhMucBlog' => 'bai-viet',
                'MoTa' => 'Bài viết về sản phẩm',
                'TrangThai' => 1,
            ],
        ]);
    }
}
