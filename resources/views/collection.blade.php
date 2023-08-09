<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>{{$meta_title}}</title> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/collection.css') }}">
    @yield('header')
</head>

<body>
    <div class="container-fluid mt-2">

        @include('layout.header')
        @include('layout.carousel_product')
        <!-- phần hiển thị -->

        <div class="d-flex">
            <div class="category col-md-3">
                @include('layout.sidebar')
            </div>

            <div class="container-fluid  col-md-9">
                @yield('product_content')
            </div>
        </div>

        <!-- end phần hiển thị -->
        @include('layout.news_letter')
        @include('layout.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>
