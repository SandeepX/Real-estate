<?php

namespace App\Http\Controllers\Admin;

use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class SubscriberController extends Controller
{
    public function getSubscribers(){

        $subscribers=Subscriber::latest()->get();

        return view('admin.pages.subscriber.index')->with('subscribers',$subscribers);

    }

    public function deleteSubscriber($emailAd){

        $subscriber = Subscriber::where('email',$emailAd)->firstOrFail();

        $subscriber->delete();

        Session::flash('success', 'User Unsubscribed!');
        return redirect()->back();
    }
}
