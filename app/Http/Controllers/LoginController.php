<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Login;
use App\Models\Login1;
use App\Models\Social;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback_google()
    {
        $currentYear = now()->format('Y'); // Lấy năm hiện tại

        $dailyRevenue = DB::table('tbl_order')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(order_total) as total'))
            ->where('order_status', 3)
            ->groupBy('date')
            ->get();

        $currentMonth = now()->format('m'); // Lấy tháng hiện tại (định dạng 'mm')

        $totalRevenueCurrentMonth = DB::table('tbl_order')
            ->where('order_status', 3)
            ->whereMonth('created_at', $currentMonth)
            ->sum('order_total');

        $mostPurchasedProduct = DB::table('tbl_product')
            ->orderBy('product_quantity', 'asc') // Sắp xếp tăng dần theo product_quantity
            ->first(); // Chọn sản phẩm có product_quantity thấp nhất (MIN)

        $customerRegistrations = DB::table('tbl_customer')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as registrations'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('year', 'month')
            ->get();

        $customerRegistrationLabels = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        $customerRegistrationData = [];
        foreach ($customerRegistrationLabels as $monthLabel) {
            $matchingMonth = $customerRegistrations->where('month', array_search($monthLabel, $customerRegistrationLabels) + 1)->first();

            if ($matchingMonth) {
                $customerRegistrationData[] = $matchingMonth->registrations;
            } else {
                $customerRegistrationData[] = 0;
            }
        }

        $topCustomers = DB::table('tbl_customer')
            ->orderBy('customer_point', 'desc')
            ->limit(3) // Chọn top 3 người dùng
            ->get();

        $topProducts = DB::table('tbl_product')
            ->orderBy('product_quantity', 'asc')
            ->limit(5) // Chọn top 5 sản phẩm
            ->get();



        $monthlyRevenue = DB::table('tbl_order')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(order_total) as total'))
            ->where('order_status', 3)
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->get();

        // Bổ sung dữ liệu thiếu
        $allMonths = range(1, 12); // Tạo một mảng chứa các tháng từ 1 đến 12

        $monthlyData = [];

        foreach ($allMonths as $month) {
            $matchingMonth = $monthlyRevenue->where('month', $month)->first();

            if ($matchingMonth) {
                $monthlyData[] = $matchingMonth->total;
            } else {
                $monthlyData[] = 0; // Nếu không có dữ liệu, thêm giá trị 0
            }
        }
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return view('admin_login');
        }

        // Kiểm tra xem người dùng đã tồn tại trong CSDL chưa
        $existingUser = Admin::where('admin_email', $user->getEmail())->first();
        $account_name = Login::where('admin_id', $user->getId())->first();

        if ($account_name) {
            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
        }

        if ($existingUser) {
            $account_name = Login::where('admin_id', $existingUser->admin_id)->first();
            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
            Auth::login($existingUser);
        } else {
            // Nếu người dùng chưa tồn tại, bạn có thể tạo một người dùng mới tại đây
            // Tạo thông tin mới cho bảng tbl_social
            $newSocialUser = new Social();
            $newSocialUser->provider_user_id = $user->getId();
            $newSocialUser->email = $user->getEmail();
            $newSocialUser->provider = 'google';
            $newSocialUser->user = $user->getName(); // Mã hóa tên người dùng trước khi lưu vào CSDL
            $newSocialUser->save();

            // Tạo thông tin mới cho bảng tbl_admin
            $newAdminUser = new Admin();
            $newAdminUser->admin_id = null; // Bạn cần đặt giá trị phù hợp cho admin_id.
            $newAdminUser->admin_name = $user->getName();
            $newAdminUser->admin_email = $user->getEmail();
            $newAdminUser->admin_password = ''; // Bạn cần cung cấp mật khẩu cho admin hoặc sử dụng mã hóa phù hợp.
            $newAdminUser->admin_phone = ''; // Bạn cần cung cấp số điện thoại cho admin.
            $newAdminUser->created_at = now();
            $newAdminUser->updated_at = now();
            $newAdminUser->save();

            // Lưu admin_name vào session
            Session::put('admin_name', $user->getName());
            Session::put('admin_id', $newAdminUser->admin_id);

            // Đăng nhập người dùng mới tạo
            Auth::login($newAdminUser); // Thay đổi $existingUser thành $newAdminUser
        }

        return view('admin.dashboard')
            ->with('dailyRevenue', $dailyRevenue)
            ->with('mostPurchasedProduct', $mostPurchasedProduct)
            ->with('totalRevenueCurrentMonth', $totalRevenueCurrentMonth)
            ->with('currentMonth', $currentMonth)
            ->with('customerRegistrations', $customerRegistrations)
            ->with('topCustomers', $topCustomers)
            ->with('topProducts', $topProducts)
            ->with('monthlyRevenue', $monthlyRevenue)
            ->with('monthlyData', $monthlyData)
            ->with('currentYear', $currentYear)
            ->with('customerRegistrations', $customerRegistrations)
            ->with('customerRegistrationLabels', $customerRegistrationLabels)
            ->with('customerRegistrationData', $customerRegistrationData); // Chuyển hướng đến trang sau khi đăng nhập thành công
    }

    public function findOrCreateUser($users, $provider)
    {
        $authUser = Social::where('provider_user_id', $users->id)->first();

        if ($authUser) {
            return $authUser;
        }

        $account_name = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider),
            'email' => $users->getEmail(), // Add the email field here
        ]);

        $orang = Login::where('admin_email', $users->getEmail())->get();

        if (!$orang) {
            $orang = Login::create([
                'admin_name' => $users->getName(),
                'admin_email' => $users->getEmail(),
                'admin_password' => '',
                'admin_phone' => ''
            ]);
        }

        $account_name->login()->associate($orang);
        $account_name->save();

        // Return the created $account_name (Social) model instead of redirecting to another view
        return $account_name;
    }
}
