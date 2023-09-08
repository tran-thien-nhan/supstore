<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect; // Add the Redirect facade
use App\Models\Coupon;

session_start();

class BlogController extends Controller
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

    public function unactive_blog($blog_id)
    {
        $this->Authenlogin();
        DB::table('tbl_blog')->where('blog_id', $blog_id)->update(['blog_status' => 1]);
        return Redirect::to('all-blog')->with('success', 'unactivate blog successfully');
    }

    public function active_blog($blog_id)
    {
        $this->Authenlogin();
        DB::table('tbl_blog')->where('blog_id', $blog_id)->update(['blog_status' => 0]);
        return Redirect::to('all-blog')->with('success', 'activate blog successfully');
    }

    public function all_blog_category()
    {
        $this->Authenlogin();
        $all_blog_category = DB::table('tbl_category_blog')
            ->paginate(5);

        $manager_blog_category = view('admin.all_blog_category')
            ->with('all_blog_category', $all_blog_category);

        return view('admin_layout')
            ->with('admin.all_blog_category', $manager_blog_category);
    }

    public function add_blog()
    {
        $this->Authenlogin();

        $cate_blog = DB::table('tbl_category_blog')
            ->orderBy('blog_category_id', 'desc')
            ->get();

        return view('admin.add_blog')
            ->with('cate_blog', $cate_blog);
    }

    public function save_blog(Request $request)
    {
        $this->Authenlogin();

        $request->validate([
            'blog_title' => 'required',
            'pre_blog_content' => 'required',
            'blog_content' => 'required',
            'blog_cate' => 'required',
            'blog_thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra nếu là ảnh và có định dạng phù hợp
        ], [
            'required' => 'The :attribute field is required.',
            'image' => 'The :attribute must be an image.',
            'mimes' => 'The :attribute must be a file of type: :values.',
            'max' => 'The :attribute may not be greater than :max kilobytes.',
        ]);

        $data = array();
        $data['blog_title'] = $request->blog_title;
        $data['pre_blog_content'] = $request->pre_blog_content;
        $data['blog_content'] = $request->blog_content;
        $data['blog_category_id'] = $request->blog_cate;
        $data['blog_status'] = 0;
        $get_image = $request->file('blog_thumbnail');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $timestamp = time();
            $new_image = $name_image . '_' . $timestamp . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/blog', $new_image);
            $data['blog_thumbnail'] = $new_image;
            DB::table('tbl_blog')->insert($data);

            return redirect()->to('all-blog')->with('success', 'Blog created successfully');
        }

        $data['blog_thumbnail'] = '';
        DB::table('tbl_blog')->insert($data);

        return redirect()->to('all-blog')->with('success', 'Blog created successfully');
    }


    public function all_blog()
    {
        $this->Authenlogin();

        $all_blog = DB::table('tbl_blog')
            ->join('tbl_category_blog', 'tbl_category_blog.blog_category_id', '=', 'tbl_blog.blog_category_id')
            ->select('tbl_blog.*', 'tbl_category_blog.blog_category_id', 'tbl_category_blog.blog_category_name')
            ->paginate(5);

        $all_category_blog = DB::table('tbl_category_blog')->get();

        $manager_blog = view('admin.all_blog')
            ->with('all_blog', $all_blog)
            ->with('all_category_blog', $all_category_blog);

        return view('admin_layout')
            ->with('admin.all_blog', $manager_blog);
    }

    public function add_category_blog()
    {
        $this->Authenlogin();
        return view('admin.add_blog_category');
    }

    public function save_category_blog(Request $request)
    {
        $this->Authenlogin();

        $request->validate([
            'blog_category_name' => 'required',
            'blog_category_desc' => 'required',
            'blog_category_status' => 'required',
            'category_blog_keywords' => 'required',
        ], [
            'required' => 'The :attribute field is required.',
        ]);

        $data = array();
        $data['blog_category_name'] = $request->blog_category_name;
        $data['blog_category_desc'] = $request->blog_category_desc;
        $data['blog_category_status'] = $request->blog_category_status;
        $data['meta_keywords'] = $request->category_blog_keywords;

        DB::table('tbl_category_blog')->insert($data);

        return redirect()->to('add-blog-category')->with('success', 'New blog category created successfully');
    }


    public function unactive_category_blog($blog_category_id)
    {
        $this->Authenlogin();
        DB::table('tbl_category_blog')
            ->where('blog_category_id', $blog_category_id)
            ->update(['blog_category_status' => 1]);
        //Session::put('message','thêm danh mục bài viết thành công');

        return Redirect::to('all-blog-category')
            ->with('success', 'unactivate blog category successfully');
    }

    public function active_category_blog($blog_category_id)
    {
        $this->Authenlogin();
        DB::table('tbl_category_blog')
            ->where('blog_category_id', $blog_category_id)
            ->update(['blog_category_status' => 0]);
        //Session::put('message','thêm danh mục sản phẩm thành công');

        return Redirect::to('all-blog-category')
            ->with('success', 'activate blog category successfully');
    }

    public function edit_blog($blog_id)
    {
        $cate_blog = DB::table('tbl_category_blog')
            ->orderBy('blog_category_id', 'desc')
            ->get();

        $edit_blog = DB::table('tbl_blog')->where('blog_id', $blog_id)->get();

        $manager_blog = view('admin.edit_blog')
            ->with('edit_blog', $edit_blog)
            ->with('cate_blog', $cate_blog);

        return view('admin_layout')->with('admin.edit_blog', $manager_blog);
    }

    public function update_blog(Request $request, $blog_id)
    {
        $this->Authenlogin();
        $request->validate([
            'blog_title' => 'required',
            'pre_blog_content' => 'required',
            'blog_content' => 'required',
            'blog_cate' => 'required',
            'blog_status' => 'required',
            'blog_thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra nếu là ảnh và có định dạng phù hợp
        ], [
            'required' => 'The :attribute field is required.',
            'image' => 'The :attribute must be an image.',
            'mimes' => 'The :attribute must be a file of type: :values.',
            'max' => 'The :attribute may not be greater than :max kilobytes.',
        ]);
        $data = array();
        $data['blog_title'] = $request->blog_title;
        $data['pre_blog_content'] = $request->pre_blog_content;
        $data['blog_content'] = $request->blog_content;
        $data['blog_category_id'] = $request->blog_cate;
        $data['blog_status'] = $request->blog_status;
        $get_image = $request->file('blog_thumbnail');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $timestamp = time(); // hoặc $timestamp = date('Ymd_His');
            $new_image = $name_image . '_' . $timestamp . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/blog', $new_image);
            $data['blog_thumbnail'] = $new_image;
            DB::table('tbl_blog')->where('blog_id', $blog_id)->update($data);
            return Redirect::to('all-blog')->with('success', 'blog updated successfully');
        }
        DB::table('tbl_blog')->where('blog_id', $blog_id)->update($data);
        return Redirect::to('all-blog')->with('success', 'blog updated successfully');
    }

    public function delete_blog($blog_id)
    {
        $this->Authenlogin();
        DB::table('tbl_blog')->where('blog_id', $blog_id)->delete();
        return Redirect::to('all-blog')->with('success', 'blog deleted successfully');
    }

    public function edit_category_blog($blog_category_id)
    {
        $this->Authenlogin();
        $edit_category_blog = DB::table('tbl_category_blog')
            ->where('blog_category_id', $blog_category_id)
            ->get();

        $manager_category_blog = view('admin.edit_category_blog')
            ->with('edit_category_blog', $edit_category_blog);

        return view('admin_layout')
            ->with('admin.edit_category_blog', $manager_category_blog);
    }

    public function update_category_blog(Request $request, $blog_category_id)
    {
        $this->Authenlogin();
        $request->validate([
            'blog_category_name' => 'required',
            'blog_category_desc' => 'required',
            'category_blog_keywords' => 'required',
        ], [
            'required' => 'The :attribute field is required.',
        ]);

        $data = array();
        $data['blog_category_name'] = $request->blog_category_name;
        $data['blog_category_desc'] = $request->blog_category_desc;
        $data['meta_keywords'] = $request->category_blog_keywords;

        DB::table('tbl_category_blog')
            ->where('blog_category_id', $blog_category_id)
            ->update($data);

        return Redirect::to('all-blog-category')
            ->with('success', 'category updated successfully');
    }

    public function delete_category_blog($blog_category_id)
    {
        $this->Authenlogin();
        DB::table('tbl_category_blog')
            ->where('blog_category_id', $blog_category_id)
            ->delete();

        return Redirect::to('all-blog-category')
            ->with('success', 'blog category deleted successfully');
    }

    public function show_blog_details(Request $request, $blog_id)
    {
        $meta_desc = '';
        $meta_title = '';
        $meta_keywords = '';
        $meta_image = '';
        $meta_category_title = '';
        $url_canonical = $request->url();

        $blog_category = DB::table('tbl_category_blog')->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $detail_blog_by_id = DB::table('tbl_blog')
            ->join('tbl_category_blog', 'tbl_category_blog.blog_category_id', '=', 'tbl_blog.blog_category_id')
            ->where('tbl_blog.blog_id', $blog_id)
            ->get();

        foreach ($detail_blog_by_id as $key => $val) {
            //seo
            $meta_desc = $val->pre_blog_content;
            $meta_title = $val->blog_title;
            $meta_keywords = $val->meta_keywords;
            $meta_category_title = $val->blog_category_name;
            $meta_image = $val->blog_thumbnail;
            $url_canonical = $request->url();
            //--seo--
        }

        return view('pages.blog.show_blog_details')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('detail_blog_by_id', $detail_blog_by_id)
            ->with('meta_desc', $meta_desc)
            ->with('meta_title', $meta_title)
            ->with('meta_category_title', $meta_category_title)
            ->with('meta_image', $meta_image)
            ->with('url_canonical', $url_canonical)
            ->with('blog_category', $blog_category)
            ->with('meta_keywords', $meta_keywords);
    }

    public function showBlogsByCategory($category_id)
    {
        // Kiểm tra nếu category_id là "all" thì không lọc theo category
        if ($category_id === 'all') {
            $all_blog = DB::table('tbl_blog')
                ->join('tbl_category_blog', 'tbl_blog.blog_category_id', '=', 'tbl_category_blog.blog_category_id')
                ->select('tbl_blog.*', 'tbl_category_blog.blog_category_name')
                ->paginate(10);

            $all_category_blog = DB::table('tbl_category_blog')->get();
        } else {
            $all_blog = DB::table('tbl_blog')
                ->join('tbl_category_blog', 'tbl_blog.blog_category_id', '=', 'tbl_category_blog.blog_category_id')
                ->select('tbl_blog.*', 'tbl_category_blog.blog_category_name')
                ->where('tbl_blog.blog_category_id', $category_id)
                ->paginate(10);

            $all_category_blog = DB::table('tbl_category_blog')->get();
        }

        return view('admin.all_blog', compact('all_blog', 'all_category_blog'));
    }
}
