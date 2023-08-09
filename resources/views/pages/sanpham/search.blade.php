@extends('collection')
@section('product_content')
    <h2>kết quả tìm kiếm</h2>
    <div class="container-fluid mt-2">
        <div class="row row-cols-1 row-cols-md-2 row-cols-sm-2 row-cols-lg-4">
            @foreach ($search_product as $key => $product)
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
                                <h5 class="card-title text-center"
                                    style="font-size: 1rem; color: red; margin-right: 0.1rem;">
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
    </div>
@endsection