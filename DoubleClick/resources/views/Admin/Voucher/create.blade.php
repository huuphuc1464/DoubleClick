@extends('Admin.layout')

@section('title', 'Thêm Voucher')

@section('content')
    <div class="container mt-4">
        <h1 class="h3 mb-4 text-gray-800">Thêm Voucher</h1>

        <!-- Hiển thị thông báo lỗi -->
        <div id="error-log" class="alert alert-danger d-none">
            <ul id="error-list" class="mb-0"></ul>
        </div>

        <!-- Hiển thị thông báo thành công -->
        <div id="success-log" class="alert alert-success d-none">
            <span id="success-message"></span>
        </div>

        <form id="voucherForm" action="{{ route('admin.vouchers.store') }}" method="POST">
            @csrf

            <!-- Mã Voucher -->
            <div class="mb-3">
                <label for="MaVoucher" class="form-label">Mã Voucher</label>
                <input type="text" class="form-control" id="MaVoucher" name="MaVoucher" placeholder="Nhập mã voucher"
                    required>
            </div>

            <!-- Tên Voucher -->
            <div class="mb-3">
                <label for="TenVoucher" class="form-label">Tên Voucher</label>
                <input type="text" class="form-control" id="TenVoucher" name="TenVoucher" placeholder="Nhập tên voucher"
                    required>
            </div>

            <!-- Giảm Giá -->
            <div class="mb-3">
                <label for="GiamGia" class="form-label">Giảm Giá (%)</label>
                <input type="number" class="form-control" id="GiamGia" name="GiamGia" placeholder="Nhập giá trị giảm (%)"
                    required min="0" max="100">
                <small class="form-text text-muted">Nhập giá trị từ 0 đến 100.</small>
            </div>

            <!-- Ngày Bắt Đầu -->
            <div class="mb-3">
                <label for="NgayBatDau" class="form-label">Ngày Bắt Đầu</label>
                <input type="date" class="form-control" id="NgayBatDau" name="NgayBatDau" required>
            </div>

            <!-- Ngày Kết Thúc -->
            <div class="mb-3">
                <label for="NgayKetThuc" class="form-label">Ngày Kết Thúc</label>
                <input type="date" class="form-control" id="NgayKetThuc" name="NgayKetThuc" required>
            </div>

            <!-- Giá Trị Tối Thiểu -->
            <div class="mb-3">
                <label for="GiaTriToiThieu" class="form-label">Giá Trị Tối Thiểu</label>
                <div class="input-group">
                    <span class="input-group-text">VNĐ</span>
                    <input type="number" class="form-control" id="GiaTriToiThieu" name="GiaTriToiThieu"
                        placeholder="Nhập giá trị tối thiểu" required min="0">
                </div>
            </div>

            <!-- Số Lượng -->
            <div class="mb-3">
                <label for="SoLuong" class="form-label">Số Lượng</label>
                <input type="number" class="form-control" id="SoLuong" name="SoLuong" placeholder="Nhập số lượng voucher"
                    required min="1">
            </div>

            <!-- Nút hành động -->
            <button type="submit" class="btn btn-success">Thêm Voucher</button>
            <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>

    <!-- Thêm thư viện SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date().toISOString().split("T")[0];
            const ngayBatDauInput = document.getElementById("NgayBatDau");
            const ngayKetThucInput = document.getElementById("NgayKetThuc");
            const errorLog = document.getElementById("error-log");
            const errorList = document.getElementById("error-list");
            const successLog = document.getElementById("success-log");
            const successMessage = document.getElementById("success-message");

            // Đặt giá trị min cho Ngày Bắt Đầu
            ngayBatDauInput.setAttribute("min", today);

            // Cập nhật giá trị min cho Ngày Kết Thúc khi chọn Ngày Bắt Đầu
            ngayBatDauInput.addEventListener("change", function() {
                const selectedDate = ngayBatDauInput.value;
                ngayKetThucInput.setAttribute("min", selectedDate);
            });

            // Đặt giá trị min ban đầu cho Ngày Kết Thúc là ngày hiện tại
            ngayKetThucInput.setAttribute("min", today);

            // Xử lý khi submit form
            const form = document.getElementById('voucherForm');
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                errorLog.classList.add('d-none');
                errorList.innerHTML = '';
                successLog.classList.add('d-none');
                successMessage.innerHTML = '';

                try {
                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const result = await response.json();
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: 'Voucher được thêm thành công!',
                        });
                        form.reset(); // Xóa dữ liệu trong form
                    } else {
                        // Hiển thị lỗi
                        if (result.errors) {
                            errorLog.classList.remove('d-none');
                            Object.values(result.errors).forEach((err) => {
                                const li = document.createElement('li');
                                li.textContent = err[0];
                                errorList.appendChild(li);
                            });
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: result.message || 'Đã xảy ra lỗi.',
                        });
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: 'Đã xảy ra lỗi không xác định.',
                    });
                }
            });
        });
    </script>
@endsection
