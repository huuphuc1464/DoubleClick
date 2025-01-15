@extends('layout')

@section('content')
    <div class="container mt-5 main-content">
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
                <h2 class="mb-4 text-lg font-semibold">Sách Nổi Bật Nhất</h2>
                <ul class="space-y-4">
                    @for ($i = 0; $i < 3; $i++)
                        @foreach ($sach as $book)
                            @if ($book->MaSach == $data[$i]->MaSach)
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
                    @endfor
                </ul>
            </div>
        </aside>
        {{-- Hiển thị danh sách sản phẩm --}}
        <div class="container mt-5">
            <h1 class="text-start">{{ $title }}</h1>
            <div class="row">
                @for ($i = 0; $i < count($data); $i++)
                    @foreach ($sach as $book)
                        @if ($book->MaSach == $data[$i]->MaSach)
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
            </div>
        </div>
    @endsection
