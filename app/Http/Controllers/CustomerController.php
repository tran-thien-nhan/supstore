<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\District;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; // Import DB facade

class CustomerController extends Controller
{
    public function Authenlogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function index()
    {
        $this->Authenlogin();
        $customers = Customer::paginate(5);
        $districts = DB::table('tbl_district')->get();
        return view('admin.all_customers', compact('customers', 'districts'));
    }

    public function filterByRank(Request $request)
    {
        $this->Authenlogin();
        $rank = $request->input('rank');
        $districts = District::all();
        $customers = Customer::query();

        if ($rank === 'all') {
            // Do nothing, retrieve all customers
        } elseif ($rank) {
            $minPoint = $this->getMinPointForRank($rank);
            $maxPoint = $this->getMaxPointForRank($rank);

            $customers->whereBetween('customer_point', [$minPoint, $maxPoint]);
        }

        $customers = $customers->paginate(10);

        return view('admin.all_customers', compact('customers', 'districts'));
    }

    // Define a helper function to get the maximum points for each rank
    private function getMaxPointForRank($rank)
    {
        switch ($rank) {
            case 'Diamond':
                return PHP_INT_MAX; // Set to a very high value to indicate no upper limit
            case 'Silver':
                return 1499; // Maximum points for Silver
            case 'Gold':
                return 999; // Maximum points for Gold
            case 'Newbie':
                return 499; // Maximum points for Newbie
            default:
                return 0;
        }
    }

    // Define a helper function to get the minimum points for each rank
    private function getMinPointForRank($rank)
    {
        switch ($rank) {
            case 'Diamond':
                return 1500;
            case 'Silver':
                return 1000;
            case 'Gold':
                return 500;
            case 'Newbie':
                return 0;
            default:
                return 0;
        }
    }

    public function filterCustomersByDistrict(Request $request)
    {
        $this->Authenlogin();
        $districtId = $request->input('district');

        // Query để lọc khách hàng theo quận (hoặc tất cả nếu chọn "All")
        $query = Customer::query();

        if ($districtId && $districtId !== 'all') {
            $query->where('district_id', $districtId);
        }

        $customers = $query->paginate(10);

        $districts = District::all(); // Lấy danh sách quận để hiển thị trong dropdown

        return view('admin.all_customers', [
            'customers' => $customers,
            'districts' => $districts,
        ]);
    }

    public function searchCustomers(Request $request)
    {
        $this->Authenlogin();
        $search = $request->input('search');

        // Query để tìm kiếm khách hàng theo số điện thoại, tên, hoặc email
        $customers = Customer::where(function ($query) use ($search) {
            $query->where('customer_name', 'like', '%' . $search . '%')
                ->orWhere('customer_email', 'like', '%' . $search . '%')
                ->orWhere('customer_phone', 'like', '%' . $search . '%')
                ->orWhere('customer_address', 'like', '%' . $search . '%')
                ->orWhere('customer_id', 'like', '%' . $search . '%');
        })->paginate(20);

        // Lấy danh sách quận để hiển thị trong dropdown
        $districts = District::all();

        return view('admin.all_customers', [
            'customers' => $customers,
            'districts' => $districts,
        ]);
    }
}
