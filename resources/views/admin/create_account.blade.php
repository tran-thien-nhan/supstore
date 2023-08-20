<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>trang quản lý admin web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
    <!-- //font-awesome icons -->
    <script src="js/jquery2.0.3.min.js"></script>
    <style>
        .custom-button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            /* Căn chỉnh khoảng cách trên */
        }

        .custom-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #dc3545;
            /* Màu nền nút */
            color: white;
            /* Màu chữ */
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
            /* Hiệu ứng chuyển màu */
        }

        .custom-button:hover {
            background-color: #c82333;
            /* Màu nền khi di chuột qua */
        }
    </style>
</head>

<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Sign Up Now</h2>
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span style="color: red; text-align: center; font-size: 17px; width: 100%; font-weight: bold">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <!-- Đoạn mã HTML hiển thị form đăng ký tài khoản mới -->
            <form action="{{ route('post.create.account') }}" method="post">
                @csrf
                <input type="text" class="ggg" name="admin_name" placeholder="điền tên" required="">
                @error('admin_name')
                    <span class=""
                        style="color: white; text-align: center; font-size: 17px; width: 100%; font-weight: bold; background-color:black">{{ $message }}</span>
                @enderror
                <input type="email" class="ggg" name="admin_email" placeholder="Enter email" required="">
                @error('admin_email')
                    <span class=""
                        style="color: white; text-align: center; font-size: 17px; width: 100%; font-weight: bold; background-color:black">{{ $message }}</span>
                @enderror
                <input type="password" class="ggg" name="admin_password" placeholder="Enter password" required="">
                @error('admin_password')
                    <span class=""
                        style="color: white; text-align: center; font-size: 17px; width: 100%; font-weight: bold; background-color:black">{{ $message }}</span>
                @enderror
                <input type="password" class="ggg" name="re_admin_password" placeholder="Enter password again   "
                    required="">
                @error('re_admin_password')
                    <span class=""
                        style="color: white; text-align: center; font-size: 17px; width: 100%; font-weight: bold; background-color:black">{{ $message }}</span>
                @enderror
                <input type="text" class="ggg" name="admin_phone" placeholder="điền SĐT" required="">
                @error('admin_phone')
                    <span class=""
                        style="color: white; text-align: center; font-size: 17px; width: 100%; font-weight: bold; background-color:black">{{ $message }}</span>
                @enderror
                <input type="text" class="ggg" name="address" placeholder="điền SĐT" required="">
                @error('address')
                    <span class=""
                        style="color: white; text-align: center; font-size: 17px; width: 100%; font-weight: bold; background-color:black">{{ $message }}</span>
                @enderror
                <div class="mb-3">
                    <label for="role_value" class="form-label">Role</label>
                    <select name="role_value" id="role_value" class="form-select" required>
                        <option value="1">Admin</option>
                        <option value="2">Shipper</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="district_id" class="form-label">District</label>
                    <select name="district_id" id="district_id" class="form-select" required>
                        <option value="" selected disabled>Select District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->district_id }}">{{ $district->district_name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="clearfix"></div>
                <input type="submit" value="Create Account" name="register">
            </form>
            <p><a href="{{ URL::to('/admin') }}">Login</a></p>
            <hr>
            <div class="custom-button-container">
                <a href="{{ URL::to('auth/google') }}" class="custom-button">Sign up with Google</a>
            </div>
        </div>
    </div>
    <script src="{{ asset('backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('backend/js/scripts.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{ asset('backend/js/jquery.scrollTo.js') }}"></script>
</body>

</html>
