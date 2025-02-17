@extends('Admin.Staff.subLayout')

@section('title', 'Nhân Viên Đã Xóa')
@section('subtitle', 'Danh sách nhân viên đã xóa')

@section('subcontent')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-3 d-flex align-items-center" style="gap: 10px;">
        <form action="{{ route('staff.search') }}" method="GET" class="d-flex" style="flex: 1;">
            <input type="text" name="query" class="form-control" placeholder="Tìm kiếm nhân viên" required
                style="width: 80%;"> <!-- Điều chỉnh chiều rộng -->
            <button class="btn btn-primary btn-sm" type="submit"style="margin-left: 10px;">Tìm kiếm</button>
            <!-- Nút nhỏ -->
        </form>
    </div>
    <div class="card-header text-center">
        <h1>Danh Sách Nhân Viên Đã Xóa</h1>
    </div>

    <ul class="list-group mb-3">
        @forelse ($nhanVienListDeleted as $nhanVien)
            <li class="list-group-item d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center" style="gap: 10px;">
                    <!-- Hình ảnh nhân viên -->
                    {{-- <img src="{{ asset('img/' . $nhanVien->Image) }}" alt="User " class="rounded-circle me-3"
                        style="width: 50px; height: 50px;"> --}}
                    <img src="{{ asset('storage/' . $nhanVien->Image) }}" alt="User" class="rounded-circle me-3"
                        style="width: 50px; height: 50px;">
                    <!-- Thông tin nhân viên -->
                    <div>
                        <a href="#" class="text-decoration-none">
                            <h4 class="mb-1 ten-nhan-vien" style="gap: 5px;">
                                <strong>
                                    {{ $nhanVien->TenTK }} <!-- Đảm bảo tên trường đúng -->
                                    <small class="status-indicator text-danger">
                                        <i class="fa fa-check-circle"></i> Vô hiệu hóa
                                    </small>
                                </strong>
                            </h4>
                        </a>
                        <span class="mb-1">{{ $nhanVien->MaRole }}</span>
                    </div>
                </div>
                <div class="d-none d-md-flex btn-action">
                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>
                    <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#editNhanVienModal" data-id="{{ $nhanVien->MaTK }}">
                        <i class="fa fa-edit"></i>
                    </a>
                    {{-- <a href="#" class="btn btn-warning btn-sm" onclick="khoaTaiKhoan({{ $nhanVien->MaTK }})">
                        <i class="fa fa-lock"></i>
                    </a> --}}
                    <a href="#" class="btn btn-danger btn-sm me-2" onclick="khoiPhucTaiKhoan({{ $nhanVien->MaTK }})">
                        <i class="fas fa-redo"></i>

                    </a>
                </div>
                <div class="dropdown d-md-none">
                    <button class="btn btn-info btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle"></i> Thông tin</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Chỉnh sửa</a></li>
                        {{-- <li><a class="dropdown-item" href="#"><i class="fas fa-user-lock"></i> Khóa tài khoản</a></li> --}}
                        <li><a class="dropdown-item" href="#"><i class="fas fa-trash-alt"></i> Xóa</a></li>
                    </ul>
                </div>
            </li>
        @empty
            <li class="list-group-item text-center">
                <strong>Chưa có nhân viên đã xóa tại đây.</strong>
            </li>
        @endforelse
    </ul>

    <!-- Hiển thị phân trang -->
    <div class="d-flex justify-content-center">
        {{-- {{ $nhanVienListDeleted->links() }} <!-- Thêm liên kết phân trang --> --}}
    </div>

    <script>
        function khoaTaiKhoan(id) {
            if (confirm(`Bạn có chắc chắn muốn khóa tài khoản ID ${id} không?`)) {
                alert(`Đã khóa tài khoản ID ${id}.`);
            }
        }

        function xoaTaiKhoan(id) {
            if (confirm(`Bạn có chắc chắn muốn xóa tài khoản ID ${id} không?`)) {
                window.location.href = `quan-ly-nhan-vien/${id}/delete`;
            }
        }

        function khoiPhucTaiKhoan(id) {
            if (confirm(`Bạn có chắc chắn muốn khôi phục tài khoản ID ${id} không?`)) {
                window.location.href = `quan-ly-nhan-vien/${id}/restore`;
            }
        }
    </script>

@endsection
