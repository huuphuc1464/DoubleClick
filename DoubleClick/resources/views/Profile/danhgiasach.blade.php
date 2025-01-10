@extends('Profile.sublayout')

@section('css_sub')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/danhgiasach.css') }}">


@endsection
@section('title')
{{ $title }}
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
        <input type="hidden" name="SoSao" value="1">

        <div class="card p-4">
            <div class="text-center">
                <img alt="Book cover of {{ $sach->TenSach }}" height="150" src="{{ asset('/img/sach/' . $sach->AnhDaiDien) }}" width="100" style="object-fit: cover;" />
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
                <textarea class="form-control" name="DanhGia" id="review" placeholder="Bạn nghĩ như thế nào về chất lượng sách đã mua?" rows="3" required></textarea>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Đảm bảo chọn 5 sao khi trang tải
        const stars = document.querySelectorAll('.rating-star');

        // Chọn 5 sao đầu tiên (index 0 đến index 4)
        for (let i = 0; i < 5; i++) {
            stars[i].classList.add('selected');
        } // Đưa số sao vào input ẩn để gửi cùng form document.querySelector('input[name="SoSao" ]').value=5; // Mặc định là 5 sao 
    });

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
