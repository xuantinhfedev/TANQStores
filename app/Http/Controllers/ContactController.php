<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    //
    public function contact(){
        return view('contact-us');
    }

    public function sendEmail(Request $request){
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'msg' => $request->msg
        ];

        Mail::to('xunatinhfff@gmail.com')->send(new ContactMail($details));

        return back()->with('message_sent', 'Tin nhắn của bạn đã được gửi thành công!!');
    }
}
