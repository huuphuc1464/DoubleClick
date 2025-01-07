@extends('Admin.layout')
@section('title', $title)
@section('subtitle', $subtitle)
@section('content')
<div class="container-fluid my-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row">
                <div class="subcontent" style="flex: 1 0 75%; padding: 15px;">
                    <form action="{{ route('admin.category') }}" method="GET" class="mb-3">
                        <div class="row g-2 align-items-center">
                            <div class="col-12 col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm danh mục"
                                    value="{{ $search ?? '' }}">
                            </div>
                            <div class="col-6 col-md-2">
                                <button type="submit" class="btn btn-dark w-100">Tìm kiếm</button>
                            </div>
                            <div class="col-6 col-md-2">
                                <a href="{{ route('admin.category') }}" class="btn btn-primary w-100">Thêm danh mục</a>
                            </div>
                            <div class="col-6 col-md-2">
                                @if(request()->routeIs('admin.category.trashed'))
                                    <a href="{{ route('admin.category') }}" class="btn btn-success w-100">Danh mục hoạt
                                        động</a>
                                @else
                                    <a href="{{ route('admin.category.trashed') }}" class="btn btn-danger w-100">Danh mục
                                        xóa</a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="card-header text-center">
                        <h1>Danh mục</h1>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Tên danh mục</th>
                                    <th>Mô tả</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listCate as $index => $category)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $category->TenLoai }}</td>
                                        <td>{{ $category->MoTa }}</td>
                                        <td class="text-center">
                                            @if ($category->TrangThai == 1)
                                                <span class="badge bg-success" style="color: white;">Hoạt động</span>
                                            @elseif ($category->TrangThai == 0)
                                                <span class="badge bg-dark" style="color: white;">Ẩn</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-action">
                                                @if($category->TrangThai == 1 || $category->TrangThai == 0)
                                                    <a href="{{ route('admin.category.edit', $category->MaLoai) }}"
                                                        class="btn btn-primary btn-sm">Sửa</a>

                                                    <a href="{{ route('admin.category.delete', $category->MaLoai) }}"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục {{$category->TenLoai}}?')">
                                                        Xóa
                                                    </a>
                                                @elseif($category->TrangThai == 2)
                                                    <a href="{{ route('admin.category.restore', $category->MaLoai) }}"
                                                        class="btn btn-success"
                                                        onclick="return confirm('Bạn có chắc chắn muốn khôi phục danh mục {{$category->TenLoai}}?')">
                                                        Khôi phục
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Không có danh mục nào</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $listCate->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    /* Styles chung */
    .container-fluid {
        padding: 0;
        width: 1200px;
    }

    .btn-action a {
        font-size: 14px;
        margin: 0 5px;
    }

    @media (max-width: 768px) {
        .container-fluid {
            width: 100%;
            padding: 0 15px;
        }

        .btn-action a {
            font-size: 12px;
        }
    }
</style>
@endsection
