<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{
    //
    public function getAllNotifications(){

        $unreadNotifications=Auth::user()->unreadNotifications()->orderBy('created_at','desc')->get();

        //dd($unreadNotifications);

        $readNotifications=Auth::user()->readNotifications()->orderBy('created_at','desc')->paginate(15);


        return view('admin.pages.notifications.index',compact('unreadNotifications','readNotifications'));
    }

    public function markAllRead(){

        Auth::user()->unreadNotifications()->get()->markAsRead();

        return redirect()->back();

    }

    public function markAsRead(Request $request,$id){

        $notification = DatabaseNotification::findOrFail($id);

        if ($request->ajax()){
            $notification->markAsRead();
            return 1;
        }

    }
}
