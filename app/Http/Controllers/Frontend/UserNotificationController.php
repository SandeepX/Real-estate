<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class UserNotificationController extends Controller
{
    //

    public function getAllNotifications(){

        $unreadNotifications=Auth::user()->unreadNotifications()->where("type",'=',"App\Notifications\UserNotification")->orderBy('created_at','desc')->get();


        $readNotifications=Auth::user()->readNotifications()->where("type",'=',"App\Notifications\UserNotification")->orderBy('created_at','desc')->paginate(15);


        return view('frontend.pages.notifications.index',compact('unreadNotifications','readNotifications'));
    }

    public function markAllRead(Request $request){

        Auth::user()->unreadNotifications()->where("type",'=',"App\Notifications\UserNotification")->get()->markAsRead();

        if ($request->ajax()){

            return 1;
        }
        return redirect()->back();

    }

    public function markAsRead(Request$request,$id){

        $notification = DatabaseNotification::findOrFail($id);

        if ($request->ajax()){
            $notification->markAsRead();
            return 1;
        }
    }
}
