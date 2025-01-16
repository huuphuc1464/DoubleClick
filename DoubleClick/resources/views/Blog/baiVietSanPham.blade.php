@extends('Blog.layoutBlog')
@section('title', $title)
@section('subtitle', $subtitle)

@section('subcontent')
<!-- Khung tìm kiếm -->
<div class="w3-card w3-margin w3-white" style="border-radius: 10px;">
    <form action="{{ route('blog.search') }}" method="get" class="d-flex">
        <div class="input-group" style="box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow: hidden;">
            <!-- Input tìm kiếm -->
            <input 
                type="text" 
                name="search"
                class="form-control" 
                placeholder="Tìm kiếm bài viết về sản phẩm..." 
                style="border: none; box-shadow: none; padding: 12px; font-size: 1rem;"
                value="{{ old('search', $searchTerm ?? '') }}" 
                required 
            >
            <!-- Nút tìm kiếm -->
            <button 
                type="submit" 
                class="btn btn-secondary" 
                style="border: none; background-color: #007bff; color: #fff; padding: 0 20px; font-size: 1rem;"
            >
                Tìm kiếm
            </button>
        </div>
    </form>
</div>

<!-- Thông báo kết quả tìm kiếm -->
@if(isset($searchTerm) && !empty($searchTerm))
    <div id="search-result-info" class="search-result-info" style="padding: 10px; border-radius: 10px;">
        @if ($listBlog->isEmpty())
            <div class="alert alert-warning">
                <strong>Không có bài viết nào phù hợp với từ khóa "{{ $searchTerm }}"</strong>
                <button type="button" class="close" aria-label="Close" onclick="closeSearchResult()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @else
            <div class="alert alert-success">
                <strong>Kết quả tìm kiếm bài viết sản phẩm cho từ khóa "{{ $searchTerm }}":</strong>
                <button type="button" class="close" aria-label="Close" onclick="closeSearchResult()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
@else
    <div id="search-result-info" class="search-result-info" style="display: none;">
        <!-- Không có thông báo mặc định khi chưa nhập gì -->
    </div>
@endif

<!-- Danh sách Bài viết về sản phẩm -->
<div class="w3-col l8 m12 s12">
    @foreach ($listBlog as $blog)
        <div class="w3-card-4 w3-margin w3-white w3-row w3-hover-shadow-2" style="border-radius: 10px;">
            <div class="w3-col l3 m4 s12 p-2">
                <img src="{{ asset('img/baiviet/' . ($blog->AnhBlog ?? 'blog-default.jpg')) }}" alt="Bìa sách" class="w3-round" style="width: 100%; height: auto;">
            </div>
            <div class="w3-col l9 m8 s12 p-3">
                <h3 class="w3-text-dark-grey" style="font-size: 1.6rem; font-weight: bold;">{{ $blog->TieuDe }}</h3></br>
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
                <a href="{{ route('blog.detail', $blog->MaBlog) }}" class="w3-button w3-border w3-round w3-small" style="font-size: 1rem;">
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

<!-- JavaScript để đóng thông báo -->
<script>
    function closeSearchResult() {
        document.getElementById('search-result-info').style.display = 'none';
    }
</script>
