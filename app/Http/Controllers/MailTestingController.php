<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MailerController;

class MailTestingController extends Controller
{
    //
    public function index(){
        return view('welcome');
    }

    public function send(Request $request){
        $mail = new MailerController(
            'smtp.gmail.com',               // host
            587,                            // port
            'msah30jan2001@gmail.com',      // username -> email
            'vtbjwvsvkmwqprjk',             // password  -> app password
            'msah30jan2001@gmail.com',      // set from -> email
            'Your Name Or Project Name',    // set from name
            'tls',                          // smtp secure
            false,                          // smtp debug
            true                            // smtp auth
        );

        $to = $request->to;
        $cc = $request->cc;
        $bcc = $request->bcc;
        $subject = $request->subject;
        $body = $request->body;

        if($mail->SendMail([[$to]],$subject,$body,null,[[]],[$cc],[$bcc],false)){
            return redirect()->back()->with('success');
        }else{
            return redirect()->back()->with('error');
        }
    }
}
