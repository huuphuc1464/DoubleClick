@extends('Admin.layout')
@section('title', $title)
{{-- @section('subtitle', $subtitle) --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/updatesach.css') }}">

@endsection
@section('content')
<div class="container updatesach mt-5 mb-5">
    <h4 class="mb-4">
        Chỉnh sửa thông tin sách
    </h4>
    <form action="{{ route('admin.sach.update', $sach->MaSach) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Định nghĩa phương thức PUT -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="coverImage">
                        Ảnh bìa
                    </label>
                    <div class="image-upload" id="coverImagePreviewWrapper">
                        @if ($sach->AnhDaiDien)
                        <div class="image-wrapper position-relative mb-2">
                            <img src="{{ asset('/img/sach/' . $sach->AnhDaiDien) }}" alt="Ảnh bìa" class="img-thumbnail">
                            <button type="button" class="btn btn-danger btn-sm position-absolute btn-circle top-0 end-0" onclick="removeCoverImage(this)">
                                &times;
                            </button>
                        </div>
                        @endif
                    </div>
                    <input type="file" id="coverImageInput" name="AnhDaiDien" accept="image/*" class="form-control mt-3" onchange="previewCoverImage(this)">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="bookImages">
                        Hình ảnh sách (Tối đa 9 ảnh)
                    </label>
                    <div id="bookImagesPreviewWrapper" class="d-flex flex-wrap image-upload">

                        @foreach ($anhSach as $image)
                        <div class="image-wrapper position-relative me-3 mb-3">
                            <img src="{{ asset('/img/sach/' . $image->HinhAnh) }}" alt="Book Image" class="img-thumbnail" style="max-width: 100px;">
                            <button type="button" class="btn btn-danger btn-sm btn-circle position-absolute top-0 end-0" onclick="removeBookImage(this, '{{ $image->HinhAnh }}')">
                                &times;
                            </button>
                        </div>
                        @endforeach
                    </div>
                    <input type="file" id="bookImagesInput" name="new_images[]" accept="image/*" class="form-control mt-3" multiple onchange="previewBookImages(this)">
                    <input type="hidden" name="deleted_images" id="deletedImages">
                    <small class="text-muted">Bạn có thể chọn thêm ảnh, tối đa 9 ảnh.</small>
                </div>
                <input type="hidden" name="MaSach" value="{{ $sach->MaSach }}">
                <div class="mb-3">
                    <label class="form-label" for="bookName">
                        Tên sách
                    </label>
                    <input class="form-control" id="bookName" name="TenSach" type="text" value="{{ old('TenSach', $sach->TenSach) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="publisher">
                        Nhà xuất bản
                    </label>
                    <input class="form-control" id="publisher" name="NXB" type="text" value="{{ old('NXB', $sach->NXB) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="author">
                        Tên tác giả
                    </label>
                    <input class="form-control" id="author" name="TacGia" type="text" value="{{ old('TacGia', $sach->TenTG) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="isbn">
                        ISBN
                    </label>
                    <input class="form-control" id="isbn" name="ISBN" type="text" value="{{ old('ISBN', $sach->ISBN) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="purchasePrice">
                        Số lượng tồn kho
                    </label>
                    <input class="form-control" id="purchasePrice" name="SoLuongTon" type="text" value="{{ old('SoLuongTon', number_format($sach->SoLuongTon)) }}" required readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="purchasePrice">
                        Giá nhập
                    </label>
                    <input class="form-control" id="purchasePrice" name="GiaNhap" type="text" value="{{ old('GiaNhap', number_format($sach->GiaNhap, 0, '.', ',')) }}" required readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="salePrice">
                        Giá bán
                    </label>
                    <input class="form-control" id="salePrice" name="GiaBan" min="1000" type="number" value="{{ old('GiaBan', $sach->GiaBan) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="category">
                        Loại
                    </label>
                    <select class="form-select" id="category" name="Loai">
                        @foreach($loaiSach as $category)
                        <option value="{{ $category->MaLoai }}" {{ $sach->MaLoai == $category->MaLoai ? 'selected' : '' }}>
                            {{ $category->TenLoai }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="series">
                        Bộ
                    </label>
                    <select class="form-select" id="series" name="Bo">
                        @foreach($boSach as $serie)
                        <option value="{{ $serie->TenBoSach }}" {{ $sach->TenBoSach == $serie->TenBoSach ? 'selected' : '' }}>
                            {{ $serie->TenBoSach }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">
                        Mô tả
                    </label>
                    <textarea class="form-control" id="description" name="MoTa" rows="3">{{ old('MoTa', $sach->MoTa) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="status">
                        Trạng thái
                    </label>
                    <select class="form-select" id="status" name="TrangThai">
                        <option value="1" {{ $sach->TrangThai == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $sach->TrangThai == 0 ? 'selected' : '' }}>Ngưng bán</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary me-2" type="submit">Cập nhật</button>
            <a href="{{ route('admin.sach') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>

</div>
<script>
    let deletedImageIds = []; // Danh sách ID ảnh bị xóa

    // Hiển thị ảnh bìa đã chọn
    function previewCoverImage(input) {
        const wrapper = document.getElementById('coverImagePreviewWrapper');
        wrapper.innerHTML = ''; // Xóa ảnh cũ
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                wrapper.innerHTML = `
    <div class="image-wrapper position-relative mb-2">
        <img src="${e.target.result}" alt="Ảnh bìa" class="img-thumbnail" style="max-width: 150px;">
        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" onclick="removeCoverImage(this)">
            &times;
        </button>
    </div>`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Xóa ảnh bìa (không gửi lên server)
    function removeCoverImage(button) {
        const wrapper = document.getElementById('coverImagePreviewWrapper');
        wrapper.innerHTML = '';
        document.getElementById('coverImageInput').value = ''; // Reset input file
    }

    // Hiển thị danh sách ảnh đã chọn
    function previewBookImages(input) {
        const wrapper = document.getElementById('bookImagesPreviewWrapper');
        const currentImageCount = wrapper.children.length - deletedImageIds.length; // Ảnh hiện tại trừ ảnh đã xóa
        const selectedFiles = input.files;

        console.log("Current image count:", currentImageCount); // Log số ảnh hiện tại
        console.log("Selected files count:", selectedFiles.length); // Log số ảnh được chọn

        if (currentImageCount + selectedFiles.length > 9) {
            alert("Bạn chỉ được tải lên tối đa 9 ảnh!");
            input.value = ""; // Xóa ảnh đã chọn
            return;
        }

        for (const file of selectedFiles) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'image-wrapper position-relative me-3 mb-3';
                div.innerHTML = `
    <img src="${e.target.result}" alt="Book Image" class="img-thumbnail" style="max-width: 100px;">
    <button type="button" class="btn btn-danger btn-sm btn-circle position-absolute top-0 end-0" onclick="removeBookImage(this)">
        &times;
    </button>`;
                wrapper.appendChild(div);
            };
            reader.readAsDataURL(file);
        }
    }



    // Xóa ảnh sách
    function removeBookImage(button, imageId = null) {
        const wrapper = button.closest('.image-wrapper');
        wrapper.remove();
        if (imageId) {
            deletedImageIds.push(imageId); // Thêm ID ảnh vào danh sách xóa
            document.getElementById('deletedImages').value = JSON.stringify(deletedImageIds);
        }
    }

</script>
@endsection
