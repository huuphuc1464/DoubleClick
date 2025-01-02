@extends('Profile.sublayout')

@section('css_sub')
{{-- <link rel="stylesheet" href="{{ asset('css/.css') }}"> --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    body {
        background-color: #f8f9fa;
    }

    .header {
        background-color: #f1f3f4;
        padding: 20px;
    }

    .header h1 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .add-all {
        color: #00bcd4;
        font-weight: bold;
        cursor: pointer;
        margin-top: 10px;
    }

    .cart-item {
        background-color: #ffffff;
        padding: 20px;
        border-bottom: 1px solid #e0e0e0;
    }

    .cart-item img {
        width: 60px;
        height: 90px;
    }

    .cart-item .item-title {
        font-size: 1rem;
        font-weight: bold;
    }

    .cart-item .item-price {
        color: #ff9800;
        font-size: 1.25rem;
        font-weight: bold;
    }

    .cart-item .delete-icon {
        color: #9e9e9e;
        cursor: pointer;
        margin-top: 20px;
    }

    .cart-item .add-to-cart {
        background-color: #ff9800;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }

</style>

@endsection

@section('content_sub')
<div class="container">
    <div class="header">
        <h1>
            Sách yêu thích
        </h1>
    </div>
    @if ($wishlist->isEmpty())
    <p>Không có sách yêu thích nào.</p>
    @else
    <div class="add-all">
        THÊM TẤT CẢ VÀO GIỎ HÀNG
    </div>
    @endif

    @foreach ($wishlist as $item)
    <div class="cart-item mt-3" id="wishlist-item-{{ $item->MaSach }}">
        <div class="row align-items-center">
            <div class="col-2">
                {{-- <img alt="Book cover of {{ $item->TenSach }}" height="90" src="{{ asset('storage/img/Books/' . $item->AnhDaiDien) }}" width="60" /> --}}
                <img alt="Book cover of {{ $item->TenSach }}" height="90" src="https://storage.googleapis.com/a1aa/image/QgYXdjkmvHaOI1otRFlO4l3eIOCg5XRIcX9lyeHVN7xReYfPB.jpg" width="60" />
            </div>
            <div class="col-6">
                <div class="item-title">
                    {{ $item->TenSach }}
                </div>
                <div>
                    <i class="fas fa-trash delete-icon" data-id="{{ $item->MaSach }}" style="cursor: pointer; color: red;">
                    </i>
                </div>
            </div>
            <div class="col-2 text-end">
                <div class="item-price">
                    {{ number_format($item->GiaBan, 0, ',', '.') }} ₫
                </div>
            </div>
            <div class="col-2 text-end">
                <button class="add-to-cart" data-id="{{ $item->MaSach }}">
                    <i class="fas fa-cart-plus"></i>
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bắt sự kiện click vào biểu tượng xóa
        document.querySelectorAll('.delete-icon').forEach(function(icon) {
            icon.addEventListener('click', function() {
                const MaSach = this.getAttribute('data-id');

                // Hiển thị xác nhận trước khi xóa
                if (confirm('Bạn có chắc chắn muốn xóa sách này khỏi danh sách yêu thích?')) {
                    // Gửi yêu cầu AJAX
                    fetch("{{ route('profile.sachyeuthich.xoa') }}", {
                            method: 'DELETE'
                            , headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                , 'Content-Type': 'application/json'
                            , }
                            , body: JSON.stringify({
                                MaSach: MaSach
                            })
                        , })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Xóa phần tử khỏi DOM
                                const item = document.getElementById(`wishlist-item-${MaSach}`);
                                if (item) {
                                    item.remove();
                                }
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                            alert('Đã xảy ra lỗi khi xóa sách.');
                        });
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Bắt sự kiện click vào nút "Thêm vào giỏ"
        document.querySelectorAll('.add-to-cart').forEach(function(button) {
            button.addEventListener('click', function() {
                const MaSach = this.getAttribute('data-id'); // Lấy mã sách từ data-id

                // Gửi yêu cầu AJAX
                fetch("{{ route('profile.sachyeuthich.addToCart') }}", {
                        method: 'POST'
                        , headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            , 'Content-Type': 'application/json'
                        }
                        , body: JSON.stringify({
                            MaSach: MaSach
                        })
                    })
                    .then(response => response.json()) // Chuyển response thành JSON
                    .then(data => {
                        console.log('Response:', data);
                        const notification = document.getElementById('notification');
                        if (data.success) {
                            // Cập nhật và hiển thị thông báo thành công
                            notification.classList.remove('alert-danger');
                            notification.classList.add('alert-success');
                            notification.textContent = data.message;
                        } else {
                            // Cập nhật và hiển thị thông báo thất bại
                            notification.classList.remove('alert-success');
                            notification.classList.add('alert-danger');
                            notification.textContent = data.message;
                        }
                        notification.style.display = 'block'; // Hiển thị thông báo

                        // Ẩn thông báo sau 5 giây
                        setTimeout(function() {
                            notification.style.display = 'none';
                        }, 5000); // Thời gian 5 giây
                    })
                    .catch(error => {
                        console.error('Lỗi:', error);
                        const notification = document.getElementById('notification');
                        notification.classList.remove('alert-success');
                        notification.classList.add('alert-danger');
                        notification.textContent = 'Đã xảy ra lỗi khi thêm vào giỏ hàng.';
                        notification.style.display = 'block'; // Hiển thị thông báo lỗi
                    });
            });
        });
    });

</script>

@endsection
