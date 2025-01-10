@extends('Admin.layout')
@section('title', $title)
@section('subtitle', $subtitle)
@section('content')
<div class="mt-4 d-flex justify-content-start">
    <a href="{{ route('admin.donhang') }}" class="btn btn-outline-primary">
        <i class="fas fa-arrow-left"></i> Trở về
    </a>
</div>
<div class="container mt-6 mb-7">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-7">
            <div class="card shadow-lg">
                <div class="card-body p-10">
                    <h3 class="text-primary mb-4" style="font-size: 1.75rem; font-weight: 600;">DoubleClick.vn</h3>
                    <div class="border-top border-gray-200 pt-4 mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-muted mb-2">Mã hóa đơn</div>
                                <strong>#{{ $detail->MaHD }}</strong>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <div class="text-muted mb-2">Ngày lập hóa đơn</div>
                                    <strong>{{ \Carbon\Carbon::parse($detail->NgayLapHD)->format('d/m/Y H:i:s') }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="border-top border-gray-200 mt-4 py-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-muted mb-2">Khách hàng</div>
                                <strong>{{ $detail->taikhoan->TenTK }}</strong>
                                <p class="fs-sm">
                                    Địa chỉ: <strong>{{ $detail->DiaChi }}</strong>
                                    <br>
                                    SDT: <strong>{{ $detail->SDT }}</strong>
                                    <br>
                                    Email: <a href="mailto:{{ $detail->taikhoan->Email }}" class="text-primary">{{ $detail->taikhoan->Email }}</a>
                                </p>
                                <div class="text-muted mb-2">Thông tin hóa đơn</div>
                                <p class="fs-sm">
                                    Khuyến mãi: 
                                    @if ($detail->MaVoucher)
                                        <span class="badge bg-danger">{{ $detail->voucher->TenVoucher }}</span>
                                    @else
                                        <span class="badge bg-dark">Không có</span>
                                    @endif

                                    <br>
                                    Phương thức thanh toán: {{ $detail->PhuongThucThanhToan }}
                                    <br>
                                    Trạng thái: 
                                    @if ($detail->TrangThai == 0) 
                                        <span class="badge bg-warning text-dark">Chờ thanh toán</span>
                                    @elseif ($detail->TrangThai == 1) 
                                        <span class="badge bg-info">Đang xử lý</span>
                                    @elseif ($detail->TrangThai == 2) 
                                        <span class="badge bg-primary">Đang vận chuyển</span>
                                    @elseif ($detail->TrangThai == 3) 
                                        <span class="badge bg-success">Đã giao</span>
                                    @elseif ($detail->TrangThai == 4) 
                                        <span class="badge bg-danger">Hủy</span>
                                    @endif
                                    <br>
                                    Ghi chú: 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="text-muted mb-2">Chi tiết hóa đơn</div>
                    <table class="table border-bottom border-gray-200 mt-3">
                        <thead>
                            <tr>
                                <th scope="col" class="fs-sm text-dark text-uppercase px-0">#</th>
                                <th scope="col" class="fs-sm text-dark text-uppercase px-0">Sản phẩm</th>
                                <th scope="col" class="fs-sm text-dark text-uppercase text-end px-0">Đơn giá</th>
                                <th scope="col" class="fs-sm text-dark text-uppercase text-end px-0">Số lượng</th>
                                <th scope="col" class="fs-sm text-dark text-uppercase text-end px-0">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail->chitiethoadon as $item)
                                <tr>
                                    <td class="px-0">{{ $loop->iteration }}</td>
                                    <td class="px-1">
                                        <img src="{{ asset('/img/sach/'. $item->sach->AnhDaiDien) }}" alt="{{ $item->sach->TenSach }}" class="me-3" style="width: 70px;">
                                        {{ $item->sach->TenSach }}
                                    </td>
                                    <td class="text-end px-0">{{ number_format($item->sach->GiaBan) }}₫</td>  
                                    <td class="text-end px-0">x {{ $item->SLMua }}</td>
                                    <td class="text-end px-0"><strong>{{ number_format($item->ThanhTien) }}₫</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5">
                        <div class="d-flex justify-content-end">
                            <p class="text-muted me-3">Tạm tính:</p>
                            <span>{{ number_format($detail->TongTien - $detail->KhuyenMai) }}₫</span>
                        </div>
                        <div class="d-flex justify-content-end">
                            <p class="text-muted me-3">Phí vận chuyển:</p>
                            <span>{{ number_format($detail->TienShip) }}₫</span>
                        </div>
                        <div class="d-flex justify-content-end">
                            <p class="text-muted me-3">Khuyến mãi:</p>
                            <span>-{{ number_format($detail->KhuyenMai) }}₫</span>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <h5 class="me-3">Tổng tiền:</h5>
                            <h5 class="text-success">{{ number_format($detail->TongTien) }}₫</h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
