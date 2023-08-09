@extends('layout')
@section('content')
    <!-- carousel -->
    @include('layout.carousel')
    <!-- end carousel -->
    <h3 style="text-align:center; margin-top: 1rem; margin-bottom: 1rem">FOR THE HARDEST WORKERS IN THE TEAM</h3>
    <div class="horizontal-line"></div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-sm-2 row-cols-lg-4">
        @foreach ($all_product as $key => $product)
            <div class="col mb-4">
                <div class="card border-0">
                    <a href="{{ URL::to('/chi-tiet-san-pham/'.$product->product_id) }}" class="d-flex justify-content-center align-items-center">
                        <img style="height: 16rem; width: 14rem; object-fit: cover;"
                            src="{{ asset('public/uploads/product/' . $product->product_image) }}" class="card-img-top"
                            alt="">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-center" style="font-size: 1rem">{{$product->product_name}}</h5>
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

    <h3 style="text-align:center; margin-top: 1rem; margin-bottom: 1rem">NEWS AND TRAINING</h3>
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
                    <a href="{{ URL::to('/chi-tiet-san-pham/'.$product_basic->product_id) }}" class="d-flex justify-content-center align-items-center">
                        <img style="height: 16rem; width: 14rem; object-fit: cover;"
                            src="{{ asset('public/uploads/product/' . $product_basic->product_image) }}" class="card-img-top"
                            alt="">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-center" style="font-size: 1rem">{{$product_basic->product_name}}</h5>
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
    <h3 style="text-align:center; margin-top: 1rem; margin-bottom: 1rem">STACK & GROW</h3>
    <div class="row row-cols-1 row-cols-md-2 row-cols-sm-2 row-cols-lg-4">
        @foreach ($all_product_stack as $key => $product_stack)
            <div class="col mb-4">
                <div class="card border-0">
                    <a href="{{ URL::to('/chi-tiet-san-pham/'.$product_stack->product_id) }}" class="d-flex justify-content-center align-items-center">
                        <img style="height: 16rem; width: 14rem; object-fit: cover;"
                            src="{{ asset('public/uploads/product/' . $product_stack->product_image) }}" class="card-img-top"
                            alt="">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-center" style="font-size: 1rem">{{$product_stack->product_name}}</h5>
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
@endsection
