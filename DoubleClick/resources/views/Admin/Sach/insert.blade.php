@extends('Admin.layout')
@section('title', $title)
{{-- @section('subtitle', $subtitle) --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/insertsach.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')

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


<div class="container insert mb-5">
    <h5 class="mb-4">
        Thêm thông tin sách mới
    </h5>
    <form action="{{ route('admin.sach.store') }}" method="POST" id="bookForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                {{-- Ảnh bìa --}}
                <div class="mb-3">
                    <label class="form-label" for="coverImage">
                        Ảnh bìa
                    </label>
                    <div class="image-upload" id="coverImage">
                        <i class="fas fa-image"></i>
                        <span>(0/1)</span>
                        <input type="file" id="coverImageInput" name="AnhDaiDien" accept="image/*" style="display: none;">
                    </div>
                    <div id="coverImagePreview" class="mt-3"></div> <!-- Chứa ảnh bìa -->
                    @error('AnhDaiDien')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Hình ảnh sách --}}
                <div class="mb-3">
                    <label class="form-label" for="bookImages">
                        Hình ảnh sách
                    </label>
                    <div class="image-upload" id="bookImages">
                        <i class="fas fa-image"></i>
                        <span>Thêm hình ảnh (0/9)</span>
                        <input type="file" id="images" name="images[]" accept="image/*" style="display: none;" multiple>
                    </div>
                    <div id="imagePreview" class="mt-3"></div> <!-- Chứa preview các hình ảnh -->
                    @error('images')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Tên sách --}}
                <div class="mb-3">
                    <label class="form-label" for="bookName">
                        Tên sách
                    </label>
                    <input class="form-control" id="bookName" name="TenSach" type="text" placeholder="Hãy nhập tên sách" required maxlength="50" value="{{ old('TenSach')}}" />
                    @error('TenSach')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Năm xuất bản --}}
                <div class="mb-3">
                    <label class="form-label" for="publisher">
                        Năm xuất bản
                    </label>
                    <input class="form-control" id="publisher" name="NXB" type="number" min="1000" max="2099" placeholder="Hãy nhập năm xuất bản" required value="{{ old('NXB')}}" />
                    @error('NXB')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                {{-- Tên Tác giả --}}
                <div class="mb-3">
                    <label class="form-label" for="author">
                        Tên tác giả
                    </label>
                    <input class="form-control" id="author" type="text" name="TenTG" placeholder="Hãy nhập tác giả" maxlength="50" value="{{ old('TenTG')}}" />
                    @error('TenTG')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- ISBN --}}
                <div class="mb-3">
                    <label class="form-label" for="isbn">
                        ISBN
                    </label>
                    <input class="form-control" id="isbn" type="text" name="ISBN" placeholder="Hãy nhập ISBN" required maxlength="50" value="{{ old('ISBN')}}" />
                    @error('ISBN')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Giá bán --}}
                <div class="mb-3">
                    <label class="form-label" for="salePrice">
                        Giá bán (VNĐ)
                    </label>
                    <input class="form-control" id="salePrice" name="GiaBan" type="number" min="1000" placeholder="Hãy nhập giá bán" required value="{{ old('GiaBan')}}" />
                    @error('GiaBan')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
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
                        <option value="" selected disabled>Chọn loại</option>
                        @foreach($loaiSach as $loai)
                        <option value="{{ $loai->MaLoai }}">
                            {{ $loai->TenLoai }}
                        </option>
                        @endforeach
                    </select>
                </div>
                {{-- Tên bộ sách --}}
                <div class="mb-3">
                    <label class="form-label">Chọn cách thức nhập bộ sách</label>
                    <div>
                        <!-- Radio button cho "Chọn bộ sách có sẵn" -->
                        <input type="radio" id="chooseExisting" name="chooseOption" value="existing" {{ old('chooseOption') == 'existing' ? 'checked' : '' }}>
                        <label for="chooseExisting">Chọn bộ có sẵn</label>

                        <!-- Radio button cho "Nhập bộ sách mới" -->
                        <input type="radio" id="enterNew" name="chooseOption" value="new" {{ old('chooseOption') == 'new' ? 'checked' : '' }}>
                        <label for="enterNew">Nhập bộ sách mới</label>
                    </div>

                    @if($boSach->isEmpty())
                    <div id="newSeriesDiv">
                        <label class="form-label" for="newSeries">Nhập bộ mới</label>
                        <input type="text" id="newSeries" name="TenBoSach" class="form-control" placeholder="Nhập bộ sách mới" value="{{ old('TenBoSach') }}" maxlength="100">
                    </div>
                    @else
                    <div id="existingSeriesDiv" style="display: none;">
                        <label class="form-label" for="series">Bộ</label>
                        <select class="form-select" id="series" name="TenBoSach">
                            <option value="" selected disabled>Chọn bộ</option>
                            @foreach($boSach as $bo)
                            <option value="{{ $bo->TenBoSach }}" {{ old('TenBoSach') == $bo->TenBoSach ? 'selected' : '' }}>
                                {{ $bo->TenBoSach }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Trường nhập bộ mới -->
                    <div id="newSeriesDiv" style="display: none;">
                        <label class="form-label" for="newSeries">Hoặc nhập bộ mới</label>
                        <input type="text" id="newSeries" name="TenBoSach" class="form-control" placeholder="Nhập bộ sách mới" value="{{ old('TenBoSach') }}">
                    </div>
                    @endif
                    @error('TenBoSach')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- Mô tả --}}
                <div class="mb-3">
                    <label class="form-label" for="description">
                        Mô tả
                    </label>
                    <textarea class="form-control" id="description" rows="4" name="MoTa" placeholder="Hãy nhập mô tả" maxlength="100" value="{{ old('MoTa')}}"></textarea>
                    @error('MoTa')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary me-2" type="submit">
                Thêm
            </button>
            <button class="btn btn-secondary" type="button">
                Quay lại
            </button>
        </div>
    </form>
