@extends('Admin.layout')
@section('title', $title)
@section('subtitle', $subtitle)
@section('content')
    <div class="container-fluid my-4">
        <div class="card shadow-sm">
            <div class="card-body">
                {{-- Thông báo lỗi nếu có --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form Thêm danh mục --}}
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="TenLoai" class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control @error('TenLoai') is-invalid @enderror" id="TenLoai"
                            name="TenLoai" value="{{ old('TenLoai') }}" required>
                        @error('TenLoai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="MoTa" class="form-label">Mô tả</label>
                        <textarea class="form-control @error('MoTa') is-invalid @enderror" id="MoTa" name="MoTa">{{ old('MoTa') }}</textarea>
                        @error('MoTa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="TrangThai" class="form-label">Trạng thái</label>
                        <select class="form-select @error('TrangThai') is-invalid @enderror" id="TrangThai"
                            name="TrangThai">
                            <option value="1" {{ old('TrangThai') == '1' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="0" {{ old('TrangThai') == '0' ? 'selected' : '' }}>Ẩn</option>
                        </select>
                        @error('TrangThai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($parentCategory)
                        <input type="hidden" name="MaLoaiCha" value="{{ $parentCategory->MaLoai }}">
                        <p><strong>Danh mục cha:</strong> {{ $parentCategory->TenLoai }}</p>
                    @endif
                    <button type="submit" class="btn btn-success">Thêm danh mục</button>
                    <a href="{{ route('admin.category') }}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
@endsection
