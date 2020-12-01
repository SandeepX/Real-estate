<?php

namespace App\Providers;

use App\CustomServices\UserAuthCheck;
use App\Municipal;
use App\PropertyStatus;
use App\SiteSetting;
use App\Sponser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use View;
use Spatie\Permission\Models\Role;

class ViewShareProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    //khaali nai chodney ho yo
    public function register()
    {
        //

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */

    public function boot()
    {
        //

        $this->shareSiteSetting();
    }

    public function shareSiteSetting(){


        $setting= SiteSetting::find(1);

        $sponsers= Sponser::where('status',1)->get();

        $sitePropertyStatuses = PropertyStatus::all();

        $municipals = Municipal::get();


        //compose all the views....

        //pass data to only specific pages
        View::composer(['admin.partials.navbar'],function ($view){
            $unReadNotifications=Auth::user()->unreadNotifications()->orderBy('created_at','desc')->get()->toArray();
            $view->with('unReadNotifications', $unReadNotifications);
        });

        //pass data to only specific pages
        View::composer(['frontend.partials.notification-partial'],function ($view){
            $unReadNotifications=Auth::user()->unreadNotifications()->where("type",'=',"App\Notifications\UserNotification")->orderBy('created_at','desc')->get()->toArray();
            $view->with('unReadNotifications', $unReadNotifications);
        });

        view()->share(['setting'=>$setting,'sponsers'=>$sponsers,'sitePropertyStatuses'=>$sitePropertyStatuses,
            'municipals'=>$municipals]);

    }


}
