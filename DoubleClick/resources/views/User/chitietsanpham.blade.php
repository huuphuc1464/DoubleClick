@extends('layout')
@section('title', 'Chi Tiết Sản Phẩm')
@section('content')


<div class="breadcrumb">

    <a href="{{ route('user.products') }}">Sản phẩm</a> &nbsp;&gt;&nbsp;
    <span>{{ $sach->TenSach }}</span>
</div>



<div class="container">
    <div class="product-detail">
        <!-- Hình ảnh sản phẩm -->
        <div class="product-image">
            <img id="mainImage" src="{{ asset('img/sach/' . $anhsach->AnhSach1) }}" alt="{{ $sach->TenSach }}" class="img-fluid">
            <br> </br>
            <div class="product-thumbnails">    
                <img src="{{ asset('img/sach/' . $anhsach->AnhSach1) }}" alt="{{ $sach->TenSach }} - 1" class="thumbnail" onclick="changeImage(this)">
                <img src="{{ asset('img/sach/' . $anhsach->AnhSach2) }}" alt="{{ $sach->TenSach }} - 2" class="thumbnail" onclick="changeImage(this)">
            </div>
        </div>


        <!-- Thông tin sản phẩm -->
        <div class="description">
            <h1>{{ $sach->TenSach }}</h1>
            <div class="price">{{ number_format($sach->GiaBan, 0, ',', '.') }} VND</div>
            <div class="rating">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star{{ $i <= $sach->danhGia()->avg('SoSao') ? ' filled' : '' }}"></i>
                @endfor
                <span>({{ $danhgia->count() }} đánh giá | đã bán {{ number_format($sach->SoLuongTon, 0, ',', '.') }})</span>
            </div>
            <p><strong>Mã Sách:</strong> {{ $sach->MaSach }}</p>
            <p><strong>ISBN:</strong> {{ $sach->ISBN }}</p>
            <p><strong>Nhà Xuất Bản:</strong> {{ $sach->TenNCC }}</p>
            <p><strong>Năm Xuất Bản:</strong> {{ $sach->NXB }}</p>
            <p><strong>Tác Giả:</strong> {{ $sach->TenTG }}</p>
            <p><strong>Mô Tả:</strong> {{ $sach->MoTa }}</p>
            <p><strong>Số Lượng Còn: </strong>{{ number_format($sach->SoLuongTon, 0, ',', '.') }}</p>
            <p><strong>Tình trạng:</strong>
                @if ($sach->TrangThai == 1)
                    <span class="badge bg-success">Còn hàng</span>
                @else
                    <span class="badge bg-danger">Hết Hàng</span>
                @endif
            </p>
            <div class="quantity-container">
                <label for="quantity"><strong>Số lượng:</strong></label>
                <input id="quantity" type="number" name="quantity" min="1" value="1" max="{{ $sach->SoLuongTon }}" class="form-control quantity-input">
            </div>
            <div class="action-buttons">
                {{-- <button
                    class="btn btn-success {{ in_array($sach->TrangThai, [0, 2]) ? 'btn-disabled' : '' }}" {{ in_array($sach->TrangThai, [0, 2]) ? 'disabled' : '' }}>
                    <i class="fas fa-cart-plus "></i>Thêm vào giỏ hàng
                </button> --}}
                <button
                    class="btn btn-success add-to-cart {{ in_array($sach->TrangThai, [0, 2]) ? 'btn-disabled' : '' }}"
                    {{ in_array($sach->TrangThai, [0, 2]) ? 'disabled' : '' }}
                    data-id="{{ $sach->MaSach }}"
                    data-name="{{ $sach->TenSach }}"
                    data-price="{{ $sach->GiaBan }}"
                    data-image="{{ $sach->AnhDaiDien }}"
                    data-quantity="1"
                >
                    <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                </button>

                <!-- Nút Tim -->

                {{-- <button class="btn btn-outline-danger" id="likeButton" style="display: none;">
                    <i class="fas fa-heart"></i>
                </button> --}}

                @if (Session::has('user'))
                    <button
                        class="btn btn-outline-danger like-button"
                        onclick="handleFavorite(event, {{ $sach->MaSach }})">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                @else
                    {{-- <button
                        class="btn btn-outline-danger like-button"
                        onclick="alert('Bạn cần đăng nhập để sử dụng chức năng này!');">
                        <i class="fa-regular fa-heart"></i>
                    </button> --}}
                @endif




            </div>
            <div class="product-stats" style="display: flex; gap: 20px;">
                <p><strong>Lượt xem: </strong><span id="luotXem">{{ $sach->luot_xem }}</span></p>
                <p><strong>Lượt thích: </strong><span id="luotTim">{{ $sach->luot_tim }}</span></p>
            </div>

        </div>

    </div>
