@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liệt kê đơn hàng
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

                <div class="row w3-res-tb">
                    <div class="col-sm-5 m-b-xs">
                        <select class="input-sm form-control w-sm inline v-middle">
                            <option value="0">Bulk action</option>
                            <option value="1">Delete selected</option>
                            <option value="2">Bulk edit</option>
                            <option value="3">Export</option>
                        </select>
                        <button class="btn btn-sm btn-default">Apply</button>
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
                <div style="margin-left: 1rem; margin-bottom:1rem">
                    total: {{ $count_order }} đơn hàng
                </div>
                <div style="margin-left: 1rem">
                    <span class="badge bg-dark" style= margin-right:1rem">{{ $count_orderst_1 }} đơn đang xử lý</span>
                    <span class="badge bg-info" style="margin-right:1rem; color: white">{{ $count_orderst_2 }} đơn đang giao</span>
                    <span class="badge bg-success" style="margin-right:1rem; color: white">{{ $count_orderst_3 }} đơn giao thành công</span>
                    <span class="badge bg-warning" style="margin-right:1rem; color: white">{{ $count_orderst_4 }} đơn trả</span>
                    <span class="badge bg-danger" style="margin-right:1rem; color: white">{{ $count_orderst_5 }} đơn hủy</span>
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
                                <th>tên người đặt</th>
                                <th>tổng giá tiền</th>
                                <th>tình trạng</th>
                                <th>ngày đặt</th>
                                <th>hành động</th>
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
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ number_format($order->order_total, 0, ',', '.') }}đ</td>
                                    <td>
                                        @if ($order->order_status == 1)
                                            <span class="badge bg-primary">Đang xử lý đơn hàng</span>
                                        @elseif($order->order_status == 2)
                                            <span class="badge bg-info" style="color: white">Đang giao hàng</span>
                                        @elseif($order->order_status == 3)
                                            <span class="badge bg-success" style="color: white">Giao hàng thành công</span>
                                        @elseif($order->order_status == 4)
                                            <span class="badge bg-warning text-dark">Trả lại hàng</span>
                                        @elseif($order->order_status == 5)
                                            <span class="badge bg-danger">Hủy hàng</span>
                                        @else
                                            <span class="badge bg-secondary">Đơn hàng không tồn tại</span>
                                        @endif
                                    </td>                                    
                                    <td>{{ $order->created_at }}</td>

                                    <td>
                                        <a href="{{ URL::to('/view-order/' . $order->order_id) }}"
                                            class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-eye text-success text-active"></i>
                                        </a>
                                        <a onclick="return confirm('are you sure to delete this order?')"
                                            href="{{ URL::to('/delete-order/' . $order->order_id) }}"
                                            class="active styling-delete" ui-toggle-class="">
                                            <i class="fa fa-trash text-danger text"></i>
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
