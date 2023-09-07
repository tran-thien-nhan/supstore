<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; // Import DB facade

session_start();

class ProductController extends Controller
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

    public function add_product()
    {
        $this->Authenlogin();

        // $blog_category = DB::table('tbl_category_blog')
        //     ->where('blog_category_status', '0')
        //     ->orderBy('blog_category_id ', 'desc')
        //     ->get();

        $cate_product = DB::table('tbl_category_product')
            ->orderBy('category_id', 'desc')
            ->get();

        $brand_product = DB::table('tbl_brand')
            ->orderBy('brand_id', 'desc')
            ->get();

        return view('admin.add_product')
            ->with('cate_product', $cate_product)
            ->with('brand_product', $brand_product);
    }

    public function all_product()
    {
        $this->Authenlogin();

        // $blog_category = DB::table('tbl_category_blog')
        //     ->where('blog_category_status', '0')
        //     ->orderBy('blog_category_id ', 'desc')
        //     ->get();

        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->paginate(5);

        $all_category_product = DB::table('tbl_category_product')->get();
        $all_brand_product = DB::table('tbl_brand')->get();

        $manager_product = view('admin.all_product')
            ->with('all_product', $all_product)
            ->with('all_category_product', $all_category_product)
            ->with('all_brand_product', $all_brand_product);

        return view('admin_layout')
            ->with('admin.all_product', $manager_product);
    }

    public function save_product(Request $request)
    {
        $this->Authenlogin();
        //return view('admin.all_product');
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_discount'] = $request->product_discount;
        $data['product_flavour'] = $request->product_flavour;
        $data['product_point'] = $request->product_price * (1 - $request->product_discount / 100) / 100000;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $timestamp = time(); // hoặc $timestamp = date('Ymd_His');
            $new_image = $name_image . '_' . $timestamp . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);

            return Redirect::to('all-product')->with('success', 'product created successfully');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);

        return Redirect::to('add-product')->with('success', 'product created successfully');
    }

    public function unactive_product($product_id)
    {
        $this->Authenlogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        //Session::put('message','thêm thương hiệu sản phẩm thành công');
        return Redirect::to('all-product')->with('success', 'unactivate product successfully');
    }

    public function active_product($product_id)
    {
        $this->Authenlogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        //Session::put('message','thêm thương hiệu sản phẩm thành công');
        return Redirect::to('all-product')->with('success', 'activate product successfully');
    }

    public function edit_product($product_id)
    {
        $this->Authenlogin();

        // $blog_category = DB::table('tbl_category_blog')
        //     ->where('blog_category_status', '0')
        //     ->orderBy('blog_category_id ', 'desc')
        //     ->get();

        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)
            ->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $product_id)
    {
        $this->Authenlogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_discount'] = $request->product_discount;
        $data['product_flavour'] = $request->product_flavour;
        $data['product_point'] = $request->product_price * (1 - $request->product_discount / 100) / 100000;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $get_image = $request->file('product_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $timestamp = time(); // hoặc $timestamp = date('Ymd_His');
            $new_image = $name_image . '_' . $timestamp . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            return Redirect::to('all-product')->with('success', 'product updated successfully');
        }

        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        return Redirect::to('all-product')->with('success', 'product updated successfully');
    }

    public function delete_product($product_id)
    {
        $this->Authenlogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        return Redirect::to('all-product')->with('success', 'product deleted successfully');
    }

    // ket thuc trang admin page

    public function details_product(Request $request, $product_id)
    {
        $meta_desc = '';
        $meta_keywords = '';
        $meta_title = '';
        $meta_image = '';
        $meta_caegory_title = '';
        $url_canonical = $request->url();

        $blog_category = DB::table('tbl_category_blog')->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $detail_product_by_id = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            // ->join('tbl_comments', 'tbl_comments.product_id', '=', 'tbl_product.product_id')
            ->where('tbl_product.product_id', $product_id)
            ->get();

        $product = Product::with('comments')->find($product_id);

        $comments_count = Product::with('comments')->find($product_id)->comments->count();

        // Lấy customer_id từ session
        $customer_id = Session::get('customer_id');

        // Lấy thông tin customer_name từ bảng tbl_customer
        $customer_name = DB::table('tbl_customer')->where('customer_id', $customer_id)->value('customer_name');

        // Thêm thông tin customer_name vào dữ liệu sản phẩm
        $product->customer_name = $customer_name;


        $product_name = $detail_product_by_id->first()->product_name;

        $detail_product_by_flavours = DB::table('tbl_product')
            ->where('product_name', $product_name)
            ->get();

        foreach ($detail_product_by_id as $key => $value) {
            $category_id = $value->category_id;
        }

        $related_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category_product.category_id', $category_id)
            ->whereNotIn('tbl_product.product_id', [$product_id])
            ->where('product_status', 0)
            ->limit(3)
            ->get();

        foreach ($detail_product_by_id as $key => $val) {
            //seo
            $meta_desc = $val->category_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_title = $val->product_name;
            $meta_caegory_title = $val->category_name;
            $meta_image = $val->product_image;
            $url_canonical = $request->url();
            //--seo--
        }

        return view('pages.sanpham.show_details')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('detail_product_by_id', $detail_product_by_id)
            ->with('detail_product_by_flavours', $detail_product_by_flavours)
            ->with('relate', $related_product)
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('meta_caegory_title', $meta_caegory_title)
            ->with('meta_image', $meta_image)
            ->with('url_canonical', $url_canonical)
            ->with('blog_category', $blog_category)
            ->with('product', $product)
            ->with('comments_count', $comments_count);
        // ;
    }

    public function all_product_by_category($category_id)
    {
        $this->Authenlogin();

        $blog_category = DB::table('tbl_category_blog')
            ->get();

        $all_category_product = DB::table('tbl_category_product')->get();
        $all_brand_product = DB::table('tbl_brand')->get();

        $category_by_id = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.category_id', $category_id)
            ->paginate(5);

        return view('admin.all_product_by_category')
            ->with('category_by_id', $category_by_id)
            ->with('all_category_product', $all_category_product)
            ->with('all_brand_product', $all_brand_product)
            ->with('blog_category', $blog_category);
    }

    public function all_product_by_brand($brand_id)
    {
        $this->Authenlogin();

        $blog_category = DB::table('tbl_category_blog')
            ->get();

        $all_category_product = DB::table('tbl_category_product')->get();
        $all_brand_product = DB::table('tbl_brand')->get();

        $brand_by_id = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.brand_id', $brand_id)
            ->paginate(5);

        return view('admin.all_product_by_brand')
            ->with('brand_by_id', $brand_by_id)
            ->with('all_category_product', $all_category_product)
            ->with('all_brand_product', $all_brand_product)
            ->with('blog_category', $blog_category);
    }

    public function filter_by_date(Request $request)
    {

        $all_category_product = DB::table('tbl_category_product')->get();
        $all_brand_product = DB::table('tbl_brand')->get();

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Lọc dữ liệu từ database theo ngày bắt đầu và ngày kết thúc
        $filteredData = Product::whereBetween('created_at', [$start_date, $end_date])->get();

        // Gửi dữ liệu lọc được tới view để hiển thị
        return view('admin.filtered_data', ['data' => $filteredData])
            ->with('all_category_product', $all_category_product)
            ->with('all_brand_product', $all_brand_product);
    }
}
