<?php

namespace App\Http\Controllers;

use App\Http\Requests;


use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; // Import DB facade

session_start();

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //seo
        $meta_desc = "gym supplements and gears";
        $meta_keywords = "Axe & Sledge Supplements,thuc pham chuc nang,phụ kiện gym, thực phẩm gym";
        $meta_title = "Axe & Sledge Supplements";
        $meta_image = "https://axeandsledge.com/cdn/shop/files/axe-logo_410x.png?v=1614293969";
        $url_canonical = $request->url();
        //--seo--
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $blog_category = DB::table('tbl_category_blog')
            ->get();

        $all_product = DB::table('tbl_product')
            ->where('product_status', 0)
            ->limit(4)
            ->get();

        $all_product_stack = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->where('category_name', 'stack')
            ->limit(4)
            ->get();

        $all_product_basic = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->where('category_name', 'basics')
            ->limit(4)
            ->get();

        return view("pages.home")
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('all_product', $all_product)
            ->with('all_product_stack', $all_product_stack)
            ->with('all_product_basic', $all_product_basic)
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical)
            ->with('meta_image', $meta_image)
            ->with('blog_category', $blog_category);

        // return view("pages.home")
        //     ->with(compact('cate_product', 'brand_product', 'all_product', 'all_product_stack', 'all_product_basic'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $blog_category = DB::table('tbl_category_blog')
            ->get();

        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keyword . '%')->get();

        return view("pages.sanpham.search")
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('search_product', $search_product)
            ->with('blog_category', $blog_category);
    }

    public function customer_information()
    {
        $blog_category = DB::table('tbl_category_blog')
            ->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $customer_id = Session::get('customer_id');
        $customer = Customer::find($customer_id);

        return view('pages.customer_information')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('customer', $customer)
            ->with('blog_category', $blog_category);
    }

    public function updateCustomer(Request $request, $customerId)
    {
        $request->validate([
            'customer_name' => 'nullable|string|max:255|unique:tbl_customer,customer_name,' . $customerId . ',customer_id',
            'customer_email' => 'nullable|email|unique:tbl_customer,customer_email,' . $customerId . ',customer_id',
            'customer_phone' => 'nullable|string|max:15|unique:tbl_customer,customer_phone,' . $customerId . ',customer_id',
            'customer_address' => 'nullable|string|max:255|unique:tbl_customer,customer_address,' . $customerId . ',customer_id',
        ], [
            'required' => ':attribute required.',
            'min' => ':attribute must have at least :min characters.',
            'max' => ':attribute must not over :max characters.',
            'email' => 'must match email form.',
            'unique' => 'already exist, please input another one.',
        ]);

        $blog_category = DB::table('tbl_category_blog')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $customer = Customer::findOrFail($customerId);

        // Update other fields
        $customer->update([
            'customer_name' => $request->input('customer_name'),
            'customer_email' => $request->input('customer_email'),
            'customer_phone' => $request->input('customer_phone'),
            'customer_address' => $request->input('customer_address'),
        ]);

        return view('pages.customer_information', compact('customer'))
            ->with('blog_category', $blog_category)
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('success', 'Customer information updated successfully.');
    }


    public function showChangePasswordForm()
    {
        $blog_category = DB::table('tbl_category_blog')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $customer_id = Session::get('customer_id');
        $customer = Customer::find($customer_id);

        return view('pages.change_password', [
            'blog_category' => $blog_category,
            'category' => $cate_product,
            'brand' => $brand_product,
            'customer' => $customer, // Truyền biến customer vào view
        ]);
    }


    public function changePassword(Request $request, $customer_id)
    {
        $this->validate($request, [
            'new_password' => 'required|min:5|confirmed',
        ]);

        $customer = Customer::find($customer_id);

        if (!$customer) {
            return redirect()
                ->route('change_password')
                ->with('error', 'customer not found.');
        }

        // Update customer's password using md5()
        $customer->update([
            'customer_password' => md5($request->input('new_password')),
        ]);

        return redirect()
            ->route('change_password')
            ->with('success', 'password updated successfully.');
    }


    public function cart_history()
    {
        $blog_category = DB::table('tbl_category_blog')
            ->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $customer_id = Session::get('customer_id');
        $customer = Customer::find($customer_id);

        $cart_history = DB::table('tbl_order')
            ->where('customer_id', $customer_id)
            ->orderBy('order_id', 'desc')
            ->paginate(2);

        $cart_history_detail = DB::table('tbl_order')
            ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
            ->select('tbl_order.*', 'tbl_order_details.product_name', 'tbl_order_details.product_sales_quantity', 'tbl_order_details.product_price', 'tbl_order_details.product_flavour')
            ->where('customer_id', $customer_id)
            ->orderBy('order_id', 'desc')
            ->get();

        return view('pages.cart_history')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('customer', $customer)
            ->with('blog_category', $blog_category)
            ->with('cart_history', $cart_history)
            ->with('cart_history_detail', $cart_history_detail);
    }
}
