<?php

namespace App\Console\Commands;

use App\CustomServices\UserNotificationService;
use App\User;
use Illuminate\Console\Command;

class UpdateProfileNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:profile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification To User To Update Profile.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

        $users= User::with([
            'roles'=>function($query){
                $query->where('id','!=',4);
            },
        ])->whereHas('roles', function ($query) {
            $query->where('id','!=',4);
        })->where('status',1)->where('mobile',null)->where('phone',null)->get();

        foreach ($users as $user){
            $this->sendNotificationToUser($user);
        }

    }

    public function sendNotificationToUser($user){

        //$route= route('user.profile');
        $route=url('/profile');
        $image=$user->user_image;
        $msg= 'Please enter your phone or mobile number to complete your profile.';

        $androidMessage = [
            'message'           => $msg,
            'user_image'        => photoToUrl($user->user_image,"/common/images/"),
            'notification_type' => 'UpdateProfile'
        ];

        UserNotificationService::sendNotificationToUser($msg,$route,$image,$user,$androidMessage);

        //for android notification

        if ($user->device_token){

            androidPushNotification($user->device_token,$msg,$androidMessage);
        }


    }
}
