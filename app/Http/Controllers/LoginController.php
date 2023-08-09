<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Login;
use App\Models\Login1;
use App\Models\Social;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $providerUser = Socialite::driver('facebook')->user();

        $account = Social::where('provider', 'facebook')->where('provider_user_id', $providerUser->getId())->first();

        if ($account) {
            // User already logged in before, log them in
            $admin = Login::where('admin_id', $account->user)->first();

            Session::put('admin_name', $admin->admin_name);
            Session::put('admin_id', $admin->admin_id);

            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        } else {
            // User is logging in for the first time, create an account for them
            $admin = Login::where('admin_email', $providerUser->getEmail())->first();

            if (!$admin) {
                $admin = Login::create([
                    'admin_name' => $providerUser->getName(),
                    'admin_email' => $providerUser->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '',
                ]);
            }

            $account = new Social([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $account->login()->associate($admin);
            $account->save();

            Session::put('admin_name', $admin->admin_name);
            Session::put('admin_id', $admin->admin_id);

            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }
    }

    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback_google()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return view('admin_login');
        }

        // Kiểm tra xem người dùng đã tồn tại trong CSDL chưa
        $existingUser = Admin::where('admin_email', $user->getEmail())->first();
        $account_name = Login::where('admin_id', $user->getId())->first();

        if ($account_name) {
            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
        }

        if ($existingUser) {
            $account_name = Login::where('admin_id', $existingUser->admin_id)->first();
            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
            Auth::login($existingUser);
        } else {
            // Nếu người dùng chưa tồn tại, bạn có thể tạo một người dùng mới tại đây
            // Tạo thông tin mới cho bảng tbl_social
            $newSocialUser = new Social();
            $newSocialUser->provider_user_id = $user->getId();
            $newSocialUser->email = $user->getEmail();
            $newSocialUser->provider = 'google';
            $newSocialUser->user = $user->getName(); // Mã hóa tên người dùng trước khi lưu vào CSDL
            $newSocialUser->save();

            // Tạo thông tin mới cho bảng tbl_admin
            $newAdminUser = new Admin();
            $newAdminUser->admin_id = null; // Bạn cần đặt giá trị phù hợp cho admin_id.
            $newAdminUser->admin_name = $user->getName();
            $newAdminUser->admin_email = $user->getEmail();
            $newAdminUser->admin_password = ''; // Bạn cần cung cấp mật khẩu cho admin hoặc sử dụng mã hóa phù hợp.
            $newAdminUser->admin_phone = ''; // Bạn cần cung cấp số điện thoại cho admin.
            $newAdminUser->created_at = now();
            $newAdminUser->updated_at = now();
            $newAdminUser->save();

            // Lưu admin_name vào session
            Session::put('admin_name', $user->getName());
            Session::put('admin_id', $newAdminUser->admin_id);

            // Đăng nhập người dùng mới tạo
            Auth::login($newAdminUser); // Thay đổi $existingUser thành $newAdminUser
        }

        return view('admin.dashboard'); // Chuyển hướng đến trang sau khi đăng nhập thành công
    }



    public function findOrCreateUser($users, $provider)
    {
        $authUser = Social::where('provider_user_id', $users->id)->first();

        if ($authUser) {
            return $authUser;
        }

        $account_name = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider),
            'email' => $users->getEmail(), // Add the email field here
        ]);

        $orang = Login::where('admin_email', $users->getEmail())->get();

        if (!$orang) {
            $orang = Login::create([
                'admin_name' => $users->getName(),
                'admin_email' => $users->getEmail(),
                'admin_password' => '',
                'admin_phone' => ''
            ]);
        }

        $account_name->login()->associate($orang);
        $account_name->save();

        // Return the created $account_name (Social) model instead of redirecting to another view
        return $account_name;
    }

    public function login_google_customer()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback_google_customer()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return view('pages.checkout.login_checkout');
        }

        // Kiểm tra xem người dùng đã tồn tại trong CSDL chưa
        $existingUser = Customer::where('customer_email', $user->getEmail())->first();
        $account_name = Login1::where('customer_id', $user->getId())->first();

        // Khởi tạo các biến $cate_product và $brand_product trước khi sử dụng
        $cate_product = [];
        $brand_product = [];

        if ($account_name) {
            $cate_product = DB::table('tbl_category_product')
                ->where('category_status', '0')
                ->orderBy('category_id', 'desc')
                ->get();

            $brand_product = DB::table('tbl_brand')
                ->where('brand_status', '0')
                ->orderBy('brand_id', 'desc')
                ->get();

            Session::put('customer_name', $account_name->customer_name);
            Session::put('customer_id', $account_name->customer_id);
        }

        if ($existingUser) {
            $account_name = Login1::where('customer_id', $existingUser->customer_id)->first();
            Session::put('customer_name', $account_name->customer_name);
            Session::put('customer_id', $account_name->customer_id);
            Auth::login($existingUser);
        } else {
            // Nếu người dùng chưa tồn tại, bạn có thể tạo một người dùng mới tại đây
            // Tạo thông tin mới cho bảng tbl_social
            $newSocialUser = new Social();
            $newSocialUser->provider_user_id = $user->getId();
            $newSocialUser->email = $user->getEmail();
            $newSocialUser->provider = 'google';
            $newSocialUser->user = $user->getName(); // Mã hóa tên người dùng trước khi lưu vào CSDL
            $newSocialUser->save();

            // Tạo thông tin mới cho bảng tbl_admin
            $newCustomerUser = new Customer();
            $newCustomerUser->customer_id = null; // Bạn cần đặt giá trị phù hợp cho customer_id.
            $newCustomerUser->customer_name = $user->getName();
            $newCustomerUser->customer_email = $user->getEmail();
            $newCustomerUser->customer_password = ''; // Bạn cần cung cấp mật khẩu cho admin hoặc sử dụng mã hóa phù hợp.
            $newCustomerUser->customer_phone = ''; // Bạn cần cung cấp số điện thoại cho customer.
            $newCustomerUser->customer_point = 0;
            $newCustomerUser->created_at = now();
            $newCustomerUser->updated_at = now();
            $newCustomerUser->save();

            // Lưu admin_name vào session
            $cate_product = DB::table('tbl_category_product')
                ->where('category_status', '0')
                ->orderBy('category_id', 'desc')
                ->get();

            $brand_product = DB::table('tbl_brand')
                ->where('brand_status', '0')
                ->orderBy('brand_id', 'desc')
                ->get();

            Session::put('customer_name', $user->getName());
            Session::put('customer_id', $newCustomerUser->customer_id);

            // Đăng nhập người dùng mới tạo
            Auth::login($newCustomerUser); // Thay đổi $existingUser thành $newCustomerUser
        }

        return view('layout')
            ->with('category', $cate_product)
            ->with('brand', $brand_product); // Chuyển hướng đến trang sau khi đăng nhập thành công
    }
}
