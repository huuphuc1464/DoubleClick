@extends('Blog.layoutBlog')
@section('title', $title)
@section('subtitle', $subtitle)
@section('subcontent')
<!-- Danh sách Blog -->
<div class="w3-col l8 m12 s12">
    @foreach ($listBlog as $blog)
        <div class="w3-card-4 w3-margin w3-white w3-row w3-hover-shadow-2" style="border-radius: 10px;">
            <div class="w3-col l3 m4 s12 p-2">
                <img src="{{ asset('img/baiviet/' .$blog->AnhBlog) }}" alt="Bìa sách" class="w3-round" style="width: 100%; height: auto;">
            </div>
            <div class="w3-col l9 m8 s12 p-3">
                <h3 class="w3-text-dark-grey" style="font-size: 1.6rem; font-weight: bold;">{{ $blog->TieuDe }}</h3><br>
                <span class="w3-tag w3-light-grey w3-small mb-2">{{ $blog->DanhMucBlog->TenDanhMucBlog }}</span>
                <h5 class="text-muted" style="font-size: 1.1rem;">
                    {!! $blog->SubTieuDe ?? '' !!}
                    <span class="w3-opacity" style="font-size: 0.9rem;">
                        {{ \Carbon\Carbon::parse($blog->NgayDang)->format('d/m/Y') }}
                    </span>
                </h5>
                <p class="text-dark" style="font-size: 1rem; line-height: 1.6; margin-bottom: 15px;">
                    {!! Str::limit($blog->NoiDung, 100, '...') !!}
                </p>
                <a href="{{ route('blog.detail', $blog->MaBlog) }}" 
                    class="w3-button w3-border w3-round w3-small" > 
                    Đọc tiếp »
                </a>
            </div>
        </div>
        <hr style="border: 1px solid #ddd;">
    @endforeach
    <!-- Phân trang -->
    <div class="mt-3 text-center">
        {{ $listBlog->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
