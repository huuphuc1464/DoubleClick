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
            <i class="fas fa-comments"></i>
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
                        <th scope="col" class="text-center" style="width: 50px; vertical-align: middle;">
                            <div class="form-check custom-check">
                                <input type="checkbox" class="form-check-input" id="select-all">
                                <label class="form-check-label" for="select-all"></label>
                            </div>  
                        </th>
                        <th scope="col" style="vertical-align: middle;">Tiêu đề</th>
                        <th scope="col" style="vertical-align: middle;">Blog</th>
                        <th scope="col" style="vertical-align: middle;">Tác giả</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            <!-- Tùy chỉnh nút check -->
                            <div class="form-check custom-check">
                                <input type="checkbox" class="form-check-input" id="checkbox1">
                                <label class="form-check-label" for="checkbox1"></label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/doc-sach.png') }}" alt="Thumbnail" style="width: 70px; height: 70px;">
                                <a href="#" class="text-decoration-none fw-bold">Cách đọc sách bằng mắt</a>
                            </div>
                        </td>
                        <td>Tin tức</td>
                        <td>Chí Đạt</td>
                    </tr>
                    <tr>
                        <td class="text-center">
                           <!-- Tùy chỉnh nút check -->
                           <div class="form-check custom-check">
                                <input type="checkbox" class="form-check-input" id="checkbox1">
                                <label class="form-check-label" for="checkbox1"></label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/20-10.jpg') }}" alt="Thumbnail" style="width: 70px; height: 70px;">
                                <a href="#" class="text-decoration-none fw-bold">5 món quà tặng 20/10 100% phụ nữ đều muốn nhận</a>
                            </div>
                        </td>
                        <td>Tin tức</td>
                        <td>Chí Đạt</td>
                    </tr>
                    <!-- Thêm các dòng bài viết khác tương tự -->
                </tbody>
            </table>
        </div>
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
