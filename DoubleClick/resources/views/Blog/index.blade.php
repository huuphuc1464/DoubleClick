@extends('Blog.layoutBlog')
@section('title', $title)
@section('subtitle', $subtitle)
@section('subcontent')
<!-- Danh sách Blog -->
<div class="w3-col l8 m12 s12">
    @foreach ($listBlog as $blog)
        <div class="w3-card-4 w3-margin w3-white w3-row w3-hover-shadow-2" style="border-radius: 10px; overflow: hidden;">
            <div class="w3-col l3 m4 s12" style="padding: 10px;">
                <img src="{{ asset('img/baiviet/' . ($blog->AnhBlog ?? 'default.jpg')) }}" alt="Bìa sách" style="width: 100%; height: auto; border-radius: 8px;">
            </div>
            <div class="w3-col l9 m8 s12" style="padding: 20px;">
                <div class="w3-container">
                    <h3 class="w3-text-dark-grey" style="font-size: 1.6rem; font-weight: bold; margin-bottom: 10px;">{{ $blog->TieuDe }}</h3>
                    <h5 style="font-size: 1.1rem; color: #555;">
                        {!! $blog->SubTieuDe ?? '' !!}
                        <br>
                        <span class="w3-opacity" style="font-size: 0.9rem; color: #888;">
                            {{ \Carbon\Carbon::parse($blog->NgayDang)->format('d/m/Y') }}
                        </span>
                    </h5>
                </div>
                <div class="w3-container" style="margin-top: 15px;">
                    <p style="font-size: 1rem; color: #333; line-height: 1.6; margin-bottom: 15px;">{!! Str::limit($blog->NoiDung, 100, '...') !!}</p>
                    <!-- Nút Đọc tiếp -->
                    <a href="" class="w3-button w3-border w3-padding-small w3-round" style="font-size: 1rem; color: #333; background-color: #f1f1f1; text-decoration: none; display: inline-block; padding: 12px 20px; transition: background-color 0.3s ease;">
                        <b>Đọc tiếp »</b>
                    </a>
                </div>
            </div>
        </div>   
        <hr style="border: 1px solid #ddd;">
    @endforeach
    <!-- Hiển thị phân trang -->
    <div class="mt-3">
        {{ $listBlog->links() }}
    </div>
</div>
@endsection
