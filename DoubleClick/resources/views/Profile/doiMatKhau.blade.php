@extends('Profile.sublayout')

@section('css_sub')
<link rel="stylesheet" href="css/doimatkhau_user.css">
@endsection

@section('content_sub')
<div id="body">
    <div class="container-custom">
        <h2>Đổi mật khẩu</h2>
        <div class="mb-3">
            <label for="old-password" class="form-label">Mật khẩu cũ <span class="text-danger">*</span></label>
            <div class="input-wrapper-custom">
                <input type="password" class="form-control" id="old-password" placeholder="Nhập mật khẩu cũ">
                <i class="fas fa-eye"></i>
            </div>
        </div>
        <div class="mb-3">
            <label for="new-password" class="form-label">Mật khẩu mới <span class="text-danger">*</span></label>
            <div class="input-wrapper-custom">
                <input type="password" class="form-control" id="new-password" placeholder="Nhập mật khẩu mới">
                <i class="fas fa-eye"></i>
            </div>
            <div class="note-custom">Mật khẩu phải dài từ 8 đến 32 ký tự, bao gồm chữ và số</div>
        </div>
        <div class="mb-3">
            <label for="confirm-password" class="form-label">Nhập lại mật khẩu mới <span class="text-danger">*</span></label>
            <div class="input-wrapper-custom">
                <input type="password" class="form-control" id="confirm-password" placeholder="Nhập lại mật khẩu mới">
                <i class="fas fa-eye"></i>
            </div>
        </div>
        <button class="btn btn-primary w-100">Lưu thay đổi</button>
    </div>
</div>

@endsection
