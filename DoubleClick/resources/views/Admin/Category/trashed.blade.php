@extends('Admin.layout')
@section('title', $title)
@section('subtitle', $subtitle)
@section('content')
    <div class="container-fluid my-4">
        <div class="card shadow-sm">
            <div class="card-body">
                {{-- Nút Quay lại --}}
                <div class="mb-3">
                    <a href="{{ route('admin.category') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Quay lại danh mục chính
                    </a>
                </div>

                {{-- Tiêu đề --}}
                <div class="card-header text-center">
                    <h2 class="fw-bold">{{ $title }}</h2>
                </div>

                {{-- Hiển thị danh mục theo phân cấp --}}
                <div class="accordion mt-3" id="categoryAccordion">
                    @foreach ($listCate as $category)
                        @include('admin.Category.partials.trashed_category_row', ['category' => $category])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
