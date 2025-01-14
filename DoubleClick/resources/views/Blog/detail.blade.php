@extends('Blog.layoutBlog')

@section('subtitle', $subtitle)

@section('subcontent')
    <div class="w3-col l8 s12">  
        <div class="w3-card-4 w3-margin w3-white w3-round-large">
            <div class="w3-container w3-padding">
                <br>
                <h2 class="blog-title"><b>{!! $blog->TieuDe !!}</b></h2>
                <br>
                <span class="w3-opacity blog-date">{{$blog->NgayDang}}</span>
                <br>
                <h5 class="blog-subtitle"><b>{!! $blog->SubTieuDe !!}</b></h5>
            </div>
            <img src="{{ asset('img/baiviet/' . $blog->AnhBlog) }}" alt="Bìa sách" class="blog-image">
            <div class="w3-container blog-content">
                {!! $blog->NoiDung !!}
                <div class="w3-row blog-author">
                    <div class="w3-col m8 s12">
                        <p><b>Người viết:</b> {{ $blog->TacGia }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
