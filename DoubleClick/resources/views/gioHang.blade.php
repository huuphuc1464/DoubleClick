@extends('layout')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
        @if(session('insufficientProducts'))
            <ul>
                @foreach(session('insufficientProducts') as $product)
                    <li>{{ $product }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<h1>Giỏ hàng</h1>
<div class ="container-fluid">
    <table class="table ">
        <thead>
            <tr>
                <th class="text-center">Chọn</th>
                <th>Hình ảnh</th>
                <th>Sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody id="cart-items">
            @foreach ($cart as $item)
                <tr data-id="{{ $item->MaSach }}">
                    <td class="text-center" style="line-height: 100px">
                        <input type="checkbox" class="select-item" value="{{ $item->MaSach }}">
                    </td>
                    <td>
                        <img src="{{ asset('img/sach/' . $item->sach->AnhDaiDien) }}" alt="{{ $item->sach->TenSach }}"
                            width="100">
                    </td>
                    <td style="line-height: 100px">{{ $item->sach->TenSach }}</td>
                    <td style="line-height: 100px">{{ number_format($item->sach->GiaBan, 0, ',', '.') }} VNĐ</td>
                    <td style="line-height: 100px">{{ $item->SLMua }}</td>
                    <td style="line-height: 100px">{{ number_format($item->SLMua * $item->sach->GiaBan, 0, ',', '.') }} VNĐ
                    </td>
                    <td style="line-height: 100px">
                        <button class="btn btn-danger btn-sm delete-item">Xóa</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-3"
        style="border-top: 1px solid #ddd; padding-top: 30px; padding-left: 47px;">
        <div>
            <input type="checkbox" id="select-all" class="form-check-input" style="margin-right: 5px;"> Chọn tất cả
        </div>
        <div>
            <button type="button" class="btn btn-success" style="margin-right: 5px;">Mua hàng</button>
            <button type="button" class="btn btn-danger" id="delete-all">Xóa tất cả</button>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Xử lý nút "Xóa từng mục"
        document.querySelectorAll('.delete-item').forEach(button => {
            button.addEventListener('click', function () {
                const row = this.closest('tr');
                const itemId = row.dataset.id;

                if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                    fetch(`/cart/remove/${itemId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                row.remove();
                            } else {
                                alert(data.message); // Hiển thị lỗi từ server
                            }
                        })
                        .catch(error => console.error('Lỗi:', error));

                }
            });
        });

        // Xử lý checkbox "Chọn tất cả"
        document.getElementById('select-all').addEventListener('change', function () {
            const isChecked = this.checked;
            document.querySelectorAll('.select-item').forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        // Xử lý nút "Xóa tất cả"
        document.getElementById('delete-all').addEventListener('click', function () {
            const selectedItems = Array.from(document.querySelectorAll('.select-item:checked')).map(checkbox => checkbox.value);

            if (selectedItems.length === 0) {
                alert('Vui lòng chọn ít nhất một sản phẩm để xóa!');
                return;
            }

            if (confirm('Bạn có chắc chắn muốn xóa các sản phẩm đã chọn không?')) {
                fetch('/cart/remove-multiple', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ selected: selectedItems })
                })
                    .then(response => {
                        if (response.ok) {
                            selectedItems.forEach(itemId => {
                                const row = document.querySelector(`tr[data-id="${itemId}"]`);
                                if (row) row.remove();
                            });
                        } else {
                            alert('Không thể xóa các sản phẩm. Vui lòng thử lại.');
                        }
                    })
                    .catch(error => console.error('Lỗi:', error));
            }
        });
    });
</script>
@endsection
