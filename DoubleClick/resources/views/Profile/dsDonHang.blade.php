@extends('Profile.sublayout')

@section('css_sub')
<link rel="stylesheet" href="{{ asset('css/dsdonhang.css') }}">
@endsection

@section('content_sub')
<div class="mt-4">
    <h2>
        Đơn hàng của tôi
    </h2>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#">
                Tất cả đơn
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                Chờ thanh toán
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                Đang xử lý
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                Đang vận chuyển
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                Đã giao
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                Đã huỷ
            </a>
        </li>
    </ul>
    <div class="mt-3">
        <div class="input-group">
            <input class="form-control search-bar" placeholder="Tìm đơn hàng theo Mã đơn hàng hoặc Tên sách" type="text" />
            <button class="btn btn-primary" type="button">
                Tìm đơn hàng
            </button>
        </div>
    </div>
    <div class="mt-4">
        <div class="order-status">
            <i class="fas fa-star">
            </i>
            Đã giao
        </div>
        <div class="order-item mt-3">
            <img alt="Book cover of Chiến Binh Cầu Vồng (Tái Bản 2020)" height="80" src="https://storage.googleapis.com/a1aa/image/TfwcXIeKESrJlUwj8IjeDQ9hzYxSmzhcJqft46qowUv8IqefE.jpg" width="60" />
            <div class="order-info">
                <p class="order-title">
                    Chiến Binh Cầu Vồng (Tái Bản 2020)
                </p>
                <p class="order-price">
                    67.154 ₫
                </p>
            </div>
            <div class="order-actions">
                <button class="btn btn-outline-danger">
                    Đánh giá
                </button>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <p class="me-3">
                Tổng tiền:
                <strong>
                    90.854 ₫
                </strong>
            </p>
            <button class="btn btn-outline-primary me-2">
                Mua lại
            </button>
            <button class="btn btn-outline-primary">
                Xem chi tiết
            </button>
        </div>
    </div>
</div>
@endsection
