@extends('layout')

@section('content')
<div class="breadcrumb">
    <a href="/">Trang chủ</a> &gt; <a href="/products">Sản phẩm</a> &gt; Chi tiết sản phẩm
</div>

<div class="container">
    <!-- Thông tin sản phẩm -->
    <div class="product-detail">
        <div class="product-images">
            <img src="{{ asset('images/products/' . $product->AnhDaiDien) }}" alt="{{ $product->TenSach }}" width="300">
        </div>
        <div class="product-info">
            <h1>{{ $product->TenSach }}</h1>
            <div class="price">{{ number_format($product->GiaBan, 0, ',', '.') }}đ</div>
            <div class="status">
                <strong>Trạng thái:</strong>
                @if ($product->SoLuongTon > 0)
                    <span style="color: green;">Còn hàng</span>
                @else
                    <span style="color: red;">Hết hàng</span>
                @endif
            </div>
            <div class="rating">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star{{ $i <= $product->DiemDanhGia ? '' : '-o' }}"></i>
                @endfor
                <span>({{ $product->SoDanhGia }} đánh giá | Đã bán {{ $product->SoLuongBan }})</span>
            </div>
            <div class="description">
                <p><strong>Mã sách:</strong> {{ $product->MaSach }}</p>
                <p><strong>ISBN:</strong> {{ $product->ISBN }}</p>
                <p><strong>Nhà xuất bản:</strong> {{ $product->NXB }}</p>
                <p><strong>Mô tả:</strong> {{ $product->MoTa }}</p>
            </div>
            <div class="quantity">
                <label for="quantity">Số lượng:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1">
            </div>
            <div class="actions">
                <button class="add-to-cart">Thêm vào giỏ hàng</button>
                <button class="buy-now">Mua ngay</button>
                <button class="wishlist"><i class="fas fa-heart"></i> Yêu thích</button>
            </div>
        </div>
    </div>

    <!-- Mô tả chi tiết -->
    <div class="product-description">
        <h2>Mô tả sản phẩm</h2>
        <p>{{ $product->MoTa }}</p>
    </div>

    <!-- Bình luận sản phẩm -->
    <div class="product-reviews">
        <h2>Bình luận</h2>
        @if ($product->comments->isEmpty())
            <p>Chưa có bình luận nào.</p>
        @else
            @foreach ($product->comments as $comment)
                <div class="comment">
                    <strong>{{ $comment->user->name }}</strong>
                    <p>{{ $comment->content }}</p>
                </div>
            @endforeach
        @endif
        @auth
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <textarea name="content" rows="4" placeholder="Viết bình luận..."></textarea>
                <button type="submit">Gửi bình luận</button>
            </form>
        @else
            <p><a href="/login">Đăng nhập</a> để bình luận.</p>
        @endauth
    </div>

    <!-- Sản phẩm liên quan -->
    <div class="related-products">
        <h2>Sản phẩm liên quan</h2>
        <div class="product-list">
            @foreach ($relatedProducts as $related)
                <div class="related-item">
                    <img src="{{ asset('images/products/' . $related->AnhDaiDien) }}" alt="{{ $related->TenSach }}">
                    <h3>{{ $related->TenSach }}</h3>
                    <p>{{ number_format($related->GiaBan, 0, ',', '.') }}đ</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .breadcrumb { margin: 10px 0; }
    .product-detail { display: flex; margin: 20px 0; }
    .product-images img { max-width: 100%; }
    .product-info { margin-left: 20px; }
    .price { font-size: 20px; color: red; margin: 10px 0; }
    .rating i { color: #FFD700; }
    .actions button { margin-right: 10px; padding: 10px 20px; }
    .related-products .product-list { display: flex; gap: 20px; }
    .related-item { text-align: center; }
</style>
@endsection
