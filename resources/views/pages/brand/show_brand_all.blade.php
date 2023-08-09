@extends('collection')
@section('product_content')
    <!-- phần hiển thị -->
    <div class="d-flex">
        <div class="container row row-cols-1 row-cols-md-2 row-cols-sm-2 row-cols-lg-4">
            @foreach ($brand_all_product as $key => $brand_id)
                <div class="container col mb-4">
                    <div class="card border-0">
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$brand_id->product_id)}}" class="d-flex justify-content-center align-items-center">
                            <img style="height: 16rem; width: 14rem; object-fit: cover;"
                                src="{{ asset('public/uploads/product/' . $brand_id->product_image) }}" class="card-img-top"
                                alt="">
                        </a>
                        <div class="card-body d-flex flex-column align-items-center">

                            <div class="d-flex justify-content-center mb-2">
                                <h5 class="card-title text-center" style="font-size: 1rem; width: 14rem;">
                                    {{ $brand_id->product_name }} </h5>
                            </div>
                            <div class="d-flex justify-content-center gap-2">
                                <h5 class="card-title text-center"
                                    style="font-size: 1rem; color: red; margin-right: 0.1rem;">
                                    {{ number_format($brand_id->product_price * (1 - $brand_id->product_discount / 100), 0, ',', '.') }}đ
                                </h5>
                                <h5 class="card-title text-center" style="font-size: 1rem;"><del>
                                        {{ number_format($brand_id->product_price, 0, ',', '.') }}đ</del>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <footer class="panel-footer">
        {{ $brand_all_product->links() }}
    </footer>
@endsection
