@extends('collection')
@section('header')
    <title>cart history</title>
@endsection
@section('product_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3>Lịch sử các đơn hàng</h3>
                </header>
                <div class="panel-body">
                    @foreach ($cart_history as $hist)
                        <hr style="border-top: 1rem solid black; margin-top:2rem; margin-bottom:2rem">
                        <table class="table table-striped table-hover table-bordered"> <!-- Thêm lớp table-bordered -->
                            <thead class="table-primary">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Tổng giá tiền phải trả</th>
                                    <th>Tình trạng</th>
                                    <th>Ngày đặt hàng</th>
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
                                            <span class="badge bg-dark">Đang xử lý đơn hàng</span>
                                        @elseif($hist->order_status == 2)
                                            <span class="badge bg-info">Đang giao hàng</span>
                                        @elseif($hist->order_status == 3)
                                            <span class="badge bg-success">Giao hàng thành công</span>
                                        @elseif($hist->order_status == 4)
                                            <span class="badge bg-warning text-dark">Trả lại hàng</span>
                                        @elseif($hist->order_status == 5)
                                            <span class="badge bg-danger">Hủy hàng</span>
                                        @else
                                            <span class="badge bg-secondary">Đơn hàng không tồn tại</span>
                                        @endif
                                    </td>
                                    <td>{{ $hist->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered table-hover"> <!-- Thêm lớp table-bordered -->
                            <thead class="table-primary">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá tiền</th>
                                    <th>Chi tiết SP</th>
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
        {{$cart_history->links()}}
    </div>
@endsection
