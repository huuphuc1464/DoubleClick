<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog')->insert([
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog'=>6,
                'TieuDe'=>'Giới thiệu cuốn sách: Dế mèn phiêu lưu ký - Tô Hoài',
                'Slug'=>'gioi-thieu-cuon-sach-de-men-phieu-luu-ky',
                'SubTieuDe'=>'<p>Nếu hỏi các bạn trẻ hiện nay ai là nhà văn sáng tác cho tuổi thiếu nhi được yêu thích nhất ở Việt Nam? Có lẽ rằng, câu trả lời sẽ không ai khác ngoài cái tên Tô Hoài. Ông là nhà văn viết rất nhiều tác phẩm hay giành cho thiếu nhi. Dế Mèn phiêu lưu kí có lẽ vẫn là một trong những tác phẩm quen thuộc nhất đối với bao độc giả nhí.</p>',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung'=>'<p>Đây là tác phẩm đầu tay và hay nhất của nhà văn Tô Hoài. Dế Mèn phiêu lưu ký được dịch ra 15 thứ tiếng như Nga, Đức, Hàn Quốc, Thái Lan... Lập kỷ lục tác phẩm học Việt Nam được dịch ra nhiều thứ tiếng nhất. Với sự quan sát tinh tế, nhà văn sử dụng thủ pháp nghệ thuật nhân cách hóa kể về cuộc phiêu lưu sôi nổi, kỳ thú của chú Dế Mèn mới lớn nông nổi mà ham học hỏi chú Dế Mèn mới lớn, tự cao tự đại, xốc nổi, ức hiếp mấy chị Cào Cào, anh Gọng Vó... Chú không chỉ từ chối giúp đỡ mà còn khinh thường Dế Choắt. Vì trò nghịch dại, Dế Mèn gián tiếp giết chết Dế Choắt. Chú ân hận khôn nguôi nhưng khi bọn trẻ con tung hô, chú lại chứng nào tật ấy. "Đi một ngày đàng học một sàng khôn", Dế Mèn dần trưởng thành qua cuộc phiêu lưu xa lắc, xa lơ trên những vùng đất mới lạ. Chú kết thân cùng Dế Trũi, tình huynh đệ thắm thiết, sâu sắc. Trũi mất tích, Dế Mèn thảm thiết gọi to tên em. Lúc đó,chú hiểu rằng cuộc sống rất cần bạn bè thân thích, lúc khó khăn, hoạn nạn cùng sát cánh bên nhau để chú không bị cô độc, lẻ loi.</p>',
                'TrangThai' => 1,
            ],
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog'=>3,
                'TieuDe'=>'"Chăm sóc bản thân thật sự" - Làm cách nào để chăm sóc bản thân đúng cách?',
                'Slug'=>'cham-soc-ban-than-that-su-lam-cach-nao-de-cham-soc-ban-than-dung-cach',
                'SubTieuDe'=>'<p>(Dân trí) - Gần đây, khái niệm "chăm sóc bản thân" tràn ngập khắp mạng xã hội. Song, đâu mới là chăm sóc bản thân thật sự? Và làm thế nào để chăm sóc bản thân đúng cách trong cuộc sống bận rộn?</p>',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung'=>'<b>Sao gọi là chăm sóc bản thân giả tạo?<b/> <p>Trong thời đại công nghiệp tiêu dùng, việc chăm sóc bản thân thường bị đồng nhất với những buổi spa thư giãn, khóa học yoga hay những phương pháp chăm sóc da, dưỡng tóc đắt tiền…</p> <p>Thế nhưng, với vai trò là chuyên gia trong lĩnh vực sức khỏe tâm thần của nữ giới, bác sĩ Pooja Lakshmin nhận ra đây chỉ là những phương pháp "chăm sóc bản thân giả tạo" - một kiểu giải pháp tạm thời nhưng không giải quyết được vấn đề dài hạn.</p> <p>Đơn cử như câu chuyện của Monique, một cô gái 25 tuổi, lớn lên trong một gia đình nhập cư có nếp sống bó buộc, kiểm soát và đặt ra những kỳ vọng rất cao.</p> <p>Vì áp lực, cứ mỗi sáu tháng, Monique lại vung tiền cho một khóa tu dưỡng xa hoa như tập yoga ở Bali, học thiền theo triết lý Phật giáo ở ngoại ô New York, chữa lành cùng ngựa ở Montana… Những chuyến đi giống như lối thoát của Monique nhưng khi quay về, cô lại rơi vào nhịp sống bận rộn và quá tải như trước, để rồi sau đó lại kiệt sức.</p>',
                'TrangThai' => 1,
            ],
        ]);
    }
}
