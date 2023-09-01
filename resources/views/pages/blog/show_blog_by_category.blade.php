@extends('collection')
@section('header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    <link rel="shortcut icon" href="{{ URL::current() }}" type="image/x-icon">
    <link rel="canonical" href="{{ URL::current() }}">
    <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/index.css') }}">
    <!-- Các thẻ Meta OG -->
    <meta property="og:title" content="{{ $meta_blog_title }}" />
    <meta property="og:url" content="{{ URL::current() }}" />
    <meta property="og:type" content="website" />
    <!-- End Các thẻ Meta OG -->
    <title>{{ $meta_blog_title }}</title>
@endsection
@section('product_content')
    <!-- phần hiển thị -->
    <div class="container-fluid">
        <br>
        @foreach ($blog_by_category as $key => $cate_blog)
            <div class="container mb-4">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <a href="{{ URL::to('/chi-tiet-bai-viet/' . $cate_blog->blog_id) }}" class="">
                            <img style="max-height: 14rem; width: 100%;"
                                src="{{ asset('public/uploads/blog/' . $cate_blog->blog_thumbnail) }}" class="card-img-top"
                                alt="">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <h3>{{ $cate_blog->blog_title }}</h3>
                        <span class="badge bg-secondary">{{ $cate_blog->created_at }}</span>
                        <p>{{ $cate_blog->pre_blog_content }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <footer class="panel-footer">
        {{ $blog_by_category->links() }}
    </footer>
@endsection
