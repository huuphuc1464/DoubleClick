@extends('layout')

@section('content')
<div class="container">
    <h1>Giỏ hàng</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
                <tr>
                    <td>
                        <img src="{{ asset($item->sach->AnhDaiDien) }}" alt="{{ $item->sach->TenSach }}" width="100">
                    </td>
                    <td>{{ $item->sach->TenSach }}</td>
                    <td>{{ number_format($item->sach->GiaBan, 0, ',', '.') }} VNĐ</td>
                    <td>{{ $item->SLMua }}</td>
                    <td>{{ number_format($item->SLMua * $item->sach->GiaBan, 0, ',', '.') }} VNĐ</td>
                    <td>
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="MaSach" value="{{ $item->MaSach }}">
                            <button class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