</div>

<div class="related-products">
    <h2>MÔ TẢ</h2>
    <br>
    <p>{{ $sach->MoTa }}</p>
</div>

<div class="comment-products" >
    <h2 >Đánh giá</h2>
    <div style="display: flex; gap: 30px;">
        <div class="reviews" style="width: 50%;">

            @foreach ($danhgia as $review)
                <div class="review" style="margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                    <!-- Hiển thị tên người dùng -->
                    <h4 style="margin: 0; color: #333;">{{ $review->user->TenTK }}</h4>

                    <!-- Hiển thị số sao -->
                    <div class="rating" style="margin: 5px 0;">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star{{ $i <= $review->SoSao ? ' filled' : '' }}"
                               style="color: {{ $i <= $review->SoSao ? '#ffc107' : '#ddd' }};"></i>
                        @endfor
                    </div>

                    <!-- Hiển thị nhận xét -->
                    <p style="margin: 5px 0; font-style: italic;">{{ $review->DanhGia }}</p>
                    <small style="color: #999;">{{ $review->NgayDang }}</small>
                </div>
            @endforeach
        </div>
        <div class="comment" style="width: 50%;">
            <h3>Đánh giá sản phẩm</h3>
            <form action="{{ route('danhgia.store') }}" method="POST">
                @csrf

                <!-- Chọn số sao -->
                <div class="rating">
                    <label>Đánh giá sao:</label>
                    <div class="rate-container">
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="radio" id="star{{ $i }}" name="SoSao" value="{{ $i }}">
                            <label for="star{{ $i }}" class="fas fa-star"></label>
                        @endfor
                    </div>
                </div>

                <!-- Nhập bình luận -->
                <div class="form-group">
                    <label for="DanhGia">Nhận xét:</label>
                    <textarea id="DanhGia" name="DanhGia" class="form-control" rows="3" placeholder="Viết nhận xét của bạn..."></textarea>
                </div>

                <!-- Nút gửi đánh giá -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                </div>
            </form>
        </div>
    </div>

</div>
<div class="author-products">
    <h2>Liên Quan</h2>
    <div class="flex-wrap product-list d-flex justify-content-center">
        @foreach ($relatedProducts as $sach)
            <div class="m-3 text-center product-item card" onclick="window.location='{{ route('product.detail', $sach->MaSach) }}'" style="cursor: pointer; width: 200px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <img src="{{ asset('img/sach/' . $sach->AnhDaiDien) }}" alt="{{ $sach->TenSach }}" class="card-img-top" style="width: 150px; height: 200px; object-fit: cover;">
                    <p class="mt-3"><strong>{{ $sach->TenSach }}</strong></p>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- lấy dữ liệu để add to cart --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Lấy tất cả các nút "Add to Cart"
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    // Lặp qua các nút và thêm sự kiện click
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            // Lấy thông tin sản phẩm từ data-attributes
            const productId = this.dataset.id;
            const productName = this.dataset.name;
            const productPrice = this.dataset.price;
            const productImage = this.dataset.image;

            // Lấy số lượng từ input gần nút bấm "Add to Cart"
            const quantityInput = this.closest('.action-buttons').previousElementSibling.querySelector('input[name="quantity"]');
            const productQuantity = parseInt(quantityInput.value) || 1; // Mặc định là 1 nếu giá trị không hợp lệ

            console.log("Product ID:", productId);
            console.log("Product Name:", productName);
            console.log("Product Price:", productPrice);
            console.log("Product Quantity:", productQuantity);

            // Gửi dữ liệu qua AJAX
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    quantity: productQuantity,
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message || 'Sản phẩm đã được thêm vào giỏ hàng!');
                    } else {
                        alert(data.message || 'Không thể thêm sản phẩm vào giỏ hàng!');
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    alert('Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng!');
                });
            });
        });
    });

