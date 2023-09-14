<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Login;
use App\Models\Order;
use App\Models\Login1;
use App\Models\Social;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class OrderController extends Controller
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

    public function edit_order_status(Request $request, $order_id)
    {
        $this->Authenlogin();
        $admin_id = Session::get('admin_id'); // Lấy admin_id từ session
        $admin_role_value = Session::get('admin_role_value'); // Lấy role_value từ session

        $edit_order_status = DB::table('tbl_order')
            ->where('order_id', $order_id)
            ->first();

        $district_id = $edit_order_status->district_id;

        // Lấy tất cả các shipper, không phân biệt quận
        $allShippers = DB::table('tbl_admin')
            ->join('tbl_district', 'tbl_admin.district_id', '=', 'tbl_district.district_id')
            ->where('tbl_admin.role_value', 2)
            ->select('tbl_admin.admin_id', 'tbl_admin.admin_name', 'tbl_district.district_name')
            ->get();


        $shippers = DB::table('tbl_admin')
            ->where('role_value', 2)
            ->where('district_id', $district_id)
            ->get();

        $selectedShipperId = $edit_order_status->admin_id; // Lấy shipper đã được chọn trước đó

        $manager_order_status = view('admin.edit_order_status')
            ->with([
                'edit_order_status' => $edit_order_status,
                'shippers' => $shippers,
                'allShippers' => $allShippers, // Truyền danh sách tất cả các shipper vào view
                'selectedShipperId' => $selectedShipperId,
                'admin_role_value' => $admin_role_value,
                'admin_id' => $admin_id,
            ]);
        return view('admin_layout')
            ->with('admin.edit_order_status', $manager_order_status);
    }


    public function update_order_status(Request $request, $order_id)
    {
        // Lấy dữ liệu từ form
        $admin_id = Session::get('admin_id'); // Lấy admin_id từ session
        $new_status = $request->input('order_status');
        $new_shipper_id = $request->input('shipper_id');

        $admin_role_value = Session::get('admin_role_value'); // Lấy role_value từ session
        // Cập nhật trạng thái và shipper mới cho đơn hàng

        if ($admin_role_value == 1) {
            if ($new_shipper_id !== null) {
                DB::table('tbl_order')
                    ->where('order_id', $order_id)
                    ->update([
                        'order_status' => $new_status,
                        'admin_id' => $new_shipper_id
                    ]);
            } else {
                return redirect()->back()->with('error', 'Please select a shipper.');
            }
        } else {
            // // Kiểm tra xem có shipper nào trong cùng quận không
            // $district_id = $request->input('district_id');

            DB::table('tbl_order')
                ->where('order_id', $order_id)
                ->update([
                    'order_status' => $new_status
                ]);
        }

        return redirect()->back()->with('success', 'Update order successfully.');
    }

    public function save_order_status(Request $request)
    {
        $this->Authenlogin();
        //return view('admin.all_product');
        $data = array();
        $data['order_status'] = $request->order_status;

        DB::table('tbl_order')->insert($data);

        return Redirect::to('manage-order')->with('success', 'order created successfully');
    }
}
