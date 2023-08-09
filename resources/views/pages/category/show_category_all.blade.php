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
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:url" content="{{ URL::current() }}" />
    <meta property="og:type" content="website" />
    <!-- End Các thẻ Meta OG -->
    <title>All Products</title>
@endsection
@section('product_content')
    <!-- phần hiển thị -->
    <div class="d-flex">
        <div class="container row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4">
            @foreach ($category_all_product as $key => $cate_id)
                <div class="container col mb-4">
                    <div class="card border-0">
                        <a href="{{ URL::to('/chi-tiet-san-pham/' . $cate_id->product_id) }}"
                            class="d-flex justify-content-center align-items-center">
                            <img style="height: 16rem; width: 14rem; object-fit: cover;"
                                src="{{ asset('public/uploads/product/' . $cate_id->product_image) }}" class="card-img-top"
                                alt="">
                        </a>
                        <div class="card-body d-flex flex-column align-items-center">

                            <div class="d-flex justify-content-center">
                                <h5 class="card-title text-center" style="font-size: 1rem; width: 14rem;">
                                    {{ $cate_id->product_name }} </h5>
                            </div>
                            <div style="margin-top:-0.25rem;margin-bottom:0.25rem">
                                @php
                                    if ($cate_id->product_quantity <= 10) {
                                        echo '<span class="badge bg-secondary">hết hàng</span>';
                                    }
                                @endphp
                            </div>
                            <div class="d-flex justify-content-center gap-2">
                                <h5 class="card-title text-center"
                                    style="font-size: 1rem; color: red; margin-right: 0.1rem;">
                                    {{ number_format($cate_id->product_price * (1 - $cate_id->product_discount / 100), 0, ',', '.') }}đ
                                </h5>
                                <h5 class="card-title text-center" style="font-size: 1rem;"><del>
                                        {{ number_format($cate_id->product_price, 0, ',', '.') }}đ</del>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <footer class="panel-footer">
        {{ $category_all_product->links() }}
    </footer>
@endsection
