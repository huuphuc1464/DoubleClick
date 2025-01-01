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
    <!-- Custom CSS -->
    <link href="{{ asset('css/timkiem.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header class="bg-light py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="{{ asset('img/logoname.png') }}" alt="Logo" class="logo">
            <nav>
                <a href="#" class="text-dark mx-3">Trang Chủ</a>
                <a href="#" class="text-dark mx-3">Giới Thiệu</a>
                <a href="#" class="text-dark mx-3">Liên Hệ</a>
                <a href="#" class="text-dark mx-3 position-relative">
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
                <select class="form-select form-select-sm search-select">
                    <option value="ten_sach">Tên sách</option>
                    <option value="ten_tac_gia">Tên tác giả</option>
                </select>
            </div>
            <div class="col-md-5 col-8 ">
                <input type="text" class="form-control" placeholder="Nhập từ khóa tìm kiếm...">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary">
                    <i class="fas fa-search"></i> Tìm Kiếm
                </button>
            </div>
        </div>

        <!-- Văn Học Section -->
        <section class="mb-5">
            <h3>Văn Học</h3>
            <div class="row">
                <!-- Book 1 -->
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Lược Sử Loài Người">
                        <div class="card-body ">
                            <h5 class="card-title">Lược Sử Loài Người</h5>
                            <p class="card-text">Yuval Noah Harari</p>
                            <a href="#" class="btn btn-primary btn-sm">
                                <i class="fas fa-info-circle"></i> Xem Chi Tiết
                            </a>
                            <button class="btn btn-success btn-sm float-end">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Book 2 -->
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Số Đỏ">
                        <div class="card-body">
                            <h5 class="card-title">Số Đỏ</h5>
                            <p class="card-text">Vũ Trọng Phụng</p>
                            <a href="#" class="btn btn-primary btn-sm">
                                <i class="fas fa-info-circle"></i> Xem Chi Tiết
                            </a>
                            <button class="btn btn-success btn-sm float-end">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Book 3 -->
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Tắt Đèn">
                        <div class="card-body">
                            <h5 class="card-title">Tắt Đèn</h5>
                            <p class="card-text">Ngô Tất Tố</p>
                            <a href="#" class="btn btn-primary btn-sm">
                                <i class="fas fa-info-circle"></i> Xem Chi Tiết
                            </a>
                            <button class="btn btn-success btn-sm float-end">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Book 4 -->
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Những Người Khốn Khổ">
                        <div class="card-body">
                            <h5 class="card-title">Những Người Khốn Khổ</h5>
                            <p class="card-text">Victor Hugo</p>
                            <a href="#" class="btn btn-primary btn-sm">
                                <i class="fas fa-info-circle"></i> Xem Chi Tiết
                            </a>
                            <button class="btn btn-success btn-sm float-end">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tiểu Thuyết Section -->
        <section>
            <h3>Tiểu Thuyết</h3>
            <div class="row">
                <!-- Book 1 -->
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Đảo Giấu Vàng">
                        <div class="card-body">
                            <h5 class="card-title">Đảo Giấu Vàng</h5>
                            <p class="card-text">Robert Louis Stevenson</p>
                            <a href="#" class="btn btn-primary btn-sm">
                                <i class="fas fa-info-circle"></i> Xem Chi Tiết
                            </a>
                            <button class="btn btn-success btn-sm float-end">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Book 2 -->
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Ông Già Và Biển Cả">
                        <div class="card-body">
                            <h5 class="card-title">Ông Già Và Biển Cả</h5>
                            <p class="card-text">Ernest Hemingway</p>
                            <a href="#" class="btn btn-primary btn-sm">
                                <i class="fas fa-info-circle"></i> Xem Chi Tiết
                            </a>
                            <button class="btn btn-success btn-sm float-end">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="text-center">
            <p class="footer-text">&copy; 2024 Double Click - Website Bán Sách</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <!-- Custom JS -->
    {{-- <script src="./scripts.js"></script> --}}
</body>

</html>
