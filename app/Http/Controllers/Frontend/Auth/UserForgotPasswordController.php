<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\SiteSetting;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Password;

class UserForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;

    //
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm() {
        return view('frontend.auth.passwords.email');
    }


    //sendResetLinkEmail banaunu pardaina it inherits

    //not completed hai don't use..
    //done using notification method
   /* public function sendResetLinkEmail(Request $request){

        //validate
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user= User::where('email',$request->email)->first();

        if (is_null($user)){
            Session::flash('danger', 'No user found of that email.');
            return redirect()->back();
        }
        $setting=SiteSetting::first();

        $token=str_random(40);
        //session($token,false);

        $data = array(
            'email' => $user->email,
            'route_link'=>route('user.password.reset',$token),
            'site_setting' =>$setting,

        );

        $mail=Mail::send('partials.mail-user-reset-password', $data, function($message) use ($data){
            $setting=SiteSetting::find(1);
            $message->from($setting->email);
            $message->to($data['email']);
            $message->subject('Reset Password Notification');
        });

        Session::flash('success', 'Please check your email for further action.');
        return redirect()->back();
    }*/
}
