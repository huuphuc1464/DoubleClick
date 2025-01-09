@extends('Profile.sublayout')
@section('css_sub')
<style>
    .order-status {
        color: red;
        font-size: 18px;
        font-weight: bold;
        background-color: #feebc9;
        padding: 10px;
        border-radius: 5px;
    }

    .order-details {
        font-size: 16px;
    }

    .order-details .price {
        text-decoration: line-through;
        color: #888;
    }

    .order-details .discounted-price {
        color: red;
        font-weight: bold;
    }

    .order-info {
        font-size: 14px;
    }

    .order-info .col-9 {
        font-weight: bold;
    }

    .order-reason {
        font-size: 14px;
        color: #655e5e;
        background-color: #d4d2d2;
        padding: 10px;
        border-radius: 5px;
    }

    .divider {
        border-bottom: 1px solid #ddd;
        margin-top: 10px;
        margin-bottom: 15px;
    }

    .back-link {
        margin-right: 10px;
    }

    .order-info .row {
        margin-bottom: 10px;
    }

</style>
@endsection
@section('title')
    {{ $title }}
@endsection
@section('content_sub')
<div class="container mt-4" style="max-width: 900px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a class="text-decoration-none back-link" href="{{ route('profile.dsdonhang') }}">
            &lt; TRỞ LẠI
        </a>
        <span class="order-time">
            Thời gian hủy: {{ $CTHuy->first()->NgayHuy }}
        </span>
    </div>
    <div class="divider"></div>
    <div class="order-status mb-4">
        Đã hủy đơn hàng
    </div>

    <div class="order-details">
        @foreach ($CTHuy as $item)
        <div class="d-flex justify-content-between mb-3 align-items-center">
            <!-- Hình ảnh và thông tin sách -->
            <div class="d-flex">
                {{-- <img alt="Image of a book" class="me-3" height="100" src="{{ $item->AnhDaiDien }}" width="100" /> --}}
                <img alt="Image of a Makita 8 inch fan with 2 speed settings, reversible direction, and a 4cm standard base" class="me-3" height="100" src="{{ asset('/img/sach/' . $item->AnhDaiDien) }}" width="100" style="object-fit: cover;" />
                <div>
                    <div>{{ $item->TenSach }}</div>
                    <div>x{{ $item->SLMua }}</div>
                </div>
            </div>
            <!-- Giá sách -->
            <div class="text-end">
                <div class="price">{{ number_format($item->GiaBan, 0, ',', '.') }} đ</div>
                <div class="discounted-price">{{ number_format($item->DonGia, 0, ',', '.') }} đ</div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="divider"></div>
    <div class="order-info mb-4">
        <div class="row">
            <div class="col-9 text-end">
                Yêu cầu bởi
            </div>
            <div class="col-3 text-end">
                {{ $CTHuy->first()->NguoiHuy }}
            </div>
        </div>
        <div class="row">
            <div class="col-9 text-end">
                Phương thức thanh toán
            </div>
            <div class="col-3 text-end">
                {{ $CTHuy->first()->PhuongThucThanhToan }}
            </div>
        </div>
        <div class="row">
            <div class="col-9 text-end">
                Mã đơn hàng
            </div>
            <div class="col-3 text-danger text-end">
                #{{ $CTHuy->first()->MaHD }}
            </div>
        </div>
    </div>
    <div class="order-reason">
        Lý do: Muốn thay đổi sản phẩm trong đơn hàng (size, màu sắc, số lượng,...)
    </div>
</div>
@endsection
