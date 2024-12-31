@extends('layout')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<link rel="stylesheet" href="{{ asset('css/trangcanhan_user.css') }}">

@yield('css_sub')

@endsection

@section('content')

<div class="account-container">
    <div class="account-sidebar">
        <div class="profile-section">
            <img src="{{ asset('/storage/img/Profile/' . ($account->Image ?? 'default.jpg')) }}" alt="Profile Picture">
            <div class="profile-name">{{ $account->TenTK }}</div>
        </div>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                <a href="{{ route('profile.index') }}"><i class="fas fa-user"></i> Thông tin tài khoản</a>
            </li>
            <li class="list-group-item {{ request()->routeIs('profile.dsdonhang*') ? 'active' : '' }}">
                <a href="{{ route('profile.dsdonhang') }}"><i class="fas fa-cog"></i> Quản lý đơn hàng</a>
            </li>
            <li class="list-group-item {{ request()->routeIs('profile.doimatkhau') ? 'active' : '' }}">
                <a href="{{ route('profile.doimatkhau') }}"><i class="fas fa-lock"></i> Đổi mật khẩu</a>
            </li>
            <li class="list-group-item {{ request()->routeIs('profile.sachyeuthich') ? 'active' : '' }}">
                <a href="{{ route('profile.sachyeuthich') }}"><i class="fas fa-heart"></i> Sách yêu thích</a>
            </li>
            <li class="list-group-item {{ request()->routeIs('profile.dsdanhgia') ? 'active' : '' }}">
                <a href="{{ route('profile.dsdanhgia') }}"><i class="fas fa-star-half-alt"></i> Nhận xét của tôi</a>
            </li>
        </ul>
    </div>
    <div class="account-content">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif --}}

    @yield('content_sub')
</div>
</div>



@endsection
