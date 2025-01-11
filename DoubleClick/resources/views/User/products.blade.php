@extends('layout')

@section('css')
    <style>
        .selectedList {
            border: 2px solid green;
            background-color: #f0f0f0;
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
                <h2 class="text-lg font-semibold mb-4">Danh Mục</h2>
                <ul class="space-y-2">
                    <li>
                        <button class="btn hover:underline" onclick="laySachTheoLoaiSach('getAll', this)">
                            Tất cả sách
                        </button>
                    </li>
                    @foreach ($loaiSach as $loai)
                        <li>
                            <button class="btn hover:underline" onclick="laySachTheoLoaiSach({{ $loai->MaLoai }}, this)">
                                {{ $loai->TenLoai }}
                            </button>
                        </li>
                    @endforeach

                </ul>
            </div>



            <div class="bg-white p-4 rounded shadow mt-8">
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
                    @endfor
                </ul>
            </div>
        </aside>

        {{-- Hiển thị danh sách sản phẩm --}}
        <div id="book-show" class="container mt-5">

        </div>
    </div>


    <script>
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({
                    behavior: 'smooth'
                }); // Cuộn mượt mà
            }
        }
    </script>
    <script>
        const bookShow = document.getElementById('book-show');
        const baseUrl = window.location.origin;
        const highlight = function(key, text) {
            if (!key || !text) return text; // Nếu không có key hoặc text, trả về chuỗi gốc

            // Hàm chuẩn hóa chuỗi để loại bỏ dấu
            const normalize = (str) =>
                str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();

            // Chuẩn hóa từ khóa và chuỗi gốc
            const normalizedKey = normalize(key);
            const normalizedText = normalize(text);

            // Tạo biểu thức chính quy để tìm các từ trùng khớp
            const regex = new RegExp(`(${normalizedKey})`, "gi");

            // Thay thế từ khóa bằng thẻ <span> với nền vàng, sử dụng chỉ mục gốc để thay thế
            const highlightedText = text.replace(regex, (match) => {
                return `<span style="background-color: yellow;">${match}</span>`;
            });

            return highlightedText;
        }

        const getLinkDetail = (id) => {
            return `${window.location.origin}/san-pham/${id}`
        }
        const laySachTheoLoaiSach = async function(maLoai, buttonElement) {
            try {
                if (buttonElement !== null) {
                    // Xóa class selectedList khỏi tất cả các button
                    const allButtons = document.querySelectorAll('.sidebar .btn');
                    allButtons.forEach(button => button.classList.remove('selectedList'));
                    // Thêm class selectedList vào button được bấm
                    buttonElement.classList.add('selectedList');
                }
                // Gọi API để lấy sách theo loại
                const response = await fetch(`/laySachTheoMaLoai/${maLoai}`);
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }
                const data = await response.json();


                const cards = data.map(book => {
                    return `
                <div class="col-md-4 flex-start">
                    <div class="card mb-4">
                        <a href="${getLinkDetail(book.MaSach)}">
                            <img src="${baseUrl}/img/sach/${book.AnhDaiDien}" class="card-img-top" alt="${book.TenSach}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title" id="summary">${book.TenSach}</h5>
                            <p class="card-text" id="description">${book.MoTa}</p>
                            <p class="card-text"><strong>Tác giả: </strong>${book.TenTG}</p>
                            <p class="card-text"><strong>Nhà xuất bản: </strong>${book.NXB}</p>
                            <p class="card-text">
                                <strong>Giá bán: </strong><span class="price">${book.GiaBan} VNĐ</span>
                            </p>
                            <div class="action-container">
                                <a href="#" class="btn add-to-cart">Thêm Vào Giỏ Hàng</a>
                                <a href="#" class="favorite">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
                }).join('');

                const innerHTML = `<div class="row justify-content-start">${cards}</div>`;
                bookShow.innerHTML = innerHTML;

            } catch (error) {
                bookShow.innerHTML = `<p>Lỗi khi lấy sách theo loại sách: ${error.message}</p>`;
            }
        };

        laySachTheoLoaiSach("getAll", null);

        // Xử lý tìm kiếm
        const searchDiv = document.getElementById('searchDiv');
        const inputSearch = document.getElementById('inputSearch');
        const btnSearch = document.getElementById('btnSearch');
        inputSearch.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                btnSearch.click();
            }
        });

        btnSearch.addEventListener('click', function() {
            scrollToSection('book-show');
            bookShow.innerHTML = "Đang Tìm....";
            let name = inputSearch.value;
            if (name === "") {
                name = "getAll";
            }
            fetch(`/timSachTheoTen/${name}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(books => {
                    console.log(books);
                    const ketQuaTimKiem = books.map(book => {
                        return `
                <div class="col-md-4 flex-start">
                    <div class="card mb-4">
                        <a href="${getLinkDetail(book.MaSach)}">
                            <img src="${baseUrl}/img/sach/${book.AnhDaiDien}" class="card-img-top" alt="${book.TenSach}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title" id="summary">${highlight(name,book.TenSach)}</h5>
                            <p class="card-text" id="description">${highlight(name,book.MoTa)}</p>
                            <p class="card-text"><strong>Tác giả: </strong>${highlight(name,book.TenTG)}</p>
                            <p class="card-text"><strong>Nhà xuất bản: </strong>${book.NXB}</p>
                            <p class="card-text">
                                <strong>Giá bán: </strong><span class="price">${book.GiaBan} VNĐ</span>
                            </p>
                            <div class="action-container">
                                <a href="#" class="btn add-to-cart">Thêm Vào Giỏ Hàng</a>
                                <a href="#" class="favorite">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
                    }).join('');
                    bookShow.innerHTML = `<div class="row justify-content-start">${ketQuaTimKiem}</div>`;
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });

        })
    </script>


@endsection
