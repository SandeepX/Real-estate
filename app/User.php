<?php

namespace App;

use App\Notifications\ManagerRequestNotification;
use App\Notifications\UserMailResetPasswordToken;
use App\Notifications\UserRegisteredNotification;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserMailResetPasswordToken($token));
    }

    //get propertyInfos  for the user
    public function propertyInformations(){
        return $this->hasMany('App\PropertyMoreInformation', 'user_id');
    }

    //get manager requests  for the user
    public function userRequests(){
        return $this->hasMany('App\ManagerRequest','user_id');
    }

    //get manager requests  for the manager
    public function managerRequests(){
        return $this->hasMany('App\ManagerRequest','manager_id');
    }

    //get property reviews  for the user
    public function propertyReviews(){
        return $this->hasMany('App\PropertyReview','user_id');
    }

    //get fav properties of the user
    public function favProperties()
    {
        return $this->belongsToMany('App\Property','user_fav_properties',
            'user_id', 'property_id')->withTimestamps();
    }

    //get blog reviews  for the user
    public function blogReviews(){
        return $this->hasMany('App\BlogReview','user_id');
    }

    public function sendConfirmationMail(User $user){

        $setting=SiteSetting::first();

        $data = array(
            'email' => $user->email,
            'route_link'=>route('fe.confirmRegister',[$user->id,$user->token]),
           /* 'site_setting' =>$setting,*/

        );


        $mail=Mail::send('partials.mail-confirm-userverify', $data, function($message) use ($data){
            $setting=SiteSetting::first();
            $message->from($setting->email);
            $message->to($data['email']);
            $message->subject('Confirm Registration');
        });
    }

    public function verify(){
        $this->token = null;
        $this->status =1;
        $this->email_verified_at = Carbon::now();
    }

    public function sendWelcomeEmail(User $user){

        $setting=SiteSetting::first();

        $data = array(
            'email' => $user->email,
            'user_name' => $user->name,
            'route_link'=>route('fe.getLoginForm'),
            /* 'site_setting' =>$setting,*/

        );


        $mail=Mail::send('partials.mail-welcomeuser', $data, function($message) use ($data){
            $setting=SiteSetting::first();
            $message->from($setting->email);
            $message->to($data['email']);
            $message->subject('Welcome To '.$setting->site_title);
        });
    }

    public function sendNotificationsToAdmin($normalUser){

        $superAdmins = User::role('Super Admin')->get();

        Notification::send($superAdmins, new UserRegisteredNotification($normalUser));
    }

    public function sendManagerRequestNotificationsToAdmin($normalUser,$requestType,$property){

        $superAdmins = User::role('Super Admin')->get();

        Notification::send($superAdmins, new ManagerRequestNotification($normalUser,$requestType,$property));

        // $superAdmins->notify(new ManagerRequestNotification($normalUser,$requestType,$property));

    }


}


