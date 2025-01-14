<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThongTinWebsite extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('thongtinwebsite')->insert([
            'ID' => 1,
            'DiaChi' => '65 Huỳnh Thúc Kháng , P. Bến Nghé, Q. 1, TP.HCM',
            'Website' => 'https://www.doubleclick.com',
            'SDT' => '0378386495',
            'Email' => 'trangweb.doubleclick@gmail.com',
            'MoTa' => 'DoubleClick được thành lập vào năm 2024 với mục tiêu mang đến nguồn sách đa dạng và chất lượng cho mọi độc giả. Chúng tôi cam kết cung cấp dịch vụ tốt nhất và luôn lắng nghe ý kiến khách hàng để cải thiện.',
            'MoiGoi' => 'Click mua ngay – Tri thức trong tầm tay!',
            'Logo' => 'logo.jpg',
            'Image' => 'bookwwebsite.avif',
            'Video' => 'herovideo.mp4',
            'Facebook' => 'https://www.facebook.com/doubleclick',
            'Instagram' => 'https://www.instagram.com/go.freelancer',
            'Twitter' => 'https://x.com/duyplus221407',

        ]);
    }
}
