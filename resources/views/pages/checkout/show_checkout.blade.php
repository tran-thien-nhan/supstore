@extends('collection')
@section('header')
    <title>thanh toán</title>
@endsection
@section('product_content')
    <section id="cart_items">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/trang-chu') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
            <div class="shopper-informations">
                <div class="row">
                    <div class="clearfix">
                        <div class="bill-to">
                            <h4>Bill To</h4>
                            <div class="form-one">
                                <form action="{{ URL::to('/save-checkout-customer') }}" method="POST">
                                    @csrf
                                    <div class="form-group my-3">
                                        <input type="text" name="shipping_email" class="form-control bg-light"
                                            placeholder="Email*" value="{{ $customer['customer_email'] ?? '' }}">
                                    </div>
                                    @error('shipping_email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group my-3">
                                        <input type="text" name="shipping_name" class="form-control bg-light"
                                            placeholder="Name *" value="{{ $customer['customer_name'] ?? '' }}">
                                    </div>
                                    @error('shipping_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group my-3">
                                        <input type="text" name="shipping_phone" class="form-control bg-light"
                                            placeholder="Phone" value="{{ $customer['customer_phone'] ?? '' }}">
                                    </div>
                                    @error('shipping_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group my-3">
                                        <input type="text" name="shipping_address" class="form-control bg-light"
                                            placeholder="Address" value="{{ $customer['customer_address'] ?? '' }}">
                                    </div>
                                    @error('shipping_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group my-3">
                                        <textarea class="form-control bg-light" name="shipping_notes" id="shipping_notes"
                                            placeholder="Notes about your order, Special Notes for Delivery" rows="6">...</textarea>
                                    </div>
                                    <div class="form-group my-3">
                                        <input type="submit" name="send_order" class="form-control btn btn-outline-dark"
                                            value="Send">
                                    </div>
                                    <div class="form-group my-3">
                                        <a href="{{ URL::to('/show-cart') }}" name="rewatch_cart"
                                            class="form-control btn btn-outline-dark" value="">Watch My Cart</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--/#cart_items-->
@endsection
