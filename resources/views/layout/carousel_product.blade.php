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
      animation-delay: 1s;
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
        <li data-bs-slide-to="0" class="active"></li>
        <li data-bs-slide-to="1"></li>
        <li data-bs-slide-to="2"></li>
        <li data-bs-slide-to="3"></li>
        <li data-bs-slide-to="4"></li>
        <li data-bs-slide-to="5"></li>
        <li data-bs-slide-to="6"></li>
        <li data-bs-slide-to="7"></li>
        <li data-bs-slide-to="8"></li>
        <li data-bs-slide-to="9"></li>
    </ol>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://cdn.shopify.com/s/files/1/0580/5450/8730/files/BCAA_website_banner_1_10eb187d-850e-474a-bd3b-2003fa14f3f1.jpg?v=1661592937" alt="Los Angeles" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://apexsupplements.b-cdn.net/wp-content/uploads/2022/12/CategoryBanner-BCAA1-jpg.webp" alt="Chicago" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://cdn.shopify.com/s/files/1/0580/5450/8730/files/BCAA_website_banner_3_f240fa40-ae0a-4117-9738-0f273e788c6a.jpg?v=1661592967" alt="New York" class="d-block w-100">
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

<!-- <script>
    // Auto slide every 1 second
    setInterval(function() {
        $('.carousel').carousel('next');
    }, 1000);
</script> -->