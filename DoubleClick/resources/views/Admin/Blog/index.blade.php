@extends('Admin.layout')

@section('css')
    <link href="{{ asset('css/blog-management.css') }}" rel="stylesheet">
@endsection
@section('title', $title)
@section('subtitle', $subtitle)
@section('content')

<div class="container mt-4 blog-management">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">@section('subtitle', $subtitle) </h5>
        <div class="d-flex justify-content-end align-items-center gap-3" style="gap:10px;">
        <!-- Nút Danh mục bài viết -->
        <a href="{{route('danhmucblog')}}">
            <i class="fas fa-list"></i>
            <span>Danh mục bài viết</span>
        </a>
        <!-- Nút Quản lý bình luận -->
        <a href="#">
            <i class="fas fa-comments"></i>
            <span>Quản lý bình luận</span>
        </a>
        <a href="{{route('blog.create')}}">
            <i class="fas fa-plus-circle me-2"></i>
            <span>Thêm bài viết</span>
        </a>
    </div>
    </div>
    <!-- Bộ lọc và tìm kiếm -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-2 align-items-center">
                <div class="col-md-3">
                    <select class="form-select" aria-label="Lọc bài viết">
                        <option value="all" selected>Tất cả bài viết</option>
                        <option value="published">Đã xuất bản</option>
                        <option value="draft">Bản nháp</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Tìm kiếm bài viết">
                </div>
                <div class="col-md-3 text-end">
                    <button class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Danh sách bài viết -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-center" style="width: 50px; vertical-align: middle;">#</th>
                        <th scope="col" style="vertical-align: middle;">Tiêu đề</th>
                        <th scope="col" style="vertical-align: middle;">Blog</th>
                        <th scope="col" style="vertical-align: middle;">Tác giả</th>
                        <th scope="col" style="vertical-align: middle;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($listBlog as $blog)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/baiviet/' . $blog->AnhBlog) }}" alt="Thumbnail" style="width: 70px; height: 70px;">
                                <a href="#" class="text-decoration-none fw-bold">{{ $blog->TieuDe }}</a>
                            </div>
                        </td>
                        <td>{{ $blog->danhmucblog->TenDanhMucBlog ?? 'Không có' }}</td>
                        <td>{{ $blog->TacGia ?? 'Ẩn danh' }}</td>
                        <td>
                            @if ($blog->TrangThai == 1)
                                <a href=""
                                    class="btn btn-primary btn-sm">Sửa
                                </a>
                                <a href=""
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết?')">
                                    Xóa
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Không có bài viết nào!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- Hiển thị phân trang -->
    <div class="mt-3">
        {{ $listBlog->links() }}
    </div>
</div>
<script>
        document.getElementById("select-all").addEventListener("change", function () {
            const checkboxes = document.querySelectorAll("tbody .form-check-input");
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });

</script>
@endsection
