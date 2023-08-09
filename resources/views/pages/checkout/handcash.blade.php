@extends('collection')

@section('header')
    <title>thank you</title>
@endsection

@section('product_content')
    <section id="cart_items">
        <div class="container">
            @php
                use App\Models\Customer;
                $customer_id = Session::get('customer_id');
                $shipping_id = Session::get('shipping_id');
                // Assuming you have a method to fetch the customer data by ID (e.g., using Eloquent ORM in Laravel)
                $customer = Customer::find($customer_id);
            @endphp

            @if ($customer)
                <h2>cảm ơn bạn đã đặt hàng ở chỗ chúng tôi, chúng tôi sẽ liên hệ với bạn sớm nhất, vui lòng kiểm tra email:
                    {{ $customer->customer_email }}</h2>
            @else
                <h2>Không tìm thấy thông tin email khách hàng. Vui lòng thử lại sau.</h2>
            @endif
        </div>
    </section>
@endsection
