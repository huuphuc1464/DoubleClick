@extends('Blog.layoutBlog')
@section('title' , 'Bài Viết')
@section('subcontent')
    <div class="w3-col l8 s12">
        <!-- Bài viết -->
        <!-- Bài viết -->
        <div class="w3-card-4 w3-margin w3-white">
            <h1><b>{{ $baiViet->TenBaiViet }}</b></h1>
            <div class="w3-container">
                <h3><b>{{ $baiViet->DanhMucBV }}</b></h3>
                <img src="{{ asset('img/Blog/' . $baiViet->Image1) }}" alt="Ảnh 1" style="width:100%;"><br></br>
            </div>
            <div class="w3-container">
                {!! $baiViet->NoiDungBig !!}
                <img src="{{ asset('img/Blog/' . $baiViet->Image2) }}" alt="Ảnh 2" style="width:70%;">
                {!! $baiViet->NoiDungSmall !!}
                <h6>{{ $baiViet->NgayDang }}</h6>
                <h6><b>{{ $baiViet->TenTacGia }}</b></h6>
            </div>
        </div>
        <hr>

    </div>
@endsection
