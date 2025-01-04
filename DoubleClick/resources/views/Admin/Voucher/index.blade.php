@extends('Admin.layout')

@section('title', 'Danh sách vouchers')

@section('content')
    <div class="container mt-4">
        <h1 class="h3 mb-4 text-gray-800">Danh sách Voucher</h1>

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
                                <span class="badge bg-danger">Bị vô hiệu hóa</span>
                            @elseif ($voucher->NgayKetThuc < now())
                                <span class="badge bg-secondary">Hết hạn</span>
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
                            <form action="{{ route('admin.vouchers.destroy', $voucher->MaVoucher) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
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
@endsection
