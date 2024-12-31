@extends('Profile.sublayout')

@section('css_sub')
{{-- <link rel="stylesheet" href="{{ asset('css/.css') }}"> --}}
<style>
    body {
        background-color: #f8f9fa;
    }

    .rating-star {
        font-size: 2rem;
        color: #000;
        margin: 0 10px;
    }

    .rating-star:hover,
    .rating-star:hover~.rating-star {
        color: #000;
    }

    .rating-star:hover,
    .rating-star:hover~.rating-star,
    .rating-star.selected {
        color: #ffc107;
    }

    .rating-star:hover~.rating-star {
        color: #000;
    }

    .submit-btn {
        background-color: #ff4d4d;
        color: white;
        border: none;
        padding: 15px 50px;
        font-size: 1.2rem;
        border-radius: 5px;
    }

</style>

@endsection

@section('content_sub')
<div class="container mt-5">
    <h4>
        Đánh giá sách
    </h4>
    <div class="card p-4">
        <div class="text-center">
            <img alt="Book cover of Chiến Binh Cầu Vồng (Tái Bản 2020)" height="150" src="https://storage.googleapis.com/a1aa/image/2qhWJxrzplLfNiZoe5sd8wYF45Md6z54CzwSYDjruq1ovsfnA.jpg" width="100" />
            <h5 class="mt-3">
                Chiến Binh Cầu Vồng (Tái Bản 2020)
            </h5>
            <div class="my-3">
                <i class="fas fa-star rating-star">
                </i>
                <i class="fas fa-star rating-star">
                </i>
                <i class="fas fa-star rating-star">
                </i>
                <i class="fas fa-star rating-star">
                </i>
                <i class="fas fa-star rating-star">
                </i>
            </div>
            <p>
                Đánh giá sách này
                <span class="text-danger">
                    *
                </span>
            </p>
        </div>
        <div class="mb-3">
            <label class="form-label" for="review">
                Viết đánh giá
            </label>
            <textarea class="form-control" id="review" placeholder="Bạn nghĩ như thế nào về chất lượng sách đã mua?" rows="3"></textarea>
        </div>
        <div class="text-center">
            <button class="submit-btn" type="button">
                Gửi
            </button>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.rating-star').forEach(star => {
        star.addEventListener('mouseover', function() {
            this.classList.add('selected');
            let prev = this.previousElementSibling;
            while (prev) {
                prev.classList.add('selected');
                prev = prev.previousElementSibling;
            }
        });
        star.addEventListener('mouseout', function() {
            document.querySelectorAll('.rating-star').forEach(s => s.classList.remove('selected'));
        });
        star.addEventListener('click', function() {
            let isSelected = this.classList.contains('selected');
            document.querySelectorAll('.rating-star').forEach(s => s.classList.remove('selected'));
            if (!isSelected) {
                this.classList.add('selected');
                let prev = this.previousElementSibling;
                while (prev) {
                    prev.classList.add('selected');
                    prev = prev.previousElementSibling;
                }
            }
        });
    });

</script>
@endsection
