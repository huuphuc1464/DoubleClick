@extends('Profile.sublayout')

@section('css_sub')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- <link rel="stylesheet" href="{{ asset('css/.css') }}"> --}}
<style>
    body {
        background-color: #f8f9fa;
    }

    .rating-star {
        font-size: 2rem;
        color: gray;
        /* Màu mặc định */
        margin: 0 10px;
        cursor: pointer;
        transition: color 0.1s ease;
        /* Hiệu ứng chuyển màu */
    }

    .rating-star:hover {
        color: #ffc107;
        /* Màu vàng khi hover */
    }

    .rating-star.selected {
        color: #ffc107;
        /* Màu vàng khi đã chọn */
    }

    .submit-btn {
        background-color: #ff4d4d;
        color: white;
        border: none;
        padding: 15px 50px;
        font-size: 1.2rem;
        border-radius: 5px;
    }

    .account-content form {
        display: initial;
    }

</style>

@endsection

@section('content_sub')
<div class="container mt-5">
    <h4>
        Đánh giá sách
    </h4>
    <form action="{{ route('profile.luudanhgia', ['id' => $sach->MaSach]) }}" method="POST">
        @csrf
        <input type="hidden" name="MaSach" value="{{ $sach->MaSach }}">
        <input type="hidden" name="MaTK" value="{{ $MaTK }}">
        <input type="hidden" name="SoSao" value="0"> <!-- Input để lưu số sao đã chọn -->

        <div class="card p-4">
            <div class="text-center">
                <img alt="Book cover of {{ $sach->TenSach }}" height="150" src="https://storage.googleapis.com/a1aa/image/2qhWJxrzplLfNiZoe5sd8wYF45Md6z54CzwSYDjruq1ovsfnA.jpg" width="100" />
                <h5 class="mt-3">
                    {{ $sach->TenSach }}
                </h5>
                <div class="my-3">
                    <i class="fas fa-star rating-star" data-star="1"></i>
                    <i class="fas fa-star rating-star" data-star="2"></i>
                    <i class="fas fa-star rating-star" data-star="3"></i>
                    <i class="fas fa-star rating-star" data-star="4"></i>
                    <i class="fas fa-star rating-star" data-star="5"></i>
                </div>
                <p>
                    Đánh giá sách này
                    <span class="text-danger">*</span>
                </p>
            </div>
            <div class="mb-3">
                <label class="form-label" for="review">
                    Viết đánh giá
                </label>
                <textarea class="form-control" name="DanhGia" id="review" placeholder="Bạn nghĩ như thế nào về chất lượng sách đã mua?" rows="3"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="submit-btn btn btn-primary">
                    Gửi
                </button>
            </div>
        </div>
    </form>


</div>
<script>
    document.querySelectorAll('.rating-star').forEach((star, index) => {
        // Khi di chuột qua (hover), không làm gì với màu
        star.addEventListener('mouseover', function() {
            // Không thay đổi gì khi di chuột qua
        });

        // Khi di chuột ra, giữ màu các sao đã chọn
        star.addEventListener('mouseout', function() {
            // Không làm gì khi di chuột ra
        });

        // Khi click vào sao để chọn đánh giá
        star.addEventListener('click', function() {
            let isSelected = this.classList.contains('selected');

            document.querySelectorAll('.rating-star').forEach((s, i) => {
                if (i <= index) {
                    s.classList.add('selected'); // Tô vàng các sao đã chọn 
                } else {
                    s.classList.remove('selected'); // Bỏ chọn các sao còn lại 
                }
            }); // Đưa số sao vào input ẩn để gửi cùng form 
            let selectedStars = document.querySelectorAll('.rating-star.selected').length;
            document.querySelector('input[name="SoSao" ]').value = selectedStars;
        });
    });

</script>
@endsection
