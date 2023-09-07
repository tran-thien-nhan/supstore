<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.7.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/header.css') }}">
    <!-- Các thẻ Meta OG -->
    {{-- <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_desc }}" />
    <meta property="og:image" content="https://axeandsledge.com/cdn/shop/files/axe-logo_410x.png?v=1614293969" />
    <meta property="og:url" content="{{ URL::current() }}" /> --}}
    <!-- End Các thẻ Meta OG -->
</head>

<body>

    <nav class="navbar navbar-expand-sm navbar-white bg-white sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ URL::to('/trang-chu') }}">
                <img class="logo" src="{{asset('public/uploads/product/logo.jpg')}}"
                    alt="Logo" style="width: 10rem; height: 10rem">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link text-dark btn btn-white" href="{{ URL::to('/trang-chu') }}">
                            HOME
                        </a>
                    </li>

                    <li class="nav-item products">
                        <a class="nav-link text-dark btn btn-white" href="{{ URL::to('/danh-muc-san-pham') }}">
                            CATEGORY
                        </a>
                    </li>

                    <li class="nav-item dropdown products-dropdown">
                        <a class="nav-link dropdown-toggle text-dark btn btn-white" href="#" id="navbarDropdown2"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            CATEGORY
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                            <a class="dropdown-item" href="{{ URL::to('/danh-muc-san-pham') }}">
                                ALL
                            </a>
                            @foreach ($category as $key => $cate)
                                <a class="dropdown-item"
                                    href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">
                                    {{ strtoupper($cate->category_name) }}
                                </a>
                            @endforeach
                        </div>
                    </li>

                    <li class="nav-item products">
                        <a class="nav-link text-dark btn btn-white" href="{{ URL::to('/thuong-hieu-san-pham') }}">
                            BRANDS
                        </a>
                    </li>

                    <li class="nav-item dropdown products-dropdown">
                        <a class="nav-link dropdown-toggle text-dark btn btn-white" href="#" id="navbarDropdown3"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            BRANDS
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                            <a class="dropdown-item" href="{{ URL::to('/thuong-hieu-san-pham') }}">
                                ALL
                            </a>
                            @foreach ($brand as $key => $brand)
                                <a class="dropdown-item"
                                    href="{{ URL::to('/thuong-hieu-san-pham/' . $brand->brand_id) }}">
                                    {{ strtoupper($brand->brand_name) }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item products">
                        <a class="nav-link text-dark btn btn-white" href="{{ URL::to('/danh-muc-bai-viet') }}">
                            BLOGS
                        </a>
                    </li>

                    <li class="nav-item dropdown products-dropdown">
                        <a class="nav-link dropdown-toggle text-dark btn btn-white" href="#" id="navbarDropdown3"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            BLOGS
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                            <a class="dropdown-item" href="{{ URL::to('/danh-muc-bai-viet') }}">
                                ALL
                            </a>
                            @foreach ($blog_category as $key => $blog_cate)
                                <a class="dropdown-item"
                                    href="{{ URL::to('/danh-muc-bai-viet/' . $blog_cate->blog_category_id) }}">
                                    {{ strtoupper($blog_cate->blog_category_name) }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                    @php
                        use App\Models\Customer;
                        $customer_id = Session::get('customer_id');
                        $shipping_id = Session::get('shipping_id');
                        // Assuming you have a method to fetch the customer data by ID (e.g., using Eloquent ORM in Laravel)
                        $customer = Customer::find($customer_id);
                        
                        if ($customer) {
                            // Access the customer_name property if the customer exists
                            $customer_name = $customer->customer_name;
                        } else {
                            // Handle the case where the customer doesn't exist or there's an error
                            $customer_name = 'Unknown'; // Set a default value or handle the error accordingly
                        }
                    @endphp

                    @if ($customer_id != null && $shipping_id == null)
                        <li class="nav-item">
                            <a class="nav-link text-dark btn btn-white" href="{{ URL::to('/show-cart') }}"
                                id="navbarDropdown5">
                                <i class="fa-solid fa-cart-shopping"></i>({{ Cart::count() }})
                            </a>
                        </li>
                    @elseif($customer_id != null && $shipping_id != null)
                        <li class="nav-item">
                            <a class="nav-link text-dark btn btn-white" href="{{ URL::to('/show-cart') }}"
                                id="navbarDropdown5">
                                <i class="fa-solid fa-cart-shopping"></i>({{ Cart::count() }})
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-dark btn btn-white" href="{{ URL::to('/login-checkout') }}"
                                id="navbarDropdown5">
                                <i class="fa-solid fa-cart-shopping"></i>({{ Cart::count() }})
                            </a>
                        </li>
                    @endif

                    @if ($customer_id != null)
                        <li class="nav-item dropdown products-dropdown">
                            <a class="nav-link dropdown-toggle text-dark btn btn-white" href="#"
                                id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span>
                                    HI {{ $customer_name }} !
                                </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                <a class="dropdown-item" href="{{ URL::to('/customer-information') }}">
                                    ACCOUNT <i class="fa-solid fa-user"></i>
                                </a>
                                <a class="dropdown-item" href="{{ URL::to('/cart-history') }}">
                                    ORDER HISTORY
                                </a>
                                <a class="dropdown-item" href="{{ URL::to('/logout-checkout') }}">
                                    SIGN OUT
                                </a>

                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-dark btn btn-white" href="{{ URL::to('/login-checkout') }}"
                                id="navbarDropdown6">
                                SIGN IN
                            </a>
                        </li>
                    @endif


                    <li class="nav-item">
                        <form class="form-inline" action="{{ URL::to('/tim-kiem') }}" method="POST">
                            @csrf
                            <input class="form-control search me-2" type="text" id="keywords_submit"
                                name="keywords_submit" placeholder="Search...">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.7.0/js/bootstrap.min.js"></script>
</body>

</html>
