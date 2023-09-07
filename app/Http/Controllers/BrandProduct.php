<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; // Import DB facade
use App\Brand;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

session_start();

class BrandProduct extends Controller
{
    public function Authenlogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand_product()
    {
        $this->Authenlogin();
        return view('admin.add_brand_product');
    }

    public function all_brand_product()
    {
        $this->Authenlogin();
        $all_brand_product = DB::table('tbl_brand')->paginate(5);
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);
    }

    public function save_brand_product(Request $request)
    {
        $this->Authenlogin();
        //return view('admin.all_brand_product');
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('tbl_brand')->insert($data);
        //Session::put('message','thêm thương hiệu sản phẩm thành công');
        return Redirect::to('add-brand-product')->with('success', 'new brand created successfully');
    }

    public function unactive_brand_product($brand_product_id)
    {
        $this->Authenlogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        //Session::put('message','thêm thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product')->with('success', 'unactivate brand successfully');
    }

    public function active_brand_product($brand_product_id)
    {
        $this->Authenlogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        //Session::put('message','thêm thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product')->with('success', 'activate brand successfully');
    }

    public function edit_brand_product($brand_product_id){
        $this->Authenlogin();
        $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function update_brand_product(Request $request, $brand_product_id){
        $this->Authenlogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;

        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        return Redirect::to('all-brand-product')->with('success', 'brand updated successfully');
    }
    
    public function delete_brand_product($brand_product_id){
        $this->Authenlogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        return Redirect::to('all-brand-product')->with('success', 'brand deleted successfully');
    }
}
