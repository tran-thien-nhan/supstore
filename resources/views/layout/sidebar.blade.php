<style>
    .nav-link {
        position: relative;
    }

    .nav-link .selected-marker {
        position: absolute;
        top: 0;
        left: -1rem;
        width: 10px;
        height: 100%;
        background-color: gray;
        display: none;
    }

    .nav-link.selected .selected-marker {
        display: block;
    }
</style>

<div class="container mt-3">
    <form method="get">
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <h4>SHOP BY CATEGORY</h4>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ URL::to('/danh-muc-san-pham') }}">
                    <span class="selected-marker"></span>
                    ALL
                </a>
            </li>
            <li class="nav-item">
                @foreach ($category as $key => $cate)
                    <a class="nav-link text-dark" href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">
                        <span class="selected-marker    "></span>
                        {{ strtoupper($cate->category_name) }}
                    </a>
                @endforeach
            </li>
            <hr>
            <li class="nav-item">
                <h4>SHOP BY BRAND</h4>
            </li>
            <li class="nav-item">
                @foreach ($brand as $key => $brand)
                    <a class="nav-link text-dark" href="{{ URL::to('/thuong-hieu-san-pham/' . $brand->brand_id) }}">
                        <span class="selected-marker"></span>
                        {{ strtoupper($brand->brand_name) }}
                    </a>
                @endforeach
            </li>
            <hr>
            <li class="nav-item">
                <h4>BLOG CATEGORY</h4>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ URL::to('/danh-muc-bai-viet') }}">
                    <span class="selected-marker"></span>
                    ALL
                </a>
            </li>
            <li class="nav-item">
                @foreach ($blog_category as $key => $blog_cate)
                    <a class="nav-link text-dark" href="{{ URL::to('/danh-muc-bai-viet/' . $blog_cate->blog_category_id) }}">
                        <span class="selected-marker"></span>
                        {{ strtoupper($blog_cate->blog_category_name) }}
                    </a>
                @endforeach
            </li>
        </ul>
    </form>
</div>
