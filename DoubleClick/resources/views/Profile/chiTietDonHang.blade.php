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

</style>
@endsection

@section('content_sub')
<div class="container">
    <div class="order-details">
        <div class="order-header">
            <h1>
                Chi tiết đơn hàng {{ $id }} - Hủy
            </h1>
            <div class="order-date">
                Ngày đặt hàng: 17:25 30/11/2024
            </div>
        </div>
        <div class="order-info">
            <div class="info-box">
                <h2>
                    Địa chỉ người nhận
                </h2>
                <p>
                    HUU PHUC
                </p>
                <p>
                    Địa chỉ: 65 Huỳnh Thúc Kháng
                </p>
                <p>
                    Điện thoại: 0901234567
                </p>
            </div>
            <div class="info-box">
                <h2>
                    Hình thức giao hàng
                </h2>
                <p class="highlight">
                    FAST Giao Tiết Kiệm
                </p>
                <p>
                    Giao thứ 2, trước 19h, 02/12
                </p>
                <p>
                    Được giao bởi TikiNOW Smart Logistics (giao từ Hồ Chí Minh)
                </p>
                <p>
                    Phí vận chuyển: 23.700đ
                </p>
            </div>
            <div class="info-box">
                <h2>
                    Hình thức thanh toán
                </h2>
                <p>
                    Thanh toán tiền mặt khi nhận hàng
                </p>
            </div>
        </div>
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
                        Giảm giá
                    </th>
                    <th>
                        Tạm tính
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img alt="Bìa sách Chiến binh cầu vồng" height="75" src="https://storage.googleapis.com/a1aa/image/pSyphxrR4ipOPBH3Vpns36UI5K1hhoexmL4piKudI1seJsfnA.jpg" width="50" />
                        Chiến binh cầu vồng
                    </td>
                    <td>
                        67.154 đ
                    </td>
                    <td>
                        1
                    </td>
                    <td>
                        0 đ
                    </td>
                    <td>
                        67.154 đ
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="total-summary">
            <div class="d-flex">
                <p>
                    Tạm tính:
                </p>
                <p>
                    67.154 đ
                </p>
            </div>
            <div class="d-flex">
                <p>
                    Phí vận chuyển:
                </p>
                <p>
                    28.700 đ
                </p>
            </div>
            <div class="d-flex">
                <p>
                    Giảm giá vận chuyển:
                </p>
                <p>
                    -5.000 đ
                </p>
            </div>
            <div class="d-flex total-amount">
                <p>
                    Tổng cộng:
                </p>
                <p>
                    90.854 đ
                </p>
            </div>
        </div>
        <a class="back-link" href="{{ route('profile.dsdonhang') }}">
            &lt;&lt; Quay lại đơn hàng của tôi
        </a>
    </div>
</div>
@endsection
