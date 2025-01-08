@extends('Admin.Staff.subLayout')

@section('title', $title)
@section('subtitle', $subtitle)
@section('subcontent')
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title mb-4 text-center">Thêm Nhân Viên Mới</h3>
            <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Tên Nhân Viên -->
                    <div class="col-md-6 mb-3">
                        <label for="TenTK" class="form-label">Tên Nhân Viên</label>
                        <input type="text" class="form-control @error('TenTK') is-invalid @enderror" id="TenTK"
                            name="TenTK" value="{{ old('TenTK') }}" required>
                        @error('TenTK')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Giới Tính -->
                    <div class="col-md-6 mb-3">
                        <label for="GioiTinh" class="form-label">Giới Tính</label>
                        <select class="form-select @error('GioiTinh') is-invalid @enderror" id="GioiTinh" name="GioiTinh"
                            required>
                            <option value="Nam" {{ old('GioiTinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
                            <option value="Nữ" {{ old('GioiTinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        </select>
                        @error('GioiTinh')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Ngày Sinh -->
                    <div class="col-md-6 mb-3">
                        <label for="NgaySinh" class="form-label">Ngày Sinh</label>
                        <input type="date" class="form-control @error('NgaySinh') is-invalid @enderror" id="NgaySinh"
                            name="NgaySinh" value="{{ old('NgaySinh') }}" required>
                        @error('NgaySinh')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('Email') is-invalid @enderror" id="Email"
                            name="Email" value="{{ old('Email') }}" required>
                        @error('Email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Số Điện Thoại -->
                    <div class="col-md-6 mb-3">
                        <label for="SDT" class="form-label">Số Điện Thoại</label>
                        <input type="text" class="form-control @error('SDT') is-invalid @enderror" id="SDT"
                            name="SDT" value="{{ old('SDT') }}" required>
                        @error('SDT')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Địa Chỉ -->
                    <div class="col-md-6 mb-3">
                        <label for="DiaChi" class="form-label">Địa Chỉ</label>
                        <input type="text" class="form-control @error('DiaChi') is-invalid @enderror" id="DiaChi"
                            name="DiaChi" value="{{ old('DiaChi') }}" required>
                        @error('DiaChi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Hình Ảnh -->
                    <div class="col-md-6 mb-3">
                        <label for="Image" class="form-label">Hình Ảnh</label>
                        <input type="file" class="form-control @error('Image') is-invalid @enderror" id="Image"
                            name="Image" accept="image/*">
                        @error('Image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="col-md-6 mb-3">
                        <label for="Username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('Username') is-invalid @enderror" id="Username"
                            name="Username" value="{{ old('Username') }}" required>
                        @error('Username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Password -->
                    <div class="col-md-6 mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('Password') is-invalid @enderror" id="Password"
                            name="Password" required>
                        @error('Password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mã Role -->
                    <div class="col-md-6 mb-3">
                        <label for="MaRole" class="form-label">Mã Role</label>
                        <select class="form-select @error('MaRole') is-invalid @enderror" id="MaRole" name="MaRole"
                            required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->MaRole }}"
                                    {{ old('MaRole') == $role->MaRole ? 'selected' : '' }}>
                                    {{ $role->TenRole }}
                                </option>
                            @endforeach
                        </select>
                        @error('MaRole')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Trạng Thái -->
                <div class="mb-3">
                    <label for="TrangThai" class="form-label">Trạng Thái</label>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" id="TrangThai" name="TrangThai" value="1"
                            {{ old('TrangThai', 1) ? 'checked' : '' }}>
                        <label class="form-check-label" for="TrangThai">Hoạt động</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Thêm Nhân Viên</button>
            </form>
        </div>
    </div>
@endsection
