@extends('Admin.layout')

@section('title', 'Thêm nhà cung cấp')

@section('content')
    <!-- Card for form -->
    <div class="card shadow-lg border-0 mb-4" style="border-radius: 10px;">
        <div class="card-header py-4 bg-gradient-primary text-white" style="border-radius: 10px 10px 0 0;">
            <h6 class="m-0 font-weight-bold">Thêm nhà cung cấp mới</h6>
        </div>
        <div class="card-body" style="background-color: #f4f6f9; border-radius: 0 0 10px 10px;">
            <form action="#" method="POST">
                @csrf

                <!-- Tên nhà cung cấp -->
                <div class="form-group mb-4">
                    <label for="name" class="text-muted">Tên nhà cung cấp</label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name"
                        value="Nhà cung cấp A" required
                        style="border-color: #4e73df; box-shadow: 0px 0px 5px rgba(78, 115, 223, 0.2);">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Địa chỉ -->
                <div class="form-group mb-4">
                    <label for="address" class="text-muted">Địa chỉ</label>
                    <input type="text" class="form-control form-control-lg" id="address" name="address"
                        value="Địa chỉ A" required
                        style="border-color: #4e73df; box-shadow: 0px 0px 5px rgba(78, 115, 223, 0.2);">
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group mb-4">
                    <label for="email" class="text-muted">Email</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                        value="emailA@example.com" required
                        style="border-color: #4e73df; box-shadow: 0px 0px 5px rgba(78, 115, 223, 0.2);">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Số điện thoại -->
                <div class="form-group mb-4">
                    <label for="phone" class="text-muted">Số điện thoại</label>
                    <input type="text" class="form-control form-control-lg" id="phone" name="phone"
                        value="0123456789" required
                        style="border-color: #4e73df; box-shadow: 0px 0px 5px rgba(78, 115, 223, 0.2);">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nút Submit -->
                <button type="submit" class="btn btn-success btn-lg btn-block shadow"
                    style="background-color: #28a745; border: none; transition: background-color 0.3s;">
                    <i class="fas fa-plus"></i> Thêm nhà cung cấp
                </button>

                <!-- Nút Quay lại -->
                <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary btn-lg btn-block mt-3 shadow"
                    style="background-color: #6c757d; border: none; transition: background-color 0.3s;">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </form>
        </div>
    </div>
@endsection
