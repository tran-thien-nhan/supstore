<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* CSS để tạo các tab con có hiệu ứng mở hoặc đóng và fade in/out */
        .nav-item {
            margin-bottom: 10px;
            border: 1px solid white;
            border-radius: 5px;
        }

        .nav-item h5 {
            cursor: pointer;
            margin: 0;
            padding: 10px 15px;
            background-color: #f0f0f0;
            border-bottom: 1px solid white;
            transition: background-color 0.3s ease; /* Thêm hiệu ứng hover */
        }

        .nav-item h5:hover {
            background-color: #ddd; /* Màu nền khi hover */
        }

        .nav-item ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: max-height 0.75s ease-out, opacity 0.75s ease-out;
        }

        .nav-item.active ul {
            max-height: 1000px;
            opacity: 1;
            transition: max-height 0.75s ease-in, opacity 0.75s ease-in;
        }

        .nav-item ul li {
            padding: 5px 15px;
            border-bottom: 1px solid white;
            background-color: #fff;
            transition: background-color 0.3s ease; /* Thêm hiệu ứng hover */
        }

        .nav-item ul li:hover {
            background-color: #ddd; /* Màu nền khi hover */
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <form method="get">
            <div class="nav-item">
                <h5>SHOP BY CATEGORY</h5>
                <ul>
                    <li>
                        <a class="nav-link text-dark" href="{{ URL::to('/danh-muc-san-pham') }}">
                            <span class="selected-marker"></span>
                            ALL
                        </a>
                    </li>
                    @foreach ($category as $key => $cate)
                        <li>
                            <a class="nav-link text-dark"
                                href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">
                                <span class="selected-marker"></span>
                                {{ strtoupper($cate->category_name) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="nav-item">
                <h5>SHOP BY BRAND</h5>
                <ul>
                    @foreach ($brand as $key => $brand)
                        <li>
                            <a class="nav-link text-dark"
                                href="{{ URL::to('/thuong-hieu-san-pham/' . $brand->brand_id) }}">
                                <span class="selected-marker"></span>
                                {{ strtoupper($brand->brand_name) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="nav-item">
                <h5>BLOG CATEGORY</h5>
                <ul>
                    <li>
                        <a class="nav-link text-dark" href="{{ URL::to('/danh-muc-bai-viet') }}">
                            <span class="selected-marker"></span>
                            ALL
                        </a>
                    </li>
                    @foreach ($blog_category as $key => $blog_cate)
                        <li>
                            <a class="nav-link text-dark"
                                href="{{ URL::to('/danh-muc-bai-viet/' . $blog_cate->blog_category_id) }}">
                                <span class="selected-marker"></span>
                                {{ strtoupper($blog_cate->blog_category_name) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="nav-item">
                <h5>SORT BY PRICE</h5>
                <ul>
                    <li>
                        <a class="nav-link text-dark" href="{{ URL::to('/price-ascending') }}">PRICE ASCENDING</a>
                    </li>
                    <li>
                        <a class="nav-link text-dark" href="{{ URL::to('/price-descending') }}">PRICE DESCENDING</a>
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <script>
        // JavaScript để điều khiển việc mở hoặc đóng tab
        const tabHeaders = document.querySelectorAll('.nav-item h5');
        tabHeaders.forEach(header => {
            header.addEventListener('click', () => {
                header.parentElement.classList.toggle('active');
            });
        });
    </script>
</body>

</html>
