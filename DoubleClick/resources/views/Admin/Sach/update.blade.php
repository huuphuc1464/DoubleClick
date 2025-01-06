@extends('Admin.layout')
{{-- @section('title', $title) --}}
{{-- @section('subtitle', $subtitle) --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/updatesach.css') }}">

@endsection
@section('content')
<div class="container updatesach mt-5 mb-5">
    <h4 class="mb-4">
        Chỉnh sửa thông tin sách
    </h4>
    <form>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">
                        Ảnh bìa
                    </label>
                    <div class="image-upload">
                        <img alt="Placeholder image for book cover" height="100" src="https://storage.googleapis.com/a1aa/image/cSezV8f0DYmcqEE8AK3YezEAq16V6Q81P8HyToHX7bbkptEoA.jpg" width="100" />
                        <span>
                            (0/1)
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="image-upload">
                        <img alt="Placeholder image for additional images" height="100" src="https://storage.googleapis.com/a1aa/image/76VZ4L2PXgITCdqUnIYgedJDk8fAQRKT0wme2IIBqgchptEoA.jpg" width="100" />
                        <span class="text-danger">
                            Thêm hình ảnh (0/9)
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bookName">
                        Tên sách
                    </label>
                    <input class="form-control" id="bookName" type="text" value="Sách ABC" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="publisher">
                        Nhà xuất bản
                    </label>
                    <input class="form-control" id="publisher" type="text" value="CĐKT Cao Thắng" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="author">
                        Tên tác giả
                    </label>
                    <input class="form-control" id="author" type="text" value="ABC 123" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="isbn">
                        ISBN
                    </label>
                    <input class="form-control" id="isbn" type="text" value="ABC1234" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="purchasePrice">
                        Giá nhập
                    </label>
                    <input class="form-control" disabled="" id="purchasePrice" type="text" value="500" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="salePrice">
                        Giá bán
                    </label>
                    <input class="form-control" id="salePrice" type="text" value="1000" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="category">
                        Loại
                    </label>
                    <select class="form-select" id="category">
                        <option selected="">
                            Truyện tranh
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="series">
                        Bộ
                    </label>
                    <select class="form-select" id="series">
                        <option selected="">
                            Conan
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">
                        Mô tả
                    </label>
                    <textarea class="form-control" id="description" rows="3">Hay</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="status">
                        Trạng thái
                    </label>
                    <select class="form-select" id="status">
                        <option selected="">
                            Hoạt động
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary me-2" type="submit">
                Cập nhật
            </button>
            <button class="btn btn-secondary" type="button">
                Quay lại
            </button>
        </div>
    </form>
</div>
@endsection
