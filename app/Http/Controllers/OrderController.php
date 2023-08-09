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
        $edit_order_status = DB::table('tbl_order')
            ->where('order_id', $order_id)
            ->first();

        $manager_order_status = view('admin.edit_order_status')
            ->with('edit_order_status', $edit_order_status);

        return view('admin_layout')
            ->with('admin.edit_order_status', $manager_order_status);
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

    public function update_order_status(Request $request, $order_id)
    {
        $this->Authenlogin();
        
        $newStatus = $request->input('order_status');
        
        if ($newStatus !== null) {
            $data = array('order_status' => $newStatus);
    
            DB::table('tbl_order')->where('order_id', $order_id)->update($data);
            return Redirect::to('manage-order')->with('success', 'order updated successfully');
        } else {
            return Redirect::to('manage-order')->with('error', 'Invalid order status');
        }
    }    
}
