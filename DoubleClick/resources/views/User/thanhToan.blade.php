<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
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
    <!-- Địa chỉ nhận hàng -->
    <div class="col-md-8">
        <div class="mb-4 p-3 rounded shadow-sm" style="background-color: #ffffff;">
            <h5 class="section-title">Địa chỉ nhận hàng</h5>
            <div class="d-flex justify-content-between align-items-center">
                <p style="font-weight: bold;">Trần Chí Đạt - 0901318766</p>
                <a href="#" class="text-primary">Thay đổi</a>
            </div>
            <p>Quận 7, TP. Hồ Chí Minh</p>
        </div>
        <!-- Hình thức thanh toán -->
        <div class="mb-4 p-4 rounded shadow-sm" style="background-color: #ffffff;">
            <h5 class="section-title">Hình thức thanh toán</h5>
            <div class="d-flex justify-content-between align-items-center">
                <p id="selectedPayment"> <img src="{{asset('img/cod.webp')}}" alt="COD">Thanh toán khi nhận hàng (COD)</p>
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
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="COD" value="COD" checked>
                            <label class="form-check-label" for="COD">
                                <img src="{{asset('img/cod.webp')}}" alt="COD"> Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="tcb_napas" value="tcb_napas">
                            <label class="form-check-label" for="tcb_napas">
                                <img src="{{asset('img/atm.webp')}}" alt="ATM"> Thẻ ATM nội địa/Internet Banking (Hỗ trợ Internet Banking)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="tcb_visa" value="tcb_visa">
                            <label class="form-check-label" for="tcb_visa">
                                <img src="{{asset('img/visa.webp')}}" alt="Visa"> Thanh toán bằng thẻ quốc tế Visa, Master
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="vnpay" value="vnpay">
                            <label class="form-check-label" for="vnpay">
                                <img src="{{asset('img/vnpay.webp')}}" alt="VNPAY"> Thanh toán trực tuyến VNPAY
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" id="savePaymentMethod">Lưu</button>
                    </div>
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
        <!-- Thông tin kiện hàng -->
        <div class="mb-4 p-3 rounded shadow-sm" style="background-color: #ffffff;">
            <h5 class="section-title">Thông tin kiện hàng</h5>
            <div class="d-flex align-items-center mb-2">
                <img src="{{asset('img/book01.webp')}}" alt="Product" class="me-3" style="width: 100px;">
                <div>
                    <p class="mb-1">Tư duy ngược</p>
                    <p class="text-danger">75,000đ x 2</p>
                </div>
            </div>
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
                <p>Tạm tính (2)</p>
                <p>150,000đ</p>
            </div>
            <div class="d-flex justify-content-between">
                <p>Giảm giá</p>
                <p>-0đ</p>
            </div>
            <div class="d-flex justify-content-between">
                <p>Phí vận chuyển</p>
                <p>0đ</p>
            </div>
            <div class="border-top mt-3 pt-3 d-flex justify-content-between">
                <p class="total-price">Thành tiền (Đã VAT)</p>
                <p class="total-price">150,000đ</p>
            </div>
        </div>
        <button class="btn btn-primary w-100">Đặt hàng</button>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Lấy nút Lưu trong modal
        const saveButton = document.getElementById('savePaymentMethod');

        // Lấy modal
        const modal = new bootstrap.Modal(document.getElementById('paymentModal'));

        // Thêm sự kiện click cho nút Lưu để đóng modal
        saveButton.addEventListener('click', function () {
            // Lấy phương thức thanh toán được chọn
            const selectedPaymentMethod = document.querySelector('input[name="paymentMethod"]:checked');

            if (selectedPaymentMethod) {
                // Xử lý logic lưu phương thức thanh toán nếu cần

                // Đóng modal
                modal.hide();
            } else {
                alert('Vui lòng chọn một phương thức thanh toán!');
            }
        });
    });
</script>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
