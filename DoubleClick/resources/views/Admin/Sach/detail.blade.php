@extends('Admin.layout')
@section('title', $title)
{{-- @section('subtitle', $subtitle) --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/detailbook.css') }}">
@endsection
@section('content')
<div class="container details mt-5 mb-5">
    <h5 class="mb-4">
        <b>Chi tiết sách {{ $sach->TenSach }}</b>
    </h5>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label" for="coverImage">
                    Ảnh bìa
                </label>
                <div class="image-upload-placeholder">
                    <img alt="{{ $sach->TenSach }}" src="{{ asset('img/sach/'.$sach->AnhDaiDien) }}" />
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="bookImages">
                    Hình ảnh sách
                </label>
                @if(!$anhSach->isNotEmpty())
                <p>Không có ảnh cho sách này</p>
                @else
                <div class="d-flex flex-wrap">
                    @foreach ($anhSach as $item)
                    <div class="image-upload-placeholder">
                        <img alt="{{ $item->HinhAnh }}" src="{{ asset('img/sach/'.$item->HinhAnh) }}" />
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label" for="bookName">
                    Tên sách
                </label>
                <input class="form-control" id="bookName" readonly="" type="text" value="{{ $sach->TenSach }}" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="TenNCC">
                    Tên nhà cung cấp
                </label>
                <input class="form-control" id="TenNCC" readonly="" type="text" value="{{ $sach->TenNCC }}" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="publisher">
                    Năm xuất bản
                </label>
                <input class="form-control" id="publisher" readonly="" type="text" value="{{ $sach->NXB }}" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="author">
                    Tên tác giả
                </label>
                <input class="form-control" id="author" readonly="" type="text" value="{{ $sach->TenTG }}" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="isbn">
                    ISBN
                </label>
                <input class="form-control" id="isbn" readonly="" type="text" value="{{ $sach->ISBN }}" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label" for="SoLuongTon">
                    Số lượng tồn kho
                </label>
                <input class="form-control" id="SoLuongTon" readonly="" type="text" value="{{ number_format($sach->SoLuongTon) }}" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="purchasePrice">
                    Giá nhập
                </label>
                <input class="form-control" id="purchasePrice" readonly="" type="text" value="{{ number_format($sach->GiaNhap) }}" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="salePrice">
                    Giá bán
                </label>
                <input class="form-control" id="salePrice" readonly="" type="text" value="{{ number_format($sach->GiaBan, 0, '.', ',') }} VNĐ" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="category">
                    Loại sách
                </label>
                <input class="form-control" id="category" readonly="" type="text" value="{{ $sach->TenLoai }}" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="boSach">
                    Bộ sách
                </label>
                <input class="form-control" id="boSach" readonly="" type="text" value="{{ $sach->TenBoSach }}" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">
                    Mô tả
                </label>
                <textarea class="form-control" id="description" readonly="" rows="3">{{ $sach->MoTa }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="status">
                    Trạng thái
                </label>
                @if($sach->TrangThai == 1)
                <input type="text" class="form-control" readonly name="TrangThai" id="status" value="Hoạt động">

                @else
                <input type="text" class="form-control" readonly name="TrangThai" id="status" value="Ngưng bán">

                @endif
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.sach.edit', $sach->MaSach) }}" class="btn btn-primary me-2">
            Cập nhật
        </a>
        <a class="btn btn-secondary" href="{{ route('admin.sach') }}">
            Quay lại
        </a>
    </div>
</div>
@endsection
