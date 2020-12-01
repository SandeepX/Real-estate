<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\District;
use App\Municipal;
use App\Province;
use App\SiteSetting;
use App\TermCondition;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use Session;

class RegisterController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        //return  Redirect::to('https://www.google.com/');
        $provinces = Province::get();

        $districts = District::get();

        $municipals = Municipal::get();

        $termsAndConditions = TermCondition::where('status',1)->get();

        return view('frontend/auth/register',compact('provinces','districts','municipals','termsAndConditions'));
    }

    public function registerUser(Request $request){


        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|email|string|max:191|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone'=> 'required',
            'province'=> 'required',
            'district'=> 'required',
            'municipal'=> 'required',
            'address'=> 'required',

        ]);

        $user= new User();

        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);

        $user->password = Hash::make($request->input('password'));

        $user->province_id = $request->province;
        $user->district_id = $request->district;
        $user->municipality_id = $request->municipal;

        $user->address = ucwords(strtolower($request->address));
        $user->phone = $request->phone;

        $user->token = str_random(40);
        $user->status = 0;

        //dd($user);

        $user->save();

        $user ->assignRole(3);

        $user->sendConfirmationMail($user);

        Session::flash('success','A Verification Email Has Been Sent To Your E-Mail Address. Please Verify To Login.');
        return redirect()->route('fe.getLoginForm');



    }

    public function confirmRegister($userId,$token){

        $user = User::where('id',$userId)->where('token',$token)->firstOrFail();

        $user->verify();

        $user->save();

        $user->sendWelcomeEmail($user);

        $user->sendNotificationsToAdmin($user);

        //$user->update(['token' => null, 'status' =>1]);

        Session::flash('success', "Thank you! For Registering"."<br>"."Please Login To Continue");
        return redirect()->route('fe.getLoginForm');
    }

   /* public function testMail(){
        $setting=SiteSetting::first();

        $data = array(

            'route_link'=>route('fe.getLoginForm'),
        );


        $mail=Mail::send('partials.mail-confirm-userverify', $data, function($message) use ($data){
            $setting=SiteSetting::first();
            $message->from($setting->email);
            $message->to('prajwal.sw@gmail.com');
            $message->subject('Test Email');
        });
        return "Mail Sent";
    }*/
}
