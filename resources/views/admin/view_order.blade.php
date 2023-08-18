@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    thông tin khách hàng
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>tên người đặt</th>
                                <th>số điện thoại</th>
                                <th>địa chỉ</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $order_by_id->customer_name }}</td>
                                <td>{{ $order_by_id->customer_phone }}</td>
                                <td>{{ $order_by_id->customer_address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    thông tin vận chuyển
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>tên người vận chuyển</th>
                                <th>địa chỉ</th>
                                <th>số điện thoại</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ $order_by_id->shipping_name }}</td>
                                <td>{{ $order_by_id->shipping_address }}</td>
                                <td>{{ $order_by_id->shipping_phone }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    liệt kê chi tiết đơn hàng
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>tên sản phẩm</th>
                                <th>số lượng</th>
                                <th>giá</th>
                                <th>tổng tiền</th>
                                <th>chi tiết đơn hàng</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalOrderAmount = 0;
                            @endphp
                            @foreach ($list_product_by_id as $key => $item)
                                @php
                                    $totalPrice = $item->product_price * $item->product_sales_quantity;
                                    $totalOrderAmount += $totalPrice;
                                @endphp
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->product_sales_quantity }}</td>
                                    <td>{{ number_format($item->product_price, 0, ',', '.') }}đ</td>
                                    <td>{{ number_format($totalPrice, 0, ',', '.') }}đ</td>
                                    <td>{{ $item->product_flavour }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3"></th>
                                <th>tổng tiền:</th>
                                <th>{{ number_format($totalOrderAmount, 0, ',', '.') }}đ</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th>giảm giá:</th>
                                <th>-{{ number_format($totalOrderAmount - $item->order_total, 0, ',', '.') }}đ</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th>tổng tiền phải trả:</th>
                                <th><span style="color:red">{{ number_format($item->order_total, 0, ',', '.') }}đ</span>
                                </th>
                                <th></th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
