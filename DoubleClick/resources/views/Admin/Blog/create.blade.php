@extends('Admin.layout')

@section('title', $title)
@section('subtitle', $subtitle)

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card shadow-sm p-4 mb-4">
        <!-- Trường Tiêu đề -->
        <div class="form-group">
            <label for="TieuDe" class="font-weight-bold">Tiêu đề</label>
            <input type="text" id="TieuDe" name="TieuDe" class="form-control" value="{{ old('TieuDe') }}" placeholder="Nhập tiêu đề bài viết" required>
        </div>
        <!-- Trường Sub Tiêu đề -->
        <div class="form-group">
            <label for="SubTieuDe" class="font-weight-bold">Sub Tiêu đề</label>
            <input type="text" id="SubTieuDe" name="SubTieuDe" class="form-control" value="{{ old('SubTieuDe') }}" placeholder="Nhập sub tiêu đề (tuỳ chọn)">
        </div>
        <div class="form-group">
            <!-- Danh mục blog -->
            <label for="MaDanhMucBlog" class="font-weight-bold">Danh mục Blog</label>
            <select id="MaDanhMucBlog" name="MaDanhMucBlog" class="form-control w-50" required>
                <option value="">Chọn danh mục blog</option>
                @foreach ($listCateBlog as $category)
                    <option value="{{ $category->MaDanhMucBlog }}">{{ $category->TenDanhMucBlog }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" id="sach-container" style="display: none;">
            <!-- Sách -->
            <label for="MaSach" class="font-weight-bold">Chọn sách</label>
            <select id="MaSach" name="MaSach" class="form-control w-50" >
                <option value="">Chọn sách</option>
                @foreach ($listSach as $sach)
                    <option value="{{ $sach->MaSach }}" data-image="{{ asset('img/sach/'.$sach->AnhDaiDien) }}">
                        {{ $sach->TenSach }} - {{ $sach->TenTacGia }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Hiển thị hình ảnh sách -->
        <div id="sach-image-container" style="margin-top: 20px;">
            <img id="sach-image" src="" alt="Hình ảnh sách" style="max-width: 150px; display: none;">
        </div>
        <div class="form-group">
            <label for="TacGia" class="font-weight-bold">Tác giả</label>
            <input type="text" id="TacGia" name="TacGia" class="form-control w-50" value="{{ old('TacGia') }}" placeholder="Nhập tên tác giả" required>
        </div>
        <div class="form-group">
            <!-- Trường Trạng thái (Radio buttons) -->
            <label class="font-weight-bold">Trạng thái</label>
            <div class="d-flex">
                <div class="custom-control custom-radio mr-4">
                    <input type="radio" id="TrangThaiHiện" name="TrangThai" value="1" class="custom-control-input" {{ old('TrangThai') == 1 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="TrangThaiHiện">Hiện</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="TrangThaiẨn" name="TrangThai" value="0" class="custom-control-input" {{ old('TrangThai') == 0 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="TrangThaiẨn">Ẩn</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="imageUpload">Chọn hình ảnh:</label>
            <input type="file" class="form-control" id="imageUpload" name="image" accept="image/*">
        </div>
        <!-- Trường Nội dung (CKEditor) -->
        <div class="form-group">
            <label for="NoiDung" class="font-weight-bold">Nội dung</label>
            <textarea id="NoiDung" name="NoiDung" class="form-control" rows="15" style="font-size: 1.1rem; height: 500px; width: 100%;" placeholder="Nhập nội dung bài viết">{{ old('NoiDung') }}</textarea>
        </div>
        <!-- Nút lưu -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Lưu</button>
            <a href="{{route('blog')}}" class="btn btn-danger btn-lg">Hủy</a>
        </div>
    </div>
</form>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    // Khởi tạo CKEditor cho trường "NoiDung"
    ClassicEditor
        .create(document.querySelector('#NoiDung'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    document.getElementById('MaSach').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var imageUrl = selectedOption.getAttribute('data-image');
        var imageContainer = document.getElementById('sach-image-container');
        var sachImage = document.getElementById('sach-image');

        if (imageUrl) {
            sachImage.src = imageUrl;
            sachImage.style.display = 'block'; // Hiển thị hình ảnh
        } else {
            sachImage.style.display = 'none'; // Ẩn hình ảnh nếu không có
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const danhMucBlog = document.getElementById('MaDanhMucBlog');
    const sachContainer = document.getElementById('sach-container');

    danhMucBlog.addEventListener('change', function () {
        // Kiểm tra giá trị được chọn
        if (danhMucBlog.value == 6) {
            sachContainer.style.display = 'block'; // Hiển thị "Chọn sách"
        } else {
            sachContainer.style.display = 'none'; // Ẩn "Chọn sách"
        }
    });
});

</script>
@endsection

@push('styles')
<style>
    .card {
        background-color: #f8f9fa;
    }

    .form-group label {
        font-size: 1.1rem;
        font-weight: 500;
    }

    .form-control {
        border-radius: 5px;
        box-shadow: none;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 5px;
        padding: 10px 20px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .custom-control-label {
        font-size: 1rem;
    }

    .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #007bff;
    }
</style>
@endpush
