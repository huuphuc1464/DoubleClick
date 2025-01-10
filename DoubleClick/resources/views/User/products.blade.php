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

            // Hàm xử lý khi nhấp vào danh mục
            const laySachTheoLoai = async function(idLoai) {
                // Lấy element book-show
                const bookshow = document.getElementById("book-show");

                // Hiển thị loader trước khi gọi API
                bookshow.innerHTML = `<p class="text-center">Đang tải...</p>`;

                // Xóa trạng thái "selected-category" khỏi tất cả các nút
                categoryButtons.forEach((button) =>
                    button.classList.remove("selected-category")
                );

                // Thêm trạng thái "selected-category" vào nút được nhấp
                const clickedButton = document.querySelector(`.category-btn[data-id="${idLoai}"]`);
                if (clickedButton) {
                    clickedButton.classList.add("selected-category");
                }

                try {
                    // Gọi API qua fetch
                    const response = await fetch(`/api/sach/loai/${idLoai}`);

                    // Kiểm tra xem response có thành công không
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    // Chuyển đổi dữ liệu sang JSON
                    const data = await response.json();

                    // Kiểm tra nếu có sách trong danh mục
                    if (data.length > 0) {
                        // Tạo nội dung HTML từ danh sách sách
                        const bookHTML = data
                            .map(
                                (book) => `
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
                    `
                            )
                            .join("");

                        // Gán nội dung HTML vào book-show
                        bookshow.innerHTML = bookHTML;
                    } else {
                        // Hiển thị thông báo nếu không có sách
                        bookshow.innerHTML = `<p class="text-center">Không có sách thuộc danh mục này.</p>`;
                    }
                } catch (error) {
                    // Xử lý lỗi
                    console.error("Đã xảy ra lỗi khi gọi API:", error);

                    // Hiển thị thông báo lỗi
                    bookshow.innerHTML =
                        `<p class="text-center text-danger">Không thể tải dữ liệu. Vui lòng thử lại sau.</p>`;
                }
            };

            // Gán sự kiện click cho từng nút
            categoryButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const idLoai = this.getAttribute("data-id");
                    laySachTheoLoai(idLoai);
                });
            });

            // Hiển thị tất cả sách mặc định
            laySachTheoLoai("getAll");
        });
    </script>

@endsection

