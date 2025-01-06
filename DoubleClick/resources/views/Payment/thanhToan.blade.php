<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán | DoubleClick</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/pay.css')}}">
</head>
<body>
    <!-- Header -->
    <header class="bg-success text-white py-3 fixed-top">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h1 class="h5 mb-0" style=" font-size: 2.0rem;">DoubleClick</h1>
            </div>
        </div>
    </header>
    <!-- Content -->
    <div class="checkout-container" > 
        <div class="row py-4" style="background-color: #f5f5f5;">
            <!-- Thông tin khách hàng -->
            <div class="col-md-8">
                <div class="mb-4 p-3 rounded shadow-sm" style="background-color: #ffffff;">
                    <h5 class="section-title">Thông tin khách hàng</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <p style="font-weight: bold;">{{$khachHang->TenTK}} - {{$khachHang->SDT}}</p>
                        <!-- Dẫn đến trang profile thay đổi địa chỉ -->
                        <a href="" class="text-primary">Thay đổi</a> 
                    </div>
                </div>
                <!-- Chọn địa chỉ nhận hàng -->
                <div class="mb-4 p-3 rounded shadow-sm" style="background-color: #ffffff;">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="addressInput" placeholder="Điện thoại">
                    </div>
                    <!-- Phần trên: Nhập địa chỉ -->
                    <div class="mb-3">
                        <input type="text" class="form-control" id="addressInput" placeholder="Số nhà, tên đường...">
                    </div>
                    <!-- Phần dưới: Select box -->
                    <div class="d-flex flex-column flex-lg-row gap-3">
                      
                            <!-- Tỉnh/TP -->
                            <div class="flex-grow-1">
                                <label for="provinceSelect" class="form-label fw-bold">Tỉnh/Thành phố</label>
                                <select class="form-select" id="provinceSelect" onclick="this.form.submit();">
                                    <option value="" selected>Chọn tỉnh/thành phố</option>
                                </select>
                            </div>
                            <!-- Quận/Huyện -->
                            <div class="flex-grow-1">
                                <label for="districtSelect" class="form-label fw-bold">Quận/Huyện</label>
                                <select class="form-select" id="districtSelect" disabled>
                                    <option value="" selected>Chọn quận/huyện</option>
                                </select>
                            </div>
                            <!-- Xã/Phường -->
                            <div class="flex-grow-1">
                                <label for="wardSelect" class="form-label fw-bold">Xã/Phường</label>
                                <select class="form-select" id="wardSelect" disabled>
                                    <option value="" selected>Chọn xã/phường</option>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="mb-4 p-4 rounded shadow-sm" style="background-color: #ffffff;">
                    <h5 class="section-title">Voucher</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Hiển thị voucher được chọn -->
                        <p id="selectedVoucher" class="p-2 rounded" style="background-color: #f0f0f0; border: 1px solid #ccc; color: #333;">
                            <span>Chưa chọn Voucher</span>
                        </p>
                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#voucherModal">Chọn Voucher</a>
                    </div>
                </div>
                <!-- Modal chọn voucher -->
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
                                    $cartSum = $cart->sum(fn($item) => $item->GiaBan * $item->SLMua);
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
                                            data-discount="{{ $vc->GiamGia }}"
                                            data-type="{{ $vc->GiamGia <= 100 ? 'percent' : 'amount' }}"
                                            {{ $isEligible ? '' : 'disabled' }}>
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
                <!-- Hình thức thanh toán -->
                <div class="mb-4 p-4 rounded shadow-sm" style="background-color: #ffffff;">
                    <h5 class="section-title">Hình thức thanh toán</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <!--Thay đổi thành hình thức thanh toán được chọn (dữ liệu động)-->
                        <p id="selectedPayment">
                            <img src="{{ asset('img/cod.webp') }}" alt="COD"> Thanh toán khi nhận hàng (COD)
                        </p>
                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">Thay đổi</a>
                    </div>
                </div>
                <!-- Modal chọn hình thức thanh toán -->
                <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentModalLabel">Chọn hình thức thanh toán</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @foreach ($hinhThucThanhToan as $index => $hinhThuc)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentMethod" 
                                            id="paymentMethod-{{ $index }}" 
                                            value="{{ $hinhThuc['Tên'] }}" 
                                            @if ($index === 0) checked @endif>
                                        <label class="form-check-label" for="paymentMethod-{{ $index }}">
                                            <img src="{{ asset($hinhThuc['HinhAnh']) }}" alt="{{ $hinhThuc['Tên'] }}"> {{ $hinhThuc['Tên'] }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" id="savePaymentMethod">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Thông tin kiện hàng -->
                <div class="mb-4 p-3 rounded shadow-sm" style="background-color: #ffffff;">
                    <h5 class="section-title">Thông tin kiện hàng</h5>
                    @foreach ($cart as $item)
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset($item->AnhDaiDien) }}" alt="{{ $item->TenSach }}" class="me-3" style="width: 100px;">
                            <div>
                                <p class="mb-1">{{ $item->TenSach }}</p>
                                <p class="text-danger">{{ number_format($item->GiaBan, 0, ',', '.') }}đ x {{ $item->SLMua }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Ghi chú -->
                <div>
                    <textarea class="form-control" placeholder="Ghi chú"></textarea>
                </div>
            </div>
            <!-- Đơn hàng -->
            <div class="col-md-4">
                <div class="order-summary mb-4 p-3 rounded shadow-sm" style="background-color: #ffffff;">
                    <h5 class="section-title">Đơn hàng</h5>
                    <div class="d-flex justify-content-between">
                        <p>Tạm tính ({{ $cart->count() }})</p>
                        <p id="subtotal">{{ number_format($cart->sum(fn($item) => $item->GiaBan * $item->SLMua), 0, ',', '.') }}đ</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Giảm giá</p>
                        <p id="discountAmount">-0</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Phí vận chuyển</p>
                        <p id="shippingFee">0đ</p>
                    </div>
                    <div class="border-top mt-3 pt-3 d-flex justify-content-between">
                        <p class="total-price">Thành tiền (Đã VAT)</p>
                        <p id="totalPrice" class="total-price">
                            {{ number_format($cart->sum(fn($item) => $item->GiaBan * $item->SLMua), 0, ',', '.') }}đ
                        </p>
                    </div>
                </div>
                <a href="{{route('thanks')}}" class="btn btn-primary w-100">Đặt hàng</a>
            </div>
        </div>
    </div>
    <script src="{{asset('js/pay.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
