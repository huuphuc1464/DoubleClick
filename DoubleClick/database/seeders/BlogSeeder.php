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
            //Bài viết về sản phẩm
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog'=>6,
                'TieuDe'=>'Giới thiệu cuốn sách: Dế mèn phiêu lưu ký - Tô Hoài',
                'Slug'=>'gioi-thieu-cuon-sach-de-men-phieu-luu-ky',
                'SubTieuDe'=>'Nếu hỏi các bạn trẻ hiện nay ai là nhà văn sáng tác cho tuổi thiếu nhi được yêu thích nhất ở Việt Nam? Có lẽ rằng, câu trả lời sẽ không ai khác ngoài cái tên Tô Hoài. Ông là nhà văn viết rất nhiều tác phẩm hay giành cho thiếu nhi. Dế Mèn phiêu lưu kí có lẽ vẫn là một trong những tác phẩm quen thuộc nhất đối với bao độc giả nhí.',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung'=>'<p>Đây là tác phẩm đầu tay và hay nhất của nhà văn Tô Hoài. Dế Mèn phiêu lưu ký được dịch ra 15 thứ tiếng như Nga, Đức, Hàn Quốc, Thái Lan... Lập kỷ lục tác phẩm học Việt Nam được dịch ra nhiều thứ tiếng nhất. Với sự quan sát tinh tế, nhà văn sử dụng thủ pháp nghệ thuật nhân cách hóa kể về cuộc phiêu lưu sôi nổi, kỳ thú của chú Dế Mèn mới lớn nông nổi mà ham học hỏi chú Dế Mèn mới lớn, tự cao tự đại, xốc nổi, ức hiếp mấy chị Cào Cào, anh Gọng Vó... Chú không chỉ từ chối giúp đỡ mà còn khinh thường Dế Choắt. Vì trò nghịch dại, Dế Mèn gián tiếp giết chết Dế Choắt. Chú ân hận khôn nguôi nhưng khi bọn trẻ con tung hô, chú lại chứng nào tật ấy. "Đi một ngày đàng học một sàng khôn", Dế Mèn dần trưởng thành qua cuộc phiêu lưu xa lắc, xa lơ trên những vùng đất mới lạ. Chú kết thân cùng Dế Trũi, tình huynh đệ thắm thiết, sâu sắc. Trũi mất tích, Dế Mèn thảm thiết gọi to tên em. Lúc đó,chú hiểu rằng cuộc sống rất cần bạn bè thân thích, lúc khó khăn, hoạn nạn cùng sát cánh bên nhau để chú không bị cô độc, lẻ loi.</p>',
                'TrangThai' => 1,
                'MaSach'=> 1,
            ],
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog'=>6,
                'TieuDe'=>'GIỚI THIỆU CUỐN SÁCH: “TẮT ĐÈN” - NGÔ TẤT TỐ',
                'Slug'=>'gioi-thieu-cuon-sach-tat-den-ngo-tat-to',
                'SubTieuDe'=>'',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung'=>'<p>Vào thập niên 30 của thế kỉ XX đã ghi dấu những trang vẻ vang, rực rỡ nhất trong lịch sử hiện đại của văn học nước nhà với sự xuất hiện của ba trào lưu “hiện thực” “lãng mạn” và “thơ mới”. Mỗi trào lưu trong thời điểm này đều đã có những cống hiến nhất định của các thế hệ nhà văn, nhà thơ. Cùng với nhiều tác giả khác, Ngô Tất Tố đã có những tác phẩm để lại nhiều tiếng vang. Đặc biệt, gắn liền với sự nghiệp sáng tác các tác phẩm theo trào lưu hiện đại của ông là tiểu thuyết đầu tay “Tắt đèn”.</p><p>Đây là một kiệt tác thành công nhất, có giá trị nhất của nhà văn Ngô Tất Tố, là một trong những tác phẩm xuất sắc nhất trong dòng văn học hiện thực của văn chương nước ta giai đoạn 1930 - 1945. Trào lưu văn học hiện đại là dòng văn học tái hiện xã hội hiện thực lúc bấy giờ. Một mặt là ca ngợi cái đẹp, cái tốt, cái đáng nêu gương còn mặt khác là phê phán tình hình xã hội.</p><p>Cũng như các phẩm cùng thể loại, tiểu thuyết “Tắt đèn” nói về số phận đau khổ của người dân quê - một người đàn bà nhà quê An Nam suốt đời sống trong sự nghèo khó và ức hiếp của bọn cường hào ác bá nhưng luôn hết lòng vì chồng con.</p><p>Ngay từ khi ra đời, “Tắt đèn” đã tạo ra tiếng vang và thu hút được đông đảo sự quan tâm của đồng nghiệp. Tác phẩm được đánh giá là “một thiên tiểu thuyết có luận đề xã hội, một áng văn có thể gọi là kiệt tác chưa từng thấy”, và được khẳng định là “nhờ giỏi Hán học và am hiểu thôn quê nên không ai khác, chính Ngô Tất Tố là người có đủ tư cách và đủ thẩm quyền để viết Tắt đèn”.</p><p>  “Tắt đèn. Tôi đã bật đèn lên đọc hết cuốn truyện đó rồi. Trong nửa giờ. Hay lắm! Nên đọc. Trong rừng văn, một cuốn tiểu thuyết như thế thực hiếm. Tắt đèn đứng vào hàng những cuốn tiểu thuyết có giá trị trong văn chương Việt Nam. “Tôi không chắc sau này có cuốn nào hơn nó không, nhưng tôi dám quyết trước nó chưa có cuốn nào”. Đó là những lời đánh giá về tác phẩm này.</p><p>    Tác phẩm này cũng đã được nhiều nhà văn nước ngoài đọc và dịch ra nhiều thứ tiếng như: Tiếng Nga (1958), tiếng Pháp (1959), tiếng Anh (1960), tiếng Hungary (1984), tiếng Trung Quốc (2005). “Tắt đèn” đã chuyển thể thành phim Chị Dậu (1980).</p><p>    Hàng chục năm qua, tác phẩm Tắt đèn đã được “Nhóm nghiên cứu và Biên soạn về Ngô Tất Tố” (lưu giữ và quản lí toàn bộ sự nghiệp của tác giả) đã dày công sưu tầm, nghiên cứu, khảo dị, chú giải …Vào năm 2003, tác phẩm “Tắt đèn” được in, là bản đặc biệt được khôi phục từ nguyên bản với ý kiến của chính tác giả. Cuốn truyện gồm 279 trang với 4 phần:</p><ul><li>Phần đầu tiên là lời Nhà xuất bản giới thiệu về việc xuất bản và gìn giữ tác phẩm</li><li>Tiếp theo là lời giới thiệu khá đầy đủ và khái quát về tác phẩm cùng với hình ảnh về tác phẩm.</li><li>Phần quan trọng nhất của tiểu thuyết chính là nội dung gồm 221 trang kèm theo chú thích.</li><li>Cuối cùng là phần phụ lục, trích những phần đã đăng trên các báo trước đây.</li></ul><p>  Toàn bộ cuốn sách sẽ mang lại cho bạn đọc nhiều sự hiểu biết và góc nhìn toàn diện về tác phẩm “Tắt đèn”. Kính mời các thầy cô và toàn thể các học sinh tìm đọc cuốn sách “Tắt đèn” của Ngô Tất Tố trên thư viện nhà trường.</p>',
                'TrangThai' => 1,
                'MaSach'=> 2,
            ],
            //2
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog'=>6,
                'TieuDe'=>'“Những người khốn khổ”- sự vĩ đại của những cuộc đời giản dị...',
                'Slug'=>'nhung-nguoi-khon-kho-su-vi-dai-cua-nhung-cuoc-doi-gian-di',
                'SubTieuDe'=>'(Dân trí)- Trong 150 năm qua, "Những người khốn khổ" của Victor Hugo đã khẳng định giá trị của một tác phẩm văn học vĩ đại bậc nhất. Sự vĩ đại nằm ở chính những số phận tầm thường, cơ cực...',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung'=>'<p>Trong 150 năm qua, Những người khốn khổ đã được dịch sang rất nhiều ngôn ngữ khác nhau, được chuyển thể thành hàng chục tác phẩm điện ảnh, những vở nhạc kịch, vở múa ballet... Vở nhạc kịch Les Misérables hiện đang giữ kỷ lục là vở diễn lâu đời thường xuyên được diễn lại trên các sân khấu lớn của thế giới như tại West End (Anh) hay Broadway (Mỹ). Tháng 12 năm nay, bộ phim nhạc kịch Les Misérables sẽ được công chiếu tại Anh và tháng 1/2013 sẽ công chiếu tại Mỹ.</p><p>Những người khốn khổ (Les Misérables) của đại văn hào Pháp Victor Hugo xuất bản lần đầu năm 1862 là một trong những tiểu thuyết nổi tiếng nhất của văn học thế giới. Nhân vật chính của tiểu thuyết là Giăng Van-Giăng, một cựu tù khổ sai tìm cách chuộc lại những lỗi lầm thời trai trẻ.</p><p>Những người khốn khổ có nhiều nhân vật phụ với những mảnh đời khác nhau. Sợi dây nối những mảnh đời này lại là Giăng Vangiăng, người cựu tù khổ sai cố gắng sống một cuộc đời tốt đẹp nhưng không thể thoát khỏi quá khứ của mình.</p><p>Những người khốn khổ là tiểu thuyết mang tính hiện thực, sử thi, có tầm bao quát xã hội và cũng là bài ca về tình yêu. Xét về hiện thực, tiểu thuyết miêu tả thế giới của những con người nghèo khổ một cách chân thực. Trên khía cạnh sử thi, tác phẩm đã miêu tả những sự kiện lịch sử quan trọng của nước Pháp, đã khắc họa những xung đột lớn lao bên trong tâm hồn con người, giữa cái Thiện và cái Ác bên trong Giăng Vangiăng, giữa sự tôn trọng luật pháp và tôn trọng đạo lý làm người trong Giave.</p><p>Những người khốn khổ có số lượng nhân vật nữ đông đảo, mỗi nhân vật mang một ý nghĩa riêng. Sự xuất hiện của họ ám ảnh độc giả một cách sâu xa và thấm thía.</p><p>Nói đến nhân vật nữ trong Những người khốn khổ, người ta nghĩ ngay đến Phăngtin. Phăngtin có vẻ đẹp thanh khiết, đoan trang, trong sáng. Nhưng nhớ đến Phăngtin, người ta không đến sắc đẹp , mà nhớ đến tình mẫu tử thiêng liêng của nàng. Một phụ nữ trẻ bán tóc, bán răng để con có áo mặc, có tiền chữa bệnh.</p><p>Người phụ nữ khốn khổ ấy vì con, cuối cùng đã phải tự nhủ "đành bán nốt vậy" và làm gái điếm. Giữa cảnh bùn nhơ, nàng sáng ngời như một biểu tượng của tình mẫu tử thiêng liêng. Phăngtin còn là biểu tượng của sự sa đoạ, nhục nhằn, bị lạm dụng rồi bị ruồng bỏ - thân phận của những người phụ nữ bất hạnh xưa nay. Nàng không có họ, bởi "đừng hỏi tên họ của một kẻ đi xin chỗ trú thân" - họ là cái "vô danh" trong cái "vô biên" của cuộc đời. "Nàng hứng một cái tên như người ta hứng một giọt mưa trên trời rơi xuống".</p>',
                'TrangThai' => 1,
                'MaSach'=> 4,
            ],
            //3
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog'=>6,
                'TieuDe'=>'Nội dung chính của thuyết tương đối rộng của Einstein',
                'Slug'=>'noi-dung-chinh-cua-thuyet-tuong-doi-rong-cua-einstein',
                'SubTieuDe'=>'Thuyết tương đối rộng cho rằng lực hấp dẫn là do sự biến dạng của hình học không gian và thời gian nên trường hấp dẫn ảnh hưởng đến phép đo thời gian và khoảng cách. Đó là thuyết hấp dẫn do Einstein (Anh-xtanh) thiết lập bằng ngôn ngữ hình học năm 1915. Nó tích hợp thuyết tương đối hẹp và định luật vạn vật hấp dẫn của Newton đã thay đổi lực hấp dẫn để mô tả không-thời gian bị cong bởi vật chất và năng lượng trong không-thời gian, thay thế quan điểm truyền thống cho rằng lực hấp dẫn là một lực.',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung'=>'<b>Nội dung chính của thuyết tương đối rộng​</b><p><b>1. Bản chất của lực hấp dẫn. </b>Thuyết tương đối rộng cho rằng lực hấp dẫn không phải là một lực mà do độ cong của không-thời gian mà vật thể nằm trong đó gây ra, vật thể chuyển động theo con đường ngắn nhất trong không-thời gian cong này. Con đường được gọi là một đường trắc địa, và khái niệm này khác với khái niệm trọng lực trong cơ học Newton. Trong cơ học Newton, lực hấp dẫn được cho là do lực tương tác giữa các vật thể gây ra.</p><p><b>2. Độ cong của không-thời gian. </b>Thuyết tương đối rộng cho rằng khối lượng và năng lượng sẽ làm cong không-thời gian. Độ cong này là do khối lượng và năng lượng của các vật thể gây ra. Độ cong này có thể quan sát và kiểm chứng thông qua các thí nghiệm như thấu kính hấp dẫn. Trong không-thời gian cong thì đường chuyển động của vật không còn là đường thẳng nữa mà chuyển động theo đường trắc địa.</p><p><b>3. Nguyên lý tương đương.</b>Nguyên lý tương đương trong thuyết tương đối rộng chỉ ra rằng một vật rơi tự do dường như không có trọng lực, bởi vì vật và không-thời gian xung quanh cùng cong với nhau nên quỹ đạo chuyển động của vật xem như là một đường thẳng. Khái niệm này tương tự như nguyên lý tương đương trong cơ học Newton.</p><p><b>4. Sự bóp méo không-thời gian và sóng hấp dẫn.</b>Theo thuyết tương đối rộng, khi các vật thể tăng tốc sẽ sinh ra sóng hấp dẫn, đây là hiệu ứng bóp méo không-thời gian, loại sóng hấp dẫn này có thể quan sát và kiểm chứng bằng thực nghiệm chẳng hạn như giao thoa kế laser. Khám phá này là một thành tựu lớn của thuyết tương đối rộng và là một khám phá lớn trong lĩnh vực vật lý.</p><p><b>5. Hố đen.</b>Thuyết tương đối rộng cho rằng khi khối lượng và năng lượng của vật thể đạt đến một mức nhất định thì sẽ hình thành hố đen, hố đen là một thiên thể rất đặc biệt, lực hấp dẫn của nó mạnh đến mức thậm chí ánh sáng không thoát ra được.</p><b>Những thành tựu chính của Einstein​</b><p>Einstein là một trong những nhà khoa học vĩ đại nhất của thế kỷ 20 và được mệnh danh là "Cha đẻ của Vật lý hiện đại". Các lý thuyết và ý tưởng của ông không chỉ ảnh hưởng sâu sắc đến toàn bộ lĩnh vực vật lý mà còn có tác động sâu sắc đến triết học, văn hóa, chính trị và các lĩnh vực khác. Đặt nền móng, ông cũng đề xuất thuyết tương đối hẹp và thuyết tương đối rộng, những lý thuyết đã cách mạng hóa sự hiểu biết của chúng ta về thời gian và không gian và trở thành một phần không thể thiếu của vật lý hiện đại.</p><p>Thuyết tương đối hẹp là một trong những lý thuyết sớm nhất do Einstein đề xuất. Nó chủ yếu nghiên cứu tính chất vật lý của các vật thể chuyển động. Thuyết tương đối hẹp chỉ ra rằng thời gian và không gian là tương đối, không phải tuyệt đối và tốc độ ánh sáng là không đổi trong bất kỳ hệ quy chiếu nào. Hằng số, lý thuyết này đã giải quyết một số mâu thuẫn và mâu thuẫn trong cơ học Newton và trở thành nền tảng của vật lý hiện đại.</p><p>Thuyết tương đối rộng, một trong những lý thuyết nổi tiếng hơn của Einstein, đề cập đến sự tương tác của lực hấp dẫn và vật chất. Thuyết tương đối rộng phát biểu rằng lực hấp dẫn là do độ cong của không thời gian khi các vật thể uốn cong, và lý thuyết này giải thích nhiều hiện tượng trong thiên văn học và vũ trụ học, chẳng hạn như lỗ đen và vũ trụ giãn nở.</p><p>Ngoài những lý thuyết này, Einstein còn đề xuất nguyên lý nổi tiếng về sự tương đương giữa khối lượng và năng lượng, đó là E=mc². Công thức này cho thấy khối lượng và năng lượng có thể chuyển hóa lẫn nhau. Công thức này có những ứng dụng quan trọng không chỉ trong vật lý, mà còn mà còn trong năng lượng hạt nhân. Einstein cũng đóng một vai trò quan trọng trong các lĩnh vực chính trị và xã hội. Ông là một người theo chủ nghĩa hòa bình nhiệt thành, phản đối việc sử dụng chiến tranh và vũ khí. Ông từng gửi thư cho Tổng thống Mỹ Roosevelt, nhắc nhở ông không được phát triển bom nguyên tử kêu gọi cộng đồng quốc tế giải quyết các tranh chấp bằng biện pháp hòa bình.</p>',
                'TrangThai' => 1,
                'MaSach'=> 5,
            ],
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog'=>6,
                'TieuDe'=>'Chiến Tranh Và Hòa Bình - Leo Tolstoy',
                'Slug'=>'chien-tranh-va-hoa-binh-le-tolstoy',
                'SubTieuDe'=>'Một bài ca tuổi trẻ bi hùng, khiến tôi khao khát được cống hiến..',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung'=>'<p> Chiến tranh và hòa bình - một tác phẩm mà ắt hẳn trong đời ai ai cũng sẽ vô tình đọc qua hay nhắc tới, đây là tác phẩm văn học mà đại thi hào người Nga, Lev Tolstoy chắp bút viết lên. Thật biết ơn ông khi ông đã tạo ra một khúc ca bi tráng nhưng cũng hào hùng và thấm đẫm sức sống của người trẻ sống trong cảnh chiến tranh loạn lạc.</p> <p>Mỗi người một câu chuyện, mỗi người có một số phận, nhưng chung quy lại, họ vẫn là những con người trẻ, là nhựa sống của đất nước, với những trái tim luôn rực cháy niềm tin yêu vào cuộc sống, vào hạnh phúc, và không bao giờ biết chùn bước với những khó khăn xuất hiện trong đời mình.</p><p>Tác phẩm mở màn bằng bức tranh của tầng lớp quý tộc Nga tại kinh kỳ Sankt-Peterburg-cố đô của đế quốc Nga, họ tụ họp tại đây để bàn về Hoàng đế Napoleon I và cuộc chiến tranh chống Pháp mà Nga sắp đối diện. Công tước Andrei Bolkonsky, một người đẹp trai, giàu có và chuẩn bị đón thành viên sắp chào đời của gia đình cùng với cô vợ Lisa xinh đẹp, nhỏ nhắn. Còn có Pierre, người con trai nuôi của bá tước Bezoukhov. Hai người, tuy một trầm lắng có nguyên tắc, một phóng khoáng và thích tham gia vào các cuộc vui thâu đêm suốt sáng, song họ vẫn thân với nhau rất nhanh.</p> <p>Công tước Andrei chán ghét sự tẻ nhạt của cuộc sống hiện tại nên chàng quyết tâm ghi danh vào quân đội, với mong muốn cống hiến sức mình cho quốc gia, và được gặp thần tượng của mình là Napoleon I. Song sau tất cả những gì chàng trải qua ở chiến trường, những điều đó đã hoàn toàn thay đổi. Cùng với cái chết của người vợ sau khi sinh đứa con đầu lòng chưa được bao lâu đã làm cho chàng thay đổi, chàng quyết định sống ẩn dật.</p> <p>Tôi cảm thấy như công tước Andrei cũng là hình mẫu của một số người trẻ trong ngày nay. Mọi thứ họ mong muốn, so với thực tế, không phải bao giờ cũng như họ muốn. Người thì sẽ chọn cách lui về một nơi nào đó cũng như chàng, sống yên lặng không sóng gió, song cũng sẽ có những người không chọn cách đó, mà họ sẽ tự chọn cho mình một con đường đi khác cho mình.Điển hình là Pierre, sau cuộc hôn nhân bất thành với Helena - một cô gái nhìn đạo mạosong lại có lối sống quá buông thả, chàng đã gia nhập hội Tam Điểm, với mong muốn làm những việc có ích cho đời.</p><p>Nhưng mọi sự trên đời này, nếu kết thúc quá sớm và yên bình như công tước Andrei thì cũng thật tẻ nhạt mọi người nhỉ. Trong một lần qua nhà bá tước Rostov, chàng đã gặp được Natasha,chính tâm hồn trong sáng và ngây thơ của nàng đã đánh thức con người chàng.</p><p>Chàng lại trở về là một Andrei của trước kia, nhìn trầm lắng nhưng luôn có những khát vọng cháy bỏng. Nhưng mọi chuyện không hề có một cái kết đẹp cho cặp đôi, Andrei tử trận và ra đi sau khi đã cầu nguyện cho đứa con trai của mình.</p><p>Song không vì thế mà câu chuyện kết thúc nhanh như thế được, về sau Natasha và Pierre đã nên duyên vợ chồng và có được một cuộc sống hạnh phúc bên nhau.Dù thời gian không quá dài nhưng cũng đủ để gắn kết hai tâm hồn đã bị tổn thương quá nhiều đến với nhau, và cho nhau cả quãng đời còn lại. Bỏ lại sau lung những kỷ niệm không vui, những ký ức về sự phản bội, sự ra đi của người thân, giờ chỉ còn lại sự hạnh phúc của gia đình và tận hưởng nhữngtháng năm bên nhau.</p><p>Tác phẩm này thật sự đã gây cho tôi một xúc cảm mạnh về sự mãnh liệt trong tâm hồn, của khát khao được cống hiến của những người trẻ Nga thời chiến, nhưng cũng đủ sức làm tôi mê hoặc bởi những câu chuyện về tình người, tình yêu dù có buồn hay đẹp, có ngắn có dài, nhưng đủ để tôi lưu luyến cả một đời.</p><p>Cảm ơn đại thi hào Lev Tolstoy đã tạo ra tác phẩm này, để cho mọi người được biết thế nào là một tác phẩm hào hùng của bài ca tuổi trẻ.</p>',
                'TrangThai' => 1,
                'MaSach'=> 3,
            ],
            // Bài blog mã 2 (Kinh doanh)
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog' => 2, // Kinh doanh
                'TieuDe' => 'Sách kinh doanh hàng đầu cho năm 2025',
                'Slug' => 'sach-kinh-doanh-hang-dau-cho-nam-2025',
                'SubTieuDe' => 'Kinh doanh bền vũng,..',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung' => '<p>Trong năm 2025, có rất nhiều cuốn sách kinh doanh đáng chú ý sẽ giúp bạn nâng cao kỹ năng và tư duy kinh doanh. Từ những nguyên lý cơ bản về quản trị doanh nghiệp cho đến các chiến lược marketing và đổi mới sáng tạo, những cuốn sách này sẽ cung cấp cho bạn những kiến thức quý báu để phát triển sự nghiệp và doanh nghiệp của mình. Hãy cùng khám phá những cuốn sách sẽ thay đổi cách bạn làm kinh doanh trong năm nay.</p>',
                'TrangThai' => 1,
                'MaSach'=> null,
            ],

            // Bài blog mã 3 (Sức khỏe)
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog' => 3, // Sức khỏe
                'TieuDe' => 'Làm thế nào để duy trì sức khỏe tốt trong mùa đông?',
                'Slug' => 'lam-the-nao-de-duy-tri-suc-khoe-tot-trong-mua-dong',
                'SubTieuDe' => '',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung' => '<p>Mùa đông là thời gian cơ thể dễ bị ảnh hưởng bởi các yếu tố thời tiết lạnh giá, gây ra các vấn đề về sức khỏe như cảm cúm, đau khớp và giảm sức đề kháng. Để duy trì sức khỏe tốt trong mùa đông, bạn cần tăng cường sức đề kháng, ăn uống đủ chất dinh dưỡng, giữ ấm cơ thể và tham gia các hoạt động thể dục. Ngoài ra, việc uống đủ nước và nghỉ ngơi hợp lý cũng là yếu tố quan trọng giúp cơ thể khỏe mạnh trong mùa đông.</p>',
                'TrangThai' => 1,
                'MaSach'=> null,
            ],
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog'=>3,
                'TieuDe'=>'"Chăm sóc bản thân thật sự" - Làm cách nào để chăm sóc bản thân đúng cách?',
                'Slug'=>'cham-soc-ban-than-that-su-lam-cach-nao-de-cham-soc-ban-than-dung-cach',
                'SubTieuDe'=>'(Dân trí) - Gần đây, khái niệm "chăm sóc bản thân" tràn ngập khắp mạng xã hội. Song, đâu mới là chăm sóc bản thân thật sự? Và làm thế nào để chăm sóc bản thân đúng cách trong cuộc sống bận rộn?',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung'=>'<b>Sao gọi là chăm sóc bản thân giả tạo?<b/> <p>Trong thời đại công nghiệp tiêu dùng, việc chăm sóc bản thân thường bị đồng nhất với những buổi spa thư giãn, khóa học yoga hay những phương pháp chăm sóc da, dưỡng tóc đắt tiền…</p> <p>Thế nhưng, với vai trò là chuyên gia trong lĩnh vực sức khỏe tâm thần của nữ giới, bác sĩ Pooja Lakshmin nhận ra đây chỉ là những phương pháp "chăm sóc bản thân giả tạo" - một kiểu giải pháp tạm thời nhưng không giải quyết được vấn đề dài hạn.</p> <p>Đơn cử như câu chuyện của Monique, một cô gái 25 tuổi, lớn lên trong một gia đình nhập cư có nếp sống bó buộc, kiểm soát và đặt ra những kỳ vọng rất cao.</p> <p>Vì áp lực, cứ mỗi sáu tháng, Monique lại vung tiền cho một khóa tu dưỡng xa hoa như tập yoga ở Bali, học thiền theo triết lý Phật giáo ở ngoại ô New York, chữa lành cùng ngựa ở Montana… Những chuyến đi giống như lối thoát của Monique nhưng khi quay về, cô lại rơi vào nhịp sống bận rộn và quá tải như trước, để rồi sau đó lại kiệt sức.</p>',
                'TrangThai' => 1,
                'MaSach'=> null,
            ],
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog' => 3, // Sức khỏe
                'TieuDe' => 'Tập thể dục hiệu quả tại nhà',
                'Slug' => 'tap-the-duc-hieu-qua-tai-nha',
                'SubTieuDe' => '',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung' => '<p>Tập thể dục tại nhà là lựa chọn lý tưởng cho những ai không có thời gian đến phòng gym hoặc yêu thích sự tiện lợi. Bạn có thể thực hiện nhiều bài tập thể dục hiệu quả ngay tại nhà mà không cần dụng cụ chuyên dụng, từ bài tập cardio cho đến các bài tập tăng cường sức mạnh. Tập thể dục không chỉ giúp cơ thể khỏe mạnh mà còn giảm căng thẳng, cải thiện tâm trạng và năng suất làm việc trong suốt ngày dài.</p>',
                'TrangThai' => 1,
                'MaSach'=> null,
            ],

            // Bài blog mã 4 (Giáo dục)
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog' => 4, // Giáo dục
                'TieuDe' => 'Các phương pháp học tập hiệu quả cho học sinh',
                'Slug' => 'cac-phuong-phap-hoc-tap-hieu-qua-cho-hoc-sinh',
                'SubTieuDe' => '',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung' => '<p>Để học sinh có thể tiếp thu kiến thức hiệu quả, việc áp dụng các phương pháp học tập khoa học là vô cùng quan trọng. Một số phương pháp như học nhóm, học qua hình ảnh, và sử dụng công nghệ hỗ trợ học tập đang trở thành xu hướng hiện nay. Bên cạnh đó, học sinh cũng cần biết cách lập kế hoạch học tập hợp lý, tránh bị xao nhãng và tạo ra môi trường học tập tích cực để đạt được kết quả học tập cao nhất.</p>',
                'TrangThai' => 1,
                'MaSach'=> null,
            ],
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog' => 4, // Giáo dục
                'TieuDe' => 'Khám phá các nguồn tài liệu học tập trực tuyến',
                'Slug' => 'kham-pha-cac-nguon-tai-lieu-hoc-tap-truc-tuyen',
                'SubTieuDe' => '',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung' => '<p>Học trực tuyến đang trở thành một phương thức học tập phổ biến trong thời đại công nghệ hiện nay. Các nguồn tài liệu học tập trực tuyến phong phú và đa dạng từ video, bài giảng đến các ứng dụng học tập giúp học sinh và sinh viên tiếp cận kiến thức một cách dễ dàng. Các nền tảng học tập trực tuyến như Coursera, Khan Academy và edX cung cấp nhiều khóa học miễn phí và trả phí, phục vụ nhu cầu học tập của mọi lứa tuổi.</p>',
                'TrangThai' => 1,
                'MaSach'=> null,
            ],

            // Bài blog mã 5 (Du lịch)
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog' => 5, // Du lịch
                'TieuDe' => 'Khám phá vẻ đẹp của các vùng đất Việt Nam',
                'Slug' => 'kham-pha-ve-dep-cua-cac-vung-dat-viet-nam',
                'SubTieuDe' => '',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung' => '<p>Việt Nam là một quốc gia có rất nhiều cảnh đẹp, từ những bãi biển dài tuyệt đẹp cho đến các thành phố cổ kính và những dãy núi hùng vĩ. Các địa điểm du lịch nổi tiếng như Hà Nội, Huế, Đà Nẵng và Sài Gòn luôn thu hút du khách trong và ngoài nước. Ngoài ra, các vùng nông thôn với những cánh đồng lúa xanh mướt hay các bản làng dân tộc cũng là những điểm đến hấp dẫn cho những ai yêu thích khám phá vẻ đẹp tự nhiên và văn hóa truyền thống của đất nước.</p>',
                'TrangThai' => 1,
                'MaSach'=> null,
            ],
            [
                'MaTK' => 1,
                'NgayDang' => now(),
                'TacGia' => 'Trần Chí Đạt',
                'MaDanhMucBlog' => 5, // Du lịch
                'TieuDe' => 'Cẩm nang du lịch tự túc cho những người đam mê khám phá',
                'Slug' => 'cam-nang-du-lich-tu-tuc-cho-nhung-nguoi-dam-me-kham-pha',
                'SubTieuDe' => '',
                'AnhBlog'=>'blog-defaut.jpg',
                'NoiDung' => '<p>Du lịch tự túc đang ngày càng trở nên phổ biến vì nó mang đến sự tự do và linh hoạt cho du khách. Bạn có thể tự lên kế hoạch cho chuyến đi của mình mà không cần phụ thuộc vào các tour du lịch. Tuy nhiên, để chuyến đi tự túc thành công, bạn cần phải chuẩn bị kỹ càng, từ việc lên lịch trình, tìm kiếm nơi ở cho đến việc tìm hiểu các điểm đến. Cẩm nang du lịch tự túc sẽ giúp bạn có những chuyến đi tuyệt vời và khám phá được nhiều điều mới lạ.</p>',
                'TrangThai' => 1,
                'MaSach'=> null,
            ],
        ]);
    }
}
