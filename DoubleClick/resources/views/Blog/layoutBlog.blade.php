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
                <h4 style="font-size: 1.3rem; font-weight: bold;">Danh mục Blog</h4>
            </div>
            <ul class="w3-ul w3-hoverable w3-white" style="border-radius: 10px;">
                <li class="w3-padding-16" style="transition: background-color 0.3s ease;">
                    <a href="{{route('blog.danhSachBlog')}}" class="" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="{{asset('img/baiviet/blog-defaut.jpg')}}" alt="Image" class="w3-left w3-margin-right" style="width: 50px; border-radius: 8px;">
                        <div>
                            <span class="w3-large" style="color: #333; font-weight: bold;">Blog || Truyện Nhà</span><br>
                        </div>
                    </a>
                </li>
                <li class="w3-padding-16" style="transition: background-color 0.3s ease;">
                    <a href="{{route('blog.baiviet')}}" class="" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="/img/Blog/blog03.webp" alt="Image" class="w3-left w3-margin-right" style="width: 50px; border-radius: 8px;">
                        <div>
                            <span class="w3-large" style="color: #333; font-weight: bold;">Review Sách</span><br>
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
                    @foreach ($danhMucBlog as $danhMuc)
                        <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">{{ $danhMuc->TenDanhMucBlog }}</span>
                    @endforeach
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