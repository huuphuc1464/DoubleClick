@extends('layout')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
{{-- <style>
    /* Cải tiến ảnh đại diện */
    .profile-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Giới tính */
    .mb-3 input[type="radio"] {
        margin-right: 10px;
    }

    /* Tùy chỉnh style cho ảnh đại diện */
    img.img-fluid {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
    }

    /* Các phần tử nhỏ */
    small.form-text {
        font-size: 12px;
        color: #777;
    }

    /* Chỉnh layout cho form nhập */
    .d-flex {
        gap: 10px;
    }

    .form-select {
        flex: 1;
    }

    /* Button */
    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-success:hover {
        background-color: #218838;
    }

</style> --}}

@yield('css_sub')

@endsection

@section('content')

{{-- <div class="container">
    <div class="linkprofile">Trang chủ > <strong>Thông tin tài khoản</strong></div>
    <div class="row">
        <div class="col-lg-3">
            <ul class="list-group">
                <li class="list-group-item list-group-item-action active"><a href="#"><i class="fas fa-user"></i> Thông tin tài khoản</a></li>
                <li class="list-group-item"><a href="#"><i class="fas fa-cog"></i> Quản lý đơn hàng</a></li>
                <li class="list-group-item"><a href="#"><i class="fas fa-lock"></i> Đổi mật khẩu</a></li>
                <li class="list-group-item"><a href="#"><i class="fas fa-comment"></i> Đánh giá sản phẩm</a></li>
                <li class="list-group-item"><a href="#"><i class="fas fa-heart"></i> Sản phẩm yêu thích</a></li>
                <li class="list-group-item"><a href="#"><i class="fas fa-star-half-alt"></i> Nhận xét của tôi</a></li>
            </ul>
        </div>
        <div class="col-lg-9">
            <h2>Thông tin cá nhân</h2>
            <p>Quản lý thông tin cá nhân để bảo mật tài khoản</p>
            <form>
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" id="username" value="huuphuc" class="form-control" disabled>
                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Họ và tên</label>
                    <input type="text" id="fullname" value="Huu Phuc" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" value="Q3*******@cothang.edu.vn" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" id="address" value="65 Nguyễn Thiếc Kháng" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" id="phone" value="0901234567" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Giới tính</label><br>
                    <input type="radio" id="male" name="gender" value="male" checked> <label for="male">Nam</label>
                    <input type="radio" id="female" name="gender" value="female"> <label for="female">Nữ</label>
                </div>
                <div class="mb-3">
                    <label for="profile-pic" class="form-label">Ảnh đại diện</label>
                    <div class="profile-container">
                        <img src="https://placehold.co/100x100" alt="Profile Picture" class="img-fluid rounded-circle">
                        <button type="button" class="btn btn-primary">Chọn Ảnh</button>
                    </div>
                    <small class="form-text text-muted">Dung lượng file tối đa 1 MB. Định dạng: .JPEG, .PNG</small>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Ngày sinh</label>
                    <div class="d-flex gap-2">
                        <select id="dob-day" class="form-select">
                            <option>Ngày</option>
                        </select>
                        <select id="dob-month" class="form-select">
                            <option>Tháng</option>
                        </select>
                        <select id="dob-year" class="form-select">
                            <option>Năm</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success w-100">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>

</div> --}}

@yield('content_sub')

@endsection
