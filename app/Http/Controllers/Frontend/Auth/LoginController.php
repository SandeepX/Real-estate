<?php

namespace App\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    //
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){

        return view('frontend.auth.login');
    }

    public function login(Request $request){

        //validate the form data
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);


        //attempt to log the user in
        if(Auth::attempt([
            'email'=> $request->input('email'),
            'password' =>$request->input('password'),
            'status' =>1,
        ],$request->remember)){

            //if successfull redirect to intended location
           /* return redirect()->guest(route('fe.home'));*/
            return redirect()->intended(route('fe.home'));
        }
        else{
            return $this->sendFailedLoginResponse($request);
            //if not successfull redirect to login page with the form data
            //return redirect()->back()->withInput($request->only('email','remember'));
        }
    }

    public function logout()
    {
        Auth::logout();

        return  redirect()->route('fe.getLoginForm');
    }

    
}
