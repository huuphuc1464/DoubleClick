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
        <!-- Chiếm 40% thẻ div -->
         <div class="tab-menu"style="width: 40%;">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Tất cả</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Chờ duyệt</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-cogs"></i> Thao tác nhanh
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">Hủy đơn hàng</a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">Cập nhật trạng thái</a>
                        </li>
                    </ul>
                </li>
            </ul>
         </div>
        <!-- Chiếm 40% tiếp theo của thẻ div -->
        <div class="tim-kiem-don-hang" style="width: 40%;">
            <form action="" class="from-group" style="display: flex; width: 100%; align-items: center;">
                <!-- Input chiếm 35% -->
                <input type="text" class="form-control input-ma-don-hang" name="maDonHang" id="maDonHang" placeholder="Nhập mã đơn hàng" style="flex: 0 0 70%; margin-right: 5px;">
                <!-- Button chiếm 5% -->
                <button type="submit" class="btn btn-primary btn-tim-kiem" style="flex: 0 0 25%;"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <!-- Chiếm 30% còn lại của thẻ div -->
        <div class="tab-chuc-nang" style="width: 30%; display: flex; justify-content: space-between;">
            <!-- Nút Bộ lọc chiếm 50% chiều rộng -->
            <button class="btn btn-secondary btn-bo-loc" data-bs-toggle="modal" data-bs-target="#filterModal" style="flex: 0 0 48%;">Bộ lọc</button>
        </div>
        <!-- Modal Popup Bộ lọc-->
        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterModalLabel">
                            <i class="fa fa-filter"></i> Tìm kiếm và lọc đơn hàng
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Ngày bắt đầu</label>
                            <input type="date" class="form-control" id="startDate">
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="endDate">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" id="applyFilter">Áp dụng bộ lọc</button>
                    </div>
                </div>
            </div>
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
                        <th>
                            <input type="checkbox" id="masterCheckbox" class="custom-checkbox">
                        </th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày tạo</th>
                        <th style="width: 250px;">Khách hàng</th>
                        <th>Phí Ship</th>
                        <th>Khuyến mãi</th>
                        <th>Tổng tiền</th>
                        <th>Phương thức thanh toán</th>
                        <th>Trạng thái</th>
                        <th style="width: 150px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listHoaDon as $hoaDon)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" class="custom-checkbox rowCheckbox">
                            </td>
                            <td><a href="#">#{{ $hoaDon['MaHD'] }}</a></td>
                            <td>{{ \Carbon\Carbon::parse($hoaDon['NgayLapHD'])->format('d/m/Y H:i') }}</td>
                            <td>
                                <strong>{{ $hoaDon['TaiKhoan']['TenTK'] }}</strong>
                                <br><span class="address">{{ $hoaDon['TaiKhoan']['DiaChi'] }}</span>
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
                                @if($hoaDon['TrangThai'] == 0)
                                    <span class="badge bg-secondary" style="color: white;">Chờ thanh toán</span>
                                @elseif($hoaDon['TrangThai'] == 1)
                                    <span class="badge bg-warning" style="color: white;">Đang xử lý</span>
                                @elseif($hoaDon['TrangThai'] == 2)
                                    <span class="badge bg-primary" style="color: white;">Đang vận chuyển</span>
                                @elseif($hoaDon['TrangThai'] == 3)
                                    <span class="badge bg-success" style="color: white;">Đã giao</span>
                                @elseif($hoaDon['TrangThai'] == 4)
                                    <span class="badge bg-danger" style="color: white;">Đã hủy</span>
                                @else
                                    <span class="badge bg-dark" style="color: white;">Không xác định</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($hoaDon['TrangThai'] < 2 && $hoaDon['TrangThai'] != 4)
                                <!-- Form hủy đơn hàng -->
                                <form id="cancelOrderForm" action="{{ route('admin.donhang.cancel', $hoaDon['MaHD']) }}" method="POST" style="display: inline;" >
                                    @csrf
                                    @method('PUT')
                                    <!-- Nút Hủy -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <!-- Modal popup xác nhận hủy đơn hàng -->
                                    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="cancelModalLabel"> Xác nhận hủy đơn hàng</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-times"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form nhập lý do hủy -->
                                                    <form action="{{ route('admin.donhang.cancel', $hoaDon['MaHD']) }}" method="POST" id="cancelOrderForm" onsubmit="return confirmCancel()">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="reason" class="form-label">Lý do hủy</label>
                                                            <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fa fa-times"></i> Xác nhận hủy
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Nút Sửa (Không thay đổi gì) -->
                                    <a href="#" class="btn btn-success custom-btn">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </form>
                                @elseif(in_array($hoaDon['TrangThai'], [2, 3]))
                                    <a href="#" class="btn btn-success custom-btn" data-bs-toggle="modal" data-bs-target="#updateStatusModal" data-id="{{ $hoaDon['MaHD'] }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
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
