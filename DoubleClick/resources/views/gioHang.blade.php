@extends('layout')

@section('content')

<h1>Giỏ hàng</h1>
<form action="{{ route('cart.purchase') }}" method="POST">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th style="text-align: center;">Chọn</th>
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
                    <td class="text-center">
                        <!-- Checkbox để chọn sản phẩm -->
                        <input type="checkbox" class="select-item" name="selected[]" value="{{ $item->MaSach }}">
                    </td>
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

    <!-- Hàng riêng biệt cho checkbox "Chọn tất cả" và nút -->
    <div class="d-flex justify-content-between align-items-center mt-3"
        style="border-top: 1px solid #ddd; padding-top: 30px; padding-left: 50px;">
        <div style="display: flex; justify-content: flex-start;">
            <span>
                 <input type="checkbox" id="select-all" class="form-check-input" style="margin-right: 1px;"> Chọn tất cả
            </span>
            <div style="margin-left: auto; ">
                <button type="submit" class="btn btn-success " style="margin-right: 5px;">Mua hàng</button>
                <button type="button" class="btn btn-danger " id="delete-all">Xóa tất cả</button>
            </div>
        </div>
    </div>
</form>


<script>
    // JavaScript để xử lý checkbox "Chọn tất cả"
    document.getElementById('select-all').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.select-item');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Đảm bảo trạng thái checkbox "Chọn tất cả" được cập nhật
    document.querySelectorAll('.select-item').forEach(item => {
        item.addEventListener('change', function () {
            const selectAll = document.getElementById('select-all');
            const allChecked = Array.from(document.querySelectorAll('.select-item')).every(checkbox => checkbox.checked);
            selectAll.checked = allChecked;
        });
    });


</script>
@endsection
