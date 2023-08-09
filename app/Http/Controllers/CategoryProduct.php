<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; // Import DB facade

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

session_start();

class CategoryProduct extends Controller
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

    public function add_category_product()
    {
        $this->Authenlogin();
        return view('admin.add_category_product');
    }

    public function all_category_product()
    {
        $this->Authenlogin();
        $all_category_product = DB::table('tbl_category_product')
            ->paginate(5);

        $manager_category_product = view('admin.all_category_product')
            ->with('all_category_product', $all_category_product);

        return view('admin_layout')
            ->with('admin.all_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request)
    {
        $this->Authenlogin();
        //return view('admin.all_category_product');
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')
            ->insert($data);
        //Session::put('message','thêm danh mục sản phẩm thành công');

        return Redirect::to('add-category-product')
            ->with('success', 'new category created successfully');
    }

    public function unactive_category_product($category_product_id)
    {
        $this->Authenlogin();
        DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->update(['category_status' => 1]);
        //Session::put('message','thêm danh mục sản phẩm thành công');

        return Redirect::to('all-category-product')
            ->with('success', 'không kích hoạt danh mục sản phẩm thành công');
    }

    public function active_category_product($category_product_id)
    {
        $this->Authenlogin();
        DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->update(['category_status' => 0]);
        //Session::put('message','thêm danh mục sản phẩm thành công');

        return Redirect::to('all-category-product')
            ->with('success', 'kích hoạt danh mục sản phẩm thành công');
    }

    public function edit_category_product($category_product_id)
    {
        $this->Authenlogin();
        $edit_category_product = DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->get();

        $manager_category_product = view('admin.edit_category_product')
            ->with('edit_category_product', $edit_category_product);

        return view('admin_layout')
            ->with('admin.edit_category_product', $manager_category_product);
    }

    public function update_category_product(Request $request, $category_product_id)
    {
        $this->Authenlogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['meta_keywords'] = $request->category_product_keywords;

        DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->update($data);

        return Redirect::to('all-category-product')
            ->with('success', 'category updated successfully');
    }

    public function delete_category_product($category_product_id)
    {
        $this->Authenlogin();
        DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->delete();

        return Redirect::to('all-category-product')
            ->with('success', 'category deleted successfully');
    }

    //end function admin page

    public function show_all_category_product(Request $request)
    {
        $meta_title = '';
        $url_canonical = $request->url();

        $blog_category = DB::table('tbl_category_blog')
            ->get();

        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')
            ->get();

        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')
            ->get();

        $category_all_product = DB::table('tbl_product')
            ->where('product_status', 0)
            ->paginate(8);

        foreach ($category_all_product as $key => $val) {
            //seo
            $meta_title = $val->product_name;
            $url_canonical = $request->url();
            //--seo--
        }
        return view('pages.category.show_category_all')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('category_all_product', $category_all_product)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical)
            ->with('blog_category', $blog_category);
    }

    public function show_all_brand_product()
    {
        $blog_category = DB::table('tbl_category_blog')
            ->get();

        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')
            ->get();

        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')
            ->get();

        $brand_all_product = DB::table('tbl_product')
            ->paginate(8);

        return view('pages.brand.show_brand_all')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('brand_all_product', $brand_all_product)
            ->with('blog_category', $blog_category);
    }

    public function show_all_blog(Request $request)
    {
        $meta_title = '';
        $url_canonical = $request->url();

        $blog_category = DB::table('tbl_category_blog')
            ->get();

        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')
            ->get();

        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')
            ->get();

        $category_all_blog = DB::table('tbl_blog')
            ->where('blog_status', '0')
            ->paginate(8);

        foreach ($category_all_blog as $key => $val) {
            //seo
            $meta_title = $val->blog_title;
            $url_canonical = $request->url();
            //--seo--
        }

        return view('pages.blog.show_all_blog')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical)
            ->with('category_all_blog', $category_all_blog)
            ->with('blog_category', $blog_category);
    }


    public function show_category_home(Request $request, $category_id)
    {
        $meta_desc = '';
        $meta_keywords = '';
        $meta_category_title = '';
        $url_canonical = $request->url();

        $blog_category = DB::table('tbl_category_blog')
            ->get();

        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')
            ->get();

        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')
            ->get();

        $category_by_id = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->where('product_status', 0)
            ->where('tbl_product.category_id', $category_id)
            ->paginate(8);

        foreach ($category_by_id as $key => $val) {
            //seo
            $meta_desc = $val->category_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_category_title = $val->category_name;
            $url_canonical = $request->url();
            //--seo--
        }

        return view('pages.category.show_category')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('category_by_id', $category_by_id)
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_category_title', $meta_category_title)
            ->with('url_canonical', $url_canonical)
            ->with('blog_category', $blog_category);
    }


    public function show_brand_home(Request $request, $brand_id)
    {
        $meta_brand_title = '';
        $url_canonical = $request->url();

        $blog_category = DB::table('tbl_category_blog')
            ->get();

        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')
            ->get();

        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')
            ->get();

        $brand_by_id = DB::table('tbl_product')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.brand_id', $brand_id)
            ->where('product_status', '0')
            ->paginate(8);

        foreach ($brand_by_id as $key => $val) {
            //seo
            $meta_brand_title = $val->brand_name;
            $url_canonical = $request->url();
            //--seo--
        }

        return view('pages.brand.show_brand')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('meta_brand_title', $meta_brand_title)
            ->with('url_canonical', $url_canonical)
            ->with('brand_by_id', $brand_by_id)
            ->with('blog_category', $blog_category);
    }

    public function show_blog_by_category(Request $request, $blog_category_id)
    {
        $meta_blog_title = '';
        $url_canonical = $request->url();

        $blog_category = DB::table('tbl_category_blog')
            ->get();

        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')
            ->get();

        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')
            ->get();

        $blog_by_category = DB::table('tbl_blog')
            ->join('tbl_category_blog', 'tbl_category_blog.blog_category_id', '=', 'tbl_blog.blog_category_id')
            ->where('tbl_blog.blog_category_id', $blog_category_id)
            ->where('blog_status', '0')
            ->paginate(8);

        foreach ($blog_by_category as $key => $val) {
            //seo
            $meta_blog_title = $val->blog_category_name;
            $url_canonical = $request->url();
            //--seo--
        }

        return view('pages.blog.show_blog_by_category')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('meta_blog_title', $meta_blog_title)
            ->with('url_canonical', $url_canonical)
            ->with('blog_by_category', $blog_by_category)
            ->with('blog_category', $blog_category);
    }
}
