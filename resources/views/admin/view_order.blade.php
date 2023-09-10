@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    CUSTOMER INFOMATION
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
                                <th>customer name</th>
                                <th>phone</th>
                                <th>address</th>
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
                    SHIPPING INFOMATION
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
                                <th>address on bill</th>
                                <th>phone on bill</th>
                                <th>customer noted</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ $order_by_id->shipping_address }}</td>
                                <td>{{ $order_by_id->shipping_phone }}</td>
                                <td>{{ $order_by_id->shipping_notes }}</td>
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
                    ORDER DETAIL LIST
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
                                <th>item</th>
                                <th>quantity</th>
                                <th>cost</th>
                                <th>total</th>
                                <th>detail</th>
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
                                <th>total:</th>
                                <th>{{ number_format($totalOrderAmount, 0, ',', '.') }}đ</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th>discount:</th>
                                <th>-{{ number_format($totalOrderAmount - $item->order_total, 0, ',', '.') }}đ</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th>total must pay:</th>
                                <th><span style="color:red">{{ number_format($item->order_total, 0, ',', '.') }}đ</span>
                                </th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
            <div class="row">
                <a href="{{ url('/manage-order') }}" class="btn btn-warning" style="float: right;">Back</a>
            </div>
        </div>
    </div>
    <br>
@endsection
