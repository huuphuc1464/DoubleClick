@extends('Admin.layout')
@section('title', 'Sửa danh mục')
@section('content')
<div class="container my-4">
    <div class="card">
        <div class="card-header text-center">
            <h3>Sửa danh mục</h3>
        </div>
        <div class="card-body">
            {{-- Hiển thị lỗi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.category.update', $category->MaLoai) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="TenLoai" class="form-label">Tên danh mục</label>
                    <input type="text" name="TenLoai" id="TenLoai" class="form-control"
                        value="{{ old('TenLoai', $category->TenLoai) }}" maxlength="20" required>

                </div>
                <div class="mb-3">
                    <label for="MoTa" class="form-label">Mô tả</label>
                    <textarea name="MoTa" id="MoTa" class="form-control" rows="3"
                        maxlength="70">{{ old('MoTa', $category->MoTa) }}</textarea>

                </div>
                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <div>
                        <label><input type="radio" name="TrangThai" value="1" {{ $category->TrangThai == 1 ? 'checked' : '' }}> Hiển thị</label>
                        <label><input type="radio" name="TrangThai" value="0" {{ $category->TrangThai == 0 ? 'checked' : '' }}> Ẩn</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.category') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection
