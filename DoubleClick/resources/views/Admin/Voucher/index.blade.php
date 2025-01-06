@extends('Admin.layout')

@section('title', 'Danh sách vouchers')

@section('content')
    <div class="container mt-4">

        <h1 class="h3 mb-4 text-gray-800">Danh sách Voucher</h1>

        {{-- Thông báo --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <!-- Nút thêm voucher -->
        <div class="mb-3">
            <a href="{{ route('admin.vouchers.create') }}" class="btn btn-success">Thêm Voucher</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mã Voucher</th>
                    <th>Tên Voucher</th>
                    <th>Giảm Giá</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ngày Kết Thúc</th>
                    <th>Số Lượng</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vouchers as $index => $voucher)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $voucher->MaVoucher }}</td>
                        <td>{{ $voucher->TenVoucher }}</td>
                        <td>{{ $voucher->GiamGia }}%</td>
                        <td>{{ $voucher->NgayBatDau }}</td>
                        <td>{{ $voucher->NgayKetThuc }}</td>
                        <td>{{ $voucher->SoLuong }}</td>
                        <td>
                            @if ($voucher->TrangThai == 0)
                                <span class="badge bg-danger text-light">Bị vô hiệu hóa</span>
                            @elseif ($voucher->NgayKetThuc < now())
                                <span class="badge bg-secondary text-light">Hết hạn</span>
                            @elseif ($voucher->NgayBatDau > now())
                                <span class="badge bg-info">Chưa bắt đầu</span>
                            @elseif ($voucher->SoLuong == 0)
                                <span class="badge bg-warning text-dark">Đã sử dụng hết</span>
                            @else
                                <span class="badge bg-success">Hoạt động</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.vouchers.edit', $voucher->MaVoucher) }}"
                                class="btn btn-primary btn-sm">Sửa</a>
                            <form action="{{ route('admin.vouchers.toggleStatus', $voucher->MaVoucher) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn thay đổi trạng thái của voucher này?')">
                                    {{ $voucher->TrangThai == 0 ? 'Kích hoạt' : 'Khóa' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Không có voucher nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Phân trang -->
        {{ $vouchers->links() }}
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alerts = document.querySelectorAll('.alert');

            if (alerts) {
                alerts.forEach(alert => {
                    // Tự động ẩn thông báo sau 3 giây
                    setTimeout(() => {
                        alert.classList.remove('show'); // Loại bỏ lớp 'show' (nếu có)
                        alert.classList.add('fade'); // Thêm hiệu ứng fade
                        setTimeout(() => {
                            alert.style.display = 'none'; // Ẩn hoàn toàn
                        }, 300); // Thời gian hiệu ứng fade (0.3s)
                    }, 3000); // Thời gian 3 giây

                    // Xử lý khi nhấn nút "X"
                    const closeButton = alert.querySelector('.btn-close'); // Tìm nút "X" trong thông báo
                    if (closeButton) {
                        closeButton.addEventListener('click', function() {
                            alert.classList.remove('show'); // Loại bỏ lớp 'show' (nếu có)
                            alert.classList.add('fade'); // Thêm hiệu ứng fade
                            setTimeout(() => {
                                alert.style.display = 'none'; // Ẩn hoàn toàn
                            }, 300); // Thời gian hiệu ứng fade (0.3s)
                        });
                    }
                });
            }
        });
    </script>
@endsection
