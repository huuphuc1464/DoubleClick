@extends('Profile.sublayout')

@section('css_sub')
<link rel="stylesheet" href="{{ asset('css/sachyeuthich.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
{{ $title }}
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
                <img alt="Book cover of {{ $item->TenSach }}" src="{{ asset('/img/sach/' . $item->AnhDaiDien) }}" />

                {{-- <img alt="Book cover of {{ $item->TenSach }}" height="90" src="https://storage.googleapis.com/a1aa/image/QgYXdjkmvHaOI1otRFlO4l3eIOCg5XRIcX9lyeHVN7xReYfPB.jpg" width="60" /> --}}
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
                <button class="addToCart" data-id="{{ $item->MaSach }}">
                    <i class="fas fa-cart-plus"></i>
                </button>
            </div>
        </div>
    </div>
    @endforeach
    <div class="mt-3 d-flex justify-content-end">
        @if ($wishlist->lastPage() > 1)
        <ul class="pagination">
            {{-- <!-- Mũi tên trái -->
            <li class="page-item {{ ($wishlist->currentPage() == 1) ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $wishlist->previousPageUrl() }}" aria-label="Previous">&lt;</a>
            </li> --}}

            <!-- Trang đầu -->
            <li class="page-item {{ ($wishlist->currentPage() == 1) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $wishlist->url(1) }}" aria-label="First">Trang đầu</a>
            </li>

            <!-- Trang trước nếu không ở trang đầu -->
            @if ($wishlist->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $wishlist->url($wishlist->currentPage() - 1) }}">
                    {{ $wishlist->currentPage() - 1 }}
                </a>
            </li>
            @endif

            <!-- Trang hiện tại -->
            <li class="page-item active">
                <a class="page-link" href="#">{{ $wishlist->currentPage() }}</a>
            </li>

            <!-- Trang sau nếu không ở trang cuối -->
            @if ($wishlist->currentPage() < $wishlist->lastPage())
                <li class="page-item">
                    <a class="page-link" href="{{ $wishlist->url($wishlist->currentPage() + 1) }}">
                        {{ $wishlist->currentPage() + 1 }}
                    </a>
                </li>
                @endif

                {{-- <!-- Mũi tên phải -->
                <li class="page-item {{ ($wishlist->currentPage() == $wishlist->lastPage()) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $wishlist->nextPageUrl() }}" aria-label="Next">&gt;</a>
                </li> --}}
                <!-- Trang cuối -->
                <li class="page-item {{ ($wishlist->currentPage() == $wishlist->lastPage()) ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $wishlist->url($wishlist->lastPage()) }}" aria-label="Last">Trang cuối</a>
                </li>
        </ul>
        @endif
    </div>



</div>

<script>
    //Xóa sách khỏi yêu thích
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
                            const alertDiv = document.querySelector('.alert'); // Lấy phần tử chứa thông báo
                            if (data.success) {
                                // Xóa phần tử khỏi DOM
                                const item = document.getElementById(`wishlist-item-${MaSach}`);
                                if (item) {
                                    item.remove();
                                }

                                // Hiển thị thông báo thành công
                                alertDiv.textContent = data.message;
                                alertDiv.classList.remove('alert-danger');
                                alertDiv.classList.add('alert-success');
                                alertDiv.style.display = 'block'; // Hiển thị thông báo
                            } else {
                                // Hiển thị thông báo lỗi
                                alertDiv.textContent = data.message;
                                alertDiv.classList.remove('alert-success');
                                alertDiv.classList.add('alert-danger');
                                alertDiv.style.display = 'block'; // Hiển thị thông báo
                            }

                            // Ẩn thông báo sau 5 giây
                            setTimeout(function() {
                                alertDiv.style.display = 'none';
                            }, 5000); // Thời gian 5 giây
                        })

                        .catch(error => {
                            console.error('Lỗi:', error);
                            alert('Đã xảy ra lỗi khi xóa sách.');
                        });
                }
            });
        });
    });

    //Thêm sách yêu thích vào giỏ hàng
    document.addEventListener('DOMContentLoaded', function() {
        // Bắt sự kiện click vào nút "Thêm vào giỏ"
        document.querySelectorAll('.addToCart').forEach(function(button) {
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

    //Thêm tất cả sách vào giỏ hàng
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý nút "Thêm tất cả vào giỏ hàng"
        const addAllButton = document.querySelector('.add-all');
        if (addAllButton) {
            addAllButton.addEventListener('click', function() {
                // Lấy tất cả mã sách từ các phần tử trong danh sách yêu thích
                const MaSachList = Array.from(document.querySelectorAll('.addToCart')).map(button => button.getAttribute('data-id'));

                // Gửi yêu cầu AJAX
                fetch("{{ route('profile.sachyeuthich.addAll') }}", {
                        method: 'POST'
                        , headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            , 'Content-Type': 'application/json'
                        , }
                        , body: JSON.stringify({
                            MaSachList: MaSachList
                        })
                    , })
                    .then(response => response.json())
                    .then(data => {
                        // Hiển thị thông báo
                        const alertDiv = document.querySelector('.alert');
                        alertDiv.textContent = data.message;
                        alertDiv.style.display = 'block';

                        // Thay đổi màu sắc thông báo
                        if (data.success) {
                            alertDiv.classList.remove('alert-danger');
                            alertDiv.classList.add('alert-success');
                        } else {
                            alertDiv.classList.remove('alert-success');
                            alertDiv.classList.add('alert-danger');
                        }

                        // Ẩn thông báo sau 5 giây
                        setTimeout(() => alertDiv.style.display = 'none', 5000);
                    })
                    .catch(error => {
                        console.error('Lỗi:', error);
                        const alertDiv = document.querySelector('.alert');
                        alertDiv.textContent = 'Đã xảy ra lỗi khi thêm tất cả sách vào giỏ hàng.';
                        alertDiv.classList.remove('alert-success');
                        alertDiv.classList.add('alert-danger');
                        alertDiv.style.display = 'block';

                        // Ẩn thông báo sau 5 giây
                        setTimeout(() => alertDiv.style.display = 'none', 5000);
                    });
            });
        }
    });

</script>

@endsection
