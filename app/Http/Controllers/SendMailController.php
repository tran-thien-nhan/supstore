<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; // Import DB facade

session_start();

class SendMailController extends Controller
{
    public function sendMail(){
        $customer_id = Session::get('customer_id');
        $customer = Customer::find($customer_id);
        
        // $to_name = "tran thien nhan";
        $to_name = $customer->customer_name;
        // $to_email = "pipclup28061997@gmail.com";//send to this email
        $to_email = $customer->customer_email;

        $data = array("name"=>"Axe & Sledge Supplement","body"=>"some product problems"); //body of mail.blade.php
    
        Mail::send('pages.mail.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('happy birthday');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        return Redirect::to('/')->with('message','');
    }
}
