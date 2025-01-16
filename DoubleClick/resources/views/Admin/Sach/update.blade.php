@extends('Admin.layout')
@section('title', $title)
{{-- @section('subtitle', $subtitle) --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/updatesach.css') }}">

@endsection
@section('content')
<div class="container updatesach mt-5 mb-5">
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <h4 class="mb-4">
        Chỉnh sửa thông tin sách
    </h4>
    <form action="{{ route('admin.sach.update', $sach->MaSach) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Định nghĩa phương thức PUT -->
        <div class="row">
            <div class="col-md-6">
                {{-- Ảnh bìa --}}
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
                    @error('AnhDaiDien')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Hình ảnh sách --}}
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
                    @error('images')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @error('deleted_images')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Mã sách --}}
                <input type="hidden" name="MaSach" value="{{ $sach->MaSach }}">

            </div>
            <div class="col-md-6">
                {{-- Tên sách --}}
                <div class="mb-3">
                    <label class="form-label" for="bookName">
                        Tên sách
                    </label>
                    <input class="form-control" id="bookName" name="TenSach" type="text" value="{{ old('TenSach', $sach->TenSach) }}" required maxlength="50">
                    @error('TenSach')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Năm xuất bản --}}
                <div class="mb-3">
                    <label class="form-label" for="publisher">
                        Năm xuất bản
                    </label>
                    <input class="form-control" id="publisher" name="NXB" type="number" value="{{ old('NXB', $sach->NXB) }}" required min="1000" max="2099">
                    @error('NXB')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Tên tác giả --}}
                <div class="mb-3">
                    <label class="form-label" for="author">
                        Tên tác giả
                    </label>
                    <input class="form-control" id="author" name="TenTG" type="text" value="{{ old('TenTG', $sach->TenTG) }}" required maxlength="50">
                    @error('TenTG')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- ISBN --}}
                <div class="mb-3">
                    <label class="form-label" for="isbn">
                        ISBN
                    </label>
                    <input class="form-control" id="isbn" name="ISBN" type="text" value="{{ old('ISBN', $sach->ISBN) }}" required maxlength="50">
                    @error('ISBN')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Giá bán --}}
                <div class="mb-3">
                    <label class="form-label" for="salePrice">
                        Giá bán
                    </label>
                    <input class="form-control" id="salePrice" name="GiaBan" min="1000" type="number" value="{{ old('GiaBan', $sach->GiaBan) }}" required>
                </div>
                {{-- Loại --}}
                <div class="mb-3">
                    <div class=" mb-3 d-flex justify-content-between align-items-center">
                        <label class="form-label" for="category">
                            Loại
                        </label>
                        <!-- Button to trigger popup -->
                        <button type="button" class="btn btn-primary btn-sm " data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                            Thêm loại mới
                        </button>
                    </div>
                    <select class="form-select" id="category" name="MaLoai" required>
                        @foreach($loaiSach as $category)
                        <option value="{{ $category->MaLoai }}" {{ $sach->MaLoai == $category->MaLoai ? 'selected' : '' }}>
                            {{ $category->TenLoai }}
                        </option>
                        @endforeach
                    </select>
                </div>
                {{-- Bộ sách --}}
                <div class="mb-3">
                    <label class="form-label" for="series">
                        Bộ sách
                    </label>
                    <select class="form-select" id="series" name="TenBoSach">
                        @foreach($boSach as $serie)
                        <option value="{{ $serie->TenBoSach }}" {{ $sach->TenBoSach == $serie->TenBoSach ? 'selected' : '' }}>
                            {{ $serie->TenBoSach }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Mô tả --}}
                <div class="mb-3">
                    <label class="form-label" for="description">
                        Mô tả
                    </label>
                    <textarea class="form-control" id="description" name="MoTa" rows="3" maxlength="100">{{ old('MoTa', $sach->MoTa) }}</textarea>
                    @error('MoTa')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- TrangThai --}}
                <div class="mb-3">
                    <label class="form-label" for="status">
                        Trạng thái
                    </label>
                    <select class="form-select" id="status" name="TrangThai">
                        <option value="1" {{ $sach->TrangThai == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $sach->TrangThai == 0 ? 'selected' : '' }}>Ngưng bán</option>
                    </select>
                    @error('TrangThai')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary me-2" type="submit">Cập nhật</button>
            <a href="{{ route('admin.sach') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</div>

{{-- Popup thêm danh mục mới --}}
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Thêm loại mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Form Thêm loại mới -->
            <form action="{{ route('admin.sach.luudanhmuc') }}" method="POST" id="addCategoryForm">
                @csrf
                <div class="modal-body">
                    <!-- Tên danh mục -->
                    <div class="mb-3">
                        <label for="TenLoai" class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" id="TenLoai" name="TenLoai" required>
                    </div>
                    <!-- Mô tả -->
                    <div class="mb-3">
                        <label for="MoTa" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="MoTa" name="MoTa"></textarea>
                    </div>
                    <!-- Danh mục cha -->
                    <div class="mb-3">
                        <label for="MaLoaiCha" class="form-label">Danh mục cha</label>
                        <select class="form-select" id="MaLoaiCha" name="MaLoaiCha">
                            <option value="null" selected>Danh mục cha</option>
                            @foreach ($parentCategories as $category)
                            <option value="{{ $category->MaLoai }}">{{ $category->TenLoai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="TrangThai" value="1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                </div>
            </form>


        </div>
    </div>
</div>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JavaScript Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

<script>
    $(document).ready(function() {
        $('#addCategoryForm').on('submit', function(e) {
            e.preventDefault(); // Ngăn form gửi theo cách thông thường

            let formData = $(this).serializeArray(); // Lấy dữ liệu form dưới dạng mảng

            // Kiểm tra giá trị của dropdown Danh mục cha
            let parentCategoryValue = $('#MaLoaiCha').val();
            if (parentCategoryValue === "null") {
                // Gán null nếu chọn "Danh mục cha"
                formData = formData.map((field) =>
                    field.name === "MaLoaiCha" ? {
                        name: "MaLoaiCha"
                        , value: null
                    } : field
                );
            }

            $.ajax({
                url: $(this).attr('action'), // URL từ action của form
                method: 'POST'
                , data: $.param(formData), // Chuyển đổi lại thành chuỗi
                success: function(response) {
                    if (response.success) {
                        alert('Danh mục đã được thêm thành công!');
                        $('#addCategoryModal').modal('hide'); // Đóng modal

                        // Thêm loại mới vào dropdown
                        let newOption = new Option(response.category.TenLoai, response.category.MaLoai, false, true);
                        $('#category').append(newOption).val(response.category.MaLoai).trigger('change'); // Chọn loại mới

                        // Reset form
                        $('#addCategoryForm')[0].reset();

                    } else {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                }
                , error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    for (const field in errors) {
                        errorMessage += errors[field][0] + '\n';
                    }
                    alert(errorMessage);
                }
            });
        });
    });

</script>


@endsection
