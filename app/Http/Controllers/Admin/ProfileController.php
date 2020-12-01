<?php

namespace App\Http\Controllers\Admin;

use App\CustomServices\ImageService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use Spatie\Permission\Models\Role;
use Hash;

class ProfileController extends Controller
{
    //
    public function editProfile()
    {

        //dd($user->roles);

        $user = Auth::user();

        $roles= Role::latest()->get();

        return view('admin.pages.profile.edit-profile',compact('user','roles'));
    }

    public function updateProfile(Request $request){

        //validate
        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email,'.Auth::id(),
            'user_image' => 'sometimes|nullable|image',
            'role' => 'required',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->mobile = $request->input('mobile');
        $user->email = $request->input('email');


        //update Image
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

        $role = $request->role;
        $roleName = Role::findOrFail($role)->name;

        $user->save();
        //$user ->assignRole($roleName);
        $user->syncRoles($roleName);



        if ($user){
            Session::flash('success', 'Your Profile Was Updated!');
            return redirect()->back();
        }

        return redirect()->route('admin.editProfile',Auth::id())->withInput();
    }

    public function changePassword(){

        $user = Auth::user();

        return view('admin.pages.profile.change-password',compact('user'));

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

    public function checkPasswordByAjax(Request $request, $password=null){

        if ($request->ajax()) {

            $user = Auth::user();

            if (Hash::check($password, $user->password)) {

                return 1;
            }
            else{
                return 0;
            }
        }
        return 0;
    }
}
