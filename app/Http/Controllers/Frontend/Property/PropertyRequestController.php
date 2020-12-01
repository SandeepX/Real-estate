<?php

namespace App\Http\Controllers\Frontend\Property;

use App\Property;
use App\PropertyRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Session;

class PropertyRequestController extends Controller
{
    //
    public function requestProperty(Request $request,$slug){

        $validator = Validator::make($request->all(), [
            'name' =>'required|max:191',
            'email' =>'required|email',
            'phone' =>'required',
            'address' =>'required|max:191',
            'message' =>'required',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()->with('request','request');
        }

        $property = Property::where('verify_status','verified')->where('slug',$slug)->firstOrFail();

        $propertyRequest = new PropertyRequest();

        $propertyRequest->property_id = $property->id;
        $propertyRequest->name= $request->name;
        $propertyRequest->email= $request->email;
        $propertyRequest->phone= $request->phone;
        $propertyRequest->address= $request->address;
        $propertyRequest->message= $request->message;

        $propertyRequest->save();

        Session::flash('success', 'Request Sent');

        return redirect()->back()->with('request','request');


    }

    public function getAllRequests($slug){

        $property = Property::where('slug',$slug)->firstOrFail();

        $propertyRequests = PropertyRequest::where('property_id',$property->id)->paginate(10);

        return view('frontend.pages.property.request.index',compact('property','propertyRequests'));
    }

    public function getSingleRequest($propertySlug,$requestId){


        $property = Property::where('slug',$propertySlug)->firstOrFail();

        $propertyRequest = PropertyRequest::where('property_id',$property->id)->where('id',$requestId)->firstOrFail();

        return view('frontend.pages.property.request.single',compact('property','propertyRequest'));
    }
}
