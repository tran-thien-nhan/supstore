<style>
    .headline {
        font-size: 4rem;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 10px;
        text-align: left;
    }

    .subtitle {
        font-size: 2rem;
        color: #ffffff;
        margin-bottom: 20px;
        text-align: left;
    }

    .button-grid-container {
        display: flex;
        justify-content: left;
        align-items: left;
        margin-top: 20px;
    }

    .global-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #ff0000;
        color: #ffffff;
        text-decoration: none;
        font-weight: bold;
        border-radius: 5px;
        margin-right: 10px;
    }

    .carousel-caption {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-100%, -70%);
        text-align: left;
        color: #ffffff;
    }

    .carousel-inner .carousel-item {
        position: relative;
        display: none;
        background-color: #000000;
        color: #ffffff;
        text-align: left;
    }

    .carousel-inner .carousel-item.active {
        display: block;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 20px;
        height: 20px;
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }

    .carousel-control-prev {
        margin-left: -20px;
    }

    .carousel-control-next {
        margin-right: -20px;
    }

    .carousel-item {
      transition: transform 1s ease;
      animation-delay: 0.5s;
    }

    /* Chỉnh sửa cho thiết bị di động */
    @media (max-width: 767px) {
        .carousel-caption {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            /* margin-top: 13rem;
            margin-bottom: -10rem; */
            transform: translate(-50%, 1%);
        }

        .headline {
            color: black;
            text-align: center;
        }

        .subtitle {
            color: black;
            text-align: center;
        }

        .button-grid-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .carousel-inner .carousel-item {
            background-color: white;
            text-align: center;
        }
    }
</style>

<div id="demo" class="carousel slide" data-bs-ride="carousel">

    <!-- Indicators/dots -->
    <ol class="carousel-indicators">
        <li data-bs-target="#demo" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#demo" data-bs-slide-to="1"></li>
        <li data-bs-target="#demo" data-bs-slide-to="2"></li>
        <li data-bs-target="#demo" data-bs-slide-to="3"></li>
        <li data-bs-target="#demo" data-bs-slide-to="4"></li>
    </ol>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://www.samedaysupplements.com/pub/media/easyslide/supplement-deals-desktop-banner.webp" alt="Los Angeles" class="d-block w-100">
            {{-- <div class="carousel-caption">
                <div class="caption-content align-left animated fadeInDown">
                    <h1 class="headline" role="heading" aria-level="2" data-uw-rm-heading="level">
                        Deadlifts &amp; Gummy Bears 🧸</h1>
                    <div class="subtitle">
                        <h3>The Grind - BCAAs + EAAs</h3>
                    </div>
                    <div class="button-grid-container button-grid-container--column-mobile">
                        <a href="/products/the-grind" class="global-button global-button--banner-desktop global-button--text-mobile first_button">
                            Shop The Grind
                        </a>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="carousel-item">
            <img src="https://cdn.shopify.com/s/files/1/0532/3210/7691/files/AXEANDSLEDGEBANNER.jpg?v=1651904461" alt="Chicago" class="d-block w-100">
            {{-- <div class="carousel-caption">
                <div class="caption-content align-left animated fadeInDown">
                    <h1 class="headline">
                        <p>Thermogenic Powder</p>
                    </h1>
                    <h3 class="subtitle">212° Thermo</h3>
                    <div class="button-grid-container">
                        <a href="/collections/212-thermo-collection" class="global-button global-button--banner-highlighted-desktop global-button--text-highlighted-mobile first_button">Shop Now</a>
                        <a href="https://axeandsledge.com/blogs/news/212-thermo-product-breakdown" class="global-button global-button--banner-highlighted-desktop global-button--text-highlighted-mobile second_button" aria-label="Shop Now Learn More" uw-rm-vague-link-id="https://axeandsledge.com/blogs/news/212-thermo-product-breakdown$learn more" data-uw-rm-vglnk="">Learn More</a>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="carousel-item">
            <img src="https://fitnessinformant.com/wp-content/uploads/2022/05/FITNESS-INFORMANT-X-REDCON1-_-ORANGE-03.png" alt="New York" class="d-block w-100">
            {{-- <div class="carousel-caption">
                <div class="caption-content align-left animated fadeInDown">
                    <h1 class="headline">
                        Ignition Switch</h1>
                    <div class="subtitle">
                        <h3>Unicorn Blood Pre-Workout 🦄</h3>
                    </div>
                    <div class="button-grid-container">
                        <a href="/products/ignition-switch-stim-pre-workout" class="global-button global-button--banner-desktop global-button--text-mobile first_button">Shop Now</a>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="carousel-item">
            <img src="https://cdn.shopify.com/s/files/1/0032/5550/0911/articles/Top_Prework_out_2021.jpg?v=1628992994&width=1920" alt="New York" class="d-block w-100">
            {{-- <div class="carousel-caption">
                <div class="caption-content align-left animated fadeInDown">
                    <h1 class="headline">
                        Hydraulic ICEE</h1>
                    <div class="subtitle">
                        <h3>Blood flow=nutrient flow=growth</h3>
                    </div>
                    <div class="button-grid-container button-grid-container--column-mobile">
                        <a href="/products/hydraulic-workout-pump" class="global-button global-button--banner-highlighted-desktop global-button--text-highlighted-mobile first_button">Shop Hydraulic</a>
                    </div>
                </div>
            </div> --}}
        </div>
        
        <div class="carousel-item">
            <img src="https://cdn.shopify.com/s/files/1/0018/3808/8244/files/Stack_2048x2048.jpg?v=1650377151" alt="New York" class="d-block w-100">
            <div class="carousel-caption">
                
            </div>
        </div>
    </div>

    <!-- Left and right controls/icons -->
    <a class="carousel-control-prev" href="#demo" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next" href="#demo" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
</div>