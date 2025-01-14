@extends('Admin.layout')
@section('title', $title)
@section('subtitle', $subtitle)
@section('content')
    <div class="container-fluid my-4">
        <div class="card shadow-sm">
            <div class="card-body">

                {{-- Hiển thị thông báo --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Form Tìm kiếm --}}
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
                            @if (request()->routeIs('admin.category.trashed'))
                                <a href="{{ route('admin.category') }}" class="btn btn-success w-100">Danh mục hoạt động</a>
                            @else
                                <a href="{{ route('admin.category.trashed') }}" class="btn btn-danger w-100">Danh mục
                                    xóa</a>
                            @endif
                        </div>
                        <div class="col-6 col-md-2">
                            {{-- Nút Thêm danh mục gốc --}}
                            <a href="{{ route('admin.category.create') }}" class="btn btn-primary w-100">Thêm danh mục
                                gốc</a>
                        </div>
                    </div>
                </form>

                {{-- Header --}}
                <div class="card-header text-center">
                    <h2 class="fw-bold">Danh mục sách</h2>
                </div>

                {{-- Accordion hiển thị danh mục --}}
                <div class="accordion mt-3" id="categoryAccordion">
                    @foreach ($listCate as $category)
                        @include('admin.Category.partials.category_accordion', ['category' => $category])
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .btn-sm-custom {
            padding: 5px 10px;
            font-size: 12px;
            margin-right: 5px;
        }

        .btn-add-child {
            margin-left: 10px;
        }

        .accordion-body {
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .btn-sm-custom {
                font-size: 12px;
                margin-right: 3px;
            }
        }
    </style>
@endsection
