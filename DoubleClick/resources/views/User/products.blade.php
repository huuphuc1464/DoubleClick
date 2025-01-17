@extends('layout')
@section('title', 'Trang Sản Phẩm')
@section('css')
   
@endsection
@section('content')
    {{-- code banner --}}
    <div id="carouselBanners" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($banners as $index => $banner)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <a href="{{ asset('san-pham/' . $banner->MaSach) }}">
                        <img src="{{ asset('img/banners/' . $banner->Imagebanner) }}" alt="Banner {{ $index + 1 }}">
                    </a>
                    <div class="discount">
                        {{ (int) $banner->KhuyenMai }}%
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
                        <button class="btn hover:underline" onclick="laySachTheoLoaiSach('homePage', this)">
                            Trang chủ
                        </button>
                    </li>
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
                    @endfor
                </ul>
            </div> --}}
        </aside>
        <div id="book-show" class="container mt-5" style="overflow: hidden">
            {{-- Hiển thị trang chủ sản phẩm --}}
        </div>
    </div>

    <script>
        function(sectionId) {
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
        // Hàm chuyển đổi từ có dấu sang không dấu
        function removeVietnameseTones(str) {
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
            str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
            str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
            str = str.replace(/đ/g, "d");
            str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
            str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
            str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
            str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
            str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
            str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
            str = str.replace(/Đ/g, "D");
            return str;
        }

        function highlightText(text, keyword) {
            // Nếu text hoặc keyword rỗng thì trả về text gốc
            if (!text || !keyword) return text;

            // Tạo một bản sao của text để tìm kiếm
            let searchText = text;
            let result = text;

            // Chuyển cả text và keyword về dạng không dấu để so sánh
            const normalizedText = removeVietnameseTones(text.toLowerCase());
            const normalizedKeyword = removeVietnameseTones(keyword.toLowerCase());

            // Escape các ký tự đặc biệt trong keyword
            const escapedKeyword = normalizedKeyword.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

            // Tìm tất cả các vị trí match trong normalized text
            const regex = new RegExp(escapedKeyword, 'gi');
            let match;
            let positions = [];

            while ((match = regex.exec(normalizedText)) !== null) {
                positions.push({
                    start: match.index,
                    end: match.index + match[0].length
                });
            }

            // Highlight text gốc dựa trên các vị trí đã tìm thấy
            // Xử lý từ cuối lên đầu để tránh ảnh hưởng đến các index
            for (let i = positions.length - 1; i >= 0; i--) {
                const pos = positions[i];
                const originalText = text.substring(pos.start, pos.end);
                result = result.substring(0, pos.start) +
                    `<span class="highlight">${originalText}</span>` +
                    result.substring(pos.end);
            }

            return result;
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
                let innerHTML = "";
                if (maLoai == "homePage") {
                    innerHTML = `<div class="row justify-content-start">
                        <h1 class="text-start">Sản Phẩm Bán Chạy</h1>
                        <div class="scroller">
            @for ($i = 0; $i < 5; $i++)
                @foreach ($sach as $book)
                    @if ($book->MaSach == $bestseller[$i]->MaSach)
                        <div class="col-md-4 flex flex-start">
                            <div class="card mb-4">
                                <a href="{{ route('product.detail', ['id' => $book->MaSach]) }}">
                                    <img src="{{ asset('img/sach/' . $book->AnhDaiDien) }}" class="card-img-top"
                                        alt="">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title" id="summary">{{ $book->TenSach }}</h5>
                                    <p class="card-text" id="description">{{ $book->MoTa }}</p>
                                    <p class="card-text"><strong>Tác giả: </strong>{{ $book->TenTG }}</p>
                                    <p class="card-text"><strong>Đã bán: </strong>{{ $bestseller[$i]->total_SLMua }} sản phẩm/tháng</p>
                                    <p class="card-text">
                                        <strong>Giá bán: </strong><span class="price">{{ (int) $book->GiaBan }} VNĐ</span>
                                    </p>
                                    <div class="action-container">
                                       <a href="#" class="btn add-to-cart" data-id="{{ $book->MaSach }}" onclick="addToCart({{ $book->MaSach }})">Thêm Vào Giỏ Hàng</a>
                                    </div>
                                </div>
                            </div>
                            </div>
                    @endif
                @endforeach
            @endfor
            </div>
        </div>


        <div class="row justify-content-start">
                        <h1 class="text-start">Sản Phẩm Mới</h1>
                        <div class="scroller">
            @for ($i = 0; $i < 5; $i++)
                @foreach ($sach as $book)
                    @if ($book->MaSach == $newproduct[$i]->MaSach)
                        <div class="col-md-4 flex flex-start">
                            <div class="card mb-4">
                                <a href="{{ route('product.detail', ['id' => $book->MaSach]) }}">
                                    <img src="{{ asset('img/sach/' . $book->AnhDaiDien) }}" class="card-img-top"
                                        alt="">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title" id="summary">{{ $book->TenSach }}</h5>
                                    <p class="card-text" id="description">{{ $book->MoTa }}</p>
                                    <p class="card-text"><strong>Tác giả: </strong>{{ $book->TenTG }}</p>
                                    <p class="card-text"><strong>Nhà xuất bản: </strong>{{ $book->NXB }}</p>
                                    <p class="card-text">
                                        <strong>Giá bán: </strong><span class="price">{{ (int) $book->GiaBan }} VNĐ</span>
                                    </p>
                                    <div class="action-container">
                                       <a href="#" class="btn add-to-cart" data-id="{{ $book->MaSach }}" onclick="addToCart({{ $book->MaSach }})">Thêm Vào Giỏ Hàng</a>


                                    </div>
                                </div>
                            </div>
                            </div>
                    @endif
                @endforeach
            @endfor
            </div>
        </div>






        <div class=" row justify-content-start">
                @foreach ($data as $bookType => $books)
                    <!-- In ra tên loại sách -->
                    <h1 class="text-start">Sách {{ $books[0]->TenLoai }}</h1>

                    <!-- Lặp qua các sách của loại đó -->
                    <div class="scroller">
                    @foreach ($books as $book)
                        <div class="col-md-4 flex flex-start">
                            <div class="card mb-4">
                                <a href="{{ route('product.detail', ['id' => $book->MaSach]) }}">
                                    <img src="{{ asset('img/sach/' . $book->AnhDaiDien) }}" class="card-img-top" alt="">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title" id="summary">{{ $book->TenSach }}</h5>
                                    <p class="card-text" id="description">{{ $book->MoTa }}</p>
                                    <p class="card-text"><strong>Tác giả: </strong>{{ $book->TenTG }}</p>
                                    <p class="card-text"><strong>Nhà xuất bản: </strong>{{ $book->NXB }}</p>
                                    <p class="card-text">
                                        <strong>Giá bán: </strong><span class="price">{{ (int) $book->GiaBan }} VNĐ</span>
                                    </p>
                                    <div class="action-container">
                                     <a href="#" class="btn add-to-cart" data-id="{{ $book->MaSach }}" onclick="addToCart({{ $book->MaSach }})">Thêm Vào Giỏ Hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @endforeach
            </div>


        `;
                } else {
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
                               <a href="#" class="btn add-to-cart" data-id="${book.MaSach}" onclick="addToCart(${book.MaSach})">Thêm Vào Giỏ Hàng</a>


                            </div>
                        </div>
                    </div>
                </div>
                `;
                    }).join('');
                    innerHTML = `<div class="row justify-content-start">${cards}</div>`;

                }

                bookShow.innerHTML = innerHTML;

            } catch (error) {
                bookShow.innerHTML = `<p>Lỗi khi lấy sách theo loại sách: ${error.message}</p>`;
            }
        };

        laySachTheoLoaiSach("homePage", null);

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
            ('book-show');
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
                            <h5 class="card-title" id="summary">${highlightText(book.TenSach, name)}</h5>
                            <p class="card-text" id="description">${highlightText(book.MoTa, name)}</p>
                            <p class="card-text"><strong>Tác giả: </strong>${highlightText(book.TenTG, name)}</p>
                            <p class="card-text"><strong>Nhà xuất bản: </strong>${book.NXB}</p>
                            <p class="card-text">
                                <strong>Giá bán: </strong><span class="price">${book.GiaBan} VNĐ</span>
                            </p>
                            <div class="action-container">
                              <a href="#" class="btn add-to-cart" data-id="${book.MaSach}" onclick="addToCart(${book.MaSach})">Thêm Vào Giỏ Hàng</a>


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

 <style>
        .selectedList {
            border: 2px solid green;
            background-color: #f0f0f0;
        }

        .highlight {
            background-color: yellow;
            font-weight: bold;
        }
    </style>
@endsection
