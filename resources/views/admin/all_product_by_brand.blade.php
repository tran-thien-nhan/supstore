@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    PRODUCT LIST
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="row w3-res-tb">
                    <div class="col-sm-3 m-b-xs dropdown">
                        <div class="category-group">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="categoryDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                --Select a Category--
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                <li value="all"><a class="dropdown-item" href="{{ URL::to('/all-product') }}">all</a>
                                </li>
                                @foreach ($all_category_product as $key => $cate_product)
                                    <li value="{{ $cate_product->category_name }}"><a class="dropdown-item"
                                            href="{{ URL::to('/all-product/category-product/' . $cate_product->category_id) }}">{{ $cate_product->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-1 m-b-xs dropdown">
                        <div class="brand-group">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="brandDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                --Select a Brand--
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="brandDropdown">
                                <li value="all"><a class="dropdown-item" href="{{ URL::to('/all-product') }}">all</a>
                                </li>
                                @foreach ($all_brand_product as $key => $brand_product)
                                    <li value="{{ $brand_product->brand_name }}"><a class="dropdown-item"
                                            href="{{ URL::to('/all-product/brand-product/' . $brand_product->brand_id) }}">{{ $brand_product->brand_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                        <form action="{{ route('admin.product.all_product') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="input-sm form-control" name="search" placeholder="Search by Product ID or Name">
                                <span class="input-group-btn">
                                    <button class="btn btn-sm btn-success" type="submit">Search</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                {{-- <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th> --}}
                                <th>product id</th>
                                <th>Product Name</th>
                                <th>Product Quantity</th>
                                <th>price</th>
                                <th>discount</th>
                                <th>Image</th>
                                <th>flavour</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Product Point</th>
                                <th>Visibility</th>
                                {{-- <th>mô tả </th> --}}
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brand_by_id as $key => $pro)
                                <tr>
                                    {{-- <td><label class="i-checks m-b-none"><input type="checkbox"
                                                name="post[]"><i></i></label>
                                    </td> --}}
                                    <td>PD-{{ $pro->product_id }}</td>
                                    <td>{{ $pro->product_name }}</td>
                                    <td>{{ $pro->product_quantity }}</td>
                                    <td>{{ number_format($pro->product_price, 0, ',', '.') }}đ</td>
                                    <td>{{ $pro->product_discount }}%</td>
                                    <td>
                                        <img src="{{ asset('public/uploads/product/' . $pro->product_image) }}"
                                            height="100" width="100" alt="">
                                    </td>
                                    <td>{{ $pro->product_flavour }}</td>
                                    <td>{{ $pro->category_name }}</td>
                                    <td>{{ $pro->brand_name }}</td>
                                    <td>{{ number_format($pro->product_point, 1) }}</td>
                                    <td>
                                        <span class="text-ellipsis">
                                            <?php 
                                            if ($pro->product_status == 0){
                                            ?>

                                            <a href="{{ URL::to('/unactive-product/' . $pro->product_id) }}">
                                                <span class="fa-thumb-styling fa fa-thumbs-up"></span>
                                            </a>

                                            <?php
                                            }else{
                                            ?>

                                            <a href="{{ URL::to('/active-product/' . $pro->product_id) }}">
                                                <span class="fa-thumb-styling fa fa-thumbs-down"></span>
                                            </a>

                                            <?php
                                            }
                                            ?>
                                        </span>
                                    </td>
                                    {{-- <td>{{ $pro->product_desc }}</td> --}}
                                    <td>
                                        <a href="{{ URL::to('/edit-product/' . $pro->product_id) }}"
                                            class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                                        </a>
                                        {{-- <a onclick="return confirm('are you sure to delete?')"
                                            href="{{ URL::to('/delete-product/' . $pro->product_id) }}"
                                            class="active styling-delete" ui-toggle-class="">
                                            <i class="fa fa-trash text-danger text"></i>
                                        </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <footer class="panel-footer">
                    <div class="row">

                        <div class="col-sm-5 text-center">
                            {{-- <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> --}}
                        </div>
                        <div class="col-sm-7 text-right text-center-xs">
                            {{-- {{ $all_product->links() }} --}}
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection
