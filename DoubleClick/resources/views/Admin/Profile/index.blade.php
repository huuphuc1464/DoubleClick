@extends('Admin.layout')
{{-- @section('title', $title) --}}
{{-- @section('subtitle', $subtitle) --}}
@section('css')
<style>
    .profile-container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fff;
        position: relative;
    }

    .profile-header {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .profile-info .info-group {
        margin-bottom: 15px;
    }

    .profile-info label {
        font-weight: bold;
        display: inline-block;
        width: 150px;
    }

    .profile-info .info-value {
        display: inline-block;
    }

    .profile-image {
        text-align: center;
    }

    .profile-image img {
        border-radius: 50%;
        width: 100px;
        height: 100px;
    }

    .change-password {
        position: absolute;
        top: 20px;
        right: 20px;
    }

</style>

@endsection
@section('content')
<div class="container profile-container">
    <a class="text-primary change-password" href="#">
        Đổi mật khẩu
    </a>
    <div class="profile-header">
        Thông tin cá nhân
    </div>
    <div class="row">
        <div class="col-md-8 profile-info">
            <div class="info-group">
                <label>
                    Tên đăng nhập:
                </label>
                <span class="info-value">
                    {{ $account -> Username }}
                </span>
            </div>
            <div class="info-group">
                <label>
                    Họ và tên:
                </label>
                <span class="info-value">
                    {{ $account -> TenTK }}
                </span>
            </div>
            <div class="info-group">
                <label>
                    Email:
                </label>
                <span class="info-value">
                    {{ $account -> Email }}
                </span>
            </div>
            <div class="info-group">
                <label>
                    Địa chỉ:
                </label>
                <span class="info-value">
                    {{ $account -> DiaChi }}
                </span>
            </div>
            <div class="info-group">
                <label>
                    Số điện thoại:
                </label>
                <span class="info-value">
                    {{ $account -> SDT }}
                </span>
            </div>
            <div class="info-group">
                <label>
                    Giới tính:
                </label>
                <span class="info-value">
                    {{ $account -> GioiTinh }}
                </span>
            </div>
            <div class="info-group">
                <label>
                    Ngày sinh:
                </label>
                <span class="info-value">
                    {{ \Carbon\Carbon::parse($account->NgaySinh)->format('d/m/Y') }}
                </span>
            </div>
            <div class="info-group">
                <label>
                    Chức vụ:
                </label>
                <span class="info-value">
                    {{ $account -> TenRole }}
                </span>
            </div>
        </div>
        <div class="col-md-4 profile-image">
            <img alt="Profile image of {{ $account -> TenTK }}" height="100" src="{{ asset('/storage/img/Profile/' . ($account->Image ?? 'default.jpg')) }}" width="100" />

        </div>
    </div>
</div>




@endsection
