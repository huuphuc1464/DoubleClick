@extends('layout')
@section('title', 'Trang tìm kiếm')
@section('css')
    <style>
        .tg-searchbox {
            height: 80%;
            background: #FAF3E0;
            border-radius: 90px;
        }

        input#inputSearch {
            border-radius: 999px;
        }

        #content {
            background-color: #FAF3E0;
        }


        /* Nút danh mục */
        .btn {
            display: block;
            padding: 10px 15px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            color: #333;
            text-align: left;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn:hover {
            background-color: #f7f7f7;
            border-color: #bbb;
            color: #007bff;
        }

        .btn.selectedList {
            border: 2px solid #28a745;
            /* Màu viền cho nút được chọn */
            background-color: #e6ffe6;
            /* Màu nền cho nút được chọn */
            font-weight: bold;
            color: #28a745;
            /* Màu chữ */
        }

        /* Hiệu ứng highlight */
        .highlight {
            background-color: #ffeb3b;
            font-weight: bold;
            padding: 2px 4px;
            border-radius: 3px;
        }

        /* Pagination controls */
        .pagination-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .pagination-controls button {
            padding: 8px 12px;
            border: 1px solid #ddd;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pagination-controls button:hover {
            background-color: #0056b3;
        }

        .pagination-controls span {
            font-weight: bold;
        }

        /* Loading text */
        .loading-text {
            text-align: center;
            font-size: 16px;
            color: #666;
            margin: 20px 0;
        }
    </style>
@endsection
@section('content')
    <div class="container mt-5 main-content">
        {{-- Sidebar --}}
        <aside class="sidebar">
            <div class="bg-white p-4 rounded shadow sbar">
                <h2 class="text-lg font-semibold mb-4">Danh Mục</h2>
                <ul class="space-y-2">
                    <li>
                        <button class="btn hover:underline selectedList" onclick="laySachTheoLoaiSach('getAll', this)">
                            Tất cả sách
                        </button>
                    </li>
                    @foreach ($categories as $category)
                        <li>
                            <button class="btn hover:underline" onclick="laySachTheoLoaiSach({{ $category->MaLoai }}, this)">
                                {{ $category->TenLoai }}
                            </button>
                        </li>
                    @endforeach
                </ul>

            </div>
        </aside>
        <div id="book-show" class="container mt-5" style="overflow: hidden">
            {{-- Hiển thị trang chủ sản phẩm --}}
        </div>
    </div>

    <script>
        const cuonTrang = function(sectionId) {
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
        const laySachTheoLoaiSach = async function(maLoai, buttonElement, page = 1) {
            try {
                // Hiển thị trạng thái loading
                bookShow.innerHTML = `<p class="loading-text">Đang tải sách...</p>`;

                if (buttonElement !== null) {
                    // Xóa class selectedList khỏi tất cả các button và thêm vào buttonElement
                    const allButtons = document.querySelectorAll('.sidebar .btn');
                    allButtons.forEach(button => button.classList.remove('selectedList'));
                    buttonElement.classList.add('selectedList');
                }

                // Gửi yêu cầu với tham số page
                const response = await fetch(`/laySachTheoMaLoaiTrangTimSach/${maLoai}?page=${page}`);
                if (!response.ok) {
                    throw new Error(`Lỗi kết nối: ${response.status}`);
                }

                const data = await response.json();
                const books = data.data; // Mảng sách
                const currentPage = data.current_page;
                const lastPage = data.last_page;

                // Tạo danh sách sách
                const cards = books.map(book => `
            <div class="col-md-4 flex-start">
                <div class="card mb-4">
                    <a href="${getLinkDetail(book.MaSach)}">
                        <img src="${baseUrl}/img/sach/${book.AnhDaiDien}" class="card-img-top" alt="${book.TenSach}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">${book.TenSach}</h5>
                        <p class="card-text">${book.MoTa}</p>
                        <p class="card-text"><strong>Tác giả: </strong>${book.TenTG}</p>
                        <p class="card-text"><strong>Giá bán: </strong>${book.GiaBan} VNĐ</p>
                    </div>
                </div>
            </div>
        `).join('');

                // Phần điều khiển phân trang
                let paginationHTML = `<div class="pagination-controls" style="margin-top:20px;">`;
                if (currentPage > 1) {
                    paginationHTML +=
                        `<button onclick="laySachTheoLoaiSach('${maLoai}', ${buttonElement ? 'this' : 'null'}, ${currentPage - 1})">Prev</button>`;
                }
                paginationHTML += `<span> Trang ${currentPage} / ${lastPage} </span>`;
                if (currentPage < lastPage) {
                    paginationHTML +=
                        `<button onclick="laySachTheoLoaiSach('${maLoai}', ${buttonElement ? 'this' : 'null'}, ${currentPage + 1})">Next</button>`;
                }
                paginationHTML += `</div>`;

                // Hiển thị sách và phân trang
                bookShow.innerHTML = `<div class="row justify-content-start">${cards}</div>${paginationHTML}`;

            } catch (error) {
                bookShow.innerHTML = `<p class="loading-text">Lỗi: ${error.message}</p>`;
            }
        };

        // Gọi lần đầu với danh mục "Tất cả sách"
        laySachTheoLoaiSach("getAll", document.querySelector('.btn.selectedList'), 1);



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
        const timSachTheoTen = async function(name, page = 1) {
            try {
                bookShow.innerHTML = `<p>Đang tìm kiếm sách...</p>`;

                // Gửi yêu cầu với tham số page
                const response = await fetch(`/timSachTheoTenTrangTimKiem/${name}?page=${page}`);
                if (!response.ok) {
                    throw new Error(`Lỗi kết nối: ${response.status}`);
                }

                const data = await response.json();
                const books = data.data; // Mảng sách
                const currentPage = data.current_page;
                const lastPage = data.last_page;

                // Tạo danh sách sách
                const cards = books.map(book => `
            <div class="col-md-4 flex-start">
                <div class="card mb-4">
                    <a href="${getLinkDetail(book.MaSach)}">
                        <img src="${baseUrl}/img/sach/${book.AnhDaiDien}" class="card-img-top" alt="${book.TenSach}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">${highlightText(book.TenSach, name)}</h5>
                        <p class="card-text">${highlightText(book.MoTa, name)}</p>
                        <p class="card-text"><strong>Tác giả: </strong>${highlightText(book.TenTG, name)}</p>
                        <p class="card-text"><strong>Giá bán: </strong>${book.GiaBan} VNĐ</p>
                    </div>
                </div>
            </div>
        `).join('');

                // Phần điều khiển phân trang
                let paginationHTML = `<div class="pagination-controls" style="margin-top:20px;">`;
                if (currentPage > 1) {
                    paginationHTML +=
                        `<button onclick="timSachTheoTen('${name}', ${currentPage - 1})">Prev</button>`;
                }
                paginationHTML += `<span> Trang ${currentPage} / ${lastPage} </span>`;
                if (currentPage < lastPage) {
                    paginationHTML +=
                        `<button onclick="timSachTheoTen('${name}', ${currentPage + 1})">Next</button>`;
                }
                paginationHTML += `</div>`;

                // Hiển thị sách và phân trang
                bookShow.innerHTML = `<div class="row justify-content-start">${cards}</div>${paginationHTML}`;

            } catch (error) {
                bookShow.innerHTML = `<p>Lỗi: ${error.message}</p>`;
            }
        };

        // Gọi hàm tìm kiếm khi nhấn nút tìm kiếm hoặc enter
        btnSearch.addEventListener('click', function() {
            const name = inputSearch.value.trim() || "getAll";
            timSachTheoTen(name, 1); // Gọi với trang đầu tiên
        });
    </script>
@endsection
