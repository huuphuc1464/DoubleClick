@extends('Admin.layout')
{{-- @section('title', $title) --}}
{{-- @section('subtitle', $subtitle) --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/detailbook.css') }}">
@endsection
@section('content')
<div class="container details mt-5 mb-5">
    <h5 class="mb-4">
        Chi tiết sách
    </h5>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label" for="coverImage">
                    Ảnh bìa
                </label>
                <div class="image-upload-placeholder">
                    <img alt="Placeholder for cover image upload" height="50" src="https://storage.googleapis.com/a1aa/image/u3PQTveGydU5T6HubcFo9GxtHgqjCfBD6OTgtehE2ygqYuEoA.jpg" width="50" />
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="bookImages">
                    Hình ảnh sách
                </label>
                <div class="d-flex flex-wrap">
                    <div class="image-upload-placeholder">
                        <img alt="Placeholder for book image upload 1" height="50" src="https://storage.googleapis.com/a1aa/image/zZocX3eWpy3aP6xW0V0SAnADtTBzMtvV7nMoze2STVdRMXCUA.jpg" width="50" />
                    </div>
                    <div class="image-upload-placeholder">
                        <img alt="Placeholder for book image upload 2" height="50" src="https://storage.googleapis.com/a1aa/image/wMf0SCI8sGzmdiGDM6vSzSI3VCyVBMLWThrmN6ecN8STMXCUA.jpg" width="50" />
                    </div>
                    <div class="image-upload-placeholder">
                        <img alt="Placeholder for book image upload 3" height="50" src="https://storage.googleapis.com/a1aa/image/7nzpNuFxrvJpH1X2InpxSOxEyNWzjv6Ql0isvnaSuVzFzlAF.jpg" width="50" />
                    </div>
                    <div class="image-upload-placeholder">
                        <img alt="Placeholder for book image upload 4" height="50" src="https://storage.googleapis.com/a1aa/image/l241mrl446ZHHJdhZ8Ze9v47wNjgrV6q9yfkpih10XxPMXCUA.jpg" width="50" />
                    </div>
                    <div class="image-upload-placeholder">
                        <img alt="Placeholder for book image upload 5" height="50" src="https://storage.googleapis.com/a1aa/image/1.jpg" width="50" />
                    </div>
                    <div class="image-upload-placeholder">
                        <img alt="Placeholder for book image upload 6" height="50" src="https://storage.googleapis.com/a1aa/image/2.jpg" width="50" />
                    </div>
                    <div class="image-upload-placeholder">
                        <img alt="Placeholder for book image upload 7" height="50" src="https://storage.googleapis.com/a1aa/image/3.jpg" width="50" />
                    </div>
                    <div class="image-upload-placeholder">
                        <img alt="Placeholder for book image upload 8" height="50" src="https://storage.googleapis.com/a1aa/image/4.jpg" width="50" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="bookName">
                    Tên sách
                </label>
                <input class="form-control" id="bookName" readonly="" type="text" value="Sách ABC" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="publisher">
                    Nhà xuất bản
                </label>
                <input class="form-control" id="publisher" readonly="" type="text" value="CĐKT Cao Thắng" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="author">
                    Tên tác giả
                </label>
                <input class="form-control" id="author" readonly="" type="text" value="ABC 123" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label" for="isbn">
                    ISBN
                </label>
                <input class="form-control" id="isbn" readonly="" type="text" value="ABC1234" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="purchasePrice">
                    Giá nhập
                </label>
                <input class="form-control" id="purchasePrice" readonly="" type="text" value="500" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="salePrice">
                    Giá bán
                </label>
                <input class="form-control" id="salePrice" readonly="" type="text" value="1000" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="category">
                    Loại
                </label>
                <select class="form-select" disabled="" id="category">
                    <option selected="">
                        Truyện tranh
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="series">
                    Bộ
                </label>
                <select class="form-select" disabled="" id="series">
                    <option selected="">
                        Conan
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">
                    Mô tả
                </label>
                <textarea class="form-control" id="description" readonly="" rows="3">Hay</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="status">
                    Trạng thái
                </label>
                <select class="form-select" disabled="" id="status">
                    <option selected="">
                        Hoạt động
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary me-2" type="button">
            Cập nhật
        </button>
        <button class="btn btn-secondary" type="button">
            Quay lại
        </button>
    </div>
</div>
@endsection
