@extends('Admin.Staff.subLayout')

@section('title', $title)
@section('subtitle', $subtitle)
@section('subcontent')
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4 text-center">Thêm Nhân Viên Mới</h5>
            <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Tên Nhân Viên -->
                    <div class="col-md-6 mb-3">
                        <label for="TenTK" class="form-label">Tên Nhân Viên</label>
                        <input type="text" class="form-control" id="TenTK" name="TenTK" required>
                    </div>

                    <!-- Giới Tính -->
                    <div class="col-md-6 mb-3">
                        <label for="GioiTinh" class="form-label">Giới Tính</label>
                        <select class="form-select" id="GioiTinh" name="GioiTinh" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Ngày Sinh -->
                    <div class="col-md-6 mb-3">
                        <label for="NgaySinh" class="form-label">Ngày Sinh</label>
                        <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="Email" name="Email" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Số Điện Thoại -->
                    <div class="col-md-6 mb-3">
                        <label for="SDT" class="form-label">Số Điện Thoại</label>
                        <input type="text" class="form-control" id="SDT" name="SDT" required>
                    </div>

                    <!-- Địa Chỉ -->
                    <div class="col-md-6 mb-3">
                        <label for="DiaChi" class="form-label">Địa Chỉ</label>
                        <input type="text" class="form-control" id="DiaChi" name="DiaChi" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Hình Ảnh -->
                    <div class="col-md-6 mb-3">
                        <label for="Image" class="form-label">Hình Ảnh</label>
                        <input type="file" class="form-control" id="Image" name="Image" accept="image/*">
                    </div>

                    <!-- Username -->
                    <div class="col-md-6 mb-3">
                        <label for="Username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="Username" name="Username" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Password -->
                    <div class="col-md-6 mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="Password" name="Password" required>
                    </div>

                    <!-- Mã Role -->
                    <div class="col-md-6 mb-3">
                        <label for="MaRole" class="form-label">Mã Role</label>
                        <select class="form-select" id="MaRole" name="MaRole" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->MaRole }}">{{ $role->TenRole }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Trạng Thái -->
                <div class="mb-3">
                    <label for="TrangThai" class="form-label">Trạng Thái</label>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" id="TrangThai" name="TrangThai" value="1" checked>
                        <label class="form-check-label" for="TrangThai">Hoạt động</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Thêm Nhân Viên</button>
            </form>
        </div>
    </div>
@endsection