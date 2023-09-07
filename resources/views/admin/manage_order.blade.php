@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ORDER LIST
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        <strong>Error!</strong> {{ session('error') }}
                    </div>
                @endif
                <br>
                <div style="margin-left: 1rem; margin-bottom:1rem">
                    total: {{ $count_order }} items
                </div>
                <div style="margin-left: 1rem">
                    <span class="badge bg-dark" style=margin-right:1rem">{{ $count_orderst_1 }} order in process</span>
                    <span class="badge bg-info" style="margin-right:1rem; color: white">{{ $count_orderst_2 }} in
                        shipping</span>
                    <span class="badge bg-success" style="margin-right:1rem; color: white">{{ $count_orderst_3 }} ship
                        successfully</span>
                    <span class="badge bg-warning" style="margin-right:1rem; color: white">{{ $count_orderst_4 }} order
                        refunded</span>
                    <span class="badge bg-danger" style="margin-right:1rem; color: white">{{ $count_orderst_5 }}
                        order cancelled</span>
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
                                <th>order id</th>
                                <th>address</th>
                                <th>customer name</th>
                                <th>shipper</th>
                                <th>total</th>
                                <th>condition</th>
                                <th>payment method</th>
                                <th>order date</th>
                                <th>action</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_order as $key => $order)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                name="post[]"><i></i></label>
                                    </td>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->district_name }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->admin_name }}</td>
                                    <td>{{ number_format($order->order_total, 0, ',', '.') }}đ</td>
                                    <td>
                                        @if ($order->order_status == 1)
                                            <span class="badge bg-primary">order in process</span>
                                        @elseif($order->order_status == 2)
                                            <span class="badge bg-info" style="color: white">in
                                                shipping</span>
                                        @elseif($order->order_status == 3)
                                            <span class="badge bg-success" style="color: white">ship
                                                successfully</span>
                                        @elseif($order->order_status == 4)
                                            <span class="badge bg-warning text-dark">order refunded</span>
                                        @elseif($order->order_status == 5)
                                            <span class="badge bg-danger">order cancelled</span>
                                        @else
                                            <span class="badge bg-secondary">not existed</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->payment_method == 1)
                                            <span class="badge bg-warning" style="color:white">By ATM</span>
                                        @elseif ($order->payment_method == 2)
                                            <span class="badge bg-info" style="color:white">By Cash</span>
                                        @else
                                            <span class="badge bg-secondary">Unknown</span>
                                        @endif
                                    </td>


                                    <td>{{ $order->created_at }}</td>

                                    <td>
                                        <a href="{{ URL::to('/view-order/' . $order->order_id) }}"
                                            class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-eye text-success text-active"></i>
                                        </a>
                                        <a href="{{ URL::to('/edit-order-status/' . $order->order_id) }}"
                                            class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-pencil text-success text-active"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-7 text-right text-center-xs">
                            {{ $all_order->links() }}
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection
