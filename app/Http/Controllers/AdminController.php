<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Http\Requests;

use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB; // Import DB facade

session_start();

class AdminController extends Controller
{
    public function Authenlogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }
    public function index()
    {
        return view('admin_login');
    }

    public function show_dashboard()
    {
        $this->Authenlogin();
        return view('admin.dashboard');
    }

    public function dashboard(Request $request)
    {
        $data = $request->all();
        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);

        $login = Login::where('admin_email',$admin_email)
        ->where('admin_password',$admin_password)
        ->first();

        $login_count = $login->count();
        if ($login_count) {
            Session::put('admin_name',$login->admin_name);
            Session::put('admin_id', $login->admin_id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'mật khẩu hoặc tài khoản chưa đúng, vui lòng nhập lại');
            return Redirect::to('/admin');
        }
    }

    public function logout()
    {
        $this->Authenlogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
}
