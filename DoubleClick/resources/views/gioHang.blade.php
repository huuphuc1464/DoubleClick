@extends('layout')
@section('css')
    <style>
        .highlight {
            background-color: yellow;
            font-weight: bold;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('content')

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1 class="text-center mb-4">Giỏ Hàng</h1>

    <div class="container-fluid">
        @if (empty($cart) || count($cart) === 0)
            <p class="text-center text-danger fw-bold" style="font-size: 24px; margin-top: 130px;">
                Chưa có sản phẩm trong giỏ hàng!
            </p>
        @else
            <form id="cart-form">
                <table class="table table-bordered">
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
                    <tbody id="DanhSachSanPham">
                        @foreach ($cart as $id => $item)
                            <tr data-id="{{ $id }}" data-stock="{{ $item['stock'] ?? 0 }}">
                                <td>
                                    <img src="{{ asset('img/sach/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                        width="100">
                                </td>
                                <td class="text-center align-middle">{{ $item['name'] }}</td>
                                <td class="text-center align-middle">{{ number_format($item['price'], 0, ',', '.') }} VNĐ
                                </td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-sm btn-outline-secondary decrease-quantity"
                                        data-id="{{ $id }}">-</button>
                                    <input type="number" class="quantity" data-id="{{ $id }}"
                                        value="{{ $item['quantity'] }}" min="1"
                                        style="width: 60px; text-align: center;">
                                    <button type="button" class="btn btn-sm btn-outline-secondary increase-quantity"
                                        data-id="{{ $id }}">+</button>
                                </td>
                                <td class="total-item-price text-center align-middle">
                                    {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ
                                </td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-danger btn-sm remove-item"
                                        data-id="{{ $id }}">Xóa</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </form>

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p>Tổng tiền:
                        <span id="total-price">
                            {{ number_format($totalPrice, 0, ',', '.') }} VNĐ
                        </span>
                    </p>

                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $cart->links('pagination::bootstrap-4') }}
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <a href="/cart/gio-hang" class="btn btn-success">Cập nhật giỏ hàng</a>
                    <button id="delete-all" class="btn btn-danger">Xóa tất cả</button>

                    <form action="{{ route('thanhToan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="cart_data" value="{{ json_encode($cart) }}">
                        <button type="submit" class="btn btn-primary">Mua hàng</button>
                    </form>
                </div>

            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputSearch = document.getElementById('inputSearch');
            const danhSachSanPhamElement = document.getElementById('DanhSachSanPham');

            /**
             * Xóa dấu tiếng Việt
             */
            function removeVietnameseTones(str) {
                return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/đ/g, "d").replace(/Đ/g, "D");
            }

            /**
             * Làm nổi bật từ khóa trong văn bản
             */
            function highlightText(text, keyword) {
                if (!text || !keyword) return text;
                const regex = new RegExp(keyword, 'gi');
                return text.replace(regex, (match) => `<span class="highlight">${match}</span>`);
            }

            /**
             * Tìm kiếm sản phẩm theo tên
             */
            inputSearch.addEventListener('input', function() {
                const keyword = removeVietnameseTones(inputSearch.value.toLowerCase());
                const rows = danhSachSanPhamElement.querySelectorAll('tr');

                rows.forEach(row => {
                    const productName = removeVietnameseTones(row.querySelector('td:nth-child(2)')
                        .innerText.toLowerCase());
                    if (productName.includes(keyword)) {
                        row.style.display = '';
                        row.querySelector('td:nth-child(2)').innerHTML = highlightText(row
                            .querySelector('td:nth-child(2)').innerText, inputSearch.value);
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const totalPriceElement = document.getElementById('total-price');

            /**
             * Tính tổng tiền của 1 sản phẩm (cập nhật cột "Tổng tiền" cho dòng đó)
             * @param {HTMLElement} row
             */
            function calculateItemTotalPrice(row) {
                const quantity = parseInt(row.querySelector('.quantity').value, 10);
                const unitPrice = parseInt(
                    row.querySelector('td:nth-child(3)').innerText.replace(/\./g, '').replace(' VNĐ', '')
                );
                const totalItemPrice = quantity * unitPrice;

                row.querySelector('.total-item-price').innerText =
                    new Intl.NumberFormat('vi-VN').format(totalItemPrice) + ' VNĐ';
            }

            /**
             * Tính tổng tiền của tất cả sản phẩm
             */
            const cartData = @json($cart->toArray());

            function calculateTotalPrice() {
                const total = cartData.reduce((sum, item) => sum + item.price * item.quantity, 0);
                document.getElementById('total-price').innerText =
                    new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';
            }

            function fetchTotalPrice() {
                fetch('/api/cart/total-price')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('total-price').innerText =
                            new Intl.NumberFormat('vi-VN').format(data.totalPrice) + ' VNĐ';
                    });
            }



            /**
             * Gắn sự kiện cho các nút tăng/giảm số lượng
             */
            function setupCartEvents() {
                document.querySelectorAll('.quantity').forEach(input => {
                    input.addEventListener('focus', function() {
                        this.dataset.previousValue = this.value; // Lưu giá trị cũ
                    });

                    input.addEventListener('input', function() {
                        const row = this.closest('tr');
                        handleQuantityChange(this, row);
                    });
                });

                document.querySelectorAll('.increase-quantity, .decrease-quantity').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const row = this.closest('tr');
                        const input = row.querySelector('.quantity');
                        const maxStock = parseInt(row.dataset.stock, 10);
                        let quantity = parseInt(input.value, 10);

                        if (this.classList.contains('increase-quantity')) {
                            if (quantity >= maxStock) {
                                alert('Không thể tăng thêm số lượng do hết hàng!');
                                return;
                            }
                            quantity++;
                        } else if (this.classList.contains('decrease-quantity')) {
                            if (quantity > 1) {
                                quantity--;
                            }
                        }

                        // Gửi yêu cầu cập nhật số lượng tới server
                        fetch('{{ route('cart.update') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    id: row.dataset.id,
                                    quantity
                                }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Cập nhật giao diện
                                    input.value = quantity;
                                    row.querySelector('.total-item-price').innerText =
                                        new Intl.NumberFormat('vi-VN').format(data.cart[row
                                            .dataset.id].price * quantity) + ' VNĐ';
                                    document.getElementById('total-price').innerText =
                                        new Intl.NumberFormat('vi-VN').format(data.totalPrice) +
                                        ' VNĐ';
                                } else {
                                    alert(data.message || 'Không thể cập nhật số lượng!');
                                }
                            });
                    });
                });

                function syncCart() {
                    fetch('/api/cart/sync') // API đồng bộ
                        .then(response => response.json())
                        .then(data => {
                            const cart = data.cart;
                            const totalPrice = data.totalPrice;

                            // Cập nhật tổng tiền
                            document.getElementById('total-price').innerText =
                                new Intl.NumberFormat('vi-VN').format(totalPrice) + ' VNĐ';

                            // Cập nhật danh sách sản phẩm
                            const danhSachSanPhamElement = document.getElementById('DanhSachSanPham');
                            danhSachSanPhamElement.innerHTML = ''; // Xóa nội dung cũ

                            cart.forEach(item => {
                                const row = document.createElement('tr');
                                row.setAttribute('data-id', item.id);
                                row.setAttribute('data-stock', item.stock);

                                row.innerHTML = `
                    <td>
                        <img src="/img/sach/${item.image}" alt="${item.name}" width="100">
                    </td>
                    <td>${item.name}</td>
                    <td>${new Intl.NumberFormat('vi-VN').format(item.price)} VNĐ</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-secondary decrease-quantity"
                            data-id="${item.id}">-</button>
                        <input type="number" class="quantity" data-id="${item.id}" value="${item.quantity}"
                            min="1" style="width: 60px; text-align: center;">
                        <button type="button" class="btn btn-sm btn-outline-secondary increase-quantity"
                            data-id="${item.id}">+</button>
                    </td>
                    <td class="total-item-price">
                        ${new Intl.NumberFormat('vi-VN').format(item.price * item.quantity)} VNĐ
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-item" data-id="${item.id}">Xóa</button>
                    </td>
                `;
                                danhSachSanPhamElement.appendChild(row);
                            });

                            // Gắn lại sự kiện sau khi cập nhật giao diện
                            setupCartEvents();
                        })
                        .catch(error => console.error('Error:', error));
                }



                document.querySelectorAll('.remove-item').forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.dataset.id;

                        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                            fetch('{{ route('cart.removeFromCart') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        id: productId
                                    }),
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        syncCart(); // Đồng bộ lại giao diện
                                    } else {
                                        alert(data.message || 'Không thể xóa sản phẩm!');
                                    }
                                });
                        }
                    });
                });


                document.getElementById('delete-all')?.addEventListener('click', function() {
                    if (confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm trong giỏ hàng?')) {
                        fetch('{{ route('cart.clear') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);
                                    location.reload();
                                }
                            });
                    }
                });
            }

            // Lần đầu load
            setupCartEvents();
            calculateTotalPrice();
        });


