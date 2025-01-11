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
    {{-- Banner --}}
    <div id="carouselBanners" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @if (!empty($banners) && is_array($banners))
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
            @else
                <div class="carousel-item active">
                    <img src="{{ asset('img/default-banner.jpg') }}" alt="Default Banner">
                </div>
            @endif
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

    {{-- Main Content --}}
    <div class="container mt-5 main-content">
        {{-- Sidebar --}}
        <aside class="sidebar">
            <div class="p-4 bg-white rounded shadow sbar">
                <h2 class="mb-4 text-lg font-semibold">Danh Mục</h2>
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
                <h2 class="mb-4 text-lg font-semibold">Sách Thịnh Hành</h2>
                <ul class="space-y-4">
                    @if (!empty($bestseller) && is_array($bestseller))
                        @foreach ($bestseller as $item)
                            @php
                                $book = $sach->firstWhere('MaSach', $item->MaSach);
                            @endphp
                            @if ($book)
                                <li class="flex items-center space-x-4">
                                    <img class="book-cover" src="{{ asset('img/sach/' . $book->AnhDaiDien) }}"
                                        alt="Book cover">
                                    <div>
                                        <h5 class="text-sm font-semibold">{{ $book->TenSach }}</h5>
                                        <p class="text-sm">Tác giả: {{ $book->TenTG }}</p>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    @else
                        <li>Không có sách thịnh hành.</li>
                    @endif
                </ul>
            </div>
        </aside>

        {{-- Sách Hiển Thị --}}
        <div class="container mt-5">
            <div id="book-show" class="row justify-content-start">
                {{-- Tất cả sách sẽ hiển thị ở đây --}}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const categoryButtons = document.querySelectorAll(".category-btn");
            const bookshow = document.getElementById("book-show");

            const laySachTheoLoai = async function(idLoai) {
                bookshow.innerHTML = `<p class="text-center">Đang tải...</p>`;
                categoryButtons.forEach(button => button.classList.remove("selected-category"));
                const clickedButton = document.querySelector(`.category-btn[data-id="${idLoai}"]`);
                if (clickedButton) clickedButton.classList.add("selected-category");

                try {
                    const response = await fetch(`/api/sach/loai/${idLoai}`);
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    const data = await response.json();

                    if (data.length > 0) {
                        const bookHTML = data.map(book => `
                            <div class="col-md-4">
                                <div class="mb-4 card">
                                    <img src="${book.AnhDaiDien ? `/img/sach/${book.AnhDaiDien}` : '/img/default.png'}"
                                        class="card-img-top" alt="${book.TenSach}">
                                    <div class="card-body">
                                        <h5 class="card-title">${book.TenSach}</h5>
                                        <p class="card-text">${book.MoTa || "Mô tả không có sẵn"}</p>
                                        <p class="card-text"><strong>Tác giả:</strong> ${book.TenTG || "Không rõ"}</p>
                                        <p class="card-text"><strong>Nhà xuất bản:</strong> ${book.NXB || "Không rõ"}</p>
                                        <p class="card-text"><strong>Giá bán:</strong>
                                            <span class="price">${new Intl.NumberFormat().format(book.GiaBan)} VNĐ</span>
                                        </p>
                                        <a href="/products/${book.MaSach}" class="btn btn-primary">Chi tiết sản phẩm</a>
                                    </div>
                                </div>
                            </div>
                        `).join("");
                        bookshow.innerHTML = bookHTML;
                    } else {
                        bookshow.innerHTML = `<p class="text-center">Không có sách thuộc danh mục này.</p>`;
                    }
                } catch (error) {
                    console.error("Lỗi khi gọi API:", error);
                    bookshow.innerHTML =
                        `<p class="text-center text-danger">Không thể tải dữ liệu. Vui lòng thử lại sau.</p>`;
                }
            };

            categoryButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const idLoai = this.getAttribute("data-id");
                    laySachTheoLoai(idLoai);
                });
            });

            laySachTheoLoai("getAll");
        });
    </script>
@endsection
