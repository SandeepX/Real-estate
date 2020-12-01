<?php

namespace App\Http\Controllers\Frontend\Property;

use App\Notifications\PropertyVerificationRequestNotification;
use App\Property;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Notification;

use Session;

class PropertyVerificationRequestController extends Controller
{
    private $unVerified = 'unverified';
    private $pending = 'pending';
    private $verified = 'Verified';
    //
    public function requestVerification($propertySlug){

        $property = Property::where('slug',$propertySlug)->firstOrfail();

        $property->verify_status = $this->pending;

        $property->save();

        $this->sendVerificationRequestNotificationsToaAdmin($property);

        Session::flash('success', 'Verification Request Sent');

        return redirect()->back();
    }

    public function requestFeaturing($propertySlug){

        $property = Property::where('slug',$propertySlug)->firstOrfail();

        $property->feature_status = $this->pending;

        $property->save();

        $this->sendFeatureRequestNotificationsToaAdmin($property);

        Session::flash('success', 'Featured Request Sent');

        return redirect()->back();

    }

    public function sendVerificationRequestNotificationsToaAdmin($property){

        $superAdmins = User::role('Super Admin')->get();

        $route =route('admin.request.verification');

        $msg = 'Verification request for the property '.'"'.$property->title.'"';

        Notification::send($superAdmins, new PropertyVerificationRequestNotification($property,$route,$msg));
    }

    public function sendFeatureRequestNotificationsToaAdmin($property){

        $superAdmins = User::role('Super Admin')->get();

        $route =route('admin.request.featured');

        $msg = 'Feature request for the property '.'"'.$property->title.'"';

        Notification::send($superAdmins, new PropertyVerificationRequestNotification($property,$route,$msg));
    }
}
