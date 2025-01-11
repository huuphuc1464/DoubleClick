<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Kiếm Sách</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/timkiem.css') }}" rel="stylesheet">
    <style>
        .swiper {
            padding: 20px 0;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
        }

        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="bg-light py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('user.timsach') }}">
                <img src="{{ asset('img/' . $website->Logo) }}" alt="Logo" class="logo">
            </a>
            <nav>
                <a href="{{ route('user.products') }}" class="text-dark mx-3">Trang Chủ</a>
                <a href="#" class="text-dark mx-3">Giới Thiệu</a>
                <a href="{{ route('contact.form') }}" class="text-dark mx-3">Liên Hệ</a>
                <a href="{{ route('cart.index') }}" class="text-dark mx-3 position-relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span
                        class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">0</span>
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Search Section -->
        <h2 class="text-center mb-4">Tìm Kiếm Sách</h2>
        <div class="row mb-5 justify-content-center resize-search">
            <div class="col-auto">
                <select id="search-type" class="form-select form-select-sm search-select">
                    <option value="ten_sach">Tên sách</option>
                    <option value="ten_tac_gia">Tên tác giả</option>
                </select>
            </div>
            <div class="col-md-5 col-8">
                <input id="search-input" type="text" class="form-control" placeholder="Nhập từ khóa tìm kiếm...">
            </div>
            <div class="col-auto">
                <button id="search-btn" class="btn btn-primary">
                    <i class="fas fa-search"></i> Tìm Kiếm
                </button>
            </div>
        </div>

        <!-- Results Section -->
        <div id="results-container">
            <!-- Các kết quả sẽ được render tại đây -->
        </div>

        <!-- Pagination -->
        <div id="pagination-container" class="mt-4 text-center">
            <!-- Phân trang sẽ được thêm vào đây -->
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="text-center">
            <p class="footer-text">&copy; 2024 Double Click - Website Bán Sách</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const baseUrl = "/api/sach";
            const resultsContainer = document.getElementById("results-container");

            async function fetchBooks(params = "") {
                resultsContainer.innerHTML = "<p class='text-center'>Đang tải dữ liệu...</p>";
                try {
                    const response = await axios.get(`${baseUrl}${params}`);
                    renderBooks(response.data.data);
                } catch (error) {
                    console.error("Lỗi khi lấy dữ liệu:", error);
                    resultsContainer.innerHTML = "<p class='text-center text-danger'>Lỗi khi tải dữ liệu.</p>";
                }
            }

            function renderBooks(data) {
                resultsContainer.innerHTML = ""; // Xóa nội dung cũ

                if (data.length === 0) {
                    resultsContainer.innerHTML =
                        "<p class='text-center text-muted'>Không tìm thấy sách phù hợp.</p>";
                    return;
                }

                data.forEach(loaiSach => {
                    const section = document.createElement("section");
                    section.classList.add("mb-5");
                    section.innerHTML = `
                        <h3 class="text-center">${loaiSach.TenLoai}</h3>
                        <hr class="mx-auto" style="width: 60%; border: 1px solid #007bff; margin-top: 0.5rem; margin-bottom: 1.5rem;">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    `;
                    resultsContainer.appendChild(section);

                    const swiperWrapper = section.querySelector(".swiper-wrapper");

                    loaiSach.sach.forEach(sach => {
                        const baseUrl = window.location.origin;
                        const imagePath = `${baseUrl}/img/sach/${sach.AnhDaiDien}`;
                        const slide = document.createElement("div");
                        slide.classList.add("swiper-slide");
                        slide.innerHTML = `
                            <div class="card h-100 border-0 shadow-sm">
                                <img src="${imagePath}" class="card-img-top rounded-top" alt="${sach.TenSach}">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title text-center">${sach.TenSach}</h5>
                                    <p class="card-text text-muted text-center">${sach.TenTG}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <a href="/san-pham/${sach.MaSach}" class="btn btn-outline-primary btn-sm flex-grow-1 me-2 text-nowrap">
                                            <i class="fas fa-info-circle"></i> Xem Chi Tiết
                                        </a>
                                        <button class="btn btn-outline-success btn-sm text-nowrap">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                        swiperWrapper.appendChild(slide);
                    });

                    // Khởi tạo Swiper
                    new Swiper(section.querySelector(".mySwiper"), {
                        slidesPerView: 4, // Hiển thị 4 sách đầu tiên
                        spaceBetween: 20,
                        navigation: {
                            nextEl: section.querySelector(".swiper-button-next"),
                            prevEl: section.querySelector(".swiper-button-prev"),
                        },
                        slidesPerGroup: 1, // Chuyển 1 sách mỗi lần
                    });
                });
            }

            document.getElementById("search-btn").addEventListener("click", () => {
                const search = document.getElementById("search-input").value.trim();
                const type = document.getElementById("search-type").value;
                fetchBooks(`?search=${search}&type=${type}`);
            });

            fetchBooks(); // Gọi API khi tải trang
        });
    </script>
</body>

</html>
