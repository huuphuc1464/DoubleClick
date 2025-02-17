@extends('layout')
@section('title', 'Chi Tiết Sản Phẩm')
@section('css')
@endsection
@section('content')
<div class="breadcrumb">



    <div class="breadcrumb">

        <a href="{{ route('user.products') }}">Sản phẩm</a> &nbsp;&gt;&nbsp;
        <span>{{ $sach->TenSach }}</span>
    </div>



    <div class="container">
        <div class="product-detail">
            <!-- Hình ảnh sản phẩm -->
            <div class="product-image">

                <img id="mainImage" src="{{ asset('img/sach/' . $sach->AnhDaiDien) }}" alt="{{ $sach->TenSach }}" class="img-fluid">
                <br> </br>

                <div class="custom-thumbnails-container">
                    @if(count($anhsach) > 3)
                    <button class="prev-btn" onclick="moveImage(-1)">&#10094;</button>
                    @endif
                    <div class="custom-thumbnails">
                        @foreach ($anhsach as $item)
                        <img src="{{ asset('img/sach/' . $item->HinhAnh) }}" alt="{{ $sach->TenSach }}" class="thumbnail-img" onclick="changeImage(this)">
                        @endforeach
                    </div>
                    @if(count($anhsach) > 3)
                    <button class="next-btn" onclick="moveImage(1)">&#10095;</button>
                    @endif
                </div>
            </div>


            <!-- Thông tin sản phẩm -->
            <div class="description">
                <h1>{{ $sach->TenSach }}</h1>
                <div class="price">{{ number_format($sach->GiaBan, 0, ',', '.') }} VND</div>
                <div class="rating">
                    @php
                    $averageRating = $sach->danhGia()->avg('SoSao') ?? 5; // Nếu không có đánh giá, mặc định là 5 sao
                    @endphp

                    @for ($i = 1; $i <= 5; $i++) <i class="fas fa-star{{ $i <= $averageRating ? ' filled' : '' }}"></i>
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
                    @if ($sach->SoLuongTon == 0)
                    <span class="badge bg-danger">Hết hàng</span>
                    @else($sach->SoLuongTon >0)
                    <span class="badge bg-success">Còn Hàng</span>
                    @endif
                </p>
                <div class="quantity-container">
                    <label for="quantity"><strong>Số lượng:</strong></label>
                    <input id="quantity" type="number" name="quantity" min="1" value="1" max="{{ $sach->SoLuongTon }}" class="form-control quantity-input">

                </div>
                <div class="action-buttons">

                    <button class="btn btn-success add-to-cart {{ in_array($sach->TrangThai, [0, 2]) ? 'btn-disabled' : '' }}" {{ in_array($sach->TrangThai, [0, 2]) ? 'disabled' : '' }} data-id="{{ $sach->MaSach }}" data-name="{{ $sach->TenSach }}" data-price="{{ $sach->GiaBan }}" data-image="{{ $sach->AnhDaiDien }}">
                        <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                    </button>






                    <!-- Nút Tim -->
                    {{-- //Nhat --}}
                    @if (Session::has('user'))
                    <a href="#" class="favorite" data-book-id="{{ $sach->MaSach }}" onclick="handleFavorite(event, {{ $sach->MaSach }})">
                        <i class="fa-regular fa-heart"></i>
                    </a>
                    @endif
                    {{-- endNhat --}}





                </div>
                <div class="product-stats" style="display: flex; gap: 20px;">
                    <p><strong>Lượt xem: </strong><span id="luotXem">{{ $sach->luot_xem }}</span></p>
                    <p><strong>Lượt thích: </strong><span id="luotTim">0</span></p>
                </div>

            </div>

        </div>
    </div>
</div>
<div class="related-products">
    <h2>MÔ TẢ</h2>
    <br>
    <p>{{ $sach->MoTa }}</p>
</div>

<div class="comment-products">
    <h2>Đánh giá</h2>
    <div style="display: flex; gap: 30px;">
        <div class="reviews" style="width: 50%;">

            @foreach ($danhgia as $review)
            <div class="review" style="margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                <!-- Hiển thị tên người dùng -->
                <h4 style="margin: 0; color: #333;">{{ $review->user->TenTK }}</h4>

                <!-- Hiển thị số sao -->
                <div class="rating" style="margin: 5px 0;">
                    @for ($i = 1; $i <= 5; $i++) <i class="fas fa-star{{ $i <= $review->SoSao ? ' filled' : '' }}" style="color: {{ $i <= $review->SoSao ? '#ffc107' : '#ddd' }};"></i>
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
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
             @if (session('success'))
             <div class="alert alert-success">
                 {{ session('success') }}
             </div>
             @endif

            <form action="{{ route('danhgia.store') }}" method="POST">
                @csrf
                <input type="hidden" name="MaSach" value="{{ $sach->MaSach }}">
                <!-- Chọn số sao -->
                <div class="rating">
                    <label>Đánh giá sao:</label>
                    <div class="rate-container d-flex justify-content-center align-items-center">
                        @for ($i = 1; $i <= 5; $i++) <input type="radio" id="star{{ $i }}" name="SoSao" value="{{ $i }}">
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy tất cả các nút "Add to Cart"
        const addToCartButtons = document.querySelectorAll('.add-to-cart');

        // Lặp qua các nút và thêm sự kiện click
        addToCartButtons.forEach(button => {
            button.addEventListener('click', async function(e) {
                e.preventDefault();

                // Lấy thông tin sản phẩm từ data-attributes
                const productId = this.dataset.id;
                const productName = this.dataset.name;
                const productPrice = this.dataset.price;
                const productImage = this.dataset.image;

                // Tìm trường số lượng liên quan
                const quantityInput = document.querySelector(`#quantity`);
                const productQuantity = quantityInput ? parseInt(quantityInput.value) : 1; // Mặc định là 1 nếu không có trường số lượng

                if (productQuantity < 1) {
                    alert('Vui lòng nhập số lượng hợp lệ!');
                    return;
                }

                try {
                    // Gửi yêu cầu POST qua AJAX
                    const response = await fetch('{{ route('cart.add') }}', {
                            method: 'POST'
                            , headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                , 'Content-Type': 'application/json'
                            , }
                            , body: JSON.stringify({
                                id: productId
                                , name: productName
                                , price: productPrice
                                , image: productImage
                                , quantity: productQuantity
                            , })
                        , });

                    // Xử lý phản hồi
                    const data = await response.json();
                    if (data.success) {
                        alert(data.message || 'Sản phẩm đã được thêm vào giỏ hàng!');
                    } else {
                        alert(data.message || 'Không thể thêm sản phẩm vào giỏ hàng!');
                    }
                } catch (error) {
                    console.error('Lỗi:', error);
                    alert('Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng!');
                }
            });
        });
    });

