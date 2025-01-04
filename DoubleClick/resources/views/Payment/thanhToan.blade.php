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
                            <select class="form-select" id="provinceSelect">
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
                <!-- Mã giảm giá -->
                <div class="mb-4 p-3 rounded shadow-sm" style="background-color: #ffffff;">
                    <h5 class="section-title">Mã giảm giá</h5>
                    <div class="d-flex">
                        <input type="text" class="form-control me-2" placeholder="Nhập mã giảm giá"style="width: 80%;">
                        <button class="btn btn-primary">Sử dụng</button>
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
                        <p>{{ number_format($cart->sum(fn($item) => $item->GiaBan * $item->SLMua), 0, ',', '.') }}đ</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Giảm giá</p>
                        <p>-0đ</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Phí vận chuyển</p>
                        <p id="shippingFee">0đ</p>
                    </div>
                    <div class="border-top mt-3 pt-3 d-flex justify-content-between">
                        <p class="total-price">Thành tiền (Đã VAT)</p>
                        <p class="total-price">
                            {{ number_format($cart->sum(fn($item) => $item->GiaBan * $item->SLMua), 0, ',', '.') }}đ
                        </p>
                    </div>
                </div>
                <a href="{{route('thanks')}}" class="btn btn-primary w-100">Đặt hàng</a>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const saveButton = document.getElementById('savePaymentMethod');
            const selectedPayment = document.getElementById('selectedPayment');
            const paymentRadios = document.querySelectorAll('input[name="paymentMethod"]');

            saveButton.addEventListener('click', function () {
                const selected = Array.from(paymentRadios).find(radio => radio.checked);
                if (selected) {
                    const label = selected.nextElementSibling.innerHTML;
                    selectedPayment.innerHTML = label;
                }
                const modal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
                modal.hide();
            });
        });
        //Lấy Địa chỉ
        document.addEventListener("DOMContentLoaded", function () {
        const provinceSelect = document.getElementById("provinceSelect");
        const districtSelect = document.getElementById("districtSelect");
        const wardSelect = document.getElementById("wardSelect");
        const shippingFeeElement = document.getElementById("shippingFee");

        // Lấy danh sách tỉnh/thành phố
        fetch("https://provinces.open-api.vn/api/p/")
            .then(response => response.json())
            .then(data => {
                data.forEach(province => {
                    const option = new Option(province.name, province.code); // Sử dụng `province.code` làm value
                    provinceSelect.add(option);
                });
            });

        // Khi chọn tỉnh/thành phố, lấy danh sách quận/huyện
        provinceSelect.addEventListener("change", function () {
            districtSelect.innerHTML = '<option value="" selected>Chọn quận/huyện</option>';
            wardSelect.innerHTML = '<option value="" selected>Chọn xã/phường</option>';
            districtSelect.disabled = true;
            wardSelect.disabled = true;

            const selectedProvinceCode = this.value;

            if (selectedProvinceCode) {
                fetch(`https://provinces.open-api.vn/api/p/${selectedProvinceCode}?depth=2`)
                    .then(response => response.json())
                    .then(data => {
                        data.districts.forEach(district => {
                            const option = new Option(district.name, district.code);
                            districtSelect.add(option);
                        });
                        districtSelect.disabled = false; // Kích hoạt quận/huyện
                    });
            } else {
                districtSelect.disabled = true; // Nếu không chọn tỉnh thì quận/huyện bị vô hiệu
            }

            // Cập nhật phí vận chuyển khi thay đổi tỉnh
            updateShippingFee();
        });

        // Khi chọn quận/huyện, lấy danh sách xã/phường
        districtSelect.addEventListener("change", function () {
            wardSelect.innerHTML = '<option value="" selected>Chọn xã/phường</option>';
            wardSelect.disabled = true;

            const selectedDistrictCode = this.value;

            if (selectedDistrictCode) {
                fetch(`https://provinces.open-api.vn/api/d/${selectedDistrictCode}?depth=2`)
                    .then(response => response.json())
                    .then(data => {
                        data.wards.forEach(ward => {
                            const option = new Option(ward.name, ward.code);
                            wardSelect.add(option);
                        });
                        wardSelect.disabled = false; // Kích hoạt xã/phường
                    });
            } else {
                wardSelect.disabled = true; // Nếu không chọn quận/huyện thì xã/phường bị vô hiệu
            }
        });

        // Cập nhật phí vận chuyển
        function updateShippingFee() {
            const province = provinceSelect.options[provinceSelect.selectedIndex].text.trim(); // Lấy tên tỉnh/TP
            console.log("Selected Province: ", province);  // In giá trị tỉnh/TP ra console

            let fee = 0;

            if (province === "Thành phố Hồ Chí Minh") {
                fee = 25000; // 25,000 VND cho TP HCM
            } else if (province) {
                fee = 35000; // 35,000 VND cho các tỉnh/TP khác
            }

            shippingFeeElement.textContent = fee.toLocaleString("vi-VN") + "đ"; // Hiển thị phí vận chuyển
        }

        // Lắng nghe sự kiện thay đổi trên combobox tỉnh/TP khi trang tải
        updateShippingFee();
    });

    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
