<?php

namespace App\Http\Controllers\Admin;

use App\CustomServices\ImageService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

use Hash;
use Session;

class UserController extends Controller
{

    public function deleteImage(Request $request,$id){

        if ($request->ajax()) {

            $user = User::findOrFail($id);

            $oldFileName = $user->user_image;

            $user->user_image=null;

            $user->save();

            //delete image from Server
            if (!empty($oldFileName)) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::latest()->get();

        return view('admin.pages.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::latest()->get();

        return view('admin.pages.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|email|string|max:191|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'user_image' => 'sometimes|nullable|image',
            'role' => 'required',
        ]);

        $user= new User();
        $user->name = $request->name;
        $user->email = $request->email;

        $user->password = Hash::make($request->input('password'));

        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->mobile = $request->mobile;

        if ($request->hasFile('user_image')) {
            $filenameToStore=ImageService::saveImage($request->file('user_image'));
            $user->user_image=$filenameToStore;
        }

        $role = $request->role;
        $roleName = Role::findOrFail($role)->name;

        if ($role == 1){
            $user->manager_status ='yes';
        }

        $user->save();
        $user ->assignRole($role);

        Session::flash('success', 'New User of role '.$roleName.' Was Added!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
       $user = User::findOrFail($id);

       $roles = Role::latest()->get();

       return view('admin.pages.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate
        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email,'.$id,
            'user_image' => 'sometimes|nullable|image',
        ]);

        $user = User::findOrFail($id);

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

        //check for new password
        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('password');
        if (isset($currentPassword) && isset($newPassword)) {
            //validate
            $this->validate($request, [
                'current_password' => 'required',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if (Hash::check($currentPassword, $user->password)) {
                $user->password = Hash::make($request->input('password'));
                $user->save();
            } else {
                Session::flash('danger', 'The Current Password did not match!');
                return redirect()->back();
            }
        }

        $role = $request->role;
        $roleName = Role::findOrFail($role)->name;

        if ($role == 1){
            $user->manager_status ='yes';
        }
        else{
            $user->manager_status ='no';
        }
        //dd($role);
        $user->save();
        //$user ->assignRole($role);
        $user->syncRoles($role);


        Session::flash('success', 'Profile Was Updated!');
        return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
