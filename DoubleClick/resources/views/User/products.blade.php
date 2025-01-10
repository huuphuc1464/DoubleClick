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




            {{-- <div class="bg-white p-4 rounded shadow mt-8">
                <h2 class="text-lg font-semibold mb-4">Sách thịnh hành</h2>
                <ul class="space-y-4">
                    @for ($i = 0; $i < 3; $i++)
                        @foreach ($sach as $book)
                            @if ($book->MaSach == $bestseller[$i]->MaSach)
                                <li class="flex items-center space-x-4">
                                    <img class="book-cover" src="{{ asset('img/sach/' . $book->AnhDaiDien) }}"
                                        alt="Book cover">
                                    <div>
                                        <h5 class="text-sm font-semibold ">{{ $book->TenSach }}</h5>
                                        <p class="text-sm ">Tác giả: {{ $book->TenTG }}</p>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    @endfor --}}




            <div class="bg-white p-4 rounded shadow mt-8">
                <h2 class="text-lg font-semibold mb-4">Sách thịnh hành</h2>
                <ul class="space-y-4">
                    @foreach ($newbook as $index => $book)
                        @if ($index == 3)
                        @break
                    @endif
                    <li class="flex items-center space-x-4">
                        <img class="book-cover" src="{{ asset('img/sach/' . $book->AnhDaiDien) }}" alt="Book cover">
                        <div>
                            <h5 class="text-sm font-semibold ">{{ $book->TenSach }}</h5>
                            <p class="text-sm ">Tác giả: {{ $book->TenTG }}</p>
                        </div>
                    </li>
                @endforeach









            </ul>
        </div>
    </aside>




    {{-- Hiển thị danh sách sản phẩm --}}
    <div class="container mt-5">
        <h1 class="text-start">Sản Phẩm Bán Chạy</h1>
        <div class="row">
            @for ($i = 0; $i < 3; $i++)
                @foreach ($sach as $book)
                    @if ($book->MaSach == $bestseller[$i]->MaSach)
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="{{ asset('img/sach/' . $book->AnhDaiDien) }}" class="card-img-top"
                                    alt="{{ $book->TenSach }}">
                                <div class="card-body">
                                    <h5 class="card-title" id="summary">{{ $book->TenSach }}</h5>
                                    <p class="card-text" id="description">{{ $book->MoTa }}</p>
                                    <p class="card-text"><strong>Tác giả: </strong>{{ $book->TenTG }}</p>
                                    <p class="card-text"><strong>Nhà xuất bản: </strong>{{ $book->NXB }}</p>
                                    <p class="card-text">
                                        <strong>Giá bán: </strong><span
                                            class="price">{{ number_format($book->GiaBan) }}
                                            VNĐ</span>
                                    </p>
                                    <div class="action-container">
                                        <a href="#" class="btn add-to-cart">Thêm Vào Giỏ Hàng</a>
                                        <a href="#" class="favorite">
                                            <i class="fa-regular fa-heart"></i>
                                        </a>

                                    </div>
                                    {{-- <hihi> --}}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endfor
            <div class="text-end fw-bold">
                <a href="{{ route('user.bestseller') }}">Xem Thêm >></a>
            </div>
        </div>
        <h1 class="text-start">Sản Phẩm Mới</h1>
        <div class="row">
            @foreach ($newbook as $index => $book)
                @if ($index == 3)
                @break
            @endif
            <div class="col-md-4">
                <div class="card mb-4">
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
                        <div class="action-container">
                            <a href="#" class="btn add-to-cart">Thêm Vào Giỏ Hàng</a>
                            <a href="#" class="favorite">
                                <i class="fa-regular fa-heart"></i>
                            </a>
                        </div>
                        {{-- <hihi> --}}
                    </div>
                </div>
            </div>
        @endforeach
        <div class="text-end fw-bold">
            <a href="{{ route('user.newbook') }}">Xem Thêm >></a>
        </div>


        <h1 class="text-start">Sách Văn Học</h1>
        <div class="row">
            @foreach ($vanhoc as $index => $book)
                @if ($index == 3)
                @break
            @endif
            <div class="col-md-4">
                <div class="card mb-4">
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
                        <div class="action-container">
                            <a href="#" class="btn add-to-cart">Thêm Vào Giỏ Hàng</a>
                            <a href="#" class="favorite">
                                <i class="fa-regular fa-heart"></i>
                            </a>
                        </div>
                        {{-- <hihi> --}}
                    </div>
                </div>
            </div>
        @endforeach
        <div class="text-end fw-bold">
            <a href="{{ route('user.vanhoc') }}">Xem Thêm >></a>
        </div>

        <h1 class="text-start">Truyện Tranh</h1>
        <div class="row">
            @foreach ($truyentranh as $index => $book)
                @if ($index == 3)
                @break
            @endif
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('img/sach/' . $book->AnhDaiDien) }}" class="card-img-top"
                        alt="{{ $book->TenSach }}">
                    <div class="card-body">
                        <h5 class="card-title" id="summary">{{ $book->TenSach }}</h5>
                        <p class="card-text" id="description">{{ $book->MoTa }}</p>
                        <p class="card-text"><strong>Tác giả: </strong>{{ $book->TenTG }}</p>
                        <p class="card-text"><strong>Nhà xuất bản: </strong>{{ $book->NXB }}</p>
                        <p class="card-text">
                            <strong>Giá bán: </strong><span
                                class="price">{{ number_format($book->GiaBan) }}
                                VNĐ</span>
                        </p>
                        <div class="action-container">
                            <a href="#" class="btn add-to-cart">Thêm Vào Giỏ Hàng</a>
                            <a href="#" class="favorite">
                                <i class="fa-regular fa-heart"></i>
                            </a>
                        </div>
                        {{-- <hihi> --}}
                    </div>
                </div>
            </div>
        @endforeach
        <div class="text-end fw-bold">
            <a href="{{ route('user.truyentranh') }}">Xem Thêm >></a>
        </div>
    </div>
</div>
@endsection
