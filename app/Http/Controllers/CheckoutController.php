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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; // Import DB facade

session_start();

class CheckoutController extends Controller
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

    public function login_checkout()
    {
        $blog_category = DB::table('tbl_category_blog')
            ->get();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();
        $districts = DB::table('tbl_district')->get();
        return view('pages.checkout.login_checkout')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('blog_category', $blog_category)
            ->with('districts', $districts);
    }

    public function add_customer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|min:5|max:50',
            'customer_email' => 'required|email|unique:tbl_customer',
            'customer_password' => 'required|min:10|max:50',
            're_customer_password' => 'required|same:customer_password|min:10|max:50',
            'customer_phone' => 'required|numeric|digits:10',
            'customer_address' => 'required|string',
        ], [
            'required' => 'required',
            'min' => 'must have at least :min characters',
            'max' => 'must have at least :max characters',
            'email' => 'must match valid email form',
            'same' => 'not match with above password',
            'numeric' => 'must be number',
            'digits' => 'must have :digits characters',
            'unique' => 'email already exist, please input another email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password); // Use bcrypt for password hashing
        $data['customer_address'] = $request->customer_address;
        $data['customer_point'] = 0;
        $data['district_id'] = $request->district_id;

        $insert_customer = DB::table('tbl_customer')->insertGetId($data);

        Session::put('customer_id', $insert_customer);
        Session::put('customer_name', $request->customer_name);
        return redirect()->to('/trang-chu');
    }


    public function checkout()
    {
        $blog_category = DB::table('tbl_category_blog')->get();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();

        return view('pages.checkout.show_checkout')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('blog_category', $blog_category);
    }


    public function save_checkout_customer(Request $request)
    {
        $request->validate([
            'shipping_name' => 'required',
            'shipping_phone' => 'required',
            'shipping_email' => 'required|email',
            'shipping_notes' => 'nullable',
            'shipping_address' => 'required',
        ], [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute must be a valid email address.',
        ]);
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_address'] = $request->shipping_address;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id', $shipping_id);

        return Redirect::to('/payment');
    }

    public function payment()
    {
        $blog_category = DB::table('tbl_category_blog')
            ->get();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();

        return view('pages.checkout.payment')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('blog_category', $blog_category);
    }

    public function logout_checkout()
    {
        Session::flush();
        return Redirect('/login-checkout');
    }

    public function login_customer(Request $request)
    {
        $request->validate([
            'email_account' => 'required|email',
            'password_account' => 'required|min:5|max:50',
        ], [
            'required' => 'required',
            'email' => 'invalid form.',
            'min' => 'must have at least :min characters.',
            'max' => 'must have at least :max characters',
        ]);

        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')
            ->where('customer_email', $email)
            ->where('customer_password', $password)
            ->first();

        if ($result) {
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            return Redirect::to('/danh-muc-san-pham');
        } else {
            return Redirect::to('/login-checkout');
        }
    }

    public function login_customer_phone(Request $request)
    {
        $request->validate([
            'customer_phone_2' => 'required|numeric|digits:10',
            'password_account_2' => 'required|min:5|max:50',
        ], [
            'required' => 'required',
            'numeric' => 'must be number.',
            'digits' => 'must be :digits characters or numbers.',
            'min' => 'must have at least :min characters.',
            'max' => 'must have at least :max characters',
        ]);

        $customer_phone = $request->customer_phone_2;
        $password = md5($request->password_account_2);
        $result = DB::table('tbl_customer')
            ->where('customer_phone', $customer_phone)
            ->where('customer_password', $password)
            ->first();

        if ($result) {
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            return Redirect::to('/danh-muc-san-pham');
        } else {
            return Redirect::to('/login-checkout');
        }
    }

    public function order_place(Request $request)
    {
        $blog_category = DB::table('tbl_category_blog')
            ->get();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();

        // Get payment method
        $request->validate([
            'payment_option' => 'required|in:1,2', // Kiểm tra tùy chọn thanh toán
        ], [
            'required' => 'Please choose one payment option.',
            'in' => 'Please choose one payment option in valid.',
        ]);

        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'in process';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        // Insert order table: tbl_order
        $total = str_replace(',', '', Cart::total());
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;

        $customer_id = Session::get('customer_id');
        $customer = Customer::find($customer_id);
        $order_data['order_address'] = $customer->customer_address;
        $order_data['district_id'] = $customer->district_id;
        $order_total = $total; // Tạo biến mới để lưu trữ giá trị order_total
        $coupons = Session::get('coupon');

        if ($coupons) {
            foreach ($coupons as $key => $cou) {
                if (isset($cou['coupon_condition'])) {
                    if ($cou['coupon_condition'] == 1) {
                        $coupon_discount = ($total * $cou['coupon_number']) / 100;
                        $order_total -= $coupon_discount;

                        $coupon_data = $cou;
                        $coupon_id = $coupon_data['coupon_id'];
                        $coupon = DB::table('tbl_coupon')
                            ->where('coupon_id', $coupon_id)
                            ->first();
                        if ($coupon) {
                            $new_coupon_time = $coupon->coupon_time - 1;
                            DB::table('tbl_coupon')
                                ->where('coupon_id', $coupon_id)
                                ->update(['coupon_time' => $new_coupon_time]);
                        }
                    } elseif ($cou['coupon_condition'] == 2) {
                        $coupon_discount = $cou['coupon_number'];
                        $order_total -= $coupon_discount;

                        $coupon_data = $cou;
                        $coupon_id = $coupon_data['coupon_id'];
                        $coupon = DB::table('tbl_coupon')
                            ->where('coupon_id', $coupon_id)
                            ->first();
                        if ($coupon) {
                            $new_coupon_time = $coupon->coupon_time - 1;
                            DB::table('tbl_coupon')
                                ->where('coupon_id', $coupon_id)
                                ->update(['coupon_time' => $new_coupon_time]);
                        }
                    }
                }
            }
        }

        $order_data['order_total'] = $order_total;
        $order_data['order_status'] = 1;
        $order_data['admin_id'] = 20;

        // Insert the order into the tbl_order table
        $order_id = DB::table('tbl_order')->insertGetId($order_data);


        // Insert order details
        $content = Cart::content();
        $customer_total_point = 0; // Initialize the total point earned by the customer
        $product_qty_order = 0;

        foreach ($content as $v_content) {
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price * (1 - ($v_content->options->discount) / 100);
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            $order_d_data['product_flavour'] = $v_content->options->flavour;

            // Get product_point from tbl_product
            $product = DB::table('tbl_product')->where('product_id', $v_content->id)->first();
            $product_point = $product->product_point;

            // Calculate the total point earned from this order
            $customer_total_point += $product_point * $v_content->qty;
            $product_qty_order = $v_content->qty;
            // Add 'product_point' to the order details data
            $order_d_data['product_point'] = $product_point;

            // Insert order details
            DB::table('tbl_order_details')->insert($order_d_data);

            // Update product_quantity in the tbl_product table
            // Trừ đi số lượng đã bán trong đơn hàng hiện tại
            $product_id = $order_d_data['product_id'];
            $product = Product::find($product_id);

            if ($product) {
                $new_product_quantity = $product->product_quantity - $v_content->qty;
                // Cập nhật số lượng sản phẩm mới vào bảng tbl_product
                DB::table('tbl_product')
                    ->where('product_id', $product_id)
                    ->update(['product_quantity' => $new_product_quantity]);
            }

            $coupon = Session::get('coupon');
            if ($coupon == true) {
                Session::forget('coupon');
            }
        }


        // Update customer_point in the tbl_customer table
        $customer_id = Session::get('customer_id');
        $customer = Customer::find($customer_id);

        // If the customer exists, update the customer_point
        if ($customer) {
            $customer->customer_point += $customer_total_point;
            $product->product_quantity -= $product_qty_order;
            $customer->save();
        }

        // Gửi email xác nhận đơn hàng
        $list_product_by_id = DB::table('tbl_order')
            ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
            ->where('tbl_order.order_id', '=', $order_id)
            ->get();

        $order_data = [
            'customer_name' => Session::get('customer_name'),
            'order_id' => $order_id,
            'order_total' => Cart::total(),
            'list_product_by_id' => $list_product_by_id,
        ];

        $customer_email = $customer->customer_email;
        $customer_name = $customer->customer_name;
        Mail::send('pages.mail.order_confirmation', $order_data, function ($message) use ($customer_email, $customer_name) {
            $message->to($customer_email, $customer_name)->subject('Xác nhận đơn hàng');
            $message->from(config('mail.from.address'), config('mail.from.name'));
        });


        if ($data['payment_method'] == 1) {
            Cart::destroy();
            return view('pages.checkout.handcash')
                ->with('category', $cate_product)
                ->with('brand', $brand_product)
                ->with('list_product_by_id', $list_product_by_id)
                ->with('blog_category', $blog_category);
        } elseif ($data['payment_method'] == 2) {
            Cart::destroy();
            return view('pages.checkout.handcash')
                ->with('category', $cate_product)
                ->with('brand', $brand_product)
                ->with('list_product_by_id', $list_product_by_id)
                ->with('blog_category', $blog_category);
        } else {
            echo 'error';
        }
    }

    public function manage_order(Request $request)
    {
        $this->Authenlogin();

        $admin_id = Session::get('admin_id'); // Lấy admin_id từ session
        $admin_role_value = Session::get('admin_role_value'); // Lấy role_value từ session

        // Lấy tất cả các đơn đặt hàng và thêm phân trang
        $all_order_query = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
            ->join('tbl_district', 'tbl_district.district_id', '=', 'tbl_order.district_id')
            ->join('tbl_admin', 'tbl_admin.admin_id', '=', 'tbl_order.admin_id')
            ->select('tbl_order.*', 'tbl_customer.customer_name', 'tbl_district.district_name', 'tbl_admin.admin_name')
            ->orderBy('tbl_order.order_id', 'desc');

        if ($admin_role_value == 1) {
            // Hiển thị tất cả đơn hàng nếu là admin
            $all_order = $all_order_query->paginate(5);
        } else {
            // Lọc đơn hàng dựa trên admin_id nếu là shipper
            $all_order = $all_order_query
                ->where('tbl_order.admin_id', $admin_id)
                ->paginate(5);
        }

        // Lọc đơn hàng theo trạng thái nếu có tham số 'status' trong request
        if ($request->has('status')) {
            $status = $request->input('status');
            $all_order = $all_order_query->where('tbl_order.order_status', $status)->paginate(5);
        }

        // Tìm kiếm theo order_id nếu có tham số 'order_id' trong request
        if ($request->has('order_id')) {
            $order_id = $request->input('order_id');
            $all_order = $all_order_query->where('tbl_order.order_id', 'LIKE', "%$order_id%")->paginate(5);
        }

        // Tạo một câu truy vấn cơ sở
        $query = $all_order_query;

        if ($request->has('status')) {
            $status = $request->input('status');
            $query->where('tbl_order.order_status', $status);
        }

        if ($request->has('order_id')) {
            $order_id = $request->input('order_id');
            $query->where('tbl_order.order_id', 'LIKE', "%$order_id%");
        }

        // Tìm kiếm theo quận
        if ($request->has('district_id')) {
            $district_id = $request->input('district_id');
            $query->where('tbl_order.district_id', $district_id);
        }

        // Tìm kiếm theo tên khách hàng, số điện thoại hoặc địa chỉ
        if ($request->has('search_customer')) {
            $search_customer = $request->input('search_customer');
            $query->where(function ($q) use ($search_customer) {
                $q->where('tbl_customer.customer_name', 'LIKE', "%$search_customer%")
                    ->orWhere('tbl_customer.customer_phone', 'LIKE', "%$search_customer%")
                    ->orWhere('tbl_customer.customer_address', 'LIKE', "%$search_customer%")
                    ->orWhere('tbl_admin.admin_name', 'LIKE', "%$search_customer%");
            });
        }

        // Thực hiện truy vấn và lấy dữ liệu phân trang
        $all_order = $query->paginate(5);

        foreach ($all_order as $order) {
            $payment = Payment::find($order->payment_id);

            if ($payment) {
                $order->payment_method = $payment->payment_method;
            } else {
                $order->payment_method = 'Unknown';
            }
        }

        // Đếm số lượng đơn đặt hàng
        $count_order = DB::table('tbl_order')->count();

        // Đếm số lượng đơn đặt hàng theo trạng thái
        $count_orderst_1 = DB::table('tbl_order')
            ->where('order_status', 1)
            ->count();

        $count_orderst_2 = DB::table('tbl_order')
            ->where('order_status', 2)
            ->count();

        $count_orderst_3 = DB::table('tbl_order')
            ->where('order_status', 3)
            ->count();

        $count_orderst_4 = DB::table('tbl_order')
            ->where('order_status', 4)
            ->count();

        $count_orderst_5 = DB::table('tbl_order')
            ->where('order_status', 5)
            ->count();

        // Lấy danh sách quận
        $districts = District::all();

        // Truyền dữ liệu vào view và sử dụng mảng để gom chung các biến
        return view('admin.manage_order', [
            'all_order' => $all_order,
            'count_order' => $count_order,
            'count_orderst_1' => $count_orderst_1,
            'count_orderst_2' => $count_orderst_2,
            'count_orderst_3' => $count_orderst_3,
            'count_orderst_4' => $count_orderst_4,
            'count_orderst_5' => $count_orderst_5,
            'districts' => $districts,
        ]);
    }



    public function view_order($order_id)
    {
        $this->Authenlogin();
        $order_by_id = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_customer.customer_id', '=', 'tbl_order.customer_id')
            ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_order.shipping_id')
            ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
            ->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_order.payment_id')
            ->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*', 'tbl_order_details.*')
            ->where('tbl_order.order_id', '=', $order_id)
            ->first();

        $list_product_by_id = DB::table('tbl_order')
            ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
            ->where('tbl_order.order_id', '=', $order_id)
            ->get();

        $manager_order_by_id = view('admin.view_order')
            ->with('order_by_id', $order_by_id)
            ->with('list_product_by_id', $list_product_by_id);

        return view('admin_layout')
            ->with('admin.view_order', $manager_order_by_id);
    }

    public function delete_order($order_id)
    {
        $this->Authenlogin();

        // Sử dụng transaction để đảm bảo tính toàn vẹn dữ liệu khi xóa
        DB::transaction(function () use ($order_id) {
            // Xóa thông tin chi tiết đơn hàng (các bản ghi trong bảng tbl_order_details)
            DB::table('tbl_order_details')->where('order_id', $order_id)->delete();

            // Xóa thông tin thanh toán đơn hàng (bản ghi trong bảng tbl_payment)
            $payment_id = DB::table('tbl_order')->where('order_id', $order_id)->value('payment_id');
            DB::table('tbl_payment')->where('payment_id', $payment_id)->delete();

            // Xóa thông tin vận chuyển đơn hàng (bản ghi trong bảng tbl_shipping)
            $shipping_id = DB::table('tbl_order')->where('order_id', $order_id)->value('shipping_id');
            DB::table('tbl_shipping')->where('shipping_id', $shipping_id)->delete();

            // Cuối cùng, xóa đơn hàng (bản ghi trong bảng tbl_order)
            DB::table('tbl_order')->where('order_id', $order_id)->delete();
        });

        return Redirect::to('manage-order')->with('success', 'Order deleted successfully');
    }
}
