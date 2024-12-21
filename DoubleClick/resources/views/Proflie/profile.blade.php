@extends('Proflie.sublayout')

@section('css_sub')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .account-container {
        display: flex;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .account-sidebar {
        width: 250px;
        background-color: #fff;
        border-right: 1px solid #ddd;
        padding: 20px;
    }

    .account-sidebar .profile-section {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .account-sidebar .profile-section img {
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin-right: 10px;
    }

    .account-sidebar .profile-section .profile-name {
        font-weight: bold;
    }

    .account-sidebar ul {
        list-style: none;
        padding: 0;
    }

    .account-sidebar ul li {
        margin: 10px 0;
    }

    .account-sidebar ul li a {
        text-decoration: none;
        color: #333;
        display: flex;
        align-items: center;
    }

    .account-sidebar ul li a i {
        margin-right: 10px;
    }

    .account-content {
        flex: 1;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-left: 20px;
    }

    .account-content h2 {
        margin-top: 0;
    }

    .account-content form {
        display: flex;
        flex-wrap: wrap;
    }

    .account-content form .form-item {
        width: 100%;
        margin-bottom: 15px;
    }

    .account-content form .form-item label {
        display: block;
        margin-bottom: 5px;
    }

    .account-content form .form-item input,
    .account-content form .form-item select {
        width: calc(100% - 20px);
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .account-content form .form-item.gender-group {
        display: flex;
        align-items: center;
    }

    .account-content form .form-item.gender-group label {
        margin-right: 10px;
    }

    .account-content form .form-item.gender-group input {
        margin-right: 5px;
    }

    .account-content form .form-item .profile-pic-container {
        display: flex;
        align-items: center;
    }

    .account-content form .form-item .profile-pic-container img {
        border-radius: 50%;
        width: 100px;
        height: 100px;
        margin-right: 10px;
    }

    .account-content form .form-item .profile-pic-container button {
        padding: 10px 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f5f5f5;
        cursor: pointer;
    }

    .account-content form .form-item .profile-pic-container button:hover {
        background-color: #e5e5e5;
    }

    .account-content form .form-item.dob-group {
        display: flex;
        justify-content: space-between;
    }

    .account-content form .form-item.dob-group select {
        width: 32%;
    }

    .account-content form .form-item.submit-group {
        width: 100%;
        text-align: center;
    }

    .account-content form .form-item.submit-group button {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }

    .account-content form .form-item.submit-group button:hover {
        background-color: #0056b3;
    }

    @media (max-width: 768px) {
        .account-container {
            flex-direction: column;
        }

        .account-sidebar {
            width: 100%;
            border-right: none;
            border-bottom: 1px solid #ddd;
        }

        .account-content {
            margin-top: 20px;
        }
    }

</style>
@endsection

@section('content_sub')
<div class="account-container">
    <div class="account-sidebar">
        <div class="profile-section">
            <img src="https://placehold.co/50x50" alt="Profile Picture">
            <div class="profile-name">Huu Phuc</div>
        </div>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action active"><a href="#"><i class="fas fa-user"></i> Thông tin tài khoản</a></li>
            <li class="list-group-item"><a href="#"><i class="fas fa-cog"></i> Quản lý đơn hàng</a></li>
            <li class="list-group-item"><a href="#"><i class="fas fa-lock"></i> Đổi mật khẩu</a></li>
            <li class="list-group-item"><a href="#"><i class="fas fa-comment"></i> Đánh giá sản phẩm</a></li>
            <li class="list-group-item"><a href="#"><i class="fas fa-heart"></i> Sản phẩm yêu thích</a></li>
            <li class="list-group-item"><a href="#"><i class="fas fa-star-half-alt"></i> Nhận xét của tôi</a></li>
        </ul>
    </div>
    <div class="account-content">
        <h2>Thông tin cá nhân</h2>
        <p>Quản lý thông tin cá nhân để bảo mật tài khoản</p>
        <form>
            <div class="form-item">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" value="huuphuc" disabled>
            </div>
            <div class="form-item">
                <label for="fullname">Họ và tên</label>
                <input type="text" id="fullname" value="Huu Phuc">
            </div>
            <div class="form-item">
                <label for="email">Email</label>
                <input type="email" id="email" value="03*******@caothang.edu.vn">
            </div>
            <div class="form-item">
                <label for="address">Địa chỉ</label>
                <input type="text" id="address" value="65 Huỳnh Thúc Kháng">
            </div>
            <div class="form-item">
                <label for="phone">Số điện thoại</label>
                <input type="text" id="phone" value="0901234567">
            </div>
            <div class="form-item gender-group">
                <label>Giới tính</label>
                <input type="radio" id="male" name="gender" value="male" checked>
                <label for="male">Nam</label>
                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Nữ</label>
            </div>
            <div class="form-item profile-picture">
                <label for="profile-pic">Ảnh đại diện</label>
                <div class="profile-pic-container">
                    <img src="https://placehold.co/100x100" alt="Profile Picture">
                    <button type="button">Chọn Ảnh</button>
                </div>
                <small>Dung lượng file tối đa 1 MB. Định dạng: .JPEG, .PNG</small>
            </div>
            <div class="form-item dob-group">
                <label for="dob">Ngày sinh</label>
                <select id="dob-day">
                    <option>Ngày</option>
                </select>
                <select id="dob-month">
                    <option>Tháng</option>
                </select>
                <select id="dob-year">
                    <option>Năm</option>
                </select>
            </div>
            <div class="form-item submit-group">
                <button type="submit">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>
@endsection
