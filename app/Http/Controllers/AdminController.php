<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Admin;

use App\Models\Login;
use App\Http\Requests;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        return Redirect::to('/dashboard');
    }

    public function AdminLogin(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $existingUser = Admin::where('admin_email', $admin_email)->first();
        $login = Login::where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)
            ->first();

        if ($login && $existingUser) {
            Session::put('admin_name', $login->admin_name);
            Session::put('admin_id', $login->admin_id);
            Session::put('admin_role_value', $existingUser->role_value); // Thêm role_value vào session
            Auth::login($existingUser);
            $role_value = $existingUser->role_value;

            if ($role_value == 1) {
                return Redirect::to('/dashboard');
            } elseif ($role_value == 2) {
                return Redirect::to('/manage-order');
            }
        } else {
            Session::put('message', 'password or account is not true, please input again');
            return Redirect::to('/admin');
        }
    }

    public function showCreateAccountForm()
    {
        $districts = DB::table('tbl_district')->get();
        return view('admin.create_account')->with('districts', $districts);
    }

    public function createAccount(Request $request)
    {
        $request->validate([
            'admin_email' => 'required|email|unique:tbl_admin',
            'admin_name' => 'required',
            'admin_password' => 'required|min:5|max:50',
            're_admin_password' => 'required|same:admin_password|min:5|max:50',
            'admin_phone' => 'required|numeric|digits:10',
            'role_value' => 'required|in:1,2',
            'address' => 'required',
        ], [
            'required' => 'requried',
            'min' => 'must have at least :min characters',
            'max' => 'must have at least :max characters',
            'email' => 'must match email form',
            'same' => 'does not match with above password',
            'numeric' => 'must be number',
            'digits' => 'must have :digits characters',
            'unique' => 'email already exist, please input another email'
        ]);

        $role = Role::where('role_value', $request->role_value)->first();
        if (!$role) {
            return back()->with('message', 'Invalid role value');
        }

        $admin = new Admin();
        $admin->admin_email = $request->admin_email;
        $admin->admin_name = $request->admin_name;
        $admin->admin_phone = $request->admin_phone;
        $admin->admin_password = md5($request->admin_password);
        $admin->role_id = $role->role_id;
        $admin->role_value = $request->role_value;
        $admin->district_id = $request->district_id;
        $admin->address = $request->address;
        $admin->salary = 0;
        $admin->admin_code = '';
        $admin->save();

        return Redirect::to('/admin')->with('message', 'Account created successfully. You can now log in.');
    }

    public function logout()
    {
        $this->Authenlogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
}