</script>




<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-color: #f5f5f5;
    }

    .breadcrumb {
        padding: 15px 20px;
        background-color: #ffffff;
        margin-bottom: 20px;
        border: 1px solid #ddd;
    }

    .breadcrumb a {
        color: #4CAF50;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }



    .product-detail {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .product-image {
        flex: 1 1 40%;
    }

    .product-image img {
        max-width: 100%;
        border-radius: 8px;
    }

    .product-info {
        flex: 1 1 55%;
    }

    .product-info h1 {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .product-info .price {
        font-size: 22px;
        color: red;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .product-info .rating {
        margin-bottom: 15px;
        color: #FFD700;
    }

    .product-info .description p {
        margin-bottom: 10px;
    }

    .quantity-container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 15px;
    }

    .quantity-input {
        width: 100px;
        text-align: center;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .action-buttons {
        margin-top: 20px;
    }

    .action-buttons button {
        font-size: 16px;
        margin-right: 10px;
        padding: 10px 20px;
        border-radius: 4px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .action-buttons .btn-success:hover {
        background-color: #388e3c;
    }

    .action-buttons .btn-primary:hover {
        background-color: #1976d2;
    }

    .action-buttons .btn-outline-danger:hover {
        color: white;
        background-color: #d32f2f;
    }

    .related-products, .author-products ,.comment-products{
        margin: 20px 0;
        padding: 15px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .related-products h2, .author-products h2 ,.comment-products h2{
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        margin: 0;
        border-radius: 5px 5px 0 0;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
    }

    .related-products, .author-products {
        margin: 20px 0;
        padding: 15px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        overflow: hidden; /* Giữ các phần tử bên trong */
    }


    .related-products p {
        line-height: 1.6;
        font-size: 16px;
        color: #333;
        margin-bottom: 15px;
    }

    .author-products .product-list, .related-products .product-list {
        display: flex;
        gap: 15px;
        padding: 10px 0;
        overflow-x: auto;
    }

    .author-products .product-list img, .related-products .product-list img {
        max-width: 100%;
        width: 100px;
        height: 150px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .author-products .product-list img:hover, .related-products .product-list img:hover {
        transform: scale(1.1);
    }

    .product-thumbnails {
        display: flex; /* Hiển thị các hình ảnh theo hàng ngang */
        gap: 10px; /* Khoảng cách giữa các thumbnails */
    }

    .product-thumbnails .thumbnail {
        width: 80px; /* Đặt chiều rộng cố định */
        height: 80px; /* Đặt chiều cao cố định */
        object-fit: cover; /* Đảm bảo hình ảnh không bị méo */
        border: 1px solid #ccc; /* Tùy chọn: Thêm viền để rõ ràng hơn */
        border-radius: 5px; /* Tùy chọn: Làm bo góc hình ảnh */
        cursor: pointer; /* Tùy chọn: Con trỏ chuột sẽ thay đổi khi hover */
        transition: transform 0.2s; /* Tùy chọn: Hiệu ứng khi hover */
    }

    .product-thumbnails .thumbnail:hover {
        transform: scale(1.1); /* Phóng to khi hover */
    }
    #mainImage {
        width: 300px; /* Kích thước cố định chiều rộng */
        height: 400px; /* Kích thước cố định chiều cao */
        object-fit: cover; /* Hình ảnh sẽ được cắt và phủ đầy khu vực, đảm bảo tỷ lệ */
        border-radius: 8px; /* Tùy chọn: Bo góc cho ảnh */
    }
    .filled {
        color: gold;  /* Màu vàng cho sao đã được tô */
    }
    .product-image,
    .product-info {
        margin: 0; /* Đảm bảo không có khoảng cách thừa */
    }
    .product-image {
        flex: 0 0 40%; /* Chiếm 40% chiều rộng */
    }
    .reviews {
        margin: 40px; /* Tạo khoảng cách ngoài cùng */
    }
    .review {
        padding-left: 40px; /* Thụt vào từ phía trái */
        margin-bottom: 15px; /* Khoảng cách giữa các review */
    }

    .review h3 {
        margin-bottom: 5px; /* Khoảng cách dưới tiêu đề */
    }
    .rating {
        margin-bottom: 10px; /* Khoảng cách giữa sao và đánh giá */
    }

    .review p {
        margin-bottom: 5px; /* Khoảng cách dưới mô tả đánh giá */
    }

    .review small {
        color: #777; /* Màu nhạt cho ngày đăng */
    }
    .product-stats {
        margin-top: 20px;
        font-size: 16px;
        color: #333;
    }

    .product-stats p {
        margin: 5px 0;
    }
    .btn-disabled {
        opacity: 0.6;
        pointer-events: none; /* Ngăn chặn người dùng nhấn vào nút */
    }
    .rate-container {
        display: flex;
        flex-direction: row-reverse;
        gap: 5px;
    }

    .rate-container input[type="radio"] {
        display: none;
    }

    .rate-container label {
        cursor: pointer;
        font-size: 24px;
        color: #ccc;
    }

    .rate-container input[type="radio"]:checked ~ label {
        color: #f39c12; /* Màu vàng cho sao được chọn */
    }



    @media (max-width: 768px) {
        .product-detail {
            flex-direction: column;
        }

        .quantity-input {
            width: 80px;
        }

        .action-buttons button {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>

{{-- ẩn hiện tim --}}
<script>
    // Kiểm tra trạng thái đăng nhập bằng session
    @if (Session::has('user'))
        // Hiển thị nút tim nếu người dùng đã đăng nhập
        document.getElementById('likeButton').style.display = 'inline-block';
    @else
        // Nếu chưa đăng nhập, nút tim sẽ không hiển thị
        document.getElementById('likeButton').style.display = 'none';
    @endif
</script>

{{-- thumbnails --}}
<script>
    function changeImage(thumbnail) {
        // Lấy thẻ ảnh lớn
        const mainImage = document.getElementById('mainImage');

        // Thay đổi đường dẫn của ảnh lớn thành đường dẫn ảnh nhỏ được chọn
        mainImage.src = thumbnail.src;
    }
</script>

{{-- luot xem  va rating --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sachId = {{ $sach->MaSach }}; // ID sách hiện tại
        const statsUrl = `/sach/${MaSach}/stats`;

        function updateStats() {
            fetch(statsUrl)
                .then(response => response.json())
                .then(data => {
                    document.querySelector('#luotXem').textContent = data.luot_xem;
                    document.querySelector('#luotTim').textContent = data.luot_tim;
                    //document.querySelector('#avgRating').textContent = data.avg_rating.toFixed(1);
                })
                .catch(error => console.error('Error fetching stats:', error));
        }

        // Gọi hàm updateStats mỗi 1 giây
        setInterval(updateStats, 3000);
        updateStats(); // Gọi ngay lần đầu tiên
    });
</script>



<script>
    function handleFavorite(event, MaSach) {
    event.preventDefault();

    const button = event.currentTarget;
    const icon = button.querySelector('i');
    const isFavorited = icon.classList.contains('fa-solid'); // Kiểm tra trạng thái hiện tại

    const url = isFavorited
        ? "{{ route('profile.sachyeuthich.xoa') }}"  // Route để xóa sản phẩm yêu thích
        : "{{ route('profile.sachyeuthich.them') }}"; // Route để thêm sản phẩm yêu thích

    const method = isFavorited ? 'DELETE' : 'POST';

    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ MaSach }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Cập nhật icon yêu thích
            icon.classList.toggle('fa-solid');
            icon.classList.toggle('fa-regular');

            // Hiển thị thông báo
            alert(data.message || (isFavorited ? 'Đã xóa khỏi danh sách yêu thích!' : 'Đã thêm vào danh sách yêu thích!'));

            // Nếu có danh sách số lượng, cập nhật số lượng yêu thích
            const wishlistBadge = document.querySelector('.tg-themebadge');
            if (wishlistBadge) {
                let currentCount = parseInt(wishlistBadge.textContent, 10) || 0;
                wishlistBadge.textContent = isFavorited ? currentCount - 1 : currentCount + 1;
            }
        } else {
            alert(data.message || 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    })
    .catch(error => {
        console.error('Lỗi:', error);
        alert('Đã xảy ra lỗi khi cập nhật danh sách yêu thích.');
    });
}

</script>
@endsection
