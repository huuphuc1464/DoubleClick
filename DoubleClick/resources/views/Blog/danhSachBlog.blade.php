@extends('Blog.layoutBlog')
@section('subtitle',$subtitle)
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
            <p>Hãy bước vào thế giới văn học đầy thú vị và khám phá cách những cuốn sách định hình góc nhìn cũng như làm phong phú cuộc sống của chúng ta...</p>
            <div class="w3-row">
                <div class="w3-col m8 s12">
                    <p><button class="w3-button w3-padding-large w3-white w3-border"><b>ĐỌC TIẾP »</b></button></p>
                </div>
                <div class="w3-col m4 w3-hide-small">
                    <p><span class="w3-padding-large w3-right"><b>Bình luận  </b> <span class="w3-tag">0</span></span></p>
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
            <p>Cùng khám phá những cuốn sách đã thay đổi cuộc sống của hàng triệu người trên thế giới, từ tiểu thuyết đến sách kỹ năng sống...</p>
            <div class="w3-row">
                <div class="w3-col m8 s12">
                    <p><button class="w3-button w3-padding-large w3-white w3-border"><b>ĐỌC TIẾP »</b></button></p>
                </div>
                <div class="w3-col m4 w3-hide-small">
                    <p><span class="w3-padding-large w3-right"><b>Bình luận  </b> <span class="w3-badge">2</span></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection