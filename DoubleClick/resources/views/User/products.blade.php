@extends('layout')

@section('content')
    <style>
        .card-img-top {
            width: 100%;
            height: 480px;
            object-fit: cover;
            /* Đảm bảo ảnh không bị méo */
        }
    </style>

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

    {{-- Hiển thị danh sách sản phẩm --}}
    <div class="container mt-5">
        <div class="row">
            @foreach ($sach as $book)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('img/sach/' . $book->AnhDaiDien) }}" class="card-img-top"
                            alt="{{ $book->TenSach }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->TenSach }}</h5>
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
