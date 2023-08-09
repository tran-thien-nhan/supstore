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
            <img src="https://axeandsledge.com/cdn/shop/collections/pre-workout_1400x.progressive.jpg?v=1686767843" alt="Los Angeles" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://axeandsledge.com/cdn/shop/collections/intraworkout_1400x.progressive.jpg?v=1686767885" alt="Chicago" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://axeandsledge.com/cdn/shop/collections/protein_1400x.progressive.jpg?v=1686767902" alt="New York" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://axeandsledge.com/cdn/shop/collections/fatloss_1400x.progressive.jpg?v=1686767919" alt="New York" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://axeandsledge.com/cdn/shop/collections/musclebuilding_1400x.progressive.jpg?v=1686767937" alt="New York" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://axeandsledge.com/cdn/shop/collections/Reds_Banner2_1400x.progressive.jpg?v=1686767953" alt="New York" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://axeandsledge.com/cdn/shop/collections/wellness_1400x.progressive.jpg?v=1686767977" alt="New York" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://axeandsledge.com/cdn/shop/collections/basicseries4_1400x.progressive.jpg?v=1686768010" alt="New York" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://axeandsledge.com/cdn/shop/collections/sleepaid_1400x.progressive.jpg?v=1686767991" alt="New York" class="d-block w-100">
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