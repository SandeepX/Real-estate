<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscriber extends Model
{
    protected $fillable = [
        'token',
    ];

    public function sendConfirmationMail(Subscriber $subscriber){

        $setting=SiteSetting::find(1);

        $data = array(
            'email' => $subscriber->email,
            'route_link'=>route('fe.confirmSubscription',$subscriber->token),
            'site_setting' =>$setting,

        );

        $mail=Mail::send('partials.mail-confirm-subscribe', $data, function($message) use ($data){
            $setting=SiteSetting::find(1);
            $message->from($setting->email);
            $message->to($data['email']);
            $message->subject('Confirm Subscription');
        });
    }

    public function verify(){
        $this->token = null;
        $this->status =1;
    }
}
