@extends('Profile.sublayout')

@section('css_sub')
<link rel="stylesheet" href="{{ asset('css/doimatkhau_user.css') }}">

@endsection
@section('title')
{{ $title }}
@endsection
@section('content_sub')
<div class="container-custom">
    <h2>Đổi mật khẩu</h2>
    <form action="{{ route('profile.updatePass') }}" method="POST">
        @csrf
        <input type="hidden" name="MaTK" value="{{ $MaTK }}">

        <!-- Mật khẩu cũ -->
        <div class="mb-3">
            <label for="old-password" class="form-label">Mật khẩu cũ <span class="text-danger">*</span></label>
            <div class="input-wrapper-custom">
                <input type="password" class="form-control" id="old-password" name="old-password" placeholder="Nhập mật khẩu cũ" required title="Vui lòng nhập mật khẩu cũ">
                <i class="fas fa-eye" onclick="togglePasswordVisibility('old-password')"></i>
            </div>
            @error('old-password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Mật khẩu mới -->
        <div class="mb-3">
            <label for="new-password" class="form-label">Mật khẩu mới <span class="text-danger">*</span></label>
            <div class="input-wrapper-custom">
                <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Nhập mật khẩu mới" required title="Vui lòng nhập mật khẩu mới">
                <i class="fas fa-eye" onclick="togglePasswordVisibility('new-password')"></i>
            </div>
            @error('new-password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nhập lại mật khẩu mới -->
        <div class="mb-3">
            <label for="new-password_confirmation" class="form-label">Nhập lại mật khẩu mới <span class="text-danger">*</span></label>
            <div class="input-wrapper-custom">
                <input type="password" class="form-control" id="new-password_confirmation" name="new-password_confirmation" placeholder="Nhập lại mật khẩu mới" required title="Vui lòng nhập lại mật khẩu mới">
                <i class="fas fa-eye" onclick="togglePasswordVisibility('new-password_confirmation')"></i>
            </div>
            <div class="note-custom">Mật khẩu phải dài từ 8 đến 32 ký tự, bao gồm chữ và số</div>
            @error('new-password_confirmation')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Lưu thay đổi</button>
    </form>
</div>


<script>
    // Hàm toggle để hiển thị hoặc ẩn mật khẩu
    function togglePasswordVisibility(inputId) {
        var input = document.getElementById(inputId);
        var icon = input.nextElementSibling;

        // Kiểm tra và thay đổi loại input
        if (input.type === "password") {
            input.type = "text"; // Hiển thị mật khẩu
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash"); // Đổi icon
        } else {
            input.type = "password"; // Ẩn mật khẩu
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye"); // Đổi lại icon
        }
    }

</script>


@endsection
