<?php

namespace App\Http\Controllers\Frontend;

use App\Notifications\RequestToBeManager;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Notification;
use Session;

class RequestToBeManagerController extends Controller
{
    //

    public function sendRequest(){

        $user= Auth::user();

        if ($user->hasRole("Manager")){
            Session::flash('success', 'You already are a manager.');
            return redirect()->back();
        }

        $user->manager_status ='pending';

        $user->save();

        $this->sendRequestNotificationToAdmin($user);


        Session::flash('success', 'Manager Request Has Been Sent.');
        return redirect()->back();

    }

    public function sendRequestNotificationToAdmin($normalUser){

        $superAdmins = User::role('Super Admin')->get();

        Notification::send($superAdmins, new RequestToBeManager($normalUser));
    }


}
