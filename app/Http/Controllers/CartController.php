<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Coupon;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect; // Add the Redirect facade

session_start();
class CartController extends Controller
{
    public function save_cart(Request $request, $product_id)
    {
        // Cart::destroy();
        $product = Product::find($product_id);
        $quantity = $request->input('quantity_input'); // Update this line to get the correct quantity input
        $customer_id = Session::get('customer_id');
        $customer = Customer::find($customer_id);

        if ($customer) {
            // If the customer exists, get the customer_point
            $customer_point = $customer->customer_point;
        } else {
            // If the customer doesn't exist, set customer_point to 0 or any default value you prefer
            $customer_point = 0;
        }

        Cart::add([
            'id' => $product->product_id,
            'name' => $product->product_name,
            'qty' => $quantity,
            'price' => $product->product_price,
            'options' => [
                'flavour' => $product->product_flavour,
                'image' => $product->product_image,
                'discount' => $product->product_discount,
            ],
        ]);

        if ($customer) {
            return Redirect::to('/chi-tiet-san-pham/' . $product_id)
                ->with('success', 'Product added to cart successfully.')
                ->with('customer_point', $customer_point);
        } else {
            return Redirect::to('/login-checkout');
        }
    }

    public function show_cart()
    {
        $blog_category = DB::table('tbl_category_blog')
            ->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $customer_id = Session::get('customer_id');

        // Assuming you have a method to fetch the customer data by ID (e.g., using Eloquent ORM in Laravel)
        $customer = Customer::find($customer_id);
        return view('pages.cart.show_cart')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('customer', $customer)
            ->with('blog_category', $blog_category);
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return Redirect::to('/show-cart')->with('success', 'Product removed successfully.');
    }

    public function destroy()
    {
        Cart::destroy();
        Session::forget('coupon');
        return Redirect::to('/show-cart')->with('success', 'Product destroyed successfully.');
    }

    public function update(Request $request)
    {
        $data = $request->get('qty');
        foreach ($data as $k => $v) {
            Cart::update($k, $v);
        }
        return Redirect::to('/show-cart')->with('success', 'Product updated successfully.');
    }

    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();

        if ($coupon) {
            $count_coupon = $coupon->count();

            if ($count_coupon > 0) {
                $coupon_session = Session::get('coupon');

                if (!$coupon_session && $coupon->coupon_status == 0) {
                    $coupon_data = [
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    ];

                    Session::put('coupon', [$coupon_data]);
                    Session::save();

                    return redirect()->back()->with('success', 'Thêm mã giảm giá thành công.');
                }
            }
        } 
        return redirect()->back()->with('error', 'không thể thêm mã giảm giá.');
    }
}
