@extends('Profile.sublayout')

@section('css_sub')
{{-- <link rel="stylesheet" href="{{ asset('css/.css') }}"> --}}
<style>
    .order-details {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 20px;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .order-header h1 {
        font-size: 24px;
        font-weight: bold;
    }

    .order-header .order-date {
        font-size: 14px;
        color: #6c757d;
    }

    .order-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .order-info .info-box {
        background-color: #f1f3f5;
        padding: 15px;
        border-radius: 8px;
        width: 32%;
    }

    .order-info .info-box h2 {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .order-info .info-box p {
        margin: 0;
        font-size: 14px;
    }

    .order-info .info-box .highlight {
        color: #ff6f00;
        font-weight: bold;
    }

    .product-table {
        width: 100%;
        margin-bottom: 20px;
    }

    .product-table th,
    .product-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    .product-table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .product-table img {
        width: 50px;
        height: auto;
    }

    .total-summary {
        text-align: right;
        margin-bottom: 20px;
    }

    .total-summary p {
        margin: 0;
        font-size: 14px;
    }

    .total-summary .total-amount {
        font-size: 18px;
        font-weight: bold;
        color: #ff6f00;
    }

    .back-link {
        font-size: 14px;
        color: #007bff;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .total-summary .d-flex {
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .total-summary .d-flex p:last-child {
        text-align: right;
        width: 100px;
    }

</style>
@endsection
@section('title')
    {{ $title }}
@endsection
@section('content_sub')
<div class="container">
    <div class="order-details">
        <div class="order-header">
            <h1>
                Chi tiết đơn hàng {{ $order->MaHD }} -
                @if($order->TrangThai == '3')
                Đã giao
                @elseif($order->TrangThai == '1')
                Đang xử lý
                @elseif($order->TrangThai == '0')
                Chờ thanh toán
                @elseif($order->TrangThai == '2')
                Đang vận chuyển
                @elseif($order->TrangThai == '4')
                Đã hủy
                @else
                Trạng thái không xác định
                @endif
            </h1>
            <div class="order-date">
                Ngày đặt hàng: {{ $order->NgayLapHD }}
            </div>
        </div>
        <div class="order-info">
            <div class="info-box">
                <h2>
                    Địa chỉ người nhận
                </h2>
                <p>
                    {{ $order->TenTK }}
                </p>
                <p>
                    Địa chỉ: {{ $order->DiaChi }}
                </p>
                <p>
                    Điện thoại: {{ $order->SDT }}
                </p>
            </div>
            <div class="info-box">
                <h2>
                    Hình thức giao hàng
                </h2>
                <p class="highlight">
                    @if($order->TienShip == 25000) Vận chuyển nội thành TP.HCM
                    @elseif($order->TienShip == 35000) Vận chuyển ngoại thành TP.HCM
                    @endif
                </p>
                <p>
                    Phí vận chuyển: {{ number_format($order->TienShip, 0, ',', '.') }} đ
                </p>
            </div>
            <div class="info-box">
                <h2>
                    Phương thức thanh toán
                </h2>
                <p>
                    @if($order->PhuongThucThanhToan === "COD")
                    Thanh toán tiền mặt khi nhận hàng
                    @elseif($order->PhuongThucThanhToan === "Banking")
                    Thanh toán trực tuyến
                    @endif
                </p>
            </div>
        </div>
        @php
        $total = 0;
        @endphp
        <table class="product-table">
            <thead>
                <tr>
                    <th>
                        Sản phẩm
                    </th>
                    <th>
                        Giá
                    </th>
                    <th>
                        Số lượng
                    </th>
                    <th>
                        Ghi chú
                    </th>
                    <th>
                        Tạm tính
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                <tr>
                    <td>
                        <img alt="Bìa sách Chiến binh cầu vồng" height="75" src="https://storage.googleapis.com/a1aa/image/pSyphxrR4ipOPBH3Vpns36UI5K1hhoexmL4piKudI1seJsfnA.jpg" width="50" />
                        {{ $detail->TenSach }}
                    </td>
                    <td>
                        {{ number_format($detail->DonGia, 0, ',', '.') }} đ
                    </td>
                    <td>
                        {{ $detail->SLMua }}
                    </td>
                    <td>
                        @if($detail->GhiChu == "")
                        Không có
                        @else
                        {{ $detail->GhiChu }}
                        @endif
                    </td>
                    <td>
                        {{ number_format($detail->ThanhTien, 0, ',', '.') }} đ
                    </td>
                </tr>
            </tbody>
            @php
            $total += $detail->ThanhTien;
            @endphp
            @endforeach
        </table>
        <div class="total-summary">
            <div class="d-flex">
                <p>
                    Tạm tính:
                </p>
                <p>
                    {{ number_format($total, 0, ',', '.') }} đ
                </p>
            </div>
            <div class="d-flex">
                <p>
                    Phí vận chuyển:
                </p>
                <p>
                    {{ number_format($order->TienShip, 0, ',', '.') }} đ
                </p>
            </div>
            <div class="d-flex">
                <p>
                    @if($order->KhuyenMai != 0 && $order->KhuyenMai <= 100) Giảm giá (-{{ number_format($order->KhuyenMai, 0, ',', '.') }}%): @elseif($order->KhuyenMai > 100)
                        Giảm giá:
                        @endif
                </p>
                <p>
                    @if($order->KhuyenMai != 0 && $order->KhuyenMai <= 100) -{{ number_format($order->KhuyenMai * $total / 100, 0, ',', '.') }} đ @elseif($order->KhuyenMai > 100)
                        -{{ number_format($order->KhuyenMai, 0, ',', '.') }} đ
                        @endif
                </p>
            </div>
            <div class="d-flex total-amount">
                <p>
                    Tổng cộng:
                </p>
                <p>
                    {{ number_format($order->TongTien, 0, ',', '.') }} đ
                </p>
            </div>
        </div>
        <a class="back-link" href="{{ route('profile.dsdonhang') }}">
            &lt;&lt; Quay lại đơn hàng của tôi
        </a>
    </div>
</div>
@endsection
