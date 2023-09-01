@extends('collection')

@section('header')
    <title>thank you</title>
@endsection

@section('product_content')
    <style>
        /* CSS for styling the thank you page */
        #cart_items {
            text-align: center;
            padding: 50px 0;
        }

        #cart_items h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Style for the header section */
        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 28px;
        }

        /* Style for the product content section */
        #product_content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Style for the success message */
        .success-message {
            color: #28a745;
            font-weight: bold;
        }

        /* Style for the error message */
        .error-message {
            color: #dc3545;
            font-weight: bold;
        }
    </style>

    <section id="cart_items">
        <div class="container">
            @php
                use App\Models\Customer;
                $customer_id = Session::get('customer_id');
                $shipping_id = Session::get('shipping_id');
                // Assuming you have a method to fetch the customer data by ID (e.g., using Eloquent ORM in Laravel)
                $customer = Customer::find($customer_id);
            @endphp

            <div id="product_content">
                @if ($customer)
                    <h2 class="success-message">Cảm ơn bạn đã đặt hàng ở chỗ chúng tôi. Chúng tôi sẽ liên hệ với bạn sớm nhất. Vui lòng kiểm tra email: {{ $customer->customer_email }}</h2>
                @else
                    <h2 class="error-message">Không tìm thấy thông tin email khách hàng. Vui lòng thử lại sau.</h2>
                @endif
            </div>
        </div>
    </section>
@endsection
