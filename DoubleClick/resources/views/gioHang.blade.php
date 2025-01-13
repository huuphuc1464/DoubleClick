@extends('layout')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<h1 class="text-center mb-4">Giỏ Hàng</h1>

<style>
    /* Ẩn mũi tên mặc định của ô nhập số lượng */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        /* Loại bỏ trên Chrome, Safari, Edge */
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        /* Loại bỏ trên Firefox */
    }
</style>

<div class="container-fluid">
    <?php $cart = session()->get('cart', []); ?>
    @if (empty($cart))
        <p style="text-align: center; font-size: 24px; color: red; font-weight: bold; margin-top: 130px;">
            Chưa có sản phẩm trong giỏ hàng!
        </p>
    @else
        <form id="cart-form">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $id => $item)
                        <tr data-id="{{ $id }}">
                            <td><input type="checkbox" class="select-item" data-id="{{ $id }}"></td>
                            <td><img src="{{ asset('img/sach/' . $item['image']) }}" alt="{{ $item['name'] }}" width="100"></td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ number_format((float) $item['price'], 0, ',', '.') }} VNĐ</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-secondary decrease-quantity"
                                    data-id="{{ $id }}">-</button>
                                <input type="number" class="quantity" data-id="{{ $id }}" value="{{ $item['quantity'] }}"
                                    min="1" style="width: 60px; text-align: center;">
                                <button type="button" class="btn btn-sm btn-outline-secondary increase-quantity"
                                    data-id="{{ $id }}">+</button>
                            </td>
                            <td class="total-item-price">
                                {{ number_format((int) $item['quantity'] * (float) $item['price'], 0, ',', '.') }} VNĐ</td>
                            <td>
                                <button class="btn btn-danger btn-sm remove-item" data-id="{{ $id }}">Xóa</button>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </form>

        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p>Tổng tiền: <span id="total-price">0 VNĐ</span></p>
            </div>
            <div>
                <button id="delete-all" class="btn btn-danger">Xóa tất cả</button>
                <button id="checkout" class="btn btn-success">Mua hàng</button>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('select-all');
        const itemCheckboxes = document.querySelectorAll('.select-item');
        const totalPriceElement = document.getElementById('total-price');

        // Tính tổng tiền
        function updateTotalPrice() {
            let total = 0;
            itemCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const row = checkbox.closest('tr');
                    const quantity = row.querySelector('.quantity').value;
                    const price = parseInt(row.querySelector('.total-item-price').innerText.replace(/\./g, '').replace(' VNĐ', ''));
                    total += price * quantity;
                }
            });
            totalPriceElement.innerText = new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';
        }

        // Hàm cập nhật tổng tiền của một sản phẩm
        function updateItemTotalPrice(row) {
            const quantity = parseInt(row.querySelector('.quantity').value); // Lấy số lượng
            const unitPrice = parseInt(row.querySelector('td:nth-child(4)').innerText.replace(/\./g, '').replace(' VNĐ', '')); // Lấy đơn giá
            const totalItemPrice = unitPrice * quantity; // Tính tổng tiền của sản phẩm

            // Cập nhật cột "Tổng tiền" trong giao diện
            row.querySelector('.total-item-price').innerText = new Intl.NumberFormat('vi-VN').format(totalItemPrice) + ' VNĐ';
        }

        // Xử lý checkbox "Chọn tất cả"
        selectAllCheckbox.addEventListener('change', function () {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateTotalPrice();
        });

        // Xử lý checkbox từng sản phẩm
        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateTotalPrice);
        });

        // Xử lý tăng/giảm số lượng
        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const quantityInput = document.querySelector(`.quantity[data-id="${id}"]`);
                const currentQuantity = parseInt(quantityInput.value);
                if (currentQuantity > 1) {
                    quantityInput.value = currentQuantity - 1;
                    updateTotalPrice();
                }
            });
        });

        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const quantityInput = document.querySelector(`.quantity[data-id="${id}"]`);
                quantityInput.value = parseInt(quantityInput.value) + 1;
                updateTotalPrice();
            });
        });

        // Cập nhật tổng tiền khi thay đổi số lượng
        document.querySelectorAll('.quantity').forEach(input => {
            input.addEventListener('input', updateTotalPrice);
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                fetch('{{ route('cart.removeFromCart') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: productId }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert('Không thể xóa sản phẩm!');
                    }
                })
                .catch(error => console.error('Lỗi:', error));
            }
        });
    });
});



</script>


@endsection
