<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Http\Requests;

use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB; // Import DB facade

session_start();

class RevenueChartController extends Controller
{
    public function Authenlogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }
    public function index()
    {
        $this->Authenlogin();
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
            ->with('customerRegistrationData', $customerRegistrationData);
    }
}
