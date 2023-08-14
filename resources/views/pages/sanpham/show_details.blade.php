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
        /* Style for comment form */
        .comment-form {
            margin-bottom: 20px;
        }

        .comment-form form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .comment-form textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }

        .comment-form button {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Style for comment list */
        .comment-list {
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        .comment {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .comment-content {
            margin-bottom: 5px;
        }

        .comment-info {
            font-size: 12px;
            color: #777;
        }

        .comment-author {
            margin-right: 10px;
        }

        .comment-date {
            font-style: italic;
            margin-bottom: 0rem;
        }

        /* Additional styles for comment box */
        .box-product-mini {
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
@section('product_content')
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    {{-- <script src="sweetalert2.min.js"></script> --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid mt-2">
        <div class="container d-flex justify-content-center">
            @foreach ($detail_product_by_id as $key => $detail_product_by_id)
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ URL::to('public/uploads/product/' . $detail_product_by_id->product_image) }}"
                            alt="" class="img-fluid">

                        <div id="similar-product" class="carousel slide" data-bs-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row justify-content-around">
                                        <div class="col-4">
                                            <a href="#"><img
                                                    src="https://cdn.shopify.com/s/files/1/0018/3808/8244/files/the-grind-tropic-thunder.png?v=1685127156"
                                                    alt="" width="180px" height="180px"></a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"><img
                                                    src="https://cdn.shopify.com/s/files/1/0018/3808/8244/files/the-grind-big-melons-ocean.png?v=1685127178"
                                                    alt="" width="180px" height="180px"></a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"><img
                                                    src="https://cdn.shopify.com/s/files/1/0018/3808/8244/files/the-grind-sfp.png?v=1685132370"
                                                    alt="" width="180px" height="180px"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row justify-content-around">
                                        <div class="col-4">
                                            <a href="#"><img
                                                    src="https://cdn.shopify.com/s/files/1/0018/3808/8244/files/the-grind-tropic-thunder.png?v=1685127156"
                                                    alt="" width="180px" height="180px"></a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"><img
                                                    src="https://cdn.shopify.com/s/files/1/0018/3808/8244/files/the-grind-big-melons-ocean.png?v=1685127178"
                                                    alt="" width="180px" height="180px"></a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"><img
                                                    src="https://cdn.shopify.com/s/files/1/0018/3808/8244/files/the-grind-sfp.png?v=1685132370"
                                                    alt="" width="180px" height="180px"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row justify-content-around">
                                        <div class="col-4">
                                            <a href="#"><img
                                                    src="https://cdn.shopify.com/s/files/1/0018/3808/8244/files/the-grind-tropic-thunder.png?v=1685127156"
                                                    alt="" width="180px" height="180px"></a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"><img
                                                    src="https://cdn.shopify.com/s/files/1/0018/3808/8244/files/the-grind-big-melons-ocean.png?v=1685127178"
                                                    alt="" width="180px" height="180px"></a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"><img
                                                    src="https://cdn.shopify.com/s/files/1/0018/3808/8244/files/the-grind-sfp.png?v=1685132370"
                                                    alt="" width="180px" height="180px"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#similar-product"
                                data-bs-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#similar-product"
                                data-bs-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h4 style="margin-top: 6rem;">{{ $detail_product_by_id->product_name }}</h4>
                        <div class="fb-save"
                            data-uri="{{ URL::to('/chi-tiet-san-pham/' . $detail_product_by_id->product_id) }}"
                            data-size=""></div>
                        <div class="horizon-line"></div>
                        <div class="d-flex">
                            <h4 style="color: red; font-weight: bold; margin-right: 1rem">
                                {{ number_format($detail_product_by_id->product_price * (1 - $detail_product_by_id->product_discount / 100), 0, ',', '.') }}đ
                            </h4>

                            <h4><del>{{ number_format($detail_product_by_id->product_price, 0, ',', '.') }}đ</del></h4>

                            <h5 class="mx-4"><span
                                    class="badge bg-success">-{{ $detail_product_by_id->product_discount }}%</span></h5>
                        </div>
                        <div class="my-2">
                            <h6><em>(tiết kiệm
                                    {{ number_format($detail_product_by_id->product_price - $detail_product_by_id->product_price * (1 - $detail_product_by_id->product_discount / 100), 0, ',', '.') }}đ)</em>
                            </h6>
                        </div>
                        <div class="mb-3">

                            <div class="dropdown">
                                <button class="btn btn-outline-dark dropdown-toggle" type="button" id="flavourDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Select Flavour
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="flavourDropdown">
                                    @foreach ($detail_product_by_flavours as $detail_product_by_flavour)
                                        <li><a class="dropdown-item"
                                                href="{{ URL::to('/chi-tiet-san-pham/' . $detail_product_by_flavour->product_id) }}">{{ $detail_product_by_flavour->product_flavour }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="my-2 d-flex">
                                <h6 for="brand" class="mx-2 my-1">tình trạng: </h6>
                                @php
                                    if ($detail_product_by_id->product_quantity <= 25) {
                                        echo '<h5><span class="badge bg-secondary">hết hàng</span></h5>';
                                    } else {
                                        echo '<h5><span class="badge bg-danger">còn hàng</span></h5>';
                                    }
                                @endphp
                            </div>
                            <div class="my-2 d-flex">
                                <h6 for="brand" class="mx-2 my-1">thương hiệu: </h6>
                                <h5><span class="badge bg-dark">{{ $detail_product_by_id->brand_name }}</span></h5>
                            </div>
                            <div class="my-2 d-flex">
                                <h6 for="brand" class="mx-2 my-1">hương vị: </h6>
                                <h5><span class="badge bg-dark">{{ $detail_product_by_id->product_flavour }}</span>
                                </h5>
                            </div>
                            <div class="my-2 d-flex">
                                <h6 for="brand" class="mx-2 my-1">product point: </h6>
                                <h5><span
                                        class="badge bg-dark">+{{ number_format($detail_product_by_id->product_point, 1) }}
                                        điểm</span>
                                </h5>
                            </div>
                            <div class="my-2">
                                <div class="btn btn-primary" data-href="{{ URL::current() }}" data-layout=""
                                    data-size="">
                                    <a target="_blank"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(URL::current()) }}&amp;src=sdkpreparse"
                                        class="fb-xfbml-parse-ignore text-white" style="text-decoration: none;">
                                        <i class="fa-brands fa-facebook"></i> Chia sẻ
                                    </a>
                                </div>
                            </div>

                            <form action="{{ URL::to('/save-cart/' . $detail_product_by_id->product_id) }}"
                                method="post">
                                @csrf
                                <div class="d-flex">
                                    <div class="d-flex justify-content-left align-items-left mt-2">
                                        <button type="button" class="btn btn-light" aria-label="button"
                                            onclick="decreaseQuantity()">
                                            -
                                        </button>

                                        <!-- Change the name attribute to "quantity_input" -->
                                        <input style="text-align: center" type="number" value="1" min="1"
                                            max="1606" name="quantity_input" class="mx-2" aria-label="qty"
                                            id="quantity-input">

                                        <!-- Keep the hidden field for product ID -->
                                        <input type="hidden" value="{{ $detail_product_by_id->product_id }}"
                                            name="product_id">

                                        <button type="button" class="btn btn-light" aria-label="button"
                                            onclick="increaseQuantity()">
                                            +
                                        </button>
                                    </div>

                                    <div>
                                        <button type="submit" value="add to cart" name="add_to_cart"
                                            id="addToCartButton" class="btn btn-dark text-white mt-4"
                                            style="margin-left: 2rem; font-weight: bold">ADD TO CART</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col" style="width: 75%">
                {!! $detail_product_by_id->product_content !!}
            </div>
        </div>
        {{-- <div class="fb-comments" data-href="{{ URL::current() }}" data-width="100%" data-numposts="20">
        </div> --}}
        <span type="button" class="button-cm mt-10 write-rate"
            style="background: #005696; font-size: 17px; text-align: left; padding: 10px; border: none; color: white">Phần Bình Luận ({{$comments_count}})</span>
        @foreach ($product->comments as $comment)
            @if ($comment->approved)
                <div class="box-product-mini index mb-4" id="comment-{{ $comment->comment_id }}">
                    <div class="row align-items-center">
                        <div class="col-md-1">
                            <a href="#" class="image d-block">
                                <img src="https://www.wheystore.vn/asset/site/images/user.jpg"
                                    alt="Bình luận của khách {{ $comment->customer->customer_name }}"
                                    title="Bình luận của khách {{ $comment->customer->customer_name }}"
                                    class="img-fluid rounded-circle" width="55" height="55">
                            </a>
                        </div>
                        <div class="col-md-9">
                            <div class="about">
                                <p class="title d-flex mt-0 mb-0 cm-font">
                                    <b>
                                        {{ $comment->customer->customer_name }} -
                                        {{ substr_replace($comment->customer->customer_phone, 'xxx', -3) }}
                                    </b>
                                </p>
                                <p class="comment-date">
                                    {{ $comment->created_at->format('Y-m-d H:i:s') }}
                                </p>
                                <div class="star" total="5" point="5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= 5)
                                            <i class="fas fa-star mr-1 text-warning"></i>
                                        @else
                                            <i class="far fa-star mr-1 text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                                <p class="comment-content">
                                    {{ $comment->content }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        @if (Session::has('customer_id'))
            <div class="comment-form">
                <form method="POST" action="{{ route('submit.comment') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <textarea name="content" placeholder="Enter your comment"></textarea>
                    <button type="submit">Submit Comment</button>
                </form>
            </div>
        @else
            <em class="text-primary">Vui Lòng Đăng Nhập Để Nhập Bình Luận.</em>
            <a href="{{ url('/login-checkout') }}" class="btn btn-success my-2">Login</a>
        @endif

        <hr>
        <h2 class="title text-center">RELATED PRODUCTS</h2>
        <hr>
        <div class="row d-flex">
            @foreach ($relate as $key => $related_product)
                <div class="col mb-4">
                    <div class="card border-0">
                        <a href="{{ URL::to('/chi-tiet-san-pham/' . $related_product->product_id) }}"
                            class="d-flex justify-content-center align-items-center">
                            <img style="height: 16rem; width: 14rem; object-fit: cover;"
                                src="{{ asset('public/uploads/product/' . $related_product->product_image) }}"
                                class="card-img-top" alt="">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title text-center" style="font-size: 1rem">
                                {{ $related_product->product_name }}</h5>
                            <div class="d-flex" style="justify-content: center; gap: 10px;">
                                <h5 class="card-title text-center"
                                    style="font-size: 1rem; color: red; margin-right: 0.1rem;">
                                    {{ number_format($related_product->product_price * (1 - $related_product->product_discount / 100), 0, ',', '.') }}đ
                                </h5>
                                <h5 class="card-title text-center" style="font-size: 1rem;">
                                    <del>{{ number_format($related_product->product_price, 0, ',', '.') }}đ</del>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- JavaScript -->
    {{-- <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     alertify.set('notifier', 'position', 'top-right');
        // });

        function decreaseQuantity() {
            var quantityInput = document.getElementById('quantity-input');
            var currentQuantity = parseInt(quantityInput.value);
            var minQuantity = parseInt(quantityInput.min);
            if (currentQuantity > minQuantity) {
                quantityInput.value = currentQuantity - 1;
            }
        }

        function increaseQuantity() {
            var quantityInput = document.getElementById('quantity-input');
            var currentQuantity = parseInt(quantityInput.value);
            var maxQuantity = parseInt(quantityInput.max);
            if (currentQuantity < maxQuantity) {
                quantityInput.value = currentQuantity + 1;
            }
        }

        // Add this function to show the alert when "ADD TO CART" button is clicked
        document.getElementById("addToCartButton").addEventListener("click", function() {
            //alertify.success('Added to cart successfully!');   
            swal("Successfully!", "added product successfully!", "success");
        });
    </script>
@endsection
