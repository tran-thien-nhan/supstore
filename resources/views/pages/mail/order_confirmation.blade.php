<!DOCTYPE html>
<html>
<head>
    <title>Đơn hàng xác nhận</title>
    <!-- Thêm các thẻ meta và liên kết tới Bootstrap CSS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Xin chào {{ $customer_name }}</h2>
    <p>Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được xác nhận.</p>
    <p>Mã đơn hàng: {{ $order_id }}</p>
    <p>vui lòng thanh toán bằng tiền mặt</p>
    <div class="table-responsive">
        <!-- Sử dụng các lớp Bootstrap để tạo bảng -->
        <table class="table table-striped table-bordered">
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
                        <td></td>
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
                    <th><span style="color:black">{{ number_format($item->order_total, 0, ',', '.') }}đ</span></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- Liên kết tới tập tin JavaScript của Bootstrap (tuỳ chọn) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
