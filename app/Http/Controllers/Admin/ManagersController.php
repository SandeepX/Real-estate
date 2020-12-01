<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use Spatie\Permission\Models\Role;

class ManagersController extends Controller
{
    //
    public function getAllManagerRequests(){

        $users = User::with([
            'roles'=>function($query){
                $query->where('id',3);
            },
        ])->where('manager_status','pending')->whereHas('roles', function ($query) {
            $query->where('id',3);
        })->get();


        return view('admin.pages.users.requests.manager',compact('users'));
    }

    public function assignManager($userId){

        $user= User::findOrFail($userId);

        $msg = $user->name.' is already a manager.';

        if ($user->hasRole("Manager")){
            Session::flash('success', $msg);
            return redirect()->back();
        }

        $user->manager_status ='yes';

        //manager role
        $role = Role::findOrFail(1);

        $user->save();

        $user ->syncRoles($role);

        Session::flash('success', 'User has been assigned as manager.');
        return redirect()->back();
    }
}
