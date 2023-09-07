<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
@php
    // Lấy thông tin người dùng đang đăng nhập từ cơ sở dữ liệu
    $loggedInUserId = Auth::id(); // Lấy ID của người dùng đang đăng nhập
    $adminRole = DB::table('tbl_admin')
        ->where('admin_id', $loggedInUserId)
        ->value('role_value');
@endphp

<!DOCTYPE html>

<head>
    <title>DASHBOARD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('backend/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('backend/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('backend/css/font.css') }}" type="text/css" />
    <link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/css/morris.css') }}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('backend/css/monthly.css') }}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{ asset('backend/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('backend/js/raphael-min.js') }}"></script>
    <script src="{{ asset('backend/js/morris.js') }}"></script>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                @if ($adminRole == 1)
                    <a href="{{ URL::to('/dashboard') }}" class="logo">
                        ADMIN
                    </a>
                @elseif ($adminRole == 2)
                    <a href="{{ URL::to('/manage-order') }}" class="logo">
                        ADMIN
                    </a>
                @endif
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="top-nav clearfix">
                <!--search & user info start-->

                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ asset('backend/images/2.png') }}">
                            <span class="username">
                                <?php
                                $name = Session::get('admin_name');
                                if ($name) {
                                    echo $name;
                                }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="{{ URL::to('/logout') }}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li class="sub-menu {{ $adminRole != 1 ? 'hidden' : '' }}">
                            <a class="active" href="{{ URL::to('/dashboard') }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sub-menu {{ $adminRole != 1 && $adminRole != 2 ? 'hidden' : '' }}">
                        {{-- <li class="sub-menu {{ $adminRole != 1 ? 'hidden' : '' }}"> --}}
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Order</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/manage-order') }}">Manage Order</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu {{ $adminRole != 1 ? 'hidden' : '' }}">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Manage Coupons</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/insert-coupon') }}">Add Coupon</a></li>
                                <li><a href="{{ URL::to('/list-coupon') }}">Coupons List</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu {{ $adminRole != 1 ? 'hidden' : '' }}">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Product Category</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-category-product') }}">Add Product Category</a>
                                </li>
                                <li><a href="{{ URL::to('/all-category-product') }}">Product Category List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu {{ $adminRole != 1 ? 'hidden' : '' }}">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Product Brand</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-brand-product') }}">Add Product Brand</a>
                                </li>
                                <li><a href="{{ URL::to('/all-brand-product') }}">Product Brand List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu {{ $adminRole != 1 ? 'hidden' : '' }}">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Product</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-product') }}">Add Product</a></li>
                                <li><a href="{{ URL::to('/all-product') }}">Product List</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu {{ $adminRole != 1 ? 'hidden' : '' }}">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Blog Category</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-blog-category') }}">Add Blog Category</a></li>
                                <li><a href="{{ URL::to('/all-blog-category') }}">Blog Category List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu {{ $adminRole != 1 ? 'hidden' : '' }}">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Blog</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-blog') }}">Add Blog</a></li>
                                <li><a href="{{ URL::to('/all-blog') }}">Blog List</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu {{ $adminRole != 1 ? 'hidden' : '' }}">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Manage Comments</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/admin/comments') }}">Comment List</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu {{ $adminRole != 1 ? 'hidden' : '' }}">
                            <a class="" href="{{ URL::to('/employees') }}">
                                <i class="fa fa-users"></i>
                                <span>Manage Employees</span>
                            </a>
                        </li>
                        <li class="sub-menu {{ $adminRole != 1 ? 'hidden' : '' }}">
                            <a class="" href="{{ route('listSubscribedEmails') }}">
                                <i class="fa fa-users"></i>
                                <span>Email Subcribed list</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                @yield('admin_content')
            </section>
            <!-- footer -->
            {{-- <div class="footer">
                <div class="wthree-copyright">
                </div>
            </div>
            <!-- / footer --> --}}
        </section>
        <!--main content end-->
    </section>
    <script src="{{ asset('backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('backend/js/scripts.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{ asset('backend/js/jquery.scrollTo.js') }}"></script>
    <!-- morris JavaScript -->
    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,
                data: [{
                        period: '2015 Q1',
                        iphone: 2668,
                        ipad: null,
                        itouch: 2649
                    },
                    {
                        period: '2015 Q2',
                        iphone: 15780,
                        ipad: 13799,
                        itouch: 12051
                    },
                    {
                        period: '2015 Q3',
                        iphone: 12920,
                        ipad: 10975,
                        itouch: 9910
                    },
                    {
                        period: '2015 Q4',
                        iphone: 8770,
                        ipad: 6600,
                        itouch: 6695
                    },
                    {
                        period: '2016 Q1',
                        iphone: 10820,
                        ipad: 10924,
                        itouch: 12300
                    },
                    {
                        period: '2016 Q2',
                        iphone: 9680,
                        ipad: 9010,
                        itouch: 7891
                    },
                    {
                        period: '2016 Q3',
                        iphone: 4830,
                        ipad: 3805,
                        itouch: 1598
                    },
                    {
                        period: '2016 Q4',
                        iphone: 15083,
                        ipad: 8977,
                        itouch: 5185
                    },
                    {
                        period: '2017 Q1',
                        iphone: 10697,
                        ipad: 4470,
                        itouch: 2038
                    },

                ],
                lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="js/monthly.js"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

            switch (window.location.protocol) {
                case 'http:':
                case 'https:':
                    // running on a server, should be good.
                    break;
                case 'file:':
                    alert('Just a heads-up, events will not work when run locally.');
            }

        });
    </script>
    <!-- //calendar -->
</body>

</html>
