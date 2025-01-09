@extends('Admin.layout')

@section('title', 'Thêm Voucher')

@section('content')
    <div class="container mt-4">
        <h1 class="h3 mb-4 text-gray-800">Thêm Voucher</h1>

        <!-- Hiển thị thông báo lỗi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Hiển thị thông báo thành công -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Hiển thị thông báo lỗi chung -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="C   lose"></button>
            </div>
        @endif

        <form action="{{ route('admin.vouchers.store') }}" method="POST">
            @csrf

            <!-- Mã Voucher -->
            <div class="mb-3">
                <label for="MaVoucher" class="form-label">Mã Voucher</label>
                <input type="text" class="form-control" id="MaVoucher" name="MaVoucher" placeholder="Nhập mã voucher"
                    value="{{ old('MaVoucher') }}" required>
            </div>

            <!-- Tên Voucher -->
            <div class="mb-3">
                <label for="TenVoucher" class="form-label">Tên Voucher</label>
                <input type="text" class="form-control" id="TenVoucher" name="TenVoucher" placeholder="Nhập tên voucher"
                    value="{{ old('TenVoucher') }}" required>
            </div>

            <!-- Giảm Giá -->
            <div class="mb-3">
                <label for="GiamGia" class="form-label">Giảm Giá (%)</label>
                <input type="number" class="form-control" id="GiamGia" name="GiamGia" placeholder="Nhập giá trị giảm (%)"
                    value="{{ old('GiamGia') }}" required min="0" max="100">
                <small class="form-text text-muted">Nhập giá trị từ 0 đến 100.</small>
            </div>

            <!-- Ngày Bắt Đầu -->
            <div class="mb-3">
                <label for="NgayBatDau" class="form-label">Ngày Bắt Đầu</label>
                <input type="date" class="form-control" id="NgayBatDau" name="NgayBatDau" value="{{ old('NgayBatDau') }}"
                    required>
            </div>

            <!-- Ngày Kết Thúc -->
            <div class="mb-3">
                <label for="NgayKetThuc" class="form-label">Ngày Kết Thúc</label>
                <input type="date" class="form-control" id="NgayKetThuc" name="NgayKetThuc"
                    value="{{ old('NgayKetThuc') }}" required>
            </div>

            <!-- Giá Trị Tối Thiểu -->
            <div class="mb-3">
                <label for="GiaTriToiThieu" class="form-label">Giá Trị Tối Thiểu</label>
                <div class="input-group">
                    <span class="input-group-text">VNĐ</span>
                    <input type="number" class="form-control" id="GiaTriToiThieu" name="GiaTriToiThieu"
                        placeholder="Nhập giá trị tối thiểu" value="{{ old('GiaTriToiThieu') }}" required min="0">
                </div>
            </div>

            <!-- Số Lượng -->
            <div class="mb-3">
                <label for="SoLuong" class="form-label">Số Lượng</label>
                <input type="number" class="form-control" id="SoLuong" name="SoLuong" placeholder="Nhập số lượng voucher"
                    value="{{ old('SoLuong') }}" required min="1">
            </div>

            <!-- Nút hành động -->
            <button type="submit" class="btn btn-success">Thêm Voucher</button>
            <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date().toISOString().split("T")[0];
            const ngayBatDauInput = document.getElementById("NgayBatDau");
            const ngayKetThucInput = document.getElementById("NgayKetThuc");

            // Vô hiệu hóa trường Ngày Kết Thúc ban đầu
            ngayKetThucInput.setAttribute("disabled", "true");

            // Đặt giá trị min cho Ngày Bắt Đầu
            ngayBatDauInput.setAttribute("min", today);

            // Khi chọn ngày bắt đầu, kích hoạt trường Ngày Kết Thúc và đặt giá trị min
            ngayBatDauInput.addEventListener("change", function() {
                const selectedDate = ngayBatDauInput.value;

                if (selectedDate) {
                    // Bật lại trường Ngày Kết Thúc
                    ngayKetThucInput.removeAttribute("disabled");

                    // Đặt giá trị min cho Ngày Kết Thúc
                    const minEndDate = new Date(selectedDate);
                    minEndDate.setDate(minEndDate.getDate() + 1); // Thêm 1 ngày
                    ngayKetThucInput.setAttribute("min", minEndDate.toISOString().split("T")[0]);
                } else {
                    // Vô hiệu hóa trường Ngày Kết Thúc nếu Ngày Bắt Đầu bị xóa
                    ngayKetThucInput.setAttribute("disabled", "true");
                }
            });
        });
    </script>
@endsection
