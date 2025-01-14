<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon; // Thư viện để quản lý ngày giờ

class BaiVietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('baiviet')->insert([
            [
                'TenBaiViet' => 'Giao Hàng Nhanh',
                'DanhMucBV' => 'Vận Chuyển Toàn Cầu',
                'NoiDungBig' => '<p>Trong thế giới ngày càng phẳng và kết nối hiện nay, dịch vụ vận chuyển nhanh toàn cầu đã trở thành một
                    phần không thể thiếu của hoạt động thương mại và cuộc sống hàng ngày. Dù bạn là một doanh nghiệp lớn,
                    một cửa hàng nhỏ hay chỉ là một cá nhân muốn gửi một món quà cho người thân ở nước ngoài, dịch vụ vận
                    chuyển nhanh toàn cầu mang lại sự tiện lợi và hiệu quả chưa từng có.</p>

                <p>Dịch vụ vận chuyển nhanh toàn cầu không chỉ đơn thuần là việc chuyển hàng từ điểm A đến điểm B. Đó là cả
                    một quá trình được tối ưu hóa để đảm bảo rằng hàng hóa của bạn đến đúng nơi, đúng thời gian và trong
                    tình trạng hoàn hảo. Các công ty vận chuyển sử dụng công nghệ tiên tiến, như theo dõi GPS, quản lý kho
                    thông minh và hệ thống giao hàng tự động, để tối ưu hóa quy trình và giảm thiểu sai sót.</p>

                <p>Một trong những ưu điểm lớn nhất của dịch vụ vận chuyển nhanh toàn cầu là thời gian giao hàng. Với các
                    dịch vụ chuyển phát nhanh, hàng hóa có thể được giao trong vòng 24-48 giờ tới hầu hết các địa điểm trên
                    thế giới. Điều này đặc biệt quan trọng đối với các doanh nghiệp cần giao hàng nhanh chóng để đáp ứng nhu
                    cầu của khách hàng và duy trì lợi thế cạnh tranh.</p>',
                'NoiDungSmall' => '<br></br>
                <p>Thêm vào đó, các dịch vụ vận chuyển nhanh toàn cầu còn cung cấp nhiều tiện ích khác như bảo hiểm hàng
                    hóa, dịch vụ hỗ trợ khách hàng 24/7 và các giải pháp đóng gói an toàn. Bạn có thể yên tâm rằng hàng hóa
                    của mình sẽ được chăm sóc một cách tốt nhất từ khi rời khỏi tay bạn cho đến khi đến tay người nhận.</p>

                <p>Tóm lại, dịch vụ vận chuyển nhanh toàn cầu không chỉ mang lại sự tiện lợi mà còn mở ra nhiều cơ hội kinh
                    doanh và kết nối quốc tế. Với sự phát triển không ngừng của công nghệ và mạng lưới vận chuyển, chúng ta
                    có thể mong đợi những dịch vụ ngày càng nhanh chóng, an toàn và hiệu quả hơn nữa trong tương lai.</p>
                <h3><b>Cam Kết của Double Click</b></h3>

                <p><strong> Kết của Double Click</strong>
                    Double Click luôn đặt sự hài lòng của khách hàng lên hàng đầu. Chúng tôi cam kết không chỉ mang đến
                    những đầu sách chất lượng mà còn giao hàng đến tay quý khách một cách nhanh chóng và tiện lợi nhất. Bất
                    kể bạn ở đâu, đội ngũ vận chuyển của chúng tôi sẽ đảm bảo sách được đóng gói kỹ lưỡng và vận chuyển an
                    toàn, đến tay bạn mà không có bất kỳ hư hỏng nào. Hơn nữa, với hệ thống quản lý đơn hàng hiện đại và
                    dịch vụ hỗ trợ khách hàng trực tuyến 24/7, chúng tôi luôn sẵn sàng giải đáp mọi thắc mắc và đảm bảo mỗi
                    đơn hàng được xử lý một cách hiệu quả.</p>
                <h6>Cảm ơn.</h6>',
                'NgayDang' => Carbon::create(2023, 1, 15, 10, 30),
                'Image1' => 'blog05.png',
                'Image2' => 'blog06.png',
                'TenTacGia' => 'Nguyễn Thị Tuyết Nhật',
            ],

            [
                'TenBaiViet' => 'Chương Trình Giảm Giá Sâu Của Double Click',
                'DanhMucBV' => 'Sách Đang Giảm Giá Sốc',
                'NoiDungBig' => ' <p>Chỉ cần một click chuột, bạn đã có thể sở hữu những quyển sách hay với mức giảm giá cực kỳ ưu đãi từ
                    Double Click. Đây là cơ hội tuyệt vời để bạn bổ sung vào tủ sách của mình những tác phẩm giá trị với giá
                    hời.</p>',
                'NoiDungSmall' => '<h3>1. Con Chó Nhỏ Mang Giỏ Hoa Hồng - Giảm 10%</h3>
                <div class="anh" style="display: flex;justify-content:center;"><img
                        src="/img/sach/con-cho-nho-mang-gio-hoa-hong.png" alt="sách" style="width:20%;"></div>

                <p>Nguyễn Nhật Ánh mang đến cho bạn một câu chuyện cảm động về tình bạn và lòng trung thành qua tác phẩm
                    "Con Chó Nhỏ Mang Giỏ Hoa Hồng". Hãy cùng khám phá những điều thú vị trong cuộc sống qua góc nhìn của
                    một chú chó dễ thương. Hiện tại, sách đang được giảm 10%, từ giá gốc 180.000 VND chỉ còn 162.000 VND.
                </p><br></br>
                <h3>2. Nắng Vườn Xưa - Giảm 15%</h3>
                <div class="anh" style="display: flex;justify-content:center;"><img src="/img/sach/nang-vuon-xua.png"
                        alt="sách" style="width:20%;"></div>

                <p>"Nắng Vườn Xưa" của Đoàn Minh Phượng là một tác phẩm thơ ca nhẹ nhàng và sâu lắng, mang đến cho bạn những
                    phút giây thư giãn và tĩnh lặng. Đừng bỏ lỡ dịp sở hữu cuốn sách với mức giảm 15%, từ giá gốc 160.000
                    VND chỉ còn 136.000 VND.
                </p><br></br>
                <h3>3. Giấc Mơ Mỹ: Đường Đến Stanford - Giảm 25%</h3>
                <div class="anh" style="display: flex;justify-content:center;"><img
                        src="/img/sach/giac-mo-my-duong-den-stanford.png" alt="sách" style="width:20%;"></div>

                <p>Một câu chuyện truyền cảm hứng về ước mơ và nỗ lực của Nguyễn Quốc Khánh. "Giấc Mơ Mỹ: Đường Đến
                    Stanford" sẽ mang đến cho bạn những bài học quý giá về cuộc hành trình đến với ngôi trường danh giá nhất
                    thế giới. Đặc biệt, sách đang được giảm sâu 25%, từ giá gốc 170.000 VND chỉ còn 127.500 VND.
                </p><br></br>
                <h3>4. Người Thầy - Giảm 30%</h3>
                <div class="anh" style="display: flex;justify-content:center;"><img src="/img/sach/nguoi-thay.png"
                        alt="sách" style="width:20%;"></div>

                <p>"Người Thầy" của Lê Hoài Nam là một tác phẩm đầy triết lý và nhân văn, giúp bạn nhìn nhận cuộc sống với
                    những góc nhìn mới mẻ. Với mức giảm 30%, từ giá gốc 140.000 VND chỉ còn 98.000 VND, đây là cơ hội không
                    thể tốt hơn để bạn sở hữu cuốn sách ý nghĩa này.
                </p><br></br>
                <p>Hãy nhanh tay đặt hàng để không bỏ lỡ những ưu đãi hấp dẫn này từ <strong> Double Click</strong>. Mỗi
                    cuốn sách không chỉ là một sản phẩm, mà còn là một phần của niềm đam mê và tri thức mà chúng tôi mong
                    muốn chia sẻ cùng bạn</p>
                <h6>Cảm ơn.</h6>',
                'NgayDang' => Carbon::create(2024, 4, 18, 11, 45),
                'Image1' => 'blog07.png',
                'Image2' => 'blog01.png',
                'TenTacGia' => 'Huỳnh Anh Tú',
            ],

            [
                'TenBaiViet' => 'Chất Lượng Sách và Các Nhà Cung Cấp Sách Lớn',
                'DanhMucBV' => 'Chất Liệu In Ấn Tốt',
                'NoiDungBig' => '<p>Việc đảm bảo chất lượng sách là điều vô cùng quan trọng đối với cả nhà xuất bản và người tiêu dùng. Chất
                    lượng sách không chỉ ảnh hưởng đến trải nghiệm đọc mà còn thể hiện sự tôn trọng đối với tác giả và các
                    độc giả trung thành. Dưới đây là một số tiêu chí về chất lượng sách mà các nhà xuất bản và nhà cung cấp
                    sách lớn
                    thường tuân thủ:</p>
                <ul>
                    <li>Giấy In: Giấy in là yếu tố quan trọng quyết định chất lượng của một cuốn sách. Sách chất lượng cao
                        thường sử dụng giấy có độ dày và bền, không bị vàng ố theo thời gian. Vì vậy, các nhà xuất bản lớn
                        thường chọn giấy có chất lượng tốt và thân thiện với môi trường.</li>
                    <li>Mực In: Mực in cũng cần được chọn lựa kỹ càng. Mực in phải rõ ràng, không bị nhòe hay phai màu theo
                        thời
                        gian. Điều này không chỉ giúp nâng cao thẩm mĩ của cuốn sách mà còn bảo vệ mắt người đọc.</li>
                </ul>
                <h3><b>Đóng Sách Chắc Chắn</b></h3>
                <ul>
                    <li>Bìa Sách: Bìa sách là bộ mặt của quyển sách, được thiết kế từ vật liệu chắc chắn để không bị cong
                        vênh,
                        gãy hoặc tách rời trong quá trình sử dụng. Nhiều nhà xuất bản còn sử dụng công nghệ ép kim hoặc bìa
                        cứng
                        để tăng thêm độ bền và thẩm mĩ cho sách.</li>
                    <li>Gáy Sách: Gáy sách được đóng chắc chắn, các trang sách không bị rời rạc hay dính liền vào nhau. Việc
                        cầm
                        nắm, giở sách cần được thực hiện một cách dễ dàng và thoải mái.</li>
                </ul>
                <h3><b>Thiết Kế và Trình Bày</b></h3>
                <ul>
                    <li>Thiết Kế Bìa: Thiết kế bìa sách cần phải đẹp mắt, sáng tạo và phù hợp với nội dung sách. Điều này
                        giúp
                        thu hút độc giả ngay từ cái nhìn đầu tiên.</li>
                    <li>Bố Cục Nội Dung: Bố cục các trang sách được thiết kế hợp lý, phân chia rõ ràng giữa các phần,
                        chương,
                        mục. Điều này giúp người đọc dễ dàng theo dõi nội dung và không cảm thấy rối rắm.</li>
                    <li>Font Chữ: Font chữ cần dễ đọc, kích thước chữ phù hợp, không quá nhỏ hoặc quá to. Điều này đặc biệt
                        quan
                        trọng đối với các tác phẩm văn học dài và sách tham khảo.</li>
                </ul>
                <h3><b>Những Nhà Cung Cấp Sách Lớn</b></h3>',
                'NoiDungSmall' => '<p>Trên thị trường hiện nay, có nhiều nhà cung cấp sách lớn và uy tín, đảm bảo mang đến những đầu sách chất
                    lượng cho độc giả. Một số nhà cung cấp nổi bật có thể kể đến:</p>
                <ul>
                    <h6><b>1. Nhà xuất bản Kim Đồng:</b></h6>
                    <li>Kim Đồng là một trong những nhà xuất bản hàng đầu tại Việt Nam, nổi
                        tiếng với các ấn phẩm dành cho thiếu nhi và thanh thiếu niên. Kim Đồng luôn đảm bảo chất lượng in ấn
                        và biên tập, mang đến những quyển sách vừa hay vừa đẹp mắt cho độc giả nhỏ tuổi.</li>
                    <h6><b>2. Nhà xuất bản Trẻ: </b></h6>
                    <li>Là một cái tên quen thuộc với nhiều độc giả trẻ. Với tiêu chí phát hành
                        những đầu sách mang tính giáo dục và truyền cảm hứng, Nhà xuất bản Trẻ không ngừng nâng cao chất
                        lượng sản phẩm để phục vụ độc giả tốt nhất.</li>
                    <h6><b>3. FAHASA: </b></h6>
                    <li>Không chỉ là nhà phân phối sách hàng đầu mà còn sở hữu hệ thống cửa hàng sách lớn
                        trên toàn quốc. Với tiêu chí "Sách hay, giá hợp lý", FAHASA luôn đảm bảo chất lượng sách từ nguồn
                        cung cấp uy tín và đa dạng chủng loại.</li>
                    <h6><b>4. Nhã Nam: </b></h6>
                    <li>Nổi bật với các đầu sách văn học và tôn giáo. Chất lượng sách của Nhã Nam luôn được
                        đánh giá cao từ việc chọn lọc nội dung đến quy trình sản xuất, đảm bảo mang đến cho độc giả những
                        tác phẩm xuất sắc.</li>
                </ul>
                <p>Việc lựa chọn mua sách từ những nhà cung cấp uy tín và lớn này sẽ giúp bạn có được những trải nghiệm đọc
                    tốt nhất. Hãy luôn kiểm tra và chọn lọc kỹ lưỡng để mỗi quyển sách không chỉ là công cụ học tập và giải
                    trí mà còn là người bạn đồng hành trong cuộc sống.</p>
                <p>Hy vọng bài viết này sẽ giúp bạn hiểu rõ hơn về chất lượng sách và những nhà cung cấp sách lớn trên thị
                    trường hiện nay. Cảm ơn bạn đã đọc và chúc bạn có những trải nghiệm đọc sách tuyệt vời.</p>

                <h6>Cảm ơn.</h6>',
                'NgayDang' => Carbon::create(2024, 3, 20, 19, 45),
                'Image1' => 'blog09.png',
                'Image2' => 'blog08.png',
                'TenTacGia' => 'Nguyễn Thị Tuyết Nhật',
            ],

            [
                'TenBaiViet' => 'Hỗ Trợ Khách Hàng 24/7 - Sự Đảm Bảo Cho Sự Hài Lòng Tuyệt Đối',
                'DanhMucBV' => 'Luôn Bên Bạn Mỗi Khi Bạn Cần',
                'NoiDungBig' => '<p>Trong thế giới ngày càng kết nối số như hiện nay, việc đảm bảo sự hài lòng của khách hàng trở nên quan
                    trọng hơn bao giờ hết. Một trong những yếu tố then chốt mang lại trải nghiệm tuyệt vời cho khách hàng
                    chính là dịch vụ hỗ trợ 24/7. Hỗ trợ khách hàng 24/7 không chỉ giúp giải quyết kịp thời các vấn đề phát
                    sinh mà còn tạo dựng lòng tin và xây dựng mối quan hệ bền vững với khách hàng.</p>
            </div>
            <div class="w3-container">
                <ul>
                    <li>Giải quyết ngay lập tức các vấn đề: Khách hàng có thể gặp vấn đề hoặc cần sự hỗ trợ vào bất kỳ thời
                        điểm nào trong ngày hoặc đêm. Hỗ trợ 24/7 đảm bảo rằng mọi vấn đề sẽ được giải quyết nhanh chóng và
                        kịp thời, giúp khách hàng không phải chờ đợi lâu.</li>
                    <li>Tăng cường sự hài lòng của khách hàng: Khi khách hàng nhận được sự hỗ trợ kịp thời, họ sẽ cảm thấy
                        được quan tâm và chăm sóc. Điều này tạo ra sự hài lòng và lòng tin, từ đó dẫn đến khả năng duy trì
                        và mở rộng lượng khách hàng trung thành.</li>
                    <li>Xây dựng hình ảnh chuyên nghiệp: Dịch vụ hỗ trợ 24/7 thể hiện sự chuyên nghiệp của doanh nghiệp.
                        Khách hàng sẽ cảm thấy an tâm khi biết rằng họ có thể tiếp cận và nhận được sự hỗ trợ bất kỳ lúc
                        nào.</li>
                    <li>Nâng cao trải nghiệm khách hàng: Một dịch vụ hỗ trợ tốt là nền tảng giúp nâng cao trải nghiệm khách
                        hàng. Từ việc giải đáp thắc mắc đến hỗ trợ những vấn đề phức tạp, hỗ trợ 24/7 giúp khách hàng cảm
                        thấy thoải mái và được xướng danh.</li>
                </ul>
                <h3>
                    <p>Các lợi ích tuyệt vời của dịch vụ hỗ trợ 24/7 tại Double Click</p>
                </h3>',
                'NoiDungSmall' => '<ul>
                    <li>Hỗ trợ đa kênh: Double Click cung cấp dịch vụ hỗ trợ qua điện thoại, email, chat trực tuyến, và
                        mạng xã hội. Điều này giúp khách hàng dễ dàng tiếp cận và nhận sự hỗ trợ từ mọi kênh liên lạc.
                    </li>
                    <li>Đội ngũ chuyên nghiệp: Đội ngũ chăm sóc khách hàng của Double Click được đào tạo chuyên nghiệp,
                        am hiểu về sản phẩm và dịch vụ, sẵn sàng giải đáp mọi thắc mắc và hỗ trợ khách hàng trong mọi
                        tình huống.</li>
                    <li>Giải pháp nhanh chóng: Double Click cam kết giải quyết mọi vấn đề của khách hàng một cách nhanh
                        chóng và hiệu quả nhất. Từ việc theo dõi đơn hàng, thay đổi lịch trình giao hàng, đến giải đáp
                        thắc mắc về sản phẩm, chúng tôi luôn sẵn sàng đồng hành cùng bạn.</li>
                    <li>Dịch vụ hỗ trợ tự động: Double Click cũng cung cấp các dịch vụ hỗ trợ tự động như hướng dẫn sử
                        dụng sản phẩm, giải đáp thắc mắc thường gặp thông qua chatbot và các tài liệu hỗ trợ trực tuyến.
                    </li>
                </ul>
                <h6>Cảm ơn.</h6>',
                'NgayDang' => Carbon::create(2025, 20, 04, 1, 30),
                'Image1' => 'blog10.png',
                'Image2' => 'blog11.png',
                'TenTacGia' => 'Nguyễn Thị Tuyết Nhật',
            ],

        ]);
    }
}
