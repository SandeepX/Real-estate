<?php
/**
 * Created by PhpStorm.
 * User: Prajwal
 * Date: 8/23/2019
 * Time: 12:27 PM
 */

namespace App\CustomServices;


use App\User;

use Illuminate\Support\Facades\Notification;

use App\Notifications\PropertyVerificationRequestNotification;

class VerificationRequestService
{

    public static function sendVerificationRequestNotificationsToaAdmin($property){

        $superAdmins = User::role('Super Admin')->get();

        $route =route('admin.request.verification');

        $msg = 'Verification request for the property '.'"'.$property->title.'"';

        Notification::send($superAdmins, new PropertyVerificationRequestNotification($property,$route,$msg));
    }
}