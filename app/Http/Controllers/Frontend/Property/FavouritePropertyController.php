<?php

namespace App\Http\Controllers\Frontend\Property;

use App\CustomServices\UserNotificationService;
use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Session;

class FavouritePropertyController extends Controller
{

    //
    public function getAllFavProperties(){

        $user = Auth::user();

        $favProperties=$user->favProperties()->paginate(10);

        return view('frontend.pages.property.favourites.index',compact('favProperties'));
    }

    public function removeFavProperty($propertySlug){

        $property = Property::where('verify_status','verified')->where('slug',$propertySlug)->firstOrFail();

        $user = Auth::user();

        $propertyId = $property->id;

        $alreadyFav=$user->favProperties->contains($propertyId);

        //check if property is already users fav
        if ($alreadyFav){

            $user->favProperties()->detach($propertyId);

            Session::flash('success', 'Property has been removed as favourite!');

            return redirect()->back();

        }

        Session::flash('success', 'What exactly you want to do?');
        return redirect()->back();
    }

    public function toggleFavourite(Request $request,$propertySlug){

        $property = Property::where('verify_status','verified')->where('slug',$propertySlug)->firstOrFail();

        //if not logged in return back
        if (!Auth::check()){
            return redirect()->back();
        }
        if ($request->ajax()) {

            $user = Auth::user();

            $propertyId = $property->id;

            $alreadyFav=$user->favProperties->contains($propertyId);

            //check if property is already users fav
            if ($alreadyFav){

                $user->favProperties()->detach($propertyId);

                //Session::flash('success', 'Property has been removed as favourite!');

                return " <div class='alert alert-success'>
                        Property has been removed as favourite!
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                     </div>";

            }
            else{
                $user->favProperties()->attach($propertyId);

                $this->sendNotificationToUser($user,$property);

                //Session::flash('success', 'Property has been added as favourite!');
                return " <div class='alert alert-success'>
                        Property has been added as favourite!
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                     </div>";
            }
        }


    }

    public function sendNotificationToUser($user,$property){

        $route= route('fe.singleProperty',$property->slug);
        if($user->user_image){
            $image= $user->user_image;
        }
        else{
            $image= $user->provider_image;
        }

        $msg= $user->name . ' has liked your property ' . $property->title . '.';
        $propertyUser = $property->information->user;

        $androidMessage = [
            'message'           => $user->name . ' has liked your property ' . $property->title . '.',
            'user_id'           => $user->id,
            'user_image'        => photoToUrl($image,'/common/images/'),
            'property_id'       => $property->id,
            'property_slug'     => $property->slug,
            'notification_type' => 'LikeProperty'
        ];


        UserNotificationService::sendNotificationToUser($msg,$route,$image,$propertyUser,$androidMessage);

        if ($propertyUser->device_token){

            androidPushNotification($propertyUser->device_token, $user->name . ' has liked your property ' . $property->title . '.', $androidMessage);
        }


    }


}
