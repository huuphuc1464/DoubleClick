@extends('Admin.layout')
@section('title', $title)
{{-- @section('subtitle', $subtitle) --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/insertsach.css') }}">
<style>

</style>
@endsection
@section('content')
<div class="container insert mb-5">
    <h5 class="mb-4">
        Thêm thông tin sách mới
    </h5>
    <form>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="coverImage">
                        Ảnh bìa
                    </label>
                    <div class="image-upload" id="coverImage">
                        <i class="fas fa-image"></i>
                        <span>(0/1)</span>
                        <input type="file" id="coverImageInput" name="cover_image" accept="image/*" style="display: none;" required>
                    </div>
                    <div id="coverImagePreview" class="mt-3"></div> <!-- Chứa ảnh bìa -->
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bookImages">
                        Hình ảnh sách
                    </label>
                    <div class="image-upload" id="bookImages">
                        <i class="fas fa-image"></i>
                        <span>Thêm hình ảnh (0/9)</span>
                        <input type="file" id="images" name="images[]" accept="image/*" style="display: none;" multiple required>
                    </div>
                    <div id="imagePreview" class="mt-3"></div> <!-- Chứa preview các hình ảnh -->
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bookName">
                        Tên sách
                    </label>
                    <input class="form-control" id="bookName" type="text" placeholder="Hãy nhập tên sách" required />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="publisher">
                        Nhà xuất bản
                    </label>
                    <input class="form-control" id="publisher" type="text" placeholder="Hãy nhập nhà xuất bản" required />
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="author">
                        Tên tác giả
                    </label>
                    <input class="form-control" id="author" type="text" placeholder="Hãy nhập tác giả" required />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="isbn">
                        ISBN
                    </label>
                    <input class="form-control" id="isbn" type="text" placeholder="Hãy nhập ISBN" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="salePrice">
                        Giá bán (VNĐ)
                    </label>
                    <input class="form-control" id="salePrice" type="number" min="1000" step="1000" placeholder="Hãy nhập giá bán" required />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="category">
                        Loại
                    </label>
                    <select class="form-select" id="category" name="MaLoai" required>
                        <option value="" selected disabled>Chọn loại</option>
                        @foreach($loaiSach as $loai)
                        <option value="{{ $loai->MaLoai }}">
                            {{ $loai->TenLoai }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    @if($boSach->isEmpty())
                    <!-- Nếu danh sách bộ sách trống, hiển thị input text để người dùng nhập -->
                    <div id="newSeriesDiv">
                        <label class="form-label" for="newSeries">Nhập bộ mới</label>
                        <input type="text" id="newSeries" name="TenBoSach" class="form-control" placeholder="Nhập bộ sách mới">
                    </div>
                    @else
                    <label class="form-label" for="series">
                        Bộ
                    </label>
                    <select class="form-select" id="series" name="TenBoSach">
                        <option value="" selected disabled>Chọn bộ</option>
                        @foreach($boSach as $bo)
                        <option value="{{ $bo->TenBoSach }}">
                            {{ $bo->TenBoSach }}
                        </option>
                        @endforeach
                    </select>
                    @endif
                </div>


                <div class="mb-3">
                    <label class="form-label" for="description">
                        Mô tả
                    </label>
                    <textarea class="form-control" id="description" rows="3" placeholder="Hãy nhập mô tả"></textarea>
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
<script>
    //Hình ảnh sách
    document.getElementById('bookImages').addEventListener('click', function() {
        document.getElementById('images').click();
    });

    document.getElementById('images').addEventListener('change', function(event) {
        const files = event.target.files;
        if (files.length === 0) return;

        const previewContainer = document.getElementById('imagePreview');
        const fileCount = previewContainer.children.length + files.length;

        const maxFiles = 9;
        if (fileCount > maxFiles) {
            alert('Bạn chỉ được chọn tối đa 9 ảnh.');
            return;
        }

        document.querySelector('#bookImages span').textContent = `Thêm hình ảnh (${fileCount}/${maxFiles})`;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = function(event) {
                const imgWrapper = document.createElement('div');
                imgWrapper.style.position = 'relative';
                imgWrapper.style.display = 'inline-block';
                imgWrapper.style.marginRight = '5px';
                const imgElement = document.createElement('img');
                imgElement.src = event.target.result;
                imgElement.style.maxWidth = '100px'; // Kích thước ảnh preview 
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
                    updateImageCount(); // Cập nhật số lượng ảnh 
                });
                imgWrapper.appendChild(imgElement);
                imgWrapper.appendChild(deleteIcon);
                previewContainer.appendChild(imgWrapper);
            };
            reader.readAsDataURL(file);
        }
        event.target.value = '';
    });

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
@endsection
