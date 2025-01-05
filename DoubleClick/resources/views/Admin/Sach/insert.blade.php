@extends('Admin.layout')
{{-- @section('title', $title) --}}
{{-- @section('subtitle', $subtitle) --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/insertsach.css') }}">

@endsection
@section('content')
<div class="container insert mb-5">
    <h5 class="mb-4">
        Thêm thông tin sách
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
                        <span>
                            (0/1)
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bookImages">
                        Hình ảnh sách
                    </label>
                    <div class="image-upload" id="bookImages">
                        <i class="fas fa-image"></i>
                        <span>
                            Thêm hình ảnh (0/9)
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bookName">
                        Tên sách
                    </label>
                    <input class="form-control" id="bookName" type="text" placeholder="" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="publisher">
                        Nhà xuất bản
                    </label>
                    <input class="form-control" id="publisher" type="text" placeholder="" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="author">
                        Tên tác giả
                    </label>
                    <input class="form-control" id="author" type="text" placeholder="" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="isbn">
                        ISBN
                    </label>
                    <input class="form-control" id="isbn" type="text" placeholder="" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="salePrice">
                        Giá bán
                    </label>
                    <input class="form-control" id="salePrice" type="text" placeholder="" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="category">
                        Loại
                    </label>
                    <select class="form-select" id="category">
                        <option selected="">
                            Chọn loại
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="series">
                        Bộ
                    </label>
                    <select class="form-select" id="series">
                        <option selected="">
                            Chọn bộ
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">
                        Mô tả
                    </label>
                    <textarea class="form-control" id="description" rows="3" placeholder=""></textarea>
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

@endsection
