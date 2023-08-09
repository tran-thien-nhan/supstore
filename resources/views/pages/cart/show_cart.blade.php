@extends('collection')
@section('header')
    <title>giỏ hàng ({{ Cart::count() }})</title>
@endsection
@section('product_content')
    <section id="cart_items">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/trang-chu') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </nav>
            <div class="table-responsive cart_info">
                <?php
                $content = Cart::content(); // Thay đổi dòng này
                ?>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Thành công!</strong> {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Lỗi!</strong> {{ session('error') }}
                    </div>
                @endif

                <p>hiện tại có {{ Cart::count() }} sản phẩm trong giỏ hàng</p>
                <form action="{{ route('cart.update') }}" method="POST">
                    @csrf
                    @if (Cart::count() > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th scope="col">Item</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">flavour</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach(Cart::content() as $row) :?>
                                <tr>
                                    <td class="cart_product">
                                        <p><?php echo $row->name; ?></p>
                                    </td>
                                    <td class="cart_description">
                                        <a href="{{ URL::to('/chi-tiet-san-pham/' . $row->id) }}">
                                            <img width="100px" height="100px"
                                                src="{{ asset('public/uploads/product') }}/{{ $row->options->has('image') ? $row->options->image : '' }}"
                                                alt="">
                                        </a>
                                    </td>

                                    <td class="cart_price">
                                        <p>{{ number_format($row->price * (1 - $row->options->discount / 100), 0, ',', '.') }}đ
                                        </p>
                                    </td>

                                    <td class="cart_quantity">
                                        <div class="input-group">
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-light" aria-label="button"
                                                    onclick="increaseQuantity('<?php echo $row->rowId; ?>')">
                                                    +
                                                </button>
                                                <input style="text-align: center; width: 3rem" type="text"
                                                    value="<?php echo $row->qty; ?>" min="1" max="1606"
                                                    name="qty[{{ $row->rowId }}]" class="mx-2" aria-label="quantity"
                                                    id="quantity-input-<?php echo $row->rowId; ?>">
                                                <button type="button" class="btn btn-light" aria-label="button"
                                                    onclick="decreaseQuantity('<?php echo $row->rowId; ?>')">
                                                    -
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="cart_total">
                                        <p class="cart_total_price" id="cart-total-price-<?php echo $row->id; ?>">
                                            {{ number_format($row->price * $row->qty * (1 - $row->options->discount / 100), 0, ',', '.') }}đ
                                        </p>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_detail" id="cart_detail-<?php echo $row->id; ?>"><?php echo $row->options->has('flavour') ? $row->options->flavour : ''; ?>
                                        </p>
                                    </td>
                                    <td class="cart_delete">
                                        <form action="" method="post">
                                            @csrf
                                            <input type="hidden" name="rowId" value="<?php $row->id; ?>">
                                            <a type="submit" class="cart_quantity_delete"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')"
                                                href="{{ route('cart.remove', $row->rowId) }}"><i
                                                    class="fa fa-times"></i></a>
                                        </form>
                                    </td>

                                </tr>
                                <?php endforeach;?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td>Subtotal</td>
                                    <td><?php echo Cart::subtotal(); ?>đ</td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td>mã giảm</td>
                                    <td>
                                        @php
                                            $totalFormatted = str_replace(',', '', Cart::total()); // Loại bỏ dấu phân cách hàng nghìn
                                            $total = floatval($totalFormatted); // Chuyển đổi chuỗi thành số
                                        @endphp

                                        @if (Session::get('coupon'))
                                            @foreach (Session::get('coupon') as $key => $cou)
                                                @if ($cou['coupon_condition'] == 1)
                                                    <span class="badge bg-primary">{{ $cou['coupon_code'] }}</span>
                                                    -{{ $cou['coupon_number'] }}%
                                                    <p>
                                                        @php
                                                            $total_coupon = ($total * $cou['coupon_number']) / 100;
                                                            $total -= $total_coupon;
                                                        @endphp
                                                    </p>
                                                @elseif ($cou['coupon_condition'] == 2)
                                                    <span class="badge bg-success">{{ $cou['coupon_code'] }}</span>
                                                    -{{ number_format($cou['coupon_number'], 0, ',', '.') }}đ
                                                    <p>
                                                        @php
                                                            $total_coupon = $cou['coupon_number'];
                                                            $total -= $total_coupon;
                                                        @endphp
                                                    </p>
                                                @endif
                                            @endforeach
                                        @else
                                        0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td>Total ban đầu</td>
                                    <td id="total_amount">
                                        {{ Cart::total() }}đ
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td>tiền sau khi giảm</td>
                                    <td id="total_amount">
                                        {{ number_format($total, 0, ',', '.') }}đ
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <a href="{{ route('cart.destroy') }}" class="btn btn-warning" style="float: right">Delete All</a>
                        @if (Session::get('coupon'))
                            <a href="{{ route('unset.coupon') }}" class="btn btn-warning mx-2" style="float: right">Delete
                                coupon</a>
                        @endif
                        <div class="my-3" style="display: flex; flex-direction: column; align-items: flex-start;">
                            @php
                                $customer_id = Session::get('customer_id');
                            @endphp
                            @if ($customer_id != null)
                                <a href="{{ URL::to('checkout') }}" class="btn btn-outline-success my-2">checkout</a>
                            @else
                                <a href="{{ URL::to('/login-checkout') }}"
                                    class="btn btn-outline-success my-2">checkout</a>
                            @endif

                            <input style="margin-bottom: 10px;" type="submit" value="Update Cart"
                                class="btn btn-outline-primary" name="btn_update">
                            <a href="{{ URL::to('/danh-muc-san-pham') }}" class="btn btn-outline-dark">
                                Continue Shopping
                            </a>
                        </div>
                    @endif
                </form>
                <form action="{{ route('check.coupon') }}" method="post">
                    @csrf
                    @if (Session::get('cart'))
                        <tr>
                            <td>
                                <input type="text" name="coupon" id="coupon" placeholder="Nhập mã giảm giá">
                                <input type="submit" value="Áp dụng" class="check_coupon">
                            </td>
                        </tr>
                    @endif
                </form>
            </div>
        </div>
        <br><br>
    </section>
    <script>
        function increaseQuantity(rowId) {
            var inputElement = document.getElementById('quantity-input-' + rowId);
            var currentValue = parseInt(inputElement.value);
            var maxValue = parseInt(inputElement.getAttribute('max'));
            if (currentValue < maxValue) {
                inputElement.value = currentValue + 1;
            }
        }

        function decreaseQuantity(rowId) {
            var inputElement = document.getElementById('quantity-input-' + rowId);
            var currentValue = parseInt(inputElement.value);
            var minValue = parseInt(inputElement.getAttribute('min'));
            if (currentValue > minValue) {
                inputElement.value = currentValue - 1;
            }
        }
    </script>
@endsection
