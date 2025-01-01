@extends('layout')

@section('content')
<div class="container mt-5" style="padding: 50px;">
    <div class="text-center">
        <h1 class="display-4 text-success">Cảm ơn bạn!</h1>
        <p class="lead">Đơn hàng của bạn đã được xử lý thành công. Chúng tôi rất vui khi có bạn là khách hàng của mình!</p>
        <div class="mt-4">
            <i class="fa fa-check-circle fa-5x text-success"></i>
        </div>
        <p class="mt-3">Nếu có bất kỳ vấn đề gì về đơn hàng, vui lòng liên hệ với chúng tôi để được hỗ trợ.</p>
        <a href="{{ route('user') }}" class="btn btn-primary btn-lg mt-4">Trở về trang chủ</a>
    </div>
</div>
@endsection
