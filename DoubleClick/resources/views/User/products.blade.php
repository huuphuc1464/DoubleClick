@extends('layout')

@section('content')
    {{-- code banner --}}
    <div id="carouselBanners" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($banners as $index => $banner)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('img/banners/' . $banner) }}" alt="Banner {{ $index + 1 }}">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanners" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselBanners" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    {{-- kết thúc code banner --}}
    <div class="container mt-5 main-content">
        {{-- Sidebar --}}
        <aside class="sidebar">
            <div class="bg-white p-4 rounded shadow sbar">
                <h2 class="text-lg font-semibold mb-4">Tất cả sản phẩm</h2>
                <ul class="space-y-2">
                    <li><a class="hover:underline" href="#">Sách thiếu nhi</a></li>
                    <li><a class="hover:underline" href="#">Sách giáo khoa</a></li>
                    <li><a class="hover:underline" href="#">Sách giáo dục và nghệ thuật</a></li>
                    <li><a class="hover:underline" href="#">Truyện tranh anime, manga</a></li>
                    <li><a class="hover:underline" href="#">Sách kỹ năng sống</a></li>
                    <li><a class="hover:underline" href="#">Sách lịch sử văn hóa</a></li>
                    <li><a class="hover:underline" href="#">Sách ngoại ngữ</a></li>
                    <li><a class="hover:underline" href="#">Sách đồ dùng gia đình</a></li>
                </ul>
            </div>
            <div class="bg-white p-4 rounded shadow mt-8">
                <h2 class="text-lg font-semibold mb-4">Sách thịnh hành</h2>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-4">
                        <img class="book-cover"
                            src="https://storage.googleapis.com/a1aa/image/fy0CNfYZEjvWrUeucKfxOS4WkTYDHQ3FlSA8xPZJroeYvpKgC.jpg"
                            alt="Book cover">
                        <div>
                            <h5 class="text-sm font-semibold book-title">Đắc Nhân Tâm</h5>
                            <p class="text-sm author-name">Tác giả: Dale Carnegie</p>
                        </div>
                    </li>
                    <li class="flex items-center space-x-4">
                        <img class="book-cover"
                            src="https://storage.googleapis.com/a1aa/image/fy0CNfYZEjvWrUeucKfxOS4WkTYDHQ3FlSA8xPZJroeYvpKgC.jpg"
                            alt="Book cover">
                        <div>
                            <h5 class="text-sm font-semibold book-title">Đắc Nhân Tâm</h5>
                            <p class="text-sm author-name">Tác giả: Dale Carnegie</p>
                        </div>
                    </li>
                    <li class="flex items-center space-x-4">
                        <img class="book-cover"
                            src="https://storage.googleapis.com/a1aa/image/fy0CNfYZEjvWrUeucKfxOS4WkTYDHQ3FlSA8xPZJroeYvpKgC.jpg"
                            alt="Book cover">
                        <div>
                            <h5 class="text-sm font-semibold book-title">Đắc Nhân Tâm</h5>
                            <p class="text-sm author-name">Tác giả: Dale Carnegie</p>
                        </div>
                    </li>
                    <!-- Các li khác -->
                </ul>
            </div>




        </aside>
        {{-- Hiển thị danh sách sản phẩm --}}
        <div class="container mt-5">
            <div class="row">
                @foreach ($sach as $book)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ asset('img/sach/' . $book->AnhDaiDien) }}" class="card-img-top"
                                alt="{{ $book->TenSach }}">
                            <div class="card-body">
                                <h5 class="card-title" id="summary">{{ $book->TenSach }}</h5>
                                <p class="card-text" id="description">{{ $book->MoTa }}</p>
                                <p class="card-text"><strong>Giá bán: </strong>{{ number_format($book->GiaBan) }} VNĐ</p>
                                <p class="card-text"><strong>Tác giả: </strong>{{ $book->TenTG }}</p>
                                <p class="card-text"><strong>Nhà xuất bản: </strong>{{ $book->NXB }}</p>
                                <a href="#" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
