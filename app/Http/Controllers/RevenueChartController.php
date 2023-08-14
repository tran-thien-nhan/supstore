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

        return view('admin.dashboard')
            ->with('dailyRevenue', $dailyRevenue)
            ->with('mostPurchasedProduct', $mostPurchasedProduct)
            ->with('totalRevenueCurrentMonth', $totalRevenueCurrentMonth)
            ->with('currentMonth', $currentMonth);
    }
}
