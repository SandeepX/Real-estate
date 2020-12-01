<?php
/**
 * Created by PhpStorm.
 * User: Prajwal
 * Date: 9/5/2019
 * Time: 11:09 AM
 */

namespace App\CustomServices;


use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

class UserNotificationService
{

    public static function sendNotificationToUser($msg,$route,$image,$user,$androidMessage){

        if (isset($user)){
            Notification::send($user, new UserNotification($msg,$route,$image,$user,$androidMessage));
        }

    }
}