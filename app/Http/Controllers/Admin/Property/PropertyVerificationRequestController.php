<?php

namespace App\Http\Controllers\Admin\Property;

use App\CustomServices\UserNotificationService;
use App\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class PropertyVerificationRequestController extends Controller
{

    private $unVerified = 'unverified';
    private $verified = 'verified';
    private $pending = 'pending';
    private  $featured ='featured';

    //
    public function getAllVerificationRequests(){

        $properties = Property::with([
            'category'=>function($query){
                $query->where('status',1);
            },
            'subCategory'=>function($query){
                $query->where('status',1);
            },
            'address'
        ])->where('verify_status',$this->pending)->orderBy('updated_at','desc')->get();

        return view('admin.pages.requests.verification.index',compact('properties'));
    }


    //toggle verify
    public function verifyProperty($id){

        $property = Property::findOrFail($id);

        //$property->verify_status = $this->verified;

        $property->verify_status = $property->verify_status == $this->verified ? $this->unVerified :  $this->verified ;

        $property->verified_at = Carbon::now();

        $property->save();

        if ($property->verify_status ==  $this->unVerified){

            $notificationMsg= 'Your "'.$property->title.'" property has been unverified.';
        }
        else{
            $notificationMsg= 'Your "'.$property->title.'" property has been verified.';
        }

        $user=$property->information->user;
        $this->sendNotificationToUser($notificationMsg,$user,$property);

        Session::flash('success', 'Property Has Been Verified!');

        return redirect()->back();
    }

    public function sendNotificationToUser($msg,$user,$property){

        $route='#';
        $image= $property->featured_image;

        $androidMessage = [
            'message'           => $msg,
            'user_image'        => photoToUrl($property->featured_image,'/common/images/'),
            'property_id'       => $property->id,
            'property_slug'     => $property->slug,
            'notification_type' => 'PropertyApproved'
        ];

        UserNotificationService::sendNotificationToUser($msg,$route,$image,$user,$androidMessage);

        if ($user->device_token){

            androidPushNotification($user->device_token,$msg,$androidMessage);
        }
    }

    public function getAllFeaturedRequests(){

        $properties = Property::with([
            'category'=>function($query){
                $query->where('status',1);
            },
            'subCategory'=>function($query){
                $query->where('status',1);
            },
            'address'
        ])->where('feature_status',$this->pending)->orderBy('updated_at','desc')->get();

        return view('admin.pages.requests.featured.index',compact('properties'));

    }

    public function markPropertyFeatured($id){

        $property = Property::findOrFail($id);

        $property->feature_status = $this->featured;

        $property->save();

        $notificationMsg= 'Your '.$property->title.' property has been featured.';
        $user=$property->information->user;
        $this->sendNotificationToUser($notificationMsg,$user,$property);

        Session::flash('success', 'Property Has Been Featured!');

        return redirect()->back();
    }

}
