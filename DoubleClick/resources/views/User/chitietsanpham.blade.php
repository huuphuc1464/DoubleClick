@extends('layout')

@section('content')
    <title>Chi Tiết Sản Phẩm</title>
    <div class="breadcrumb">
        <a href="{{ route('user') }}">Trang chủ</a> &nbsp;&gt;&nbsp;
        <a href="{{ route('user.products') }}">Sản phẩm</a> &nbsp;&gt;&nbsp;
        <span>{{ $sach->TenSach }}</span>
    </div>



    <div class="container">
        <div class="product-detail">
            <!-- Hình ảnh sản phẩm -->
            <div class="product-image">
                <img src="{{ asset('img/sach/' . $sach->AnhDaiDien) }}" alt="{{ $sach->TenSach }}" class="img-fluid">
            </div>

            <div class="description">
                <p><strong>Mã Sách:</strong> {{ $sach->MaSach }}</p>
                <p><strong>ISBN:</strong> {{ $sach->ISBN }}</p>
                <p><strong>Nhà Xuất Bản:</strong> {{ $sach->NCC }}</p>
                <p><strong>Năm Xuất Bản:</strong> {{ $sach->NXB }}</p>
                <p><strong>Tác Giả:</strong> {{ $sach->TacGia }}</p>
                <p><strong>Mô Tả:</strong> {{ $sach->MoTa }}</p>
            </div>
            <div class="quantity-container">
                <label for="quantity"><strong>Số lượng:</strong></label>
                <input id="quantity" type="number" name="quantity" min="1" value="1"
                    class="form-control quantity-input">
            </div>
            <div class="action-buttons">
                <button class="btn btn-success"><i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</button>
                <button class="btn btn-primary"><i class="fas fa-bolt"></i> Mua ngay</button>
                <button class="btn btn-outline-danger"><i class="fas fa-heart"></i> Thích</button>
            </div>
        </div>
    </div>
    </div>
    <div class="related-products">
        <h2>MÔ TẢ</h2>
        <p>Amane là một nam sinh cấp 3, còn Mahiru là nữ sinh xinh nhất trường với biệt danh "thiên sứ". Cả hai vốn chẳng có
            mối liên hệ nào với nhau, thế nhưng sau một đêm mưa, cậu đã đưa ô và về tận căn chung cư nhà mình.</p>
        <p>Cũng từ đêm đó mà mối, cả chưa dứt điểm, tình hình những trò đùa kỳ quặc ngày Valentine, "thiên sứ" Mahiru hành
            động kỳ quặc và những gì cậu Amane, sự gợi ý vô lý của bạn bè cậu Amane, trái tim bình dị của cậu dần dần thay
            đổi.</p>
        <p>Đây là câu chuyện về một cặp đôi với giai điệu bay bổng lãng mạn nhưng đầy đáng yêu đã được lòng hầu hết trên
            trang Shousetsuka ni Narou.</p>
    </div>
    <div class="author-products">
        <h2>CÙNG TÁC GIẢ</h2>
        <div class="product-list">
            <img src="https://placehold.co/100x150" alt="Product 1" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 2" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 3" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 4" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 5" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 6" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 7" width="100" height="150">
        </div>
    </div>
    <div class="related-products">
        <h2>CÙNG THỂ LOẠI</h2>
        <div class="product-list">
            <img src="https://placehold.co/100x150" alt="Product 1" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 2" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 3" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 4" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 5" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 6" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 7" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 8" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 9" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 10" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 11" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 12" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 13" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 14" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 15" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 16" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 17" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 18" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 19" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 20" width="100" height="150">

        </div>


        {{-- <style>

    /* Căn chỉnh tổng thể */
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-color: #f5f5f5;
    }

    /* Đường dẫn breadcrumb */
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

    /* Container */


    /* Product Detail */
    .product-detail {
        display: flex;
        gap: 20px;
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

    /* Ô nhập số lượng */
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

    /* Nút hành động */
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

    /* Responsive */
    @media (max-width: 768px) {
        .product-detail {
            flex-direction: column;
        }

        .product-image, .product-info {
            flex: 1 1 100%;
        }

        .quantity-input {
            width: 80px;
        }

        .action-buttons button {
            width: 100%;
            margin-bottom: 10px;
        }
    }
    /* Mô Tả */
    .related-products, .author-products {
        margin: 20px 0;
        padding: 15px;
        background-color: #ffffff;
        border-radius: 8px; /* Bo tròn các góc */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Thêm bóng mờ cho các phần */
    }

    .related-products h2, .author-products h2 {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        margin: 0;
        border-radius: 5px 5px 0 0; /* Bo tròn góc trên */
        font-size: 20px;
        font-weight: bold;
        text-align: center; /* Căn giữa tiêu đề */
    }

    /* Mô tả sản phẩm */
    .related-products p {
        line-height: 1.6;
        font-size: 16px;
        color: #333;
        margin-bottom: 15px;
    }

    /* Sản phẩm cùng tác giả */
    .author-products .product-list {
        display: flex;
        gap: 15px;
        padding: 10px 0;
        justify-content: flex-start;
        overflow-x: auto;
    }

    .author-products .product-list img {
        max-width: 100%;
        width: 100px;
        height: 150px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Thêm bóng mờ cho hình ảnh */
        transition: transform 0.3s ease;
    }

    .author-products .product-list img:hover {
        transform: scale(1.1); /* Phóng to ảnh khi hover */
    }

    /* Cùng thể loại */
    .related-products .product-list {
        display: flex;
        gap: 15px;
        padding: 10px 0;
        justify-content: flex-start;
        overflow-x: auto;
    }

    .related-products .product-list img {
        max-width: 100%;
        width: 100px;
        height: 150px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Thêm bóng mờ cho hình ảnh */
        transition: transform 0.3s ease;
    }

    .related-products .product-list img:hover {
        transform: scale(1.1); /* Phóng to ảnh khi hover */
    }

</style> --}}

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

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            .product-detail {
                display: flex;
                gap: 20px;
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
            .author-products {
                margin: 20px 0;
                padding: 15px;
                background-color: #ffffff;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .related-products h2,
            .author-products h2 {
                background-color: #4CAF50;
                color: white;
                padding: 10px;
                margin: 0;
                border-radius: 5px 5px 0 0;
                font-size: 20px;
                font-weight: bold;
                text-align: center;
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
    @endsection
