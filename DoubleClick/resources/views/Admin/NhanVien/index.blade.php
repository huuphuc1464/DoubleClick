@extends('Admin.layout')
@section('title', $title)
@section('subtitle', $subtitle)
@section('content')
<div class="container-fluid my-4">
    <!-- Card cho danh sách tài khoản nhân viên -->
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-dark">
            <span style="color:white;">Tài khoản nhân viên</span>
            <a href="#" class="btn btn-primary btn-them-nhan-vien" data-bs-toggle="modal" data-bs-target="#addNhanVienModal">
                <i class="fa fa-plus-circle"></i> Thêm mới
            </a>
        </div>
        <!-- Modal thêm nhân viên -->
        <div class="modal fade" id="addNhanVienModal" tabindex="-1" aria-labelledby="addNhanVienLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNhanVienLabel">Thêm Nhân Viên Mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <form id="addNhanVienForm">
                            <div class="row">
                                <!-- Username -->
                                <div class="col-md-6">
                                    <label for="Username" class="form-label">Tên Đăng Nhập</label>
                                    <input type="text" class="form-control" id="Username" name="Username" maxlength="30" required>
                                </div>
                                <!-- Password -->
                                <div class="col-md-6">
                                    <label for="Password" class="form-label">Mật Khẩu</label>
                                    <input type="password" class="form-control" id="Password" name="Password" required>
                                </div>
                                <!-- Phân quyền -->
                                <div class="col-md-6">
                                    <label for="MaRole" class="form-label">Phân quyền</label>
                                    <select class="form-control" id="PhanQuyen" name="PhanQuyen" required>
                                        <option value="1">Nhân viên bán hàng</option>
                                        <option value="2">Nhân viên quản lý kho</option>
                                    </select>
                                </div>
                                <!-- MaNV -->
                                <div class="col-md-6">
                                    <label for="MaNV" class="form-label">Mã Nhân Viên</label>
                                    <input type="number" class="form-control" id="MaNV" name="MaNV" required>
                                </div>
                                <!-- TenNV -->
                                <div class="col-md-6">
                                    <label for="TenNV" class="form-label">Tên Nhân Viên</label>
                                    <input type="text" class="form-control" id="TenNV" name="TenNV" maxlength="50" required>
                                </div>
                                <!-- Image -->
                                <div class="col-md-6">
                                    <label for="Image" class="form-label">Ảnh</label>
                                    <input type="file" class="form-control" id="Image" name="Image" required>
                                </div>
                                <!-- GioiTinh -->
                                <div class="col-md-6">
                                    <label for="GioiTinh" class="form-label">Giới Tính</label>
                                    <select class="form-control" id="GioiTinh" name="GioiTinh" required>
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                    </select>
                                </div>
                                <!-- NgaySinh -->
                                <div class="col-md-6">
                                    <label for="NgaySinh" class="form-label">Ngày Sinh</label>
                                    <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" required>
                                </div>
                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="Email" name="Email" required>
                                </div>
                                <!-- SDT -->
                                <div class="col-md-6">
                                    <label for="SDT" class="form-label">Số Điện Thoại</label>
                                    <input type="text" class="form-control" id="SDT" name="SDT" maxlength="11" required>
                                </div>
                                <!-- DiaChi -->
                                <div class="col-md-6">
                                    <label for="DiaChi" class="form-label">Địa Chỉ</label>
                                    <input type="text" class="form-control" id="DiaChi" name="DiaChi" maxlength="50" required>
                                </div>
                                <!-- TrangThai -->
                                <div class="col-md-6">
                                    <label for="TrangThai" class="form-label">Trạng Thái</label>
                                    <select class="form-control" id="TrangThai" name="TrangThai" required>
                                        <option value="1">Hoạt Động</option>
                                        <option value="0">Không Hoạt Động</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" form="addNhanVienForm">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Tìm kiếm -->
            <div class="mb-3 d-flex align-items-center" style="gap: 10px;">
                <input type="text" class="form-control" placeholder="Tìm kiếm nhân viên" style="flex: 2;">
                <button class="btn btn-primary" style="flex: 1;">Tìm kiếm</button>
                <button class="btn btn-secondary" style="flex: 1;">Nhân viên đã xóa</button>
            </div>
            <!-- Danh sách nhân viên -->
            <ul class="list-group mb-3">
                @if($nhanVienList->isEmpty())
                    <li class="list-group-item text-center">
                        <strong>Chưa có nhân viên, Hãy thêm nhân viên mới tại đây.</strong>
                    </li>
                @else
                    @foreach($nhanVienList as $nhanVien)
                    <li class="list-group-item d-flex align-items-center justify-content-between">
                        <!-- Thẻ div chứa hình ảnh và thông tin nhân viên (căn lề trái) -->
                        <div class="d-flex align-items-center" style="gap: 10px;">
                            <!-- Hình ảnh nhân viên -->
                            <img src="{{ asset('img/' . $nhanVien->Image) }}" alt="User" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                            <!-- Thông tin nhân viên -->
                            <div>
                                <a href="" class="text-decoration-none">
                                    <h4 class="mb-1 ten-nhan-vien" style="gap: 5px;">
                                        <strong>
                                            {{ $nhanVien->TenKH }} 
                                            <small class="status-indicator text-success">
                                                <i class="fa fa-check-circle"></i> Hoạt động
                                            </small>
                                        </strong>
                                    </h4>
                                </a>
                                <span class="mb-1">{{ $nhanVien->TenRole }}</span>
                            </div>
                        </div>
                        <!-- Thẻ div chứa các nút chức năng (hiển thị khi màn hình đủ rộng) -->
                        <div class="d-none d-md-flex btn-action">
                            <a href="" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>
                            <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editNhanVienModal" data-id="{{ $nhanVien->MaTK }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-warning btn-sm" onclick="khoaTaiKhoan({{ $nhanVien->MaTK }})">
                                <i class="fa fa-lock"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm me-2" onclick="xoaTaiKhoan({{ $nhanVien->MaTK }})">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                        <!-- Thẻ div chứa menu thả xuống (hiển thị khi màn hình nhỏ) -->
                        <div class="dropdown d-md-none">
                            <button class="btn btn-info btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-h"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href=""><i class="fas fa-user-circle"></i> Thông tin</a></li>
                                <li><a class="dropdown-item" href=""><i class="fas fa-pencil-alt"></i> Chỉnh sửa</a></li>
                                <li><a class="dropdown-item" href=""><i class="fas fa-user-lock"></i> Khóa tài khoản</a></li>
                                <li><a class="dropdown-item" href=""><i class="fas fa-trash-alt"></i> Xóa</a></li>
                            </ul>
                        </div>
                    </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <!-- Modal edit -->
        <div class="modal fade" id="editNhanVienModal" tabindex="-1" aria-labelledby="editNhanVienLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNhanVienLabel">Chỉnh Sửa Thông Tin Nhân Viên: Trần Chí Đạt</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editNhanVienForm">
                            <input type="hidden" id="editMaNV" name="MaNV">
                            <div class="row">
                                <!-- TenNV -->
                                <div class="col-md-6">
                                    <label for="editTenNV" class="form-label">Tên Nhân Viên</label>
                                    <input type="text" value="Trần Chí Đạt" class="form-control" id="editTenNV" name="TenNV" maxlength="50" required>
                                </div>
                                <!-- Phân quyền -->
                                <div class="col-md-6">
                                    <label for="MaRole" class="form-label">Phân quyền</label>
                                    <select class="form-control" id="PhanQuyen" name="PhanQuyen" required>
                                        <option value="1">Nhân viên bán hàng</option>
                                        <option value="2">Nhân viên quản lý kho</option>
                                    </select>
                                </div>
                                 <!-- Image -->
                                 <div class="col-md-6">
                                    <label for="Image" class="form-label">Ảnh</label>
                                    <input type="file" class="form-control" id="Image" name="Image" required>
                                </div>
                                <!-- GioiTinh -->
                                <div class="col-md-6">
                                    <label for="GioiTinh" class="form-label">Giới Tính</label>
                                    <select class="form-control" id="GioiTinh" name="GioiTinh" required>
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                    </select>
                                </div>
                                <!-- NgaySinh -->
                                <div class="col-md-6">
                                    <label for="NgaySinh" class="form-label">Ngày Sinh</label>
                                    <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" required>
                                </div>
                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="email" value="trandatc3vvk@gmail.com" class="form-control" id="Email" name="Email" required>
                                </div>
                                <!-- SDT -->
                                <div class="col-md-6">
                                    <label for="SDT" class="form-label">Số Điện Thoại</label>
                                    <input type="text" value="0901318766" class="form-control" id="SDT" name="SDT" maxlength="11" required>
                                </div>
                                <!-- DiaChi -->
                                <div class="col-md-6">
                                    <label for="DiaChi" class="form-label">Địa Chỉ</label>
                                    <input type="text" value="Quận 7, TP Hồ Chí Minh" class="form-control" id="DiaChi" name="DiaChi" maxlength="50" required>
                                </div>
                                <!-- TrangThai -->
                                <div class="col-md-6">
                                    <label for="TrangThai" class="form-label">Trạng Thái</label>
                                    <select class="form-control" id="TrangThai" name="TrangThai" required>
                                        <option value="1">Hoạt Động</option>
                                        <option value="0">Không Hoạt Động</option>
                                    </select>
                                </div>
                                <!-- Các input khác... -->
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" form="editNhanVienForm">Cập Nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function khoaTaiKhoan(id) {
        if (confirm(`Bạn có chắc chắn muốn khóa tài khoản ID ${id} không?`)) {
            alert(`Đã khóa tài khoản ID ${id}.`);
        }
    }

    function xoaTaiKhoan(id) {
        if (confirm(`Bạn có chắc chắn muốn xóa tài khoản ID ${id} không?`)) {
            alert(`Đã xóa tài khoản ID ${id}.`);
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<Style>
    /* Styles chung */
    .container-fluid {
        padding: 0;
        width: 1000px; /* Để chiều rộng tự động điều chỉnh */
    }

    .list-group-item, .list-group-item span {
        font-size: 12px;
    }
    .list-group-item h4 {
        font-size: 14px;
    }
    .dropdown-menu {
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .btn-action {
        gap: 10px;
    }

    .btn-action a {
        font-size: 20px;
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .btn-them-nhan-vien {
        width: 130px;
        height: 45px;
        align-items: center;
        justify-content: center; 
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .container-fluid {
            width: 100%; /* Đảm bảo container chiếm toàn bộ chiều rộng */
            padding: 0 15px; /* Thêm khoảng cách bên trong */
        }

        .btn-action a {
            font-size: 16px; /* Giảm kích thước biểu tượng */
            width: 30px;
            height: 30px;
        }

        .btn-them-nhan-vien {
            width: 100px; /* Giảm kích thước nút */
            height: 40px;
        }

        .list-group-item, .list-group-item h4 {
            font-size: 11px; /* Giảm kích thước văn bản cho màn hình nhỏ */
        }
    }

    @media (max-width: 480px) {
        .btn-action a {
            font-size: 14px; /* Giảm thêm kích thước biểu tượng */
            width: 25px;
            height: 25px;
        }

        .btn-them-nhan-vien {
            width: 80px; /* Giảm kích thước nút */
            height: 35px;
        }

        .list-group-item, .list-group-item h4 {
            font-size: 10px; /* Giảm kích thước văn bản để phù hợp màn hình nhỏ hơn */
        }
    }
</Style>
@endsection
