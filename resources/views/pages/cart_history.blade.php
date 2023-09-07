@extends('collection')
@section('header')
    <title>cart history</title>
@endsection
@section('product_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3>CART HISTORY</h3>
                </header>
                <div class="panel-body">
                    @foreach ($cart_history as $hist)
                        <hr style="border-top: 1rem solid black; margin-top:2rem; margin-bottom:2rem">
                        <table class="table table-striped table-hover table-bordered"> <!-- Thêm lớp table-bordered -->
                            <thead class="table-primary">
                                <tr>
                                    <th>Order id</th>
                                    <th>Total Must Pay</th>
                                    <th>Condition</th>
                                    <th>Order date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $hist->order_id }}</td>
                                    <td>
                                        <p style="color: red; font-weight:bold">
                                            {{ number_format($hist->order_total, 0, ',', '.') }}đ</p>
                                    </td>
                                    <td>
                                        @if ($hist->order_status == 1)
                                            <span class="badge bg-dark">order
                                                in process</span>
                                        @elseif($hist->order_status == 2)
                                            <span class="badge bg-info">in
                                                shipping</span>
                                        @elseif($hist->order_status == 3)
                                            <span class="badge bg-success">ship
                                                successfully</span>
                                        @elseif($hist->order_status == 4)
                                            <span class="badge bg-warning text-dark">order
                                                refunded</span>
                                        @elseif($hist->order_status == 5)
                                            <span class="badge bg-danger">order
                                                cancelled</span>
                                        @else
                                            <span class="badge bg-secondary">not exist</span>
                                        @endif
                                    </td>
                                    <td>{{ $hist->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered table-hover"> <!-- Thêm lớp table-bordered -->
                            <thead class="table-primary">
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart_history_detail as $item)
                                    @if ($item->order_id == $hist->order_id)
                                        <tr>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->product_sales_quantity }}</td>
                                            <td>{{ number_format($item->product_price, 0, ',', '.') }}đ</td>
                                            <td>{{ $item->product_flavour }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </section>
        </div>
        {{ $cart_history->links() }}
    </div>
@endsection
