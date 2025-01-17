@extends('layout')
@section('title', 'Giới Thiệu')
@section('css')
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/about.css') }}" />
@endsection
@section('content_about')
    <!-- Hero Section -->
    <section id="hero" class="hero">
        <video autoplay muted loop>
            <source src="{{ asset('videos/' . $website->Video) }}" type="video/mp4">
            Trình duyệt của bạn không hỗ trợ video.
        </video>
        <div class="hero-overlay">
            <h1 style="color: #cac9c9">{{ $website->Title }}</h1>
            <p>{{ $website->SubTitle }}</p>
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
            <div id="sachBanChay" class="row">
                <!-- Sách bestseller sẽ hiển thị ở đây -->
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
                        <p>"{{ $website->PhanHoi1 }}"</p>
                        <h5>- {{ $website->TenKhach1 }}</h5>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="col-md-6 mb-4">
                    <div class="testimonial-item">
                        <div class="lottie" id="testimonial2"></div>
                        <p>"{{ $website->PhanHoi2 }}"</p>
                        <h5>- {{ $website->TenKhach2 }}</h5>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="col-md-6 mb-4">
                    <div class="testimonial-item">
                        <div class="lottie" id="testimonial3"></div>
                        <p>"{{ $website->PhanHoi3 }}"</p>
                        <h5>- {{ $website->TenKhach3 }}</h5>
                    </div>
                </div>
                <!-- Testimonial 4 -->
                <div class="col-md-6 mb-4">
                    <div class="testimonial-item">
                        <div class="lottie" id="testimonial4"></div>
                        <p>"{{ $website->PhanHoi4 }}"</p>
                        <h5>- {{ $website->TenKhach4 }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Lottie Files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <!-- Initialize AOS and Lottie -->
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
                        <a href="/san-pham">
                              <img src="https://images.unsplash.com/photo-1516979187457-637abb4f9353?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                            class="card-img-top" alt="${danhMuc.TenLoai}">
                        </a>
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
                return `<div class="col-md-3 mb-4">
                        <div class="card">
                            <img class="card-img-top" src="${baseUrl}/img/sach/${sach.AnhDaiDien}" alt="${sach.TenSach}">
                            <div class="card-body">
                                <h5 class="card-title">${sach.TenSach}</h5>
                                <p class="card-text">Tác giả: ${sach.TenTG}</p>
                                <p class="card-text">Giá bán: ${sach.GiaBan} VND</p>
                                <p class="card-text">${sach.MoTa}</p>
                                <a href="/san-pham/${sach.MaSach}" class="btn btn-primary">Mua Ngay</a>
                            </div>
                        </div>
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
@endsection
