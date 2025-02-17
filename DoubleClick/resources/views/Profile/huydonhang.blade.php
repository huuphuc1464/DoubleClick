@extends('Profile.sublayout')
@section('css_sub')
<link rel="stylesheet" href="{{ asset('css/huydonhang.css') }}">
@endsection
@section('title')
    {{ $title }}
@endsection
@section('content_sub')
<div class="container-fluid">
    <h4>Lý Do Hủy</h4>
    <div class="tieu-de-huy">
        <p class="mb-0">Ban có biết? Bạn có thể cập nhật thông tin nhận hàng cho đơn hàng (1 lần duy nhất) Nếu bạn xác nhận hủy, toàn bộ đơn hàng sẽ được hủy. Chọn lý do hủy phù hợp nhất với bạn nhé!</p>
    </div>
    <form action="{{ route('profile.dsdonhang.huy.luu') }}" method="POST">
        @csrf
        <input type="hidden" name="MaHD" value="{{ $id }}">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="LyDoHuy" id="reasonUpdateAddress" required value="Tôi muốn cập nhật địa chỉ/sđt nhận hàng">
            <label class="form-check-label" for="reasonUpdateAddress">
                Tôi muốn cập nhật địa chỉ/sđt nhận hàng.
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="LyDoHuy" id="reasonChangeCoupon" required value="Tôi muốn thêm/thay đổi Mã giảm giá">
            <label class="form-check-label" for="reasonChangeCoupon">
                Tôi muốn thêm/thay đổi Mã giảm giá
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="LyDoHuy" id="reasonChangeProduct" required value="Tôi muốn thay đổi sản phẩm (kích thước, màu sắc, số lượng…)">
            <label class="form-check-label" for="reasonChangeProduct">
                Tôi muốn thay đổi sản phẩm (kích thước, màu sắc, số lượng…)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="LyDoHuy" id="reasonPaymentIssue" required value="Thủ tục thanh toán rắc rối">
            <label class="form-check-label" for="reasonPaymentIssue">
                Thủ tục thanh toán rắc rối
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="LyDoHuy" id="reasonBetterOption" required value="Tôi tìm thấy chỗ mua khác tốt hơn (Rẻ hơn, uy tín hơn, giao nhanh hơn…)">
            <label class="form-check-label" for="reasonBetterOption">
                Tôi tìm thấy chỗ mua khác tốt hơn (Rẻ hơn, uy tín hơn, giao nhanh hơn…)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="LyDoHuy" id="reasonNoNeed" required value="Tôi không có nhu cầu mua nữa">
            <label class="form-check-label" for="reasonNoNeed">
                Tôi không có nhu cầu mua nữa
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="LyDoHuy" id="reasonNoFit" required value="Tôi không tìm thấy lý do hủy phù hợp">
            <label class="form-check-label" for="reasonNoFit">
                Tôi không tìm thấy lý do hủy phù hợp
            </label>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('profile.dsdonhang') }}" class="btn btn-outline-secondary me-2">KHÔNG PHẢI BÂY GIỜ</a>
            <button type="submit" class="btn btn-outline-danger">HỦY ĐƠN HÀNG</button>
        </div>
    </form>

</div>
@endsection
