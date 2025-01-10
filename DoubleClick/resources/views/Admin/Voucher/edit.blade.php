@extends('Admin.layout')

@section('title', 'Sửa Voucher')


@section('content')
    <div class="container mt-4">
        <h1 class="h3 mb-4 text-gray-800">Sửa Voucher</h1>

        {{-- Hiển thị thông tin báo lỗi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- Hiển thị thông báo thành công  --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Hiển thị thông báo lỗi chung --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible  fade show" role="alert">
                {{ session('error') }}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.vouchers.update', $voucher->MaVoucher) }}" method="POST">
            @csrf
            @method('PATCH') <!-- Thêm Phương thức PATCH -->

            <!-- Mã Voucher -->
            <div class="mb-3">
                <label for="MaVoucher" class="form-label">Mã Voucher</label>
                <input type="text" class="form-control" id="MaVoucher" name="MaVoucher" placeholder="Nhập mã voucher"
                    value="{{ old('MaVoucher') ?? $voucher->MaVoucher }}" required readonly>
            </div>
            <!-- Tên Voucher -->
            <div class="mb-3">
                <label for="TenVoucher" class="form-label">Tên Voucher</label>
                <input type="text" class="form-control" id="TenVoucher" name="TenVoucher" placeholder="Nhập tên voucher"
                    value="{{ old('TenVoucher', $voucher->TenVoucher) }}" required>
            </div>

            <!--Giảm Giá -->
            <div class="mb-3">
                <label for="GiamGia" class="form-label">Giảm Giá (%)</label>
                <input type="number" class="form-control" id="GiamGia" name="GiamGia"
                    placeholder="Nhập giá trị giảm giá (%)" value="{{ old('GiamGia', $voucher->GiamGia) }}" required
                    min="0" max="100" />
                <small class="form-text text-muted">Nhập giá trị từ 0 đến 100. </small>
            </div>
            <!-- Ngày bắt đầu -->
            <div class="mb-3">
                <label for="NgayBatDau" class="form-label">Ngày bắt đầu</label>
                <input type="date" class="form-control" id="NgayBatDau" name="NgayBatDau"
                    value="{{ old('NgayBatDau', date('Y-m-d', strtotime($voucher->NgayBatDau))) }}" required>
            </div>

            <!-- Ngày kết thúc -->
            <div class="mb-3">
                <label for="NgayKetThuc" class="form-label">Ngày kết thúc</label>
                <input type="date" class="form-control" id="NgayKetThuc" name="NgayKetThuc"
                    value="{{ old('NgayKetThuc', date('Y-m-d', strtotime($voucher->NgayKetThuc))) }}" required>
            </div>

            <!-- Giá Trị Tối Thiểu -->
            <div class="mb-3">
                <label for="GiaTriToiThieu" class="form-label">Giá Trị Tối Thiểu</label>
                <div class="input-group">
                    <span class="input-group-text">VNĐ</span>
                    <input type="number" class="form-control" id="GiaTriToiThieu" name="GiaTriToiThieu"
                        placeholder="Nhập giá trị tối thiểu"
                        value="{{ old('GiaTriToiThieu', $voucher->GiaTriToiThieu) }}" />
                </div>
            </div>

            <!-- Số lượng -->
            <div class="mb-3">
                <label for="SoLuong" class="form-label">Số Lượng</label>
                <input type="number" class="form-control" id="SoLuong" name="SoLuong" placeholder="Nhập số lượng voucher"
                    value="{{ old('SoLuong', $voucher->SoLuong) }}" required min="1" />
            </div>

            <!-- Nút hành động -->
            <button type="submit" class="btn btn-success">Cập Nhật Voucher</button>
            <button type="reset" class="btn btn-warning">Đặt lại</button>
            <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary">Hủy</a>
        </form>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date().toISOString().split("T")[0];
            const ngayBatDauInput = document.getElementById("NgayBatDau");
            const ngayKetThucInput = document.getElementById("NgayKetThuc");

            ngayBatDauInput.setAttribute("min", today);

            //Cập nhật giá trị cho Ngày kết thúc khi chọn ngày Ngày bắt đầu
            ngayBatDauInput.addEventListener("change", function() {
                const selectedDate = ngayBatDauInput.value;
                const minEndDate = new Date(selectedDate);
                minEndDate.setDate(minEndDate.getDate() + 1);
                ngayKetThucInput.setAttribute("min", minEndDate.toISOString().split("T")[0]);
            })
        })
    </script>

@endsection
