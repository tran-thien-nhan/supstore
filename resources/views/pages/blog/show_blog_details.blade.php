@extends('collection')
@section('header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    <link rel="shortcut icon" href="{{ URL::current() }}" type="image/x-icon">
    <meta name="description" content="{{ $meta_desc }}">
    <meta name="keywords" content="{{ $meta_keywords }}">
    <link rel="canonical" href="{{ URL::current() }}">
    <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/index.css') }}">
    {{-- <link rel="stylesheet" href="sweetalert2.min.css"> --}}
    <!-- Các thẻ Meta OG -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_desc }}" />
    <meta property="og:image" content="{{ URL::to('public/uploads/product/' . $meta_image) }}" />
    <meta property="og:url" content="{{ URL::current() }}" />
    <meta property="og:type" content="website" />
    <!-- End Các thẻ Meta OG -->
    <title>{{ $meta_title }}</title>
    <style>
        .blog-content img {
            max-width: 70%; /* Giới hạn chiều rộng của hình ảnh */
            height: auto; /* Duy trì tỷ lệ khung hình */
            display: block; /* Đảm bảo hình ảnh được xem xét như một khối dạng khung */
            margin: 0 auto; /* Căn giữa hình ảnh trong khung chứa */
        }
    </style>
    
@endsection
@section('product_content')
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    {{-- <script src="sweetalert2.min.js"></script> --}}
    <div class="container-fluid mt-2">
        <div class="container d-flex justify-content-center">
            @foreach ($detail_blog_by_id as $key => $detail_blog_by_id)
                <div>
                    <div>
                        <img src="{{ URL::to('public/uploads/product/' . $detail_blog_by_id->blog_thumbnail) }}"
                            alt="" class="img-fluid">
                    </div>

                    <div>
                        <h1>{{ $detail_blog_by_id->blog_title }}</h1>
                        <span class="badge bg-secondary">{{ $detail_blog_by_id->created_at }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container mt-2">
        <div class="">
            <div class="container blog-content">
                {!! $detail_blog_by_id->blog_content !!}
            </div>
            <div class="mb-3">
                <div class="my-2">
                    <div class="btn btn-primary" data-href="{{ URL::current() }}" data-layout="" data-size="">
                        <a target="_blank"
                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(URL::current()) }}&amp;src=sdkpreparse"
                            class="fb-xfbml-parse-ignore text-white" style="text-decoration: none;">
                            <i class="fa-brands fa-facebook"></i> Chia sẻ
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="fb-comments" data-href="{{ URL::current() }}" data-width="100%" data-numposts="20"></div>
        </div>
        <hr>
    </div>
@endsection