</script>
<script>
    let currentIndex = 0;

    function moveImage(direction) {
        const thumbnails = document.querySelector('.product-thumbnails');
        const totalImages = document.querySelectorAll('.thumbnail').length;

        // Tính toán chỉ số của ảnh hiện tại sau khi di chuyển
        currentIndex += direction;

        // Kiểm tra nếu chỉ số hiện tại vượt quá giới hạn ảnh
        if (currentIndex < script 0) {
            currentIndex = 0;
        } else if (currentIndex >= totalImages - 3) {
            currentIndex = totalImages - 3;
        }

        // Di chuyển các ảnh
        thumbnails.style.transform = `translateX(-${currentIndex * 110}px)`;
    }

    function changeImage(imgElement) {
        // Thực hiện hành động khi người dùng click vào một ảnh (ví dụ: hiển thị ảnh lớn)
        const selectedImageSrc = imgElement.src;
        // Bạn có thể thêm code để cập nhật hình ảnh lớn hiển thị ở đây
    }

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

    .related-products,
    .author-products,
    .comment-products {
        margin: 20px 0;
        padding: 15px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .related-products h2,
    .author-products h2,
    .comment-products h2 {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        margin: 0;
        border-radius: 5px 5px 0 0;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
    }

    .related-products,
    .author-products {
        margin: 20px 0;
        padding: 15px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        /* Giữ các phần tử bên trong */
    }


    .related-products p {
        line-height: 1.6;
        font-size: 16px;
        color: #333;
        margin-bottom: 15px;
    }

    .author-products .product-list,
    .related-products .product-list {
        display: flex;
        gap: 15px;
        padding: 10px 0;
        overflow-x: auto;
    }

    .author-products .product-list img,
    .related-products .product-list img {
        max-width: 100%;
        width: 100px;
        height: 150px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .author-products .product-list img:hover,
    .related-products .product-list img:hover {
        transform: scale(1.1);
    }

    .product-thumbnails {
        display: flex;
        /* Hiển thị các hình ảnh theo hàng ngang */
        gap: 10px;
        /* Khoảng cách giữa các thumbnails */
    }

    .product-thumbnails .thumbnail {
        width: 80px;
        /* Đặt chiều rộng cố định */
        height: 80px;
        /* Đặt chiều cao cố định */
        object-fit: cover;
        /* Đảm bảo hình ảnh không bị méo */
        border: 1px solid #ccc;
        /* Tùy chọn: Thêm viền để rõ ràng hơn */
        border-radius: 5px;
        /* Tùy chọn: Làm bo góc hình ảnh */
        cursor: pointer;
        /* Tùy chọn: Con trỏ chuột sẽ thay đổi khi hover */
        transition: transform 0.2s;
        /* Tùy chọn: Hiệu ứng khi hover */
    }

    .product-thumbnails .thumbnail:hover {
        transform: scale(1.1);
        /* Phóng to khi hover */
    }

    #mainImage {
        width: 300px;
        /* Kích thước cố định chiều rộng */
        height: 400px;
        /* Kích thước cố định chiều cao */
        object-fit: cover;
        /* Hình ảnh sẽ được cắt và phủ đầy khu vực, đảm bảo tỷ lệ */
        border-radius: 8px;
        /* Tùy chọn: Bo góc cho ảnh */
    }

    .filled {
        color: gold;
        /* Màu vàng cho sao đã được tô */
    }

    .product-image,
    .product-info {
        margin: 0;
        /* Đảm bảo không có khoảng cách thừa */
    }

    .product-image {
        flex: 0 0 40%;
        /* Chiếm 40% chiều rộng */
    }

    .reviews {
        margin: 40px;
        /* Tạo khoảng cách ngoài cùng */
    }

    .review {
        padding-left: 40px;
        /* Thụt vào từ phía trái */
        margin-bottom: 15px;
        /* Khoảng cách giữa các review */
    }

    .review h3 {
        margin-bottom: 5px;
        /* Khoảng cách dưới tiêu đề */
    }

    .rating {
        margin-bottom: 10px;
        /* Khoảng cách giữa sao và đánh giá */
    }

    .review p {
        margin-bottom: 5px;
        /* Khoảng cách dưới mô tả đánh giá */
    }

    .review small {
        color: #777;
        /* Màu nhạt cho ngày đăng */
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
        pointer-events: none;
        /* Ngăn chặn người dùng nhấn vào nút */
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

    .rate-container input[type="radio"]:checked~label {
        color: #f39c12;
        /* Màu vàng cho sao được chọn */
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

    /* Nhât */
    .favorite i {
        color: rgb(255, 5, 5);
        font-size: 32px;
        display: inline-block;
        transform: translateX(15%);
        line-height: 1;


        /* Đảm bảo không bị chênh */
    }

    .custom-thumbnails-container {
        position: relative;
        width: 330px;
        /* Hiển thị 3 ảnh với khoảng cách */
        overflow: hidden;
    }

    .custom-thumbnails {
        display: flex;
        transition: transform 0.3s ease;
    }

    .thumbnail-img {
        width: 100px;
        height: 100px;
        margin-right: 10px;
        cursor: pointer;
    }

    button.prev-btn,
    button.next-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        font-size: 20px;
        z-index: 1;
    }

    button.prev-btn {
        left: 10px;
    }

    button.next-btn {
        right: 10px;
    }

</style>

<script>
    let currentIndex = 0;

    function moveImage(direction) {
        const thumbnails = document.querySelector('.custom-thumbnails');
        const totalImages = document.querySelectorAll('.thumbnail-img').length;

        // Tính toán chỉ số của ảnh hiện tại sau khi di chuyển
        currentIndex += direction;

        // Kiểm tra nếu chỉ số hiện tại vượt quá giới hạn ảnh
        if (currentIndex < 0) {
            currentIndex = 0;
        } else if (currentIndex >= totalImages - 3) {
            currentIndex = totalImages - 3;
        }

        // Di chuyển các ảnh
        thumbnails.style.transform = `translateX(-${currentIndex * 110}px)`;
    }

    function changeImage(imgElement) {
        // Thực hiện hành động khi người dùng click vào một ảnh (ví dụ: hiển thị ảnh lớn)
        const selectedImageSrc = imgElement.src;
        // Bạn có thể thêm code để cập nhật hình ảnh lớn hiển thị ở đây
    }

</script>

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
    document.addEventListener('DOMContentLoaded', function() {
        const sachId = {
            {
                $sach - > MaSach
            }
        }; // ID sách hiện tại
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




{{-- Nhật --}}
<script>
    //xử lý nút yêu thích
    function handleFavorite(event, MaSach) {
        event.preventDefault();

        const icon = event.currentTarget.querySelector('i');
        const isFavorited = icon.classList.contains('fa-solid'); // Kiểm tra trạng thái hiện tại

        const url = isFavorited ?
            "{{ route('profile.sachyeuthich.xoa') }}" :
            "{{ route('profile.sachyeuthich.them') }}";
        const method = isFavorited ? 'DELETE' : 'POST';

        fetch(url, {
                method: method
                , headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    , 'Content-Type': 'application/json'
                , }
                , body: JSON.stringify({
                    MaSach
                })
            , })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật icon yêu thích
                    icon.classList.toggle('fa-solid');
                    icon.classList.toggle('fa-regular');

                    // Cập nhật số lượng yêu thích
                    const wishlistBadge = document.querySelector('.tg-themebadge');
                    let currentCount = parseInt(wishlistBadge.textContent, 10) || 0;
                    wishlistBadge.textContent = isFavorited ? currentCount - 1 : currentCount + 1;

                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Đã xảy ra lỗi khi cập nhật danh sách yêu thích.');
            });
    }

</script>
@endsection
