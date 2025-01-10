@extends('layout')

@section('content')
    {{-- code banner --}}
    <div id="carouselBanners" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($banners as $index => $banner)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <a href="{{ $banner['contactlink'] }}">
                        <img src="{{ asset('img/banners/' . $banner['imagebanner']) }}" alt="Banner {{ $index + 1 }}">
                    </a>
                    <div class="discount">
                        {{ $banner['discount'] }}%
                    </div>
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
            <div class="p-4 bg-white rounded shadow sbar">
                <h2 class="mb-4 text-lg font-semibold">Tất cả sản phẩm</h2>
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
            <div class="p-4 mt-8 bg-white rounded shadow">
                <h2 class="mb-4 text-lg font-semibold">Sách thịnh hành</h2>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-4">
                        <img class="book-cover" src="https://nhasachphuongnam.com/images/detailed/217/dac-nhan-tam-bc.jpg"
                            alt="Book cover">
                        <div>
                            <h5 class="text-sm font-semibold ">Đắc Nhân Tâm</h5>
                            <p class="text-sm ">Tác giả: Dale Carnegie</p>
                        </div>
                    </li>
                    <li class="flex items-center space-x-4">
                        <img class="book-cover" src="https://www.nxbctqg.org.vn/img_data/images/S2.jpg" alt="Book cover">
                        <div>
                            <h5 class="text-sm font-semibold ">Bản Đồ Mây</h5>
                            <p class="text-sm ">Tác giả: David Michell</p>
                        </div>
                    </li>
                    <li class="flex items-center space-x-4">
                        <img class="book-cover"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQWYsUfr5YvwpTRITsVXx7pHGe1VTCrG6RYg&s"
                            alt="Book cover">
                        <div>
                            <h5 class="text-sm font-semibold ">Nhà Giả Kim</h5>
                            <p class="text-sm ">Tác giả: Paulo Coelbo</p>
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
                        <div class="mb-4 card">
                            <img src="{{ asset('img/sach/' . $book->AnhDaiDien) }}" class="card-img-top"
                                alt="{{ $book->TenSach }}">
                            <div class="card-body">
                                <h5 class="card-title" id="summary">{{ $book->TenSach }}</h5>
                                <p class="card-text" id="description">{{ $book->MoTa }}</p>
                                <p class="card-text"><strong>Tác giả: </strong>{{ $book->TenTG }}</p>
                                <p class="card-text"><strong>Nhà xuất bản: </strong>{{ $book->NXB }}</p>
                                <p class="card-text">
                                    <strong>Giá bán: </strong><span class="price">{{ number_format($book->GiaBan) }}
                                        VNĐ</span>
                                </p>

                                <a href="{{ route('product.detail', ['id' => $book->MaSach]) }}" class="btn btn-primary">Chi tiết sản phẩm</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
