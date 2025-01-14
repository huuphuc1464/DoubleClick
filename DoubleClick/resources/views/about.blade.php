<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoubleClick</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Swiper.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            scroll-behavior: smooth;
        }

        /* Header */
        .navbar {
            padding: 20px 0;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.8rem;
            color: #28a745 !important;
            /* Màu xanh lá */
        }

        .nav-link {
            margin-left: 15px;
            font-weight: 500;
            color: #ffffff !important;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #28a745 !important;
            /* Màu xanh lá */
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        .hero video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: 1;
            transform: translate(-50%, -50%);
            background-size: cover;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(26, 26, 26, 0.6);
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            color: #ffffff;
        }

        .hero-overlay h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-overlay p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .hero-overlay .btn {
            padding: 10px 30px;
            font-size: 1rem;
            background-color: #28a745;
            /* Màu xanh lá */
            border-color: #28a745;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .hero-overlay .btn:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        /* About Section */
        .about {
            padding: 60px 0;
        }

        .about h2 {
            margin-bottom: 40px;
            font-weight: 600;
            text-align: center;
        }

        .about p {
            font-size: 1rem;
            color: #555555;
        }

        /* Categories Section */
        .categories {
            padding: 60px 0;
            background-color: #f8f9fa;
        }

        .categories h2 {
            margin-bottom: 40px;
            font-weight: 600;
            text-align: center;
        }

        .category-card {
            transition: transform 0.3s;
            cursor: pointer;
        }

        .category-card:hover {
            transform: translateY(-10px);
        }

        .category-card img {
            height: 200px;
            object-fit: cover;
        }

        /* Bestsellers Section */
        .bestsellers {
            padding: 60px 0;
        }

        .bestsellers h2 {
            margin-bottom: 40px;
            font-weight: 600;
            text-align: center;
        }

        .swiper-container {
            padding: 20px 0;
        }

        .swiper-slide {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
        }

        .swiper-slide:hover {
            transform: translateY(-10px);
        }

        .swiper-slide img {
            height: 200px;
            object-fit: cover;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .swiper-slide h5 {
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: #333333;
        }

        .swiper-slide p {
            font-size: 0.9rem;
            color: #777777;
            margin-bottom: 15px;
        }

        .swiper-slide .btn {
            padding: 8px 20px;
            font-size: 0.9rem;
            background-color: #28a745;
            /* Màu xanh lá */
            border-color: #28a745;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .swiper-slide .btn:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        /* New Releases Section */
        .new-releases {
            padding: 60px 0;
        }

        .new-releases h2 {
            margin-bottom: 40px;
            font-weight: 600;
            text-align: center;
        }

        .new-books {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }

        .new-book {
            width: 200px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            background-color: #ffffff;
        }

        .new-book:hover {
            transform: translateY(-10px);
        }

        .new-book img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .new-book-body {
            padding: 15px;
            text-align: center;
        }

        .new-book-body h5 {
            font-size: 1rem;
            margin-bottom: 10px;
            color: #333333;
        }

        .new-book-body p {
            font-size: 0.9rem;
            color: #777777;
            margin-bottom: 15px;
        }

        .new-book-body .btn {
            padding: 5px 15px;
            font-size: 0.8rem;
            background-color: #28a745;
            /* Màu xanh lá */
            border-color: #28a745;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .new-book-body .btn:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        /* Testimonials Section */
        .testimonials {
            padding: 60px 0;
            background-color: #f8f9fa;
        }

        .testimonials h2 {
            margin-bottom: 40px;
            font-weight: 600;
            text-align: center;
        }

        .testimonial-item {
            text-align: center;
            padding: 20px;
        }

        .testimonial-item .lottie {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
        }

        .testimonial-item p {
            font-style: italic;
            color: #555555;
            margin-bottom: 15px;
        }

        .testimonial-item h5 {
            color: #333333;
            font-weight: 600;
        }

        /* Footer */
        .footer {
            background-color: #333333;
            color: #ffffff;
            padding: 30px 0;
        }

        .footer a {
            color: #28a745;
            /* Màu xanh lá */
            text-decoration: none;
        }

        .social-icons a {
            margin: 0 10px;
            color: #ffffff;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #28a745;
            /* Màu xanh lá */
        }
    </style>
</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">DoubleClick</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#hero">Trang Chủ</a>
                    <a class="nav-link" href="#about">Giới Thiệu</a>
                    <a class="nav-link" href="#categories">Danh Mục</a>
                    <a class="nav-link" href="#bestsellers">Bán Chạy</a>
                    <a class="nav-link" href="#new-releases">Sách Mới</a>
                    <a class="nav-link" href="#testimonials">Phản Hồi</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="hero">
        <video autoplay muted loop>
            <source src="{{ asset('videos/' . $website->Video) }}" type="video/mp4">
            Trình duyệt của bạn không hỗ trợ video.
        </video>
        <div class="hero-overlay">
            <h1>Khám Phá Thế Giới Sách Cùng DoubleClick</h1>
            <p>Đa dạng về thể loại, chất lượng đảm bảo - Nơi những trang sách sống động.</p>
            <a href="#bestsellers" class="btn">Xem Bán Chạy</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <h2>Về DoubleClick</h2>
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right">
                    <img src="{{ asset('img/website/' . $website->Image) }}" alt="About Us"
                        class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <p>{{ $website->MoTa }}</p>
                    <p>{{ $website->MoiGoi }}</p>
                    <a href="#categories" class="btn btn-outline-success">Xem Danh Mục</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="categories">
        <div class="container" data-aos="fade-up">
            <h2>Danh Mục Sách</h2>
            <div id="DanhMucSach" class="row">
                {{-- Hiển thị top 3 danh mục sách ở đây --}}
            </div>
        </div>
    </section>

    <!-- Bestsellers Section -->
    <section id="bestsellers" class="bestsellers">
        <div class="container" data-aos="fade-up">
            <h2 class="mb-5 text-center">Sách Bán Chạy</h2>
            <!-- Swiper -->
            <div class="swiper-container">
                <div id="sachBanChay" class="swiper-wrapper">
                    <!-- Sách bestseller sẽ hiển thị ở đây -->
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- New Releases Section -->
    <section id="new-releases" class="new-releases">
        <div class="container" data-aos="fade-up">
            <h2>Sách Mới</h2>
            <div id="new-books" class="new-books">
                <!-- New Book 1 -->
                {{-- Sách mới sẽ hiển thị ở đây --}}
            </div>
        </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">
            <h2 class="mb-5 text-center">Phản Hồi Khách Hàng</h2>
            <div class="row justify-content-center">
                <!-- Testimonial 1 -->
                <div class="col-md-6 mb-4">
                    <div class="testimonial-item">
                        <div class="lottie" id="testimonial1"></div>
                        <p>"DoubleClick luôn mang đến những cuốn sách chất lượng và dịch vụ tuyệt vời. Tôi rất hài
                            lòng."</p>
                        <h5>- Nguyễn Thị Hương</h5>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="col-md-6 mb-4">
                    <div class="testimonial-item">
                        <div class="lottie" id="testimonial2"></div>
                        <p>"Dịch vụ khách hàng tuyệt vời và giao hàng nhanh chóng. Sẽ tiếp tục ủng hộ DoubleClick."</p>
                        <h5>- Trần Văn Nam</h5>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="col-md-6 mb-4">
                    <div class="testimonial-item">
                        <div class="lottie" id="testimonial3"></div>
                        <p>"Môi trường mua sắm thân thiện và dễ chịu. Tôi đã tìm được nhiều cuốn sách yêu thích."</p>
                        <h5>- Lê Thị Mai</h5>
                    </div>
                </div>
                <!-- Testimonial 4 -->
                <div class="col-md-6 mb-4">
                    <div class="testimonial-item">
                        <div class="lottie" id="testimonial4"></div>
                        <p>"Giá cả hợp lý và chất lượng sách tốt. Tôi sẽ giới thiệu cho bạn bè và người thân."</p>
                        <h5>- Phạm Minh Huy</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p>&copy; 2025 DoubleClick. All Rights Reserved.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#"><i class="fab fa-twitter fa-lg"></i></a>
                <a href="#"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#"><i class="fab fa-linkedin fa-lg"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Swiper.js JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Lottie Files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <!-- Initialize AOS, Swiper và Lottie -->


    <script>
        const baseUrl = window.location.origin;
        const layTop3Loai = async function() {
            const DanhMucSachElement = document.getElementById('DanhMucSach');
            //Gọi API để lấy top 3 doanh mục có nhiều sách nhất
            const response = await fetch('/top3-loai-sach');
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }
            const data = await response.json();
            const cards = data.data.map((danhMuc) => {
                return `
                     <div class="col-md-4 mb-4">
                    <div class="card category-card">
                        <img src="https://images.unsplash.com/photo-1516979187457-637abb4f9353?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="card-img-top" alt="${danhMuc.TenLoai}">
                        <div class="card-body">
                            <h5 class="card-title">${danhMuc.TenLoai}</h5>
                            <p class="card-text">${danhMuc.MoTa}.</p>
                        </div>
                    </div>
                </div>`
            }).join('');
            DanhMucSachElement.innerHTML = cards;
        }
        const laySachBanChay = async function() {
            const sachBanChayElement = document.getElementById('sachBanChay');
            //lấy 4 sản phẩm bán chạy nhất
            const response = await fetch(`getBestSeller/4`);
            if (!response.ok) {
                throw new Error(`Respone status: lỗi`)
            }
            const data = await response.json();
            const cards = data.map((sach) => {
                return `<div class="swiper-slide">
                        <img class="w-100" src="${baseUrl}/img/sach/${sach.AnhDaiDien}"
                            alt="${sach.TenSach}">
                        <h5>${sach.TenSach}</h5>
                        <p>${sach.MoTa}</p>
                        <a href="/san-pham/${sach.MaSach}" class="btn">Mua Ngay</a>
                    </div>`
            }).join('');
            sachBanChayElement.innerHTML = cards;

        }
        const laySachMoi = async function() {
            const sachMoiElement = document.getElementById('new-books');

            //lấy 4 sản phẩm mới nhất
            const response = await fetch(`/newest-books?count=4`)
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }
            const data = await response.json();
            const cards = data.data.map((sach) => {
                return `<div class="new-book">
                    <img src="${baseUrl}/img/sach/${sach.AnhDaiDien}"
                        alt="${sach.TenSach}">
                    <div class="new-book-body">
                        <h5>${sach.TenSach}</h5>
                        <p>${sach.MoTa}</p>
                       <a href="/san-pham/${sach.MaSach}" class="btn">Mua Ngay</a>
                    </div>
                </div>`
            }).join('');
            sachMoiElement.innerHTML = cards;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            layTop3Loai();
            laySachBanChay();
            laySachMoi();
            // Initialize AOS
            AOS.init({
                duration: 1000,
                once: true,
            });

            // Initialize Swiper
            const swiper = new Swiper('.swiper-container', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                }
            });

            // Initialize Lottie Animations for Testimonials
            const testimonials = [{
                    container: 'testimonial1',
                    path: 'https://assets7.lottiefiles.com/packages/lf20_t24tpb.json'
                },
                {
                    container: 'testimonial2',
                    path: 'https://assets2.lottiefiles.com/packages/lf20_u4yrau.json'
                },
                {
                    container: 'testimonial3',
                    path: 'https://assets1.lottiefiles.com/packages/lf20_jcikwtux.json'
                },
                {
                    container: 'testimonial4',
                    path: 'https://assets4.lottiefiles.com/packages/lf20_q5pk6p1k.json'
                },
            ];

            testimonials.forEach(t => {
                lottie.loadAnimation({
                    container: document.getElementById(t.container),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: t.path
                });
            });
        });
    </script>
</body>

</html>
