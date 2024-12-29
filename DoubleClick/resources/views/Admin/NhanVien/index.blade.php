@extends('Admin.NhanVien.subLayout')
@section('title', $title)
@section('subtitle', $subtitle)
@section('subcontent')
<div class="mb-3 d-flex align-items-center" style="gap: 10px;">
    <input type="text" class="form-control" placeholder="Tìm kiếm nhân viên" style="flex: 2;">
    <button class="btn btn-primary" style="flex: 1;">Tìm kiếm</button>
</div>
<h5>Danh sách nhân viên</h5>
<ul class="list-group mb-3">
    @if($nhanVienList->isEmpty())
        <li class="list-group-item text-center">
            <strong>Chưa có nhân viên, Hãy thêm nhân viên mới tại đây.</strong>
        </li>
    @else
        @foreach($nhanVienList as $nhanVien)
        <li class="list-group-item d-flex align-items-center justify-content-between">
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
@endsection
