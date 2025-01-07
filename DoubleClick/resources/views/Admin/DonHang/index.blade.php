<!-- Nội dung -->
@extends('Admin.layout')
@section('title', $title)
@section('subtitle', $subtitle)
@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="container-fluid my-4 border rounded p-3 bg-white">
    <!-- tab -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="tab-menu" style="width: auto;">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('admin.donhang')}}">Tất cả</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.donhang.trangthai',4)}}">Đã hủy</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-list"></i> Trạng thái
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($trangThai as $item)
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.donhang.trangthai', $item['maTrangThai']) }}">
                                    {{ $item['tenTrangThai'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-credit-card"></i> Hình thức thanh toán
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($phuongThucThanhToan as $payment)
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.donhang.phuongthucthanhtoan', $payment['idPayment']) }}">
                                    {{ $payment['paymentName'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-calendar"></i> Đơn hàng theo ngày
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <form action="{{route('admin.donhang.filterByDate')}}" method="get">
                            <div class="d-flex flex-column p-3">
                                <label for="startDate">Từ ngày</label>
                                <input type="date" name="startDate" id="startDate" class="form-control mb-2">

                                <label for="endDate">Đến ngày</label>
                                <input type="date" name="endDate" id="endDate" class="form-control mb-2">

                                <button type="submit" class="btn btn-primary mt-2">Áp dụng bộ lọc</button>
                            </div>
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="d-flex align-items-center">
            <form action="{{ route('admin.donhang.search') }}" class="form-group d-flex align-items-center me-3" style="flex: 1; margin-right: 10px; height: 38px;">
                <input type="text" class="form-control input-ma-don-hang" name="maDonHang" id="maDonHang" placeholder="Nhập mã đơn hàng" style="flex: 1; margin-right: 5px; height: 100%;">
                <button type="submit" class="btn btn-primary btn-tim-kiem" style="height: 100%;"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <!-- Table -->
    <div class="table-responsive">
        @if ($listHoaDon->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                Bạn chưa có đơn hàng nào.
            </div>
        @else
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr class="py-4" style="height: 40px;">
                        <th>ID</th>
                        <th>Ngày tạo</th>
                        <th style="width: 250px;">Khách hàng</th>
                        <th>Phí Ship</th>
                        <th>Khuyến mãi</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th style="width: 170px;">Trạng thái</th>
                        <th style="width: 100px;">Hủy</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listHoaDon as $hoaDon)
                        <tr>
                            <td><a href="#">#{{ $hoaDon['MaHD'] }}</a></td>
                            <td>{{ \Carbon\Carbon::parse($hoaDon['NgayLapHD'])->format('d/m/Y H:i') }}</td>
                            <td>
                                <strong>{{ $hoaDon['TaiKhoan']['TenTK'] }}</strong>
                                <br><span class="address">{{ $hoaDon['DiaChi'] }}</span>
                            </td>
                            <td>
                                <strong>{{ number_format($hoaDon['TienShip'], 0, ',', '.') }}₫</strong>
                            </td>
                            <td>
                                @if($hoaDon['Voucher'])
                                    <span class="badge bg-danger" style="color: white;">{{ $hoaDon['Voucher']['TenVoucher'] }} - {{ $hoaDon['Voucher']['GiamGia'] }}%</span>
                                @else
                                    <span class="badge bg-secondary" style="color: white;">Không có</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ number_format($hoaDon['TongTien'], 0, ',', '.') }}₫</strong>
                            </td>
                            <td>{{ $hoaDon['PhuongThucThanhToan'] }}</td>
                            <td>
                                <form action="{{ route('admin.donhang.updateStatus', $hoaDon['MaHD']) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn thay đổi trạng thái?');">
                                    @csrf
                                    @method('PUT')
                                    @if ($hoaDon['TrangThai'] == 4)
                                        <span class="badge bg-danger" style="color: white;s">Hủy</span>
                                    @elseif($hoaDon['TrangThai'] == 3)
                                        <span class="badge bg-success" style="color: white;s">Đã giao</span>
                                    @else   
                                        <select name="status" class="form-control" onchange="if(confirm('Bạn có chắc chắn muốn thay đổi trạng thái?')) this.form.submit();" style="font-size: 12px; padding: 5px 10px; height: auto;">
                                            <option value="0" {{ $hoaDon['TrangThai'] == 0 ? 'selected' : '' }}><span class="badge bg-secondary" style="color: white;">Chờ thanh toán</span></option>
                                            <option value="1" {{ $hoaDon['TrangThai'] == 1 ? 'selected' : '' }}>Đang xử lý</option>
                                            <option value="2" {{ $hoaDon['TrangThai'] == 2 ? 'selected' : '' }}>Đang vận chuyển</option>
                                            <option value="3" {{ $hoaDon['TrangThai'] == 3 ? 'selected' : '' }}>Đã giao</option>
                                        </select>
                                    @endif
                                </form>
                            </td>
                            <td class="text-center">
                                @if($hoaDon['TrangThai'] < 2 && $hoaDon['TrangThai'] != 4)
                                <!-- Form hủy đơn hàng -->
                                <form id="cancelOrderForm_{{ $hoaDon['MaHD'] }}" action="{{ route('admin.donhang.cancel', $hoaDon['MaHD']) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <!-- Nút Hủy -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal_{{ $hoaDon['MaHD'] }}">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        <!-- Modal popup xác nhận hủy đơn hàng -->
                                        <div class="modal fade" id="cancelModal_{{ $hoaDon['MaHD'] }}" tabindex="-1" aria-labelledby="cancelModalLabel_{{ $hoaDon['MaHD'] }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="cancelModalLabel_{{ $hoaDon['MaHD'] }}">Xác nhận hủy đơn hàng</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form chọn lý do hủy -->
                                                        <div class="mb-3">
                                                            <label for="cancelReason_{{ $hoaDon['MaHD'] }}" class="form-label">Lý do hủy</label>
                                                            <select name="cancel_reason" id="cancelReason_{{ $hoaDon['MaHD'] }}" class="form-control" required>
                                                                <option value="Khách hàng yêu cầu hủy">Khách hàng yêu cầu hủy</option>
                                                                <option value="Tạm hết hàng">Tạm hết hàng</option>
                                                                <option value="Sản phẩm lỗi">Sản phẩm lỗi</option>
                                                                <option value="Đơn hàng sai thông tin">Đơn hàng sai thông tin</option>
                                                                <option value="Khách hàng không thanh toán">Khách hàng không thanh toán</option>
                                                                <option value="Đơn hàng không cần thiết">Đơn hàng không cần thiết</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fa fa-times"></i> Xác nhận hủy
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <!-- Pagination -->
    <div class="mt-3">
        {{ $listHoaDon->links('pagination::bootstrap-5') }}
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const masterCheckbox = document.getElementById("masterCheckbox");
            const rowCheckboxes = document.querySelectorAll(".rowCheckbox");

            // Handle master checkbox click
            masterCheckbox.addEventListener("change", function () {
                const isChecked = masterCheckbox.checked;
                rowCheckboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
            });

            // Update master checkbox state based on row checkboxes
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function () {
                    const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
                    const noneChecked = Array.from(rowCheckboxes).every(cb => !cb.checked);
                    masterCheckbox.checked = allChecked;
                    masterCheckbox.indeterminate = !allChecked && !noneChecked;
                });
            });
        });
    </script>
    <script>
        function confirmCancel() {
            const reason = document.getElementById('reason').value;
            if (reason.trim() === "") {
                alert("Bạn phải nhập lý do hủy đơn hàng.");
                return false;
            }
            return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');
        }
    </script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
