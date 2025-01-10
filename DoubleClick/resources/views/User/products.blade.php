@extends('layout')

@section('css')
    <style>
        .category-btn {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .category-btn.selected-category {
            background-color: #007bff;
            color: #ffffff;
            font-weight: bold;
            border: none;
            border-radius: 5px;
        }
    </style>
@endsection

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
                    <li>
                        <button class="btn btn-link category-btn" data-id="getAll">
                            Tất cả Danh Mục
                        </button>
                    </li>
                    @foreach ($loaiSach as $loai)
                        <li>
                            <button class="btn btn-link category-btn" data-id="{{ $loai->MaLoai }}">
                                {{ $loai->TenLoai }}
                            </button>
                        </li>
                    @endforeach
                </ul>

            </div>
            <div class="p-4 mt-8 bg-white rounded shadow">
                <h2 class="mb-4 text-lg font-semibold">Sách thịnh hành</h2>
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
