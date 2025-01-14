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
    @if ($cart->isEmpty())
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
                                {{ number_format((int) $item['quantity'] * (float) $item['price'], 0, ',', '.') }} VNĐ
                            </td>
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
            <div class="mt-4 d-flex justify-content-center">
                {{ $cart->links('pagination::bootstrap-4') }}
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
        // Khai báo các phần tử DOM
        const selectAllCheckbox = document.getElementById('select-all');
        const itemCheckboxes = document.querySelectorAll('.select-item');
        const totalPriceElement = document.getElementById('total-price');
        const STORAGE_KEY = 'selectedItems';
        const TOTAL_PRICE_KEY = 'totalPrice';

        /**
         * Lưu trạng thái checkbox vào localStorage
         */
        function saveCheckboxState() {
            const selectedItems = Array.from(itemCheckboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.dataset.id);
            localStorage.setItem(STORAGE_KEY, JSON.stringify(selectedItems));
        }

        /**
         * Lưu tổng tiền vào localStorage
         * @param {number} total - Tổng tiền hiện tại
         */
        function saveTotalPrice(total) {
            localStorage.setItem(TOTAL_PRICE_KEY, total);
        }

        /**
         * Phục hồi trạng thái checkbox từ localStorage
         */
        function restoreCheckboxState() {
            const savedState = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = savedState.includes(checkbox.dataset.id);
            });
        }

        /**
         * Phục hồi tổng tiền từ localStorage
         */
        function restoreTotalPrice() {
            const savedTotal = localStorage.getItem(TOTAL_PRICE_KEY);
            if (savedTotal) {
                totalPriceElement.innerText = new Intl.NumberFormat('vi-VN').format(savedTotal) + ' VNĐ';
            }
        }

        /**
         * Tính tổng tiền của một sản phẩm
         * @param {HTMLElement} row - Dòng chứa thông tin sản phẩm
         */
        function calculateItemTotalPrice(row) {
            const quantity = parseInt(row.querySelector('.quantity').value, 10);
            const unitPrice = parseInt(row.querySelector('td:nth-child(4)').innerText.replace(/\./g, '').replace(' VNĐ', ''));
            const totalItemPrice = quantity * unitPrice;

            // Cập nhật cột "Tổng tiền" của sản phẩm
            row.querySelector('.total-item-price').innerText = new Intl.NumberFormat('vi-VN').format(totalItemPrice) + ' VNĐ';
        }

        /**
         * Tính tổng tiền của tất cả sản phẩm được chọn
         */
        function calculateTotalPrice() {
            let total = 0;
            itemCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const row = checkbox.closest('tr');
                    const quantity = parseInt(row.querySelector('.quantity').value, 10);
                    const unitPrice = parseInt(row.querySelector('td:nth-child(4)').innerText.replace(/\./g, '').replace(' VNĐ', ''));

                    total += quantity * unitPrice;
                }
            });

            // Cập nhật tổng tiền toàn bộ giỏ hàng
            totalPriceElement.innerText = new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';
            saveTotalPrice(total); // Lưu tổng tiền vào localStorage
        }

        // Xử lý sự kiện chọn tất cả
        selectAllCheckbox.addEventListener('change', function () {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            saveCheckboxState();
            calculateTotalPrice();
        });

        // Xử lý sự kiện thay đổi trạng thái checkbox của từng sản phẩm
        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                saveCheckboxState();
                calculateTotalPrice();
            });
        });

        // Xử lý sự kiện thay đổi số lượng sản phẩm
        document.querySelectorAll('.quantity').forEach(input => {
            input.addEventListener('input', function () {
                const row = this.closest('tr');
                calculateItemTotalPrice(row); // Cập nhật tổng tiền của sản phẩm
                calculateTotalPrice();       // Cập nhật tổng tiền toàn bộ
            });
        });

        // Xử lý sự kiện nút tăng/giảm số lượng sản phẩm
        const table = document.querySelector('table');
        table.addEventListener('click', function (e) {
            const target = e.target;
            if (target.classList.contains('increase-quantity') || target.classList.contains('decrease-quantity')) {
                const row = target.closest('tr');
                const quantityInput = row.querySelector('.quantity');
                let quantity = parseInt(quantityInput.value, 10);

                if (target.classList.contains('increase-quantity')) {
                    quantity++;
                } else if (target.classList.contains('decrease-quantity') && quantity > 1) {
                    quantity--;
                }

                quantityInput.value = quantity;
                calculateItemTotalPrice(row); // Cập nhật tổng tiền của sản phẩm
                calculateTotalPrice();       // Cập nhật tổng tiền toàn bộ
            }
        });

        // Xử lý sự kiện xóa tất cả sản phẩm
        document.getElementById('delete-all').addEventListener('click', function () {
            if (confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm trong giỏ hàng?')) {
                fetch('{{ route('cart.clear') }}', { // Route xóa tất cả giỏ hàng
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message); // Thông báo xóa thành công
                            location.reload(); // Tải lại trang
                        } else {
                            alert('Không thể xóa giỏ hàng. Vui lòng thử lại!');
                        }
                    })
                    .catch(error => console.error('Lỗi:', error)); // Log lỗi nếu xảy ra sự cố
            }
        });




        // Xử lý sự kiện xóa sản phẩm
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

        // Tính tổng tiền ban đầu và phục hồi trạng thái khi trang được tải
        restoreCheckboxState();
        restoreTotalPrice();
    });
    /**
     * Tính tổng tiền của tất cả sản phẩm được chọn, cộng dồn vào tổng tiền trước đó.
     */
    function calculateTotalPrice() {
        // Lấy tổng tiền từ localStorage
        let total = parseInt(localStorage.getItem(TOTAL_PRICE_KEY)) || 0;

        // Tính tổng tiền từ các sản phẩm trên trang hiện tại
        let currentPageTotal = 0;
        itemCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const row = checkbox.closest('tr');
                const quantity = parseInt(row.querySelector('.quantity').value, 10);
                const unitPrice = parseInt(row.querySelector('td:nth-child(4)').innerText.replace(/\./g, '').replace(' VNĐ', ''));
                currentPageTotal += quantity * unitPrice;
            }
        });

        // Cập nhật tổng tiền
        total = currentPageTotal; // Thay bằng giá trị tính từ sản phẩm đã chọn
        totalPriceElement.innerText = new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';

        // Lưu tổng tiền vào localStorage
        localStorage.setItem(TOTAL_PRICE_KEY, total);
    }

    // Xử lý sự kiện thay đổi trạng thái checkbox của từng sản phẩm
    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            calculateTotalPrice();
        });
    });




    document.getElementById('checkout').addEventListener('click', function () {
        const selectedItems = Array.from(document.querySelectorAll('.select-item:checked'))
            .map(checkbox => checkbox.dataset.id);

        console.log('Selected items:', selectedItems);

        if (selectedItems.length === 0) {
            alert('Vui lòng chọn ít nhất một sản phẩm để thanh toán.');
            return;
        }

        fetch('{{ route("checkout.prepare") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ selectedItems }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '{{ route("thanhToan") }}';
                } else {
                    alert(data.message || 'Đã xảy ra lỗi.');
                }
            })
            .catch(error => console.error('Lỗi:', error));
    });


</script>


@endsection
