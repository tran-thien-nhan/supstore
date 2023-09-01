<?php

namespace App\Http\Controllers;

use App\Mail\BulkEmail;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Mail\WelcomeNewsletter;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
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
        $subscribes = Subscribe::all();
        return view('admin.all_subscribe', compact('subscribes'));
    }

    public function composeEmail()
    {
        return view('pages.mail.compose');
    }

    public function sendBulkEmail(Request $request)
    {
        $emailContent = $request->input('email_content');
        $emailTitle = $request->input('email_title'); // Lấy giá trị title từ form
        $subscribes = Subscribe::all();

        foreach ($subscribes as $subscribe) {
            Mail::to($subscribe->email_subscribe)->send(new BulkEmail($emailContent, $emailTitle));
        }

        return redirect()->back()->with('success', 'Đã gửi email hàng loạt thành công!');
    }
}