//nhat
document.addEventListener('DOMContentLoaded', function() {
    const totalPriceElement = document.getElementById('total-price');

    // Lắng nghe sự kiện thay đổi số lượng sản phẩm
    document.querySelectorAll('.quantity').forEach(input => {
        input.addEventListener('change', function() {
            const row = this.closest('tr');
            const productId = this.dataset.id;
            const quantity = parseInt(this.value, 10);
            const maxStock = parseInt(row.dataset.stock, 10);

            if (quantity > maxStock) {
                alert('Không thể tăng thêm số lượng do hết hàng!');
                return;
            }

            // Gửi yêu cầu AJAX để cập nhật số lượng sản phẩm
            fetch('{{ route('cart.update') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: productId,
                    quantity: quantity
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật tổng tiền cho sản phẩm hiện tại
                    row.querySelector('.total-item-price').innerText = 
                        new Intl.NumberFormat('vi-VN').format(data.cart[productId].price * quantity) + ' VNĐ';

                    // Cập nhật tổng tiền trên trang
                    totalPriceElement.innerText = 
                        new Intl.NumberFormat('vi-VN').format(data.totalPrice) + ' VNĐ';
                } else {
                    alert(data.message || 'Không thể cập nhật số lượng!');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});





    </script>

@endsection
