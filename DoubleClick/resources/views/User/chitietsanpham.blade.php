@extends('layout')

@section('content')

<div class="breadcrumb">
    <a href="#">Trang chủ</a> &gt; <a href="#">Sản phẩm</a> &gt; <a href="#">Chi tiết sản phẩm</a>
</div>
<div class="container">
    <div class="product-detail">
        <div class="product-images">
            <img src="https://placehold.co/200x300" alt="Product Image" width="200" height="300">
        </div>
        <div class="product-info">
            <h1>THIÊN SỨ NHÀ BÊN - TẬP 3</h1>
            <div class="price">95,000đ</div>
            <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <span>(0 đánh giá | đã bán 37)</span>
            </div>
            <div class="description">
                <p>Mã Sách: 62421-85935-003</p>
                <p>ISBN: 978-604-1-3999-9</p>
                <p>Nhà Xuất Bản: Hanode</p>
                <p>Hình Thức: Bìa mềm</p>
                <p>Kích Thước: 13x19 cm</p>
                <p>Số Trang: 324</p>
                <p>Độ Dày: 1.8 cm</p>
                <p>Trọng Lượng: 330 gram</p>
                <p>Thiên sứ nhà bên</p>
            </div>
            <div>
                <label for="quantity">Số lượng:</label>
                <input id="quantity" type="number" name="quantity" min="1" value="1">
                <br>     <br>
            </div>
            <button class="add-to-cart">THÊM VÀO GIỎ HÀNG</button>
            <button class="add-to-cart">MUA NGAY</button>
            <button class="add-to-cart"><i class="fas fa-heart"></i> Thích</button>
        </div>
    </div>
    <div class="related-products">
        <h2>MÔ TẢ</h2>
        <p>Amane là một nam sinh cấp 3, còn Mahiru là nữ sinh xinh nhất trường với biệt danh "thiên sứ". Cả hai vốn chẳng có mối liên hệ nào với nhau, thế nhưng sau một đêm mưa, cậu đã đưa ô và về tận căn chung cư nhà mình.</p>
        <p>Cũng từ đêm đó mà mối, cả chưa dứt điểm, tình hình những trò đùa kỳ quặc ngày Valentine, "thiên sứ" Mahiru hành động kỳ quặc và những gì cậu Amane, sự gợi ý vô lý của bạn bè cậu Amane, trái tim bình dị của cậu dần dần thay đổi.</p>
        <p>Đây là câu chuyện về một cặp đôi với giai điệu bay bổng lãng mạn nhưng đầy đáng yêu đã được lòng hầu hết trên trang Shousetsuka ni Narou.</p>
    </div>
    <div class="author-products">
        <h2>CÙNG TÁC GIẢ</h2>
        <div class="product-list">
            <img src="https://placehold.co/100x150" alt="Product 1" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 2" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 3" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 4" width="100" height="150">
            <img src="https://placehold.co/100x150" alt="Product 5" width="100" height="150">
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
        </div>
    </div>
</div>
<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .header, .footer {
        background-color: #4CAF50;
        color: white;
        padding: 10px 0;
        text-align: center;
    }
    .header a, .footer a {
        color: white;
        text-decoration: none;
        margin: 0 10px;
    }
    .header .logo {
        display: inline-block;
        vertical-align: middle;
    }
    .header .search-bar {
        display: inline-block;
        vertical-align: middle;
        width: 50%;
    }
    .header .search-bar input {
        width: 80%;
        padding: 5px;
    }
    .header .search-bar button {
        padding: 5px 10px;
    }
    .header .user-info {
        display: inline-block;
        vertical-align: middle;
    }
    .nav {
        background-color: #4CAF50;
        overflow: hidden;
    }
    .nav a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
    .nav a:hover {
        background-color: #ddd;
        color: black;
    }
    .breadcrumb {
        padding: 10px 0;
        background-color: #f9f9f9;
        text-align: center;
    }
    .breadcrumb a {
        color: #4CAF50;
        text-decoration: none;
    }
    .breadcrumb a:hover {
        text-decoration: underline;
    }
    .container {
        width: 80%;
        margin: 0 auto;
    }
    .product-detail {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
    }
    .product-detail img {
        max-width: 100%;
    }
    .product-info {
        width: 60%;
    }
    .product-info h1 {
        font-size: 24px;
        margin: 0;
    }
    .product-info .price {
        color: red;
        font-size: 20px;
        margin: 10px 0;
    }
    .product-info .rating {
        color: #FFD700;
    }
    .product-info .description {
        margin: 20px 0;
    }
    .product-info .add-to-cart {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
    }
    .related-products, .author-products {
        margin: 20px 0;
    }
    .related-products h2, .author-products h2 {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        margin: 0;
    }
    .related-products .product-list, .author-products .product-list {
        display: flex;
        overflow-x: auto;
    }
    .related-products .product-list img, .author-products .product-list img {
        max-width: 100%;
        margin: 10px;
    }
    .footer {
        background-color: #4CAF50;
        color: white;
        padding: 20px 0;
        text-align: center;
    }
    .footer .contact-info, .footer .links, .footer .social-media {
        display: inline-block;
        vertical-align: top;
        width: 30%;
        margin: 0 1%;
    }
    .footer .social-media a {
        color: white;
        margin: 0 5px;
    }
    @media (max-width: 768px) {
        .product-detail {
            flex-direction: column;
        }
        .product-info {
            width: 100%;
        }
        .footer .contact-info, .footer .links, .footer .social-media {
            width: 100%;
            margin: 10px 0;
        }
    }
</style>
@endsection
