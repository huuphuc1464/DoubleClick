<!-- Nội dung -->
@extends('Admin.layout')
@section('title', $title)
@section('subtitle', $subtitle)
@section('content')
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
                            <a class="dropdown-item d-flex align-items-center" href="#">Xóa đơn</a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">Cập nhật trạng thái xử lý</a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">Cập nhật trạng thái thanh toán</a>
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
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr class="py-4" style="height: 40px;">
                    <th><input type="checkbox" class="custom-checkbox"></th>
                    <th>Mã đơn hàng</th>
                    <th>Ngày tạo</th>
                    <th style="width: 250px;">Khách hàng</th>
                    <th>Thành tiền</th>
                    <th>Trạng thái thanh toán</th>
                    <th>Trạng thái xử lý</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center"><input type="checkbox" class="custom-checkbox"></td>
                    <td><a href="#">#1001</a></td>
                    <td>15/11/2024 20:54</td>
                    <td>
                        <strong>Chí Đạt</strong>
                        <br><span class="address">Quận 7, TP Hồ Chí Minh</span>
                    </td>
                    <td>
                        <strong>150,000₫</strong>
                    </td>
                    <td class="text-center"><span class="badge bg-danger" style="color: white;">Chưa thanh toán</span></td>
                    <td class="text-center"><span class="badge bg-secondary" style="color: white;">Chờ duyệt</span></td>
                    <td class="text-center">
                        <button class="btn btn-danger custom-btn">
                            <i class="fa fa-trash"></i>
                        </button>
                        <a href="#" class="btn btn-success custom-btn"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center">
        <p>Từ 1 đến 1 trên tổng 1</p>
        <nav>
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item disabled"><a class="page-link" href="#">›</a></li>
            </ul>
        </nav>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
