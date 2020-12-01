<?php

namespace App\Http\Controllers\Frontend\Property;

use App\CustomServices\VerificationRequestService;
use App\Property;
use App\PropertyMoreInformation;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;

class PropertyInformationController extends Controller
{
    //
    public function updatePropertyInformation(Request $request,$propertyId){

        $validator = Validator::make($request->all(), [
            /*'user_id' =>'required',*/
            'owner_name'=>'required|max:191',
            'owner_address' => 'required',
            'owner_contact' => 'required',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('tabName','more-info-id');
        }

        $property = Property::findOrFail($propertyId);

       /// dd($property);
        //$user = User::findOrFail($request->user_id);

        //continue if only property exists

        $propertyInfo = PropertyMoreInformation::where('property_id',$property->id)->first();

        if (is_null($propertyInfo)){

            //return redirect()->back()->with('danger','Information Already Exists');
            $propertyInfo = new PropertyMoreInformation();
        }

        $propertyInfo->user_id = Auth::id();
        $propertyInfo->property_id = $property->id;
        $propertyInfo->owner_name = $request->owner_name;
        $propertyInfo->owner_address = $request->owner_address;
        $propertyInfo->owner_contact = $request->owner_contact;
        $propertyInfo->yt_url = $request->yt_url;
        $propertyInfo->yt_title = $request->yt_title;
        $propertyInfo->private_note = $request->private_note;
        $propertyInfo->message = $request->message;

        $propertyInfo->ref_owner_name_1 = $request->ref_owner_name_1;
        $propertyInfo->ref_owner_phone_1 = $request->ref_owner_phone_1;
        $propertyInfo->ref_owner_name_2 = $request->ref_owner_name_2;
        $propertyInfo->ref_owner_phone_2 = $request->ref_owner_phone_2;

        $propertyInfo->save();

        $property->verify_status = 'pending';

        $property->save();

        VerificationRequestService::sendVerificationRequestNotificationsToaAdmin($property);

        Session::flash('success', 'Property Information Has Been Updated!');
        return redirect()->back()->with('tabName','more-info-id');
    }
}
