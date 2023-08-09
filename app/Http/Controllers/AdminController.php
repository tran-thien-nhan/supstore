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
    // public function login_facebook()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    // public function callback_facebook()
    // {
    //     $provider = Socialite::driver('facebook')->user();
    //     $account = Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
    //     if ($account) {
    //         //login in vao trang quan tri  
    //         $account_name = Login::where('admin_id', $account->user)->first();
    //         Session::put('admin_name', $account_name->admin_name);
    //         // Session::put('login_normal', true);
    //         Session::put('admin_id', $account_name->admin_id);
    //         return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    //     } else {

    //         $admin_login = new Social([
    //             'provider_user_id' => $provider->getId(),
    //             'provider' => 'facebook'
    //         ]);

    //         $orang = Login::where('admin_email', $provider->getEmail())->first();

    //         if (!$orang) {
    //             $orang = Login::create([
    //                 'admin_name' => $provider->getName(),
    //                 'admin_email' => $provider->getEmail(),
    //                 'admin_password' => '',
    //                 'admin_phone' => ''

    //             ]);
    //         }
    //         $admin_login->login()->associate($orang);
    //         $admin_login->save();

    //         $account_name = Login::where('admin_id', $admin_login->user)->first();

    //         Session::put('admin_name', $admin_login->admin_name);
    //         Session::put('admin_id', $admin_login->admin_id);
    //         return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    //     }
    // }

    // public function login_google()
    // {
    //     return Socialite::driver('google')->redirect();
    // }

    // public function callback_google()
    // {
    //     $users = Socialite::driver('google')->user();
    //     //return $users->id;
    //     $authUser = $this->findOrCreateUser($users, 'google');
    //     $account_name = Login::where('admin_id', $authUser->user)->first();
    //     Session::put('admin_name', $account_name->admin_name);
    //     Session::put('admin_id', $account_name->admin_id);
    //     return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    // }
    // public function findOrCreateUser($users, $provider)
    // {
    //     $authUser = Social::where('provider_user_id', $users->id)->first();
    //     if ($authUser) {

    //         return $authUser;
    //     }

    //     $admin_login = new Social([
    //         'provider_user_id' => $users->id,
    //         'provider' => strtoupper($provider)
    //     ]);

    //     $orang = Login::where('admin_email', $users->email)->first();

    //     if (!$orang) {
    //         $orang = Login::create([
    //             'admin_name' => $users->name,
    //             'admin_email' => $users->email,
    //             'admin_password' => '',

    //             'admin_phone' => ''
    //         ]);
    //     }
    //     $admin_login->login()->associate($orang);
    //     $admin_login->save();

    //     $account_name = Login::where('admin_id', $admin_login->user)->first();
        
    //     Session::put('admin_name', $admin_login->admin_name);
    //     Session::put('admin_id', $admin_login->admin_id);
    //     return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    // }

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
        
        // $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        // //return view('admin.dashboard');
        // if ($result) {
        //     Session::put('admin_name', $result->admin_name);
        //     Session::put('admin_id', $result->admin_id);
        //     return Redirect::to('/dashboard');
        // } else {
        //     Session::put('message', 'mật khẩu hoặc tài khoản chưa đúng, vui lòng nhập lại');
        //     return Redirect::to('/admin');
        // }
    }

    public function logout()
    {
        $this->Authenlogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
}
