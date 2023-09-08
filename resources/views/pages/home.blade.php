@extends('layout')
@section('content')
    <style>
        /* CSS cho màu chữ trên slider */
        @media (max-width: 767px) {

            /* Điều này áp dụng cho thiết bị di động có độ rộng màn hình tối đa 767px */
            .carousel-item {
                background-color: black;
                /* Đặt màu nền của carousel thành màu đen */
                color: white;
                /* Đặt màu chữ thành màu trắng */
                padding: 20px;
                /* Tạo khoảng cách xung quanh nội dung của carousel */
                border-radius: 10px;
                /* Tạo góc bo cho khung đen */
            }

            .carousel-item h3,
            /* Chọn tất cả thẻ h3 trong .carousel-item */
            .carousel-item h1,
            /* Chọn tất cả thẻ h1 trong .carousel-item */
            .carousel-item h3.text-light,
            /* Chọn tất cả thẻ h3 có class "text-light" trong .carousel-item */
            .carousel-control-prev,
            /* Chọn nút Previous */
            .carousel-control-next {
                /* Chọn nút Next */
                color: black !important;
                /* Đặt màu chữ thành màu đen */
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- carousel -->
    @include('layout.carousel')
    <!-- end carousel -->
    <h3 style="text-align:center; margin-top: 1rem; margin-bottom: 1rem">FOR THE HARDEST WORKERS IN THE TEAM</h3>
    <div class="horizontal-line"></div>
    {{-- Phần hiển thị danh sách coupon --}}
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($validCoupons as $key => $coupon_item)
                @if ($coupon_item->coupon_time == 1 && $coupon_item->coupon_expire_date > $currentDate)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="container">
                            <div class="row justify-content-center align-items-center coupon-card">
                                <div class="col-md-8">
                                    <div class="text-center">
                                        <h3 class="text-{{ Request::is('mobile') ? 'dark' : 'light' }}">
                                            {{ $coupon_item->coupon_name }}</h3>
                                        @php
                                            $currentDate = \Carbon\Carbon::now()->format('Y-m-d');
                                        @endphp
                                        <p>
                                        <h1>{{ $coupon_item->coupon_code }}</h1>
                                        <h3 class="text-{{ Request::is('mobile') ? 'dark' : 'light' }}">
                                            @if ($coupon_item->coupon_number >= 1000)
                                                Discount {{ number_format($coupon_item->coupon_number, 0, ',', '.') }}đ
                                            @elseif ($coupon_item->coupon_number >= 1 && $coupon_item->coupon_number <= 100)
                                                Discount {{ $coupon_item->coupon_number }}%
                                            @else
                                                Discount {{ $coupon_item->coupon_number }}
                                            @endif
                                            for total value
                                        </h3>
                                        <button id="copyButton" class="btn btn-success copy-button"
                                            data-clipboard-text="{{ $coupon_item->coupon_code }}">
                                            Copy Coupon
                                        </button>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>


    <div class="row row-cols-1 row-cols-md-2 row-cols-sm-2 row-cols-lg-4">
        @foreach ($all_product as $key => $product)
            <div class="col mb-4">
                <div class="card border-0">
                    <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}"
                        class="d-flex justify-content-center align-items-center">
                        <img style="height: 16rem; width: 14rem; object-fit: cover;"
                            src="{{ asset('public/uploads/product/' . $product->product_image) }}" class="card-img-top"
                            alt="">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-center" style="font-size: 1rem">{{ $product->product_name }}</h5>
                        <div class="d-flex" style="justify-content: center; gap: 10px;">
                            <h5 class="card-title text-center" style="font-size: 1rem; color: red; margin-right: 0.1rem;">
                                {{ number_format($product->product_price * (1 - $product->product_discount / 100), 0, ',', '.') }}đ
                            </h5>
                            <h5 class="card-title text-center" style="font-size: 1rem;">
                                <del>{{ number_format($product->product_price, 0, ',', '.') }}đ</del>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @include('layout.split_img')

    <h3 style="text-align:center; margin-top: 1rem; margin-bottom: 1rem">BASICS AND VITAMINS</h3>
    <div class="horizontal-line"></div>
    <br>
    <div class="d-flex">
        <img style="width: 100%" src="https://axeandsledge.com/cdn/shop/files/Website_Banners2-20_1400x.jpg?v=1686768212"
            alt="">
    </div>
    <br>
    {{-- <h3 style="text-align:center; margin-top: 1rem; margin-bottom: 1rem">AXE & SLEDGE APPAREL</h3> --}}
    <div class="horizontal-line"></div>
    <br>
    <div class="row row-cols-1 row-cols-md-2 row-cols-sm-2 row-cols-lg-4">
        @foreach ($all_product_basic as $key => $product_basic)
            <div class="col mb-4">
                <div class="card border-0">
                    <a href="{{ URL::to('/chi-tiet-san-pham/' . $product_basic->product_id) }}"
                        class="d-flex justify-content-center align-items-center">
                        <img style="height: 16rem; width: 14rem; object-fit: cover;"
                            src="{{ asset('public/uploads/product/' . $product_basic->product_image) }}"
                            class="card-img-top" alt="">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-center" style="font-size: 1rem">{{ $product_basic->product_name }}</h5>
                        <div class="d-flex" style="justify-content: center; gap: 10px;">
                            <h5 class="card-title text-center" style="font-size: 1rem; color: red; margin-right: 0.1rem;">
                                {{ number_format($product_basic->product_price * (1 - $product_basic->product_discount / 100), 0, ',', '.') }}đ
                            </h5>
                            <h5 class="card-title text-center" style="font-size: 1rem;">
                                <del>{{ number_format($product_basic->product_price, 0, ',', '.') }}đ</del>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <h3 style="text-align:center; margin-top: 1rem; margin-bottom: 1rem"></h3>
    <div class="row row-cols-1 row-cols-md-2 row-cols-sm-2 row-cols-lg-4">
        @foreach ($all_product_stack as $key => $product_stack)
            <div class="col mb-4">
                <div class="card border-0">
                    <a href="{{ URL::to('/chi-tiet-san-pham/' . $product_stack->product_id) }}"
                        class="d-flex justify-content-center align-items-center">
                        <img style="height: 16rem; width: 14rem; object-fit: cover;"
                            src="{{ asset('public/uploads/product/' . $product_stack->product_image) }}"
                            class="card-img-top" alt="">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-center" style="font-size: 1rem">{{ $product_stack->product_name }}</h5>
                        <div class="d-flex" style="justify-content: center; gap: 10px;">
                            <h5 class="card-title text-center" style="font-size: 1rem; color: red; margin-right: 0.1rem;">
                                {{ number_format($product_stack->product_price * (1 - $product_stack->product_discount / 100), 0, ',', '.') }}đ
                            </h5>
                            <h5 class="card-title text-center" style="font-size: 1rem;">
                                <del>{{ number_format($product_stack->product_price, 0, ',', '.') }}đ</del>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <div class="horizontal-line"></div>
    @include('layout.news_letter')
    <script>
        // Khởi tạo Clipboard.js
        var clipboard = new ClipboardJS('#copyButton');
    
        // Xử lý khi sao chép thành công
        clipboard.on('success', function(e) {
            // Hiển thị thông báo
            alert('Copy coupon code successfully !');
        });
    
        // Xử lý khi sao chép thất bại
        clipboard.on('error', function(e) {
            // Hiển thị thông báo lỗi (nếu cần)
            alert('Copy failed. Please try again.');
        });
    </script>
    
@endsection
