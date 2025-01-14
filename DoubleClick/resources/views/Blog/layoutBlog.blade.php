@extends('layout')

@section('content')
<nav class="breadcrumb-nav">
    <h5 class="breadcrumb-text">
        <a href="/" class="breadcrumb-link">Trang chủ</a>
        <span class="breadcrumb-divider">/</span>
        <a href="/blog" class="breadcrumb-link">@yield('subtitle')</a>
    </h5>
</nav>

<div class="content-container w3-row">
    <!-- Content (Main Column) -->
   @yield('subcontent')

    <!-- Sidebar (Right Column) -->
    <div class="w3-col l4 m12 s12">
        <!-- Bài viết nổi bật -->
        <div class="w3-card w3-margin" style="border-radius: 10px; overflow: hidden;">
            <div class="w3-container w3-padding" style="background-color: #f1f1f1;">
                <h4 style="font-size: 1.3rem; font-weight: bold;">Bài Viết Nổi Bật</h4>
            </div>
            <ul class="w3-ul w3-hoverable w3-white" style="border-radius: 10px;">
                <li class="w3-padding-16" style="transition: background-color 0.3s ease;">
                    <a href="{{route('blog.baiviet')}}" class="" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="/img/Blog/blog03.webp" alt="Image" class="w3-left w3-margin-right" style="width: 50px; border-radius: 8px;">
                        <div>
                            <span class="w3-large" style="color: #333; font-weight: bold;">Sách hay</span><br>
                            <span style="color: #777;">Chiến Tranh và Hòa Bình</span>
                        </div>
                    </a>
                </li>
                <li class="w3-padding-16" style="transition: background-color 0.3s ease;">
                    <a href="{{route('blog.baiviet')}}" class="" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="/img/Blog/blog04.jpg" alt="Image" class="w3-left w3-margin-right" style="width: 50px; border-radius: 8px;">
                        <div>
                            <span class="w3-large" style="color: #333; font-weight: bold;">Khám phá</span><br>
                            <span style="color: #777;">Nguồn Gốc Các Loài</span>
                        </div>
                    </a>
                </li>
                <li class="w3-padding-16" style="transition: background-color 0.3s ease;">
                    <a href="{{route('blog.baiviet')}}" class="" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="/img/Blog/Blog02.jpg" alt="Image" class="w3-left w3-margin-right" style="width: 50px; border-radius: 8px;">
                        <div>
                            <span class="w3-large" style="color: #333; font-weight: bold;">Cảm hứng</span><br>
                            <span style="color: #777;">Những Cuốn Sách Đổi Thay Cuộc Sống</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <hr>
        <!-- Tags Section -->
        <div class="w3-card w3-margin" style="border-radius: 10px; overflow: hidden;">
            <div class="w3-container w3-padding" style="background-color: #f1f1f1;">
                <h4 style="font-size: 1.3rem; font-weight: bold;">Chủ Đề</h4>
            </div>
            <div class="w3-container w3-white" style="padding: 20px; border-radius: 10px;">
                <p>
                    <span class="w3-tag w3-black w3-margin-bottom">Văn học</span>
                    <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Kỹ năng sống</span>
                    <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Thiếu nhi</span>
                    <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Học tập</span>
                    <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Kinh doanh</span>
                    <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Cảm hứng</span>
                    <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Tiểu thuyết</span>
                    <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Hồi ký</span>
                    <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Sách mới</span>
                    <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Tâm lý học</span>
                    <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Khoa học</span>
                    <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Phát triển bản thân</span>
                </p>
            </div>
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