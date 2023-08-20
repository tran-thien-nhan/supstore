<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect; // Add the Redirect facade
use App\Models\Coupon;
use Carbon\Carbon;

session_start();

class CouponController extends Controller
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

    public function insert_coupon()
    {
        return view('admin.coupon.insert_coupon');
    }

    public function list_coupon()
    {
        $coupon = Coupon::orderby('coupon_id', 'DESC')->paginate(5);
        return view('admin.coupon.list_coupon')
            ->with(compact('coupon'));
    }

    public function insert_coupon_code(Request $request)
    {
        // Lấy tất cả dữ liệu từ request
        $data = $request->all();

        // Kiểm tra xem các trường cần thiết đã được gửi đi trong request hay chưa
        if (
            isset($data['coupon_name']) &&
            isset($data['coupon_number']) &&
            isset($data['coupon_code']) &&
            isset($data['coupon_time']) &&
            isset($data['coupon_condition']) &&
            isset($data['coupon_status']) &&
            isset($data['coupon_expire_date'])
        ) {
            // Khởi tạo đối tượng Coupon
            $coupon = new Coupon();
            $coupon->coupon_name = $data['coupon_name'];
            $coupon->coupon_number = $data['coupon_number'];
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->coupon_time = $data['coupon_time'];
            $coupon->coupon_condition = $data['coupon_condition'];
            $coupon->coupon_expire_date = $data['coupon_expire_date'];
            $coupon->coupon_status = 0;

            // Lưu đối tượng Coupon vào CSDL
            $coupon->save();

            // Chuyển hướng về trang insert-coupon và gửi thông báo thành công
            return Redirect::to('list-coupon')->with('success', 'Tạo mã giảm giá mới thành công');
        } else {
            // Nếu thiếu dữ liệu trong request, chuyển hướng về trang insert-coupon với thông báo lỗi
            return Redirect::to('insert-coupon')->with('error', 'Vui lòng nhập đầy đủ thông tin để tạo mã giảm giá');
        }
    }

    public function delete_coupon($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        return Redirect::to('list-coupon')->with('success', 'xóa mã giảm giá thành công');
    }

    public function unset_coupon()
    {
        $coupon = Session::get('coupon');
        if ($coupon == true) {
            Session::forget('coupon');
            return Redirect::to('/show-cart')->with('success', 'xóa mã giảm giá thành công.');
        }
    }

    public function edit_coupon($coupon_id)
    {
        $this->Authenlogin();
        $edit_coupon = DB::table('tbl_coupon')->where('coupon_id', $coupon_id)->get();
        $manager_coupon = view('admin.coupon.edit_coupon')->with('edit_coupon', $edit_coupon);
        return view('admin_layout')->with('admin.coupon.edit_coupon', $manager_coupon);
    }

    public function save_coupon(Request $request)
    {
        $this->Authenlogin();
        $data = array();
        $data['coupon_name'] = $request->coupon_name;
        $data['coupon_time'] = $request->coupon_time;
        $data['coupon_condition'] = $request->coupon_condition;
        $data['coupon_number'] = $request->coupon_number;
        $data['coupon_code'] = $request->coupon_code;
        $data['coupon_expire_date'] = $request->coupon_expire_date;

        DB::table('tbl_coupon')->insert($data);
        return Redirect::to('list-coupon')->with('success', 'coupon created successfully');
    }

    public function update_coupon(Request $request, $coupon_id)
    {
        $this->Authenlogin();
        $data = array();
        $data['coupon_name'] = $request->coupon_name;
        $data['coupon_time'] = $request->coupon_time;
        $data['coupon_condition'] = $request->coupon_condition;
        $data['coupon_number'] = $request->coupon_number;
        $data['coupon_code'] = $request->coupon_code;
        $data['coupon_expire_date'] = $request->coupon_expire_date;

        DB::table('tbl_coupon')->where('coupon_id', $coupon_id)->update($data);
        return Redirect::to('list-coupon')->with('success', 'coupon updated successfully');
    }

    public function unactive_coupon($coupon_id)
    {
        $this->Authenlogin();
        DB::table('tbl_coupon')->where('coupon_id', $coupon_id)->update(['coupon_status' => 1]);
        return Redirect::to('list-coupon')->with('success', 'không kích hoạt coupon thành công');
    }

    public function active_coupon($coupon_id)
    {
        $this->Authenlogin();
        DB::table('tbl_coupon')->where('coupon_id', $coupon_id)->update(['coupon_status' => 0]);
        return Redirect::to('list-coupon')->with('success', 'kích hoạt coupon thành công');
    }

    public function createBatchCoupon()
    {
        return view('admin.coupon.create_batch_coupon');
    }

    public function storeBatchCoupon(Request $request)
    {
        $couponName = 'giảm giá ' . $request->input('coupon_name') . ' ' . $request->input('coupon_expire_date');
        $couponTime = 1;
        $couponCondition = $request->input('coupon_condition');
        $couponNumber = $request->input('coupon_number');
        $couponStatus = 0;
        $couponExpireDate = $request->input('coupon_expire_date');

        for ($i = 1; $i <= $request->input('coupon_quantity'); $i++) {
            // Generate random coupon code
            $randomCode = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 4);

            // Create a new coupon entry in the database
            $newCoupon = new Coupon();
            $newCoupon->coupon_name = $couponName;
            $newCoupon->coupon_time = $couponTime;
            $newCoupon->coupon_condition = $couponCondition;
            $newCoupon->coupon_number = $couponNumber;
            $newCoupon->coupon_code = $randomCode . substr($couponExpireDate, 3, 2) . substr($couponExpireDate, 0, 2);
            $newCoupon->coupon_status = $couponStatus;
            $newCoupon->coupon_expire_date = $couponExpireDate;
            $newCoupon->save();
        }

        return Redirect::to('list-coupon')->with('success', 'Đã tạo mã giảm giá hàng loạt thành công!');
    }
}
