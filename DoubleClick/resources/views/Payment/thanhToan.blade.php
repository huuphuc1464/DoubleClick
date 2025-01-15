<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán | DoubleClick</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/pay.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/pay.js')}}"></script>
</head>
<body>
    <header class="bg-success text-white py-3 fixed-top">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h1 class="h5 mb-0" style=" font-size: 2.0rem;">DoubleClick</h1>
            </div>
        </div>
    </header>
    <div class="checkout-container">
        <form action="{{ route('checkout') }}" method="GET">
            @csrf
            <div class="row py-4" style="background-color: #f5f5f5;">
                <div class="col-md-8">
                    <div class="mb-4 p-3 rounded shadow-sm" style="background-color: #ffffff;">
                        <h5 class="section-title">Thông tin khách hàng</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <p style="font-weight: bold;">{{$khachHang->TenTK}}</p>
                            <input type="hidden" name="MaTK" value="{{ $khachHang->MaTK }}"> 
                            <a href="" class="text-primary">Thay đổi</a>
                        </div>
                    </div>
                    <!-- Nhập và chọn thông tin -->
                    <div class="mb-4 p-3 rounded shadow-sm" style="background-color: #ffffff;">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="phone" id="phoneInput" placeholder="Điện thoại" required>
                            <span id="phoneError" style="color: red; display: none;">Số điện thoại phải gồm 10 chữ số</span>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="address" id="addressInput" placeholder="Số nhà, tên đường..." required>
                            <span id="addressError" style="color: red; display: none;">Địa chỉ không vượt quá 250 ký tự</span>
                        </div>
                        <!-- Selectbox  -->
                        <div class="d-flex flex-column flex-lg-row gap-3">
                            <div class="flex-grow-1">
                                <label for="provinceSelect" class="form-label fw-bold">Tỉnh/Thành phố</label>
                                <select class="form-select" name="province" id="provinceSelect" required>
                                    <option value="" selected>Chọn tỉnh/thành phố</option>
                                    <!-- Options for provinces will be dynamically added -->
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <label for="districtSelect" class="form-label fw-bold">Quận/Huyện</label>
                                <select class="form-select" name="district" id="districtSelect" disabled required>
                                    <option value="" selected>Chọn quận/huyện</option>
                                    <!-- Options for districts will be dynamically added -->
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <label for="wardSelect" class="form-label fw-bold">Xã/Phường</label>
                                <select class="form-select" name="ward" id="wardSelect" disabled required>
                                    <option value="" selected>Chọn xã/phường</option>
                                    <!-- Options for wards will be dynamically added -->
                                </select>
                            </div>

                            <!-- Hidden inputs to store the selected names -->
                            <input type="hidden" id="provinceName" name="provinceName">
                            <input type="hidden" id="districtName" name="districtName">
                            <input type="hidden" id="wardName" name="wardName">
                        </div>
                    </div>
                    <div class="mb-4 p-4 rounded shadow-sm" style="background-color: #ffffff;">
                        <h5 class="section-title">Voucher</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <p id="selectedVoucher" class="p-2 rounded" style="background-color: #f0f0f0; border: 1px solid #ccc; color: #333;">
                                <span>Chưa chọn Voucher</span>
                            </p>
                            <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#voucherModal">Chọn Voucher</a>
                        </div>
                    </div>
                    <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="voucherModalLabel">Danh sách Voucher</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                @php 
                            use Carbon\Carbon;
                            $currentDate = Carbon::now();
                            
                            // Chuyển mảng thành Collection trước khi sử dụng sum
                            $cartSum = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);  // Sử dụng 'price' và 'quantity' thay vì 'GiaBan' và 'SLMua'
                            @endphp

                            @foreach ($voucher as $vc)
                                @php
                                    $isEligible = $cartSum >= $vc->GiaTriToiThieu && Carbon::parse($vc->NgayKetThuc)->gte($currentDate);
                                @endphp
                                <div class="form-check voucher-card p-3 mb-3 rounded {{ $isEligible ? 'border-primary' : 'border-secondary text-muted' }}" 
                                    style="border: 1px solid; background-color: {{ $isEligible ? '#f9f9ff' : '#f1f1f1' }};">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="voucher" 
                                        id="voucher-{{ $vc->MaVoucher }}" 
                                        value="{{ $vc->MaVoucher }}" 
                                        data-discount="{{ $vc->GiamGia }} "
                                        data-type="{{ $vc->GiamGia <= 100 ? 'percent' : 'amount' }} "
                                        {{ $isEligible ? '' : 'disabled' }} >
                                    <label class="form-check-label" for="voucher-{{ $vc->MaVoucher }}">
                                        <div>
                                            <h6 class="fw-bold">{{ $vc->TenVoucher }}</h6>
                                            <p class="mb-1">
                                                Giảm: 
                                                <span class="text-danger fw-bold">
                                                    @if ($vc->GiamGia > 100)
                                                        {{ number_format($vc->GiamGia, 0, ',', '.') }} VNĐ
                                                    @else
                                                        {{ $vc->GiamGia }}%
                                                    @endif
                                                </span>
                                            </p>
                                            <small>
                                                Áp dụng từ {{ date('d/m/Y', strtotime($vc->NgayBatDau)) }} 
                                                đến {{ date('d/m/Y', strtotime($vc->NgayKetThuc)) }}
                                            </small>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="button" class="btn btn-primary" id="saveVoucher">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 p-4 rounded shadow-sm" style="background-color: #ffffff;">
                        <h5 class="section-title">Hình thức thanh toán</h5>
                        <div class="justify-content-between align-items-center">
                            <form id="paymentForm">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethodCOD" value="COD" required>
                                    <label class="form-check-label" for="paymentMethodCOD">
                                        <img src="{{asset('img/cod.webp')}}" alt="COD" class="payment-image"> Thanh toán khi nhận hàng (COD)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethodVNPAY" value="VNPAY" required>
                                    <label class="form-check-label" for="paymentMethodVNPAY">
                                        <img src="{{asset('img/vnpay.webp')}}" alt="VNPAY" class="payment-image"> Thanh toán trực tuyến VNPAY
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mb-4 p-3 rounded shadow-sm" style="background-color: #ffffff;">
                        <h5 class="section-title">Thông tin kiện hàng</h5>
                        @foreach ($cart as $item)
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset('img/sach/'. $item['image']) }}" alt="{{ $item['name'] }}" class="me-3" style="width: 100px;">
                                <div>
                                    <p class="mb-1">{{ $item['name'] }}</p>
                                    <p class="text-danger">{{ number_format($item['price'], 0, ',', '.') }}đ x {{ $item['quantity'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <textarea class="form-control" name="note" id="note" placeholder="Ghi chú"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                <div class="order-summary mb-4 p-4 rounded shadow-sm" style="background-color: #f9f9f9; border: 1px solid #ddd;">
                    <h5 class="section-title mb-3" style="font-size: 1.25rem; font-weight: bold;">Đơn hàng</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <label style="font-weight: 500;">Tạm tính ({{ count($cart) }})</label>
                        <strong>
                            <input type="text" id="subtotal" name="subtotal" value="{{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 0, ',', '.') }}" readonly style="border: none; outline: none; background-color: transparent; font-weight: bold; color: #333;">
                        </strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <label style="font-weight: 500;">Giảm giá</label>
                        <input type="text" id="discountAmount" name="discountAmount" value="0" readonly style="border: none; outline: none; background-color: transparent; font-weight: bold; color: #333;">
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <label style="font-weight: 500;">Phí vận chuyển</label>
                        <input type="text" id="shippingFee" name="shippingFee" value="0" readonly style="border: none; outline: none; background-color: transparent; font-weight: bold; color: #333;">
                    </div>
                    <div class="border-top mt-3 pt-3 d-flex justify-content-between">
                        <label class="total-price" style="font-weight: 500;">Thành tiền (Đã VAT)</label>
                        <input type="text" id="totalPrice" name="totalPrice" required value="{{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 0, ',', '.') }}" readonly style="border: none; outline: none; background-color: transparent; font-weight: bold; color: #333;">
                    </div>
                </div>

                    <!-- Button Đặt hàng -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" id="submitOrder" class="btn btn-primary w-100 py-2" style="font-size: 1.1rem;">Đặt hàng</button>
                    </div>
                    <!-- Button Giỏ hàng -->
                    <div class="d-flex justify-content-between mt-2">
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 py-2" style="font-size: 1.1rem;">Giỏ hàng</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
