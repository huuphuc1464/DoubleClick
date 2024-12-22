@extends('layout')

@section('content')
<nav class="breadcrumb-nav">
    <h5>
        <a href="/" class="breadcrumb-link">Trang chủ</a>
        <span class="breadcrumb-divider">/</span>
        <a href="/blog" class="breadcrumb-link">@yield('subtitle')</a>
    </h5>
</nav>
@yield('subcontent')
<!-- Sidebar -->
<div class="w3-col l4">
    <!-- Bài viết nổi bật -->
    <div class="w3-card w3-margin">
        <div class="w3-container w3-padding">
            <h4>Bài Viết Nổi Bật</h4>
        </div>
        <ul class="w3-ul w3-hoverable w3-white">
            <li class="w3-padding-16">
                <a href="{{route('blog.baiviet')}}" class="">
                    <img src="/img/Blog/blog03.webp" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                    <span class="w3-large">Sách hay</span><br>
                    <span>Chiến Tranh và Hòa Bình</span>
                </a>
            </li>
            <li class="w3-padding-16">
                <a href="{{route('blog.baiviet')}}" class="">
                    <img src="/img/Blog/blog04.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                    <span class="w3-large">Khám phá</span><br>
                    <span>Nguồn Gốc Các Loài</span>
                </a>
            </li> 
            <li class="w3-padding-16">
                <a href="{{route('blog.baiviet')}}" class="">
                    <img src="/img/Blog/Blog02.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                    <span class="w3-large">Cảm hứng</span><br>
                    <span>Những Cuốn Sách Đổi Thay Cuộc Sống</span>
                </a>    
            </li>   
        </ul>
    </div>
    <hr>

    <!-- Tags -->
    <div class="w3-card w3-margin">
        <div class="w3-container w3-padding">
            <h4>Chủ Đề</h4>
        </div>
        <div class="w3-container w3-white">
            <p>
                <span class="w3-tag w3-black w3-margin-bottom">Văn học</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Kỹ năng sống</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Thiếu nhi</span>
                <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Học tập</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Kinh doanh</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Cảm hứng</span>
                <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Tiểu thuyết</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Hồi ký</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Sách mới</span>
                <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Tâm lý học</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Khoa học</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Phát triển bản thân</span>
            </p>
        </div>
    </div>
</div>
<style>
  .breadcrumb-nav {
        font-family: Arial, sans-serif;
        font-size: 14px;
        display: flex;
        align-items: center;
        margin: 15px; 
        padding: 10px 5px; 
    }

    .breadcrumb-link {
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-link:hover {
        color: #0056b3;
    }

    .breadcrumb-divider {
        margin: 0 8px; 
    }
</style>
@endsection