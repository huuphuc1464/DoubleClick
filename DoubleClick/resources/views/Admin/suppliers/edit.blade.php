@extends('Admin.layout')

@section('title', 'Chỉnh sửa nhà cung cấp')

@section('content')
    <!-- Form chỉnh sửa nhà cung cấp -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa nhà cung cấp</h6>
        </div>
        <div class="card-body">
            <form action="#" method="POST">
                @csrf
                @method('PUT') <!-- PUT method để cập nhật dữ liệu -->

                <div class="form-group">
                    <label for="name">Tên nhà cung cấp</label>
                    <input type="text" class="form-control" id="name" name="name" value="Nhà cung cấp A" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" value="Địa chỉ A" required>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="emailA@example.com"
                        required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="0123456789" required>
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1" selected>Hoạt động</option>
                        <option value="0">Không hoạt động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
                <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
            </form>
        </div>
    </div>
@endsection
