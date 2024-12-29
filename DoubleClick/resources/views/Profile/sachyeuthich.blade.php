@extends('Profile.sublayout')

@section('css_sub')
{{-- <link rel="stylesheet" href="{{ asset('css/.css') }}"> --}}
<style>
    body {
        background-color: #f8f9fa;
    }

    .header {
        background-color: #f1f3f4;
        padding: 20px;
    }

    .header h1 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .add-all {
        color: #00bcd4;
        font-weight: bold;
        cursor: pointer;
        margin-top: 10px;
    }

    .cart-item {
        background-color: #ffffff;
        padding: 20px;
        border-bottom: 1px solid #e0e0e0;
    }

    .cart-item img {
        width: 60px;
        height: 90px;
    }

    .cart-item .item-title {
        font-size: 1rem;
        font-weight: bold;
    }

    .cart-item .item-price {
        color: #ff9800;
        font-size: 1.25rem;
        font-weight: bold;
    }

    .cart-item .delete-icon {
        color: #9e9e9e;
        cursor: pointer;
        margin-top: 20px;
    }

    .cart-item .add-to-cart {
        background-color: #ff9800;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }

</style>

@endsection

@section('content_sub')
<div class="container">
    <div class="header">
        <h1>
            Sách yêu thích
        </h1>
    </div>
    <div class="add-all">
        THÊM TẤT CẢ VÀO GIỎ HÀNG
    </div>
    <div class="cart-item mt-3">
        <div class="row align-items-center">
            <div class="col-2">
                <img alt="Book cover of Chiến Binh Cầu Vồng (Tái Bản 2020)" height="90" src="https://storage.googleapis.com/a1aa/image/QgYXdjkmvHaOI1otRFlO4l3eIOCg5XRIcX9lyeHVN7xReYfPB.jpg" width="60" />
            </div>
            <div class="col-6">
                <div class="item-title">
                    Chiến Binh Cầu Vồng (Tái Bản 2020)
                </div>
                <div>
                    <i class="fas fa-trash delete-icon">
                    </i>
                </div>
            </div>
            <div class="col-2 text-end">
                <div class="item-price">
                    174.780 ₫
                </div>
            </div>
            <div class="col-2 text-end">
                <button class="add-to-cart">
                    <i class="fas fa-cart-plus">
                    </i>
                </button>
            </div>
        </div>
    </div>
</div>


@endsection
