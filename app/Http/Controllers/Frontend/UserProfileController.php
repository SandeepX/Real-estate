<?php

namespace App\Http\Controllers\Frontend;

use App\CustomServices\ImageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Session;

class UserProfileController extends Controller
{
    //
    public function getProfile(){

        $user = Auth::user();

        return view('frontend.pages.users.profile',compact('user'));
    }

    public function updateBasicInfo(Request $request){

        $validator = Validator::make($request->all(), [
            'title' =>'required',
            'name'=>'required|max:191',
            'phone'=>'required',
            'address'=>'required',
           /* 'email' => 'required|email',*/
            'user_image' =>'sometimes|nullable|image',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();

        $user->title = ucwords(strtolower($request->title));
        $user->name =ucwords(strtolower($request->name));
        $user->phone = $request->phone;
        $user->address = ucwords(strtolower($request->address));
        $user->personal_info = $request->personal_info;

        if ($request->hasFile('user_image')) {

            //save image in server
            $filenameToStore=ImageService::saveImage($request->file('user_image'));

            //save image in db
            $oldFileName=$user->user_image;
            $user->user_image=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $user->user_image == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }

        $user->save();

        Session::flash('success', 'Your Information Has Been Updated');
        return redirect()->back();

    }

    public function updateContact(Request $request){

        $validator = Validator::make($request->all(), [
            'phone'=>'required',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('phone','phone');
        }

        $user = Auth::user();

        $user->phone = $request->phone;

        $user->save();

        Session::flash('success', 'Your Phone Has Been Updated');
        return redirect()->back();

    }

    public function updatePassword(Request $request){

        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);


        $user= Auth::user();
        $currentPassword = $request->input('current_password');

        if (Hash::check($currentPassword, $user->password)) {

            $user->password = Hash::make($request->input('password'));
            $user->save();

            Session::flash('success', 'Your Password was Updated! Please login again');
            Auth::guard()->logout();

            return redirect('/login');
        } else {
            Session::flash('danger', 'The Current Password did not match!');
            return redirect()->back();
        }
    }

    public function udpateSocialLinks(Request $request){


        $validator = Validator::make($request->all(), [
            'facebook' =>'required_without_all:twitter,linkedin,instagram',
            'twitter' =>'required_without_all:facebook,linkedin,instagram',
            'linkedin' =>'required_without_all:facebook,twitter,instagram',
            'instagram' =>'required_without_all:facebook,twitter,linkedin',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        $user = Auth::user();
        $user->facebook = $request->facebook;

        $user->twitter = $request->twitter;

        $user->linkedin = $request->linkedin;

        $user->instagram = $request->instagram;

        $user->save();

        Session::flash('success', 'Your Social Links Has Been Updated.');

        return redirect()->back();
    }
}
