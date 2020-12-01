<?php

namespace App\Http\Controllers\Frontend\Property;

use App\CustomServices\ImageService;
use App\CustomServices\UserNotificationService;
use App\Property;
use App\PropertyReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Session;

class PropertyReviewController extends Controller
{
    //
    public function storePropertyReview(Request $request,$propertyId){

        $property = Property::findOrFail($propertyId);

        $validator = Validator::make($request->all(), [
            'client_message'=>'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('review','review');
        }

        $review = new PropertyReview();

        $review->property_id = $property->id;

        $user = Auth::user();

        $review->user_id = $user->id;

        $review->client_message = strip_tags($request->client_message);
        $review->client_rating = $request->rating;

        $review->status =0;

        $review->save();

        if (!$property->information->user->id != $user->id){
            $this->sendNotificationToUser($user,$property);
        }

        Session::flash('success', 'Thank You For Your Comment');
        return redirect()->back();

    }

    public function sendNotificationToUser($user,$property){

        $route= route('fe.singleProperty',$property->slug);

        if($user->user_image){
            $image= $user->user_image;
        }
        else{
            $image= $user->provider_image;
        }

        $msg= $user->name . ' has rated your property ' . $property->title . '.';
        $propertyUser = $property->information->user;

        $androidMessage = [
            'message'           => $msg,
            'user_id'           => $user->id,
            'user_image'        => photoToUrl($image,'/common/images/'),
            'property_id'       => $property->id,
            'property_slug'     => $property->slug,
            'notification_type' => 'PropertyReview'
        ];

        UserNotificationService::sendNotificationToUser($msg,$route,$image,$propertyUser,$androidMessage);

        if ($propertyUser->device_token){

            androidPushNotification($propertyUser->device_token, $msg, $androidMessage);
        }
    }
}
