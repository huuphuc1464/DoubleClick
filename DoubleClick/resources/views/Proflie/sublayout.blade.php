@extends('layout')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

@yield('css_sub')

@endsection

@section('content')

<div class="account-container">
    <div class="account-sidebar">
        <div class="profile-section">
            <img src="{{ asset('/storage/img/Profile/' . ($account->Image ?? 'default.jpg')) }}" alt="Profile Picture">
            <div class="profile-name">Huu Phuc</div>
        </div>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action active"><a href={{route('profile.index')}}><i class="fas fa-user"></i> Thông tin tài khoản</a></li>
            <li class="list-group-item"><a href="#"><i class="fas fa-cog"></i> Quản lý đơn hàng</a></li>
            <li class="list-group-item"><a href="#"><i class="fas fa-lock"></i> Đổi mật khẩu</a></li>
            <li class="list-group-item"><a href="#"><i class="fas fa-comment"></i> Đánh giá sản phẩm</a></li>
            <li class="list-group-item"><a href="#"><i class="fas fa-heart"></i> Sản phẩm yêu thích</a></li>
            <li class="list-group-item"><a href="#"><i class="fas fa-star-half-alt"></i> Nhận xét của tôi</a></li>
        </ul>
    </div>
    <div class="account-content">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @yield('content_sub')
    </div>
</div>



@endsection
