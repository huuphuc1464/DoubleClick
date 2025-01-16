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
            'Title' => 'Khám Phá Thế Giới Sách Cùng DoubleClick',
            'SubTitle' => 'Đa dạng về thể loại, chất lượng đảm bảo - Nơi những trang sách sống động.',
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


            'TenKhach1' => 'Bill Gates',
            'PhanHoi1' => 'DoubleClick mang đến những cuốn sách tuyệt vời cùng dịch vụ xuất sắc. Tôi tin rằng việc phổ cập kiến thức sẽ giúp mọi người có cơ hội thay đổi cuộc sống tốt đẹp hơn, và DoubleClick đang làm được điều đó',

            'TenKhach2' => 'Elon Musk',
            'PhanHoi2' => 'DoubleClick, nơi bạn không chỉ tìm thấy tri thức mà còn là cảm hứng. Một trải nghiệm tuyệt vời! Hãy luôn là chính mình và tiếp tục bùng nổ nhé!',

            'TenKhach3' => 'Sơn Tùng MTP',
            'PhanHoi3' => 'Đơn giản nhưng chất lượng, đó là những gì tôi cảm nhận từ DoubleClick. Tri thức giống như âm nhạc – nó kết nối mọi người. DoubleClick chắc chắn là nơi tôi sẽ quay lại.',

            'TenKhach4' => 'Jack J97',
            'PhanHoi4' => 'DoubleClick làm ăn chất lượng, mình thường mua sách cho bé Sol ở đây'

        ]);
    }
}