</div>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JavaScript Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    //Ảnh sách
    // Mảng lưu các hình ảnh đã chọn
    let images = [];

    // Khi người dùng click vào nút thêm hình ảnh
    document.getElementById('bookImages').addEventListener('click', function() {
        document.getElementById('images').click();
    });

    // Khi người dùng chọn hình ảnh
    document.getElementById('images').addEventListener('change', function(event) {
        const files = event.target.files;
        if (files.length === 0) return;

        const previewContainer = document.getElementById('imagePreview');
        const maxFiles = 9;

        // Tính toán tổng số lượng ảnh đã chọn + ảnh hiện có
        let fileCount = previewContainer.children.length + files.length;

        if (fileCount > maxFiles) {
            alert('Bạn chỉ được chọn tối đa 9 ảnh.');
            return;
        }

        // Cập nhật số lượng hình ảnh
        document.querySelector('#bookImages span').textContent = `Thêm hình ảnh (${fileCount}/${maxFiles})`;

        // Duyệt qua tất cả các file đã chọn và tạo hình ảnh preview
        for (let i = 0; i < files.length; i++) {
            const file = files[i]; // Thêm file vào mảng images 
            images.push(file);
            console.log('Ảnh đã chọn:', file.name); // Log tên file vào console 
            const reader = new FileReader();
            reader.onload = function(event) {
                const imgWrapper = document.createElement('div');
                imgWrapper.style.position = 'relative';
                imgWrapper.style.display = 'inline-block';
                imgWrapper.style.marginRight = '5px';
                const imgElement = document.createElement('img');
                imgElement.src = event.target.result;
                imgElement.style.maxWidth = '100px'; // Kích thước ảnh preview 
                // Thêm biểu tượng xóa 
                const deleteIcon = document.createElement('i');
                deleteIcon.className = 'fas fa-times-circle'; // Biểu tượng xóa 
                deleteIcon.style.position = 'absolute';
                deleteIcon.style.top = '0';
                deleteIcon.style.right = '0';
                deleteIcon.style.fontSize = '18px';
                deleteIcon.style.color = 'red';
                deleteIcon.style.cursor = 'pointer';
                deleteIcon.addEventListener('click', function() {
                    imgWrapper.remove(); // Xóa ảnh khi click vào biểu tượng 
                    updateImageCount(); // Cập nhật lại số lượng ảnh 
                    // Xóa ảnh khỏi mảng images 
                    const index = images.indexOf(file);
                    if (index > -1) {
                        images.splice(index, 1);
                        console.log('Ảnh bị xóa:', file.name);
                    }
                });

                imgWrapper.appendChild(imgElement);
                imgWrapper.appendChild(deleteIcon);
                previewContainer.appendChild(imgWrapper);

                // Cập nhật lại số lượng ảnh sau khi thêm mới
                updateImageCount();
            };
            reader.readAsDataURL(file);
        }
    });

    // Cập nhật số lượng ảnh hiện có
    function updateImageCount() {
        const previewContainer = document.getElementById('imagePreview');
        const fileCount = previewContainer.children.length;
        const maxFiles = 9;
        document.querySelector('#bookImages span').textContent = `Thêm hình ảnh (${fileCount}/${maxFiles})`;
    }



    //Ảnh bìa
    document.getElementById('coverImage').addEventListener('click', function() {
        document.getElementById('coverImageInput').click();
    });

    document.getElementById('coverImageInput').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Chọn file đầu tiên
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById('coverImagePreview');
                previewContainer.innerHTML = ''; // Xóa ảnh cũ nếu có

                const img = document.createElement('img');
                img.src = e.target.result;

                const deleteIcon = document.createElement('i');
                deleteIcon.className = 'fas fa-times-circle'; // Biểu tượng xóa
                deleteIcon.style.position = 'absolute';
                deleteIcon.style.top = '0';
                deleteIcon.style.right = '0';
                deleteIcon.style.fontSize = '18px';
                deleteIcon.style.color = 'red';
                deleteIcon.style.cursor = 'pointer';

                deleteIcon.addEventListener('click', function() {
                    previewContainer.innerHTML = ''; // Xóa ảnh bìa khi click vào biểu tượng
                    document.getElementById('coverImageInput').value = ''; // Xóa dữ liệu input file
                    document.querySelector('#coverImage span').textContent = '(0/1)'; // Cập nhật lại số lượng ảnh
                });

                previewContainer.appendChild(img);
                previewContainer.appendChild(deleteIcon);
                document.querySelector('#coverImage span').textContent = '(1/1)'; // Cập nhật số lượng ảnh
            };
            reader.readAsDataURL(file); // Đọc ảnh để hiển thị
        }
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lắng nghe sự kiện thay đổi trên radio button
        document.querySelectorAll('input[name="chooseOption"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                var isExistingSelected = document.getElementById('chooseExisting').checked;
                var isNewSelected = document.getElementById('enterNew').checked;

                // Ẩn/hiện các trường tương ứng dựa trên lựa chọn
                if (isExistingSelected) {
                    document.getElementById('existingSeriesDiv').style.display = 'block';
                    document.getElementById('newSeriesDiv').style.display = 'none';
                } else if (isNewSelected) {
                    document.getElementById('newSeriesDiv').style.display = 'block';
                    document.getElementById('existingSeriesDiv').style.display = 'none';
                }
            });
        });

        // Kiểm tra nếu có radio button đã được chọn khi load lại trang
        if (document.getElementById('chooseExisting').checked) {
            document.getElementById('existingSeriesDiv').style.display = 'block';
            document.getElementById('newSeriesDiv').style.display = 'none';
        } else if (document.getElementById('enterNew').checked) {
            document.getElementById('newSeriesDiv').style.display = 'block';
            document.getElementById('existingSeriesDiv').style.display = 'none';
        }
    });

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
