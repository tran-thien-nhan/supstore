<?php

namespace App\Http\Controllers;

use App\Mail\BulkEmail;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Mail\WelcomeNewsletter;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class NewsletterController extends Controller
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
    public function subscribe(Request $request)
    {
        // Lấy thông tin email từ biểu mẫu
        $email = $request->input('email');

        // Gửi email chào mừng
        Mail::to($email)->send(new WelcomeNewsletter());

        // Lưu email vào bảng subscribes
        Subscribe::create(['email_subscribe' => $email]);

        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }

    public function listSubscribedEmails()
    {
        $this->Authenlogin();
        $subscribes = Subscribe::all();
        return view('admin.all_subscribe', compact('subscribes'));
    }

    public function composeEmail()
    {
        return view('pages.mail.compose');
    }

    public function sendBulkEmail(Request $request)
    {
        $this->Authenlogin();
        $emailContent = $request->input('email_content');
        $emailTitle = $request->input('email_title'); // Lấy giá trị title từ form
        $subscribes = Subscribe::all();

        foreach ($subscribes as $subscribe) {
            Mail::to($subscribe->email_subscribe)->send(new BulkEmail($emailContent, $emailTitle));
        }

        return redirect()->back()->with('success', 'send email in bulk successfully!');
    }

    public function composeEmailCustomer()
    {
        $this->Authenlogin();
        return view('pages.mail.compose_customer');
    }

    public function sendBulkEmailCustomer(Request $request)
    {
        $this->Authenlogin();
        $emailContent = $request->input('email_content');
        $emailTitle = $request->input('email_title'); // Lấy giá trị title từ form
        $subscribes = Subscribe::all();

        foreach ($subscribes as $subscribe) {
            Mail::to($subscribe->email_subscribe)->send(new BulkEmail($emailContent, $emailTitle));
        }

        return redirect()->back()->with('success', 'send email in bulk successfully!');
    }
}
