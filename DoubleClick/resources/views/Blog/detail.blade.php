@extends('Blog.layoutBlog')
@section('title', $title)
@section('subtitle', $subtitle)

@section('subcontent')
    <div class="w3-col l8 s12">  
        <div class="w3-card-4 w3-margin w3-white w3-round-large">
            <div class="w3-container w3-padding">
                <br>
                @if ($blog->MaSach == null)
                    <h2 class="blog-title"><b>{!! $blog->TieuDe !!}</b></h2>
                @else
                    <div class="blog-item">
                        @if ($blog->MaSach == null)
                            <h2 class="blog-title"><b>{!! $blog->TieuDe !!}</b></h2>
                        @else
                            <div class="hover-container">
                                <a href="{{ route('product.detail', $blog->MaSach) }}" class="blog-link" style="    text-decoration: none;">
                                    <h2 class="blog-title"><b>{!! $blog->TieuDe !!}</b></h2>
                                </a>
                                <div class="image-preview">
                                    <img src="{{ asset('img/sach/'.$blog->sach->AnhDaiDien) }}" alt="Image">
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                <br>
                <div class="blog-meta">
                    <span class="blog-author">
                        <i class="fa fa-user"></i> 
                        <strong>{{ $blog->TaiKhoan->Username }}</strong>
                    </span>
                    <span class="blog-date">
                        <i class="fa fa-calendar-alt"></i> 
                        {{ \Carbon\Carbon::parse($blog->NgayDang)->format('d/m/Y H:i') }}
                    </span>
                    <span id="view-count" class="blog-views">
                        <i class="fa fa-eye"></i> {{ $blog->LuotXem }} lượt xem
                    </span>
                </div>
                <br>
                <h5 class="blog-subtitle"><b>{!! $blog->SubTieuDe !!}</b></h5>
            </div>
            @if ($blog->MaSach == null)
                <img src="{{ asset('img/baiviet/' . $blog->AnhBlog) }}" alt="Bìa sách" class="blog-image">
            @else
                <img src="{{ asset('img/sach/'.$blog->sach->AnhDaiDien) }}" alt="Bìa sách" class="blog-image">
            @endif
            <div class="w3-container blog-content">
                {!! $blog->NoiDung !!}
                <div class="w3-row blog-author">
                    <div class="w3-col m8 s12">
                        <p><b>Người viết:</b> {{ $blog->TacGia }}</p>
                    </div>
                    <div class="w3-col m4 s12 text-right">
                        <!-- Nút chia sẻ Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                        target="_blank" 
                        class="w3-button w3-small w3-blue">
                        <i class="fa-brands fa-facebook"></i> Facebook
                        </a>

                        <!-- Nút chia sẻ Instagram -->
                        <a href="https://www.instagram.com" 
                        target="_blank" 
                        class="w3-button w3-small w3-pink">
                        <i class="fa-brands fa-instagram"></i> Instagram
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Định dạng chung cho bài viết */
        .w3-card-4 {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: #fff;
        }

        /* Định dạng tiêu đề bài viết */
        .blog-title {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        /* Định dạng ngày đăng */
        .blog-date {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 20px;
        }

        /* Định dạng phụ đề bài viết */
        .blog-subtitle {
            font-size: 1.2rem;
            color: #555;
            font-style: italic;
        }

        /* Định dạng hình ảnh bìa sách */
        .blog-image {
            width: 100%;
            height: auto;
            object-fit: cover;
            margin-top: 15px;
            border-bottom: 2px solid #f1f1f1;
        }

        /* Định dạng nội dung bài viết */
        .blog-content {
            font-size: 1.1rem;
            color: #333;
            line-height: 1.6;
            padding-top: 20px;
            margin-bottom: 20px;
        }

        /* Định dạng thông tin tác giả */
        .blog-author {
            font-size: 1rem;
            color: #555;
            margin-top: 20px;
        }
        .blog-item {
            position: relative;
            display: inline-block;
        }

        .hover-container {
            position: relative;
        }

        .image-preview {
            display: none;
            position: absolute;
            top: 120%; /* Đẩy ảnh xuống dưới tiêu đề */
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 5px;
        }

        .image-preview img {
            max-width: 150px;
            max-height: 200px;
        }

        .blog-link:hover + .image-preview {
            display: block;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('blog.increment-view') }}",
                method: "POST",
                data: {
                    id: "{{ $blog->MaBlog }}",
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#view-count').text('Lượt xem: ' + response.LuotXem);
                }
            });
        });
    </script>
@endsection