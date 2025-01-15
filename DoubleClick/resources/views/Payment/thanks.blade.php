@extends('layout')
@section('title',$title)
@section('content')
<div class="container mt-5" style="padding: 50px;">
    <div class="text-center">
        @if($order_success === 1)
            <!-- Nếu thanh toán thành công -->
            <h1 class="display-4 text-success">Cảm ơn bạn!</h1>
            <p class="lead">Đơn hàng <strong>#{{ $maHD }}</strong> của bạn đã được xử lý thành công. Chúng tôi rất vui khi có bạn là khách hàng của mình!</p>
            <div class="mt-4">
                <i class="fa fa-check-circle fa-5x text-success"></i>
            </div>
            <p class="mt-3">Nếu có bất kỳ vấn đề gì về đơn hàng, vui lòng liên hệ với chúng tôi để được hỗ trợ.</p>
            <a href="{{ route('user') }}" class="btn btn-primary btn-lg mt-4">Trở về trang chủ</a>
            @elseif($order_success === 0)
            <!-- Nếu thanh toán không thành công -->
            <h1 class="display-4 text-danger">Thanh toán không thành công!</h1>
            <p class="lead">Rất tiếc, giao dịch cho đơn hàng <strong>#{{ $maHD }}</strong> của bạn không được hoàn tất. Bạn có muốn thử lại với phương thức thanh toán khác?</p>
            <a href="{{ route('checkout') }}" class="btn btn-warning btn-lg mt-4">Chọn phương thức thanh toán khác</a>

            <!-- Form cập nhật phương thức thanh toán COD -->
            <br><br>
            <form id="changePaymentMethodForm" action="{{ route('payment.updatePaymentMethod') }}" method="POST">
                @csrf
                <input type="hidden" name="maHD" value="{{ $maHD }}">
                <input type="hidden" name="paymentMethod" value="COD">
                <input type="hidden" name="status" value="1"> <!-- Trạng thái đơn hàng nếu cần -->
                <button type="button" class="btn btn-primary" id="changeToCODBtn">Đổi sang thanh toán khi nhận hàng COD?</button>
            </form>

            <br><br>
            <p id="statusMessage"></p> <!-- Để hiển thị kết quả trạng thái -->

        @elseif(session('order_success') === 2)
            <!-- Nếu cập nhật phương thức thanh toán thành công -->
            <h1 class="display-4 text-success">Cập nhật phương thức thanh toán thành công!</h1>
            <p class="lead">Phương thức thanh toán của bạn đã được chuyển sang "Thanh toán khi nhận hàng (COD)".</p>
            <div class="mt-4">
                <i class="fa fa-check-circle fa-5x text-success"></i>
            </div>
            <p class="mt-3">Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi. Chúng tôi sẽ tiếp tục xử lý đơn hàng của bạn.</p>
            <a href="{{ route('user') }}" class="btn btn-primary btn-lg mt-4">Trở về trang chủ</a>
        @else
            <!-- Nếu không xác định trạng thái thanh toán -->
            <h1 class="display-4 text-warning">Lỗi hệ thống!</h1>
            <p class="lead">Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại sau hoặc liên hệ với chúng tôi để được hỗ trợ.</p>
            <a href="{{ route('cart.index') }}" class="btn btn-danger btn-lg mt-4">Quay lại giỏ hàng</a>
        @endif
    </div>
</div>
<script>
    document.getElementById('changeToCODBtn').onclick = function() {
        if (confirm('Bạn chắc chắn muốn chuyển phương thức thanh toán sang COD không?')) {
            document.getElementById('changePaymentMethodForm').submit();
        }
    };
</script>
@endsection
