@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liệt kê sản phẩm
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="row w3-res-tb">
                    <div class="col" style="margin-left:1rem; margin-bottom:1rem">
                        <form method="GET" action="{{ route('filterData') }}">
                            <label for="start_date">Ngày bắt đầu:</label>
                            <input type="date" name="start_date" id="start_date">

                            <label for="end_date">Ngày kết thúc:</label>
                            <input type="date" name="end_date" id="end_date">

                            <button type="submit">Lọc</button>
                        </form>
                    </div>
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
                        <div class="input-group">
                            <input type="text" class="input-sm form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-default" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>tên sản phẩm</th>
                                <th>só lượng</th>
                                <th>price</th>
                                <th>discount</th>
                                <th>hình sản phẩm</th>
                                <th>flavour</th>
                                <th>danh mục</th>
                                <th>thương hiệu</th>
                                <th>điểm SP</th>
                                <th>hiển thị</th>
                                {{-- <th>mô tả </th> --}}
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_product as $key => $pro)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                name="post[]"><i></i></label>
                                    </td>
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
                                        <a onclick="return confirm('are you sure to delete?')"
                                            href="{{ URL::to('/delete-product/' . $pro->product_id) }}"
                                            class="active styling-delete" ui-toggle-class="">
                                            <i class="fa fa-trash text-danger text"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <footer class="panel-footer">
                    <div class="row">

                        <div class="col-sm-5 text-center">
                            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                        </div>
                        <div class="col-sm-7 text-right text-center-xs">
                            {{ $all_product->links() }}
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection
