@extends('Blog.layoutBlog')
@section('subtitle', $subtitle)
@section('subcontent')

    <div class="w3-col l8 s12">
        <!-- Bài viết -->
        <div class="w3-card-4 w3-margin w3-white">
            <img src="/img/Blog/Blog01.jpg" alt="Bìa sách" style="width:100%;">
            <div class="w3-container">
                <h3><b>Nghệ Thuật Đọc Sách</b></h3>
                <h5>Khám phá niềm vui từ sách, <span class="w3-opacity">20 Tháng 12, 2024</span></h5>
            </div>
            <div class="w3-container">
                <p>Hãy bước vào thế giới văn học đầy thú vị và khám phá cách những cuốn sách định hình góc nhìn cũng như làm
                    phong phú cuộc sống của chúng ta...</p>
                <div class="w3-row">
                    <a href="/blog/bai-viet">
                        <div class="w3-col m8 s12">
                            <p><button class="w3-button w3-padding-large w3-white w3-border"><b>ĐỌC TIẾP »</b></button></p>
                        </div>
                    </a>
                    <div class="w3-col m4 w3-hide-small">
                        <p><span class="w3-padding-large w3-right"><b>Bình luận  </b> <span class="w3-tag">0</span></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <!-- Bài viết khác -->
        <div class="w3-card-4 w3-margin w3-white">
            <img src="/img/Blog/Blog02.jpg" alt="Bìa sách" style="width:100%">
            <div class="w3-container">
                <h3><b>Những Cuốn Sách Đổi Thay Cuộc Sống</b></h3>
                <h5>Cảm hứng từ trang sách, <span class="w3-opacity">18 Tháng 12, 2024</span></h5>
            </div>
            <div class="w3-container">
                <p>Cùng khám phá những cuốn sách đã thay đổi cuộc sống của hàng triệu người trên thế giới, từ tiểu thuyết
                    đến sách kỹ năng sống...</p>
                <div class="w3-row">
                    <a href="/blog/bai-viet">
                        <div class="w3-col m8 s12">
                            <p><button class="w3-button w3-padding-large w3-white w3-border"><b>ĐỌC TIẾP »</b></button></p>
                        </div>
                    </a>
                    <div class="w3-col m4 w3-hide-small">
                        <p><span class="w3-padding-large w3-right"><b>Bình luận  </b> <span class="w3-badge">2</span></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <hr>



        {{-- bài viết về vận chuyển của Nhật --}}
        <div class="w3-card-4 w3-margin w3-white">
            <img src="/img/Blog/Blog05.png" alt="Bìa sách" style="width:100%;">
            <div class="w3-container">
                <h3><b>Dịch Vụ Vận Chuyển</b></h3>
                <h5>Tìm Hiểu Về Vận Chuyển Toàn Quốc, <span class="w3-opacity">18 Tháng 04, 2024</span></h5>
            </div>
            <div class="w3-container">
                <p>Trong thế giới ngày càng phẳng và kết nối hiện nay, dịch vụ vận chuyển nhanh toàn cầu đã trở thành một
                    phần không thể thiếu của hoạt động thương mại và cuộc sống hàng ngày...</p>
                <div class="w3-row">
                    <a href="{{ asset('/baiviet/1') }}">
                        <div class="w3-col m8 s12">
                            <p><button class="w3-button w3-padding-large w3-white w3-border"><b>ĐỌC TIẾP »</b></button></p>
                        </div>
                    </a>
                    <div class="w3-col m4 w3-hide-small">
                        <p><span class="w3-padding-large w3-right"><b>Bình luận  </b> <span class="w3-tag">10</span></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        {{-- bài viết về chất lương sp của Nhật --}}
        <div class="w3-card-4 w3-margin w3-white">
            <img src="/img/Blog/Blog09.png" alt="Bìa sách" style="width:100%;">
            <div class="w3-container">
                <h3><b>Chất Lượng Sách và Các Nhà Cung Cấp Sách Lớn</b></h3>
                <h5>Tìm Hiểu Chất Lượng Sách Tại Double Click, <span class="w3-opacity">15 Tháng 04, 2024</span></h5>
            </div>
            <div class="w3-container">
                <p>Việc đảm bảo chất lượng sách là điều vô cùng quan trọng đối với cả nhà xuất bản và người tiêu dùng. Chất
                    lượng sách không chỉ ảnh hưởng đến trải nghiệm đọc mà còn thể hiện sự tôn trọng đối với tác giả và các
                    độc giả trung thành...</p>
                <div class="w3-row">
                    <a href="{{ asset('/baiviet/2') }}">
                        <div class="w3-col m8 s12">
                            <p><button class="w3-button w3-padding-large w3-white w3-border"><b>ĐỌC TIẾP »</b></button></p>
                        </div>
                    </a>
                    <div class="w3-col m4 w3-hide-small">
                        <p><span class="w3-padding-large w3-right"><b>Bình luận  </b> <span class="w3-tag">10</span></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        {{-- bài viết về giảm giá mở của Nhật --}}
        <div class="w3-card-4 w3-margin w3-white">
            <img src="/img/Blog/Blog07.png" alt="Bìa sách" style="width:100%;">
            <div class="w3-container">
                <h3><b>Chương Trình Giảm Giá Sâu Của Double Click</b></h3>
                <h5>Tìm Hiểu Về Sách Đang Giảm Giá Sốc, <span class="w3-opacity">12 Tháng 04, 2024</span></h5>
            </div>
            <div class="w3-container">
                <p>Chỉ cần một click chuột, bạn đã có thể sở hữu những quyển sách hay với mức giảm giá cực kỳ ưu đãi từ
                    Double Click. Đây là cơ hội tuyệt vời để bạn bổ sung vào tủ sách của mình những tác phẩm giá trị với giá
                    hời...</p>
                <div class="w3-row">
                    <a href="{{ asset('/baiviet/3') }}">
                        <div class="w3-col m8 s12">
                            <p><button class="w3-button w3-padding-large w3-white w3-border"><b>ĐỌC TIẾP »</b></button></p>
                        </div>
                    </a>
                    <div class="w3-col m4 w3-hide-small">
                        <p><span class="w3-padding-large w3-right"><b>Bình luận  </b> <span class="w3-tag">10</span></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        {{-- bài viết về hỗ trọ 24/7 của Nhật --}}
        <div class="w3-card-4 w3-margin w3-white">
            <img src="/img/Blog/Blog10.png" alt="Bìa sách" style="width:100%;">
            <div class="w3-container">
                <h3><b>Hỗ Trợ Khách Hàng 24/7 - Sự Đảm Bảo Cho Sự Hài Lòng Tuyệt Đối</b></h3>
                <h5>Luôn Bên Bạn Mỗi Khi Bạn Cần, <span class="w3-opacity">10 Tháng 04, 2024</span></h5>
            </div>
            <div class="w3-container">
                <p>Trong thế giới ngày càng kết nối số như hiện nay, việc đảm bảo sự hài lòng của khách hàng trở nên quan
                    trọng hơn bao giờ hết. Một trong những yếu tố then chốt mang lại trải nghiệm tuyệt vời cho khách hàng
                    chính là dịch vụ hỗ trợ 24/7...</p>
                <div class="w3-row">

                    <a href="{{ asset('/baiviet/4') }}">
                        <div class="w3-col m8 s12">
                            <p><button class="w3-button w3-padding-large w3-white w3-border"><b>ĐỌC TIẾP »</b></button></p>
                        </div>
                    </a>
                    <div class="w3-col m4 w3-hide-small">
                        <p><span class="w3-padding-large w3-right"><b>Bình luận  </b> <span class="w3-tag">10</span></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection
