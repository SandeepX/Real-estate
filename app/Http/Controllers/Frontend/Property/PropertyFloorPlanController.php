<?php

namespace App\Http\Controllers\Frontend\Property;

use App\CustomServices\ImageService;
use App\CustomServices\VerificationRequestService;
use App\Property;
use App\PropertyFloorPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Session;

class PropertyFloorPlanController extends Controller
{
    //
    public function storeFloor(Request $request,$propertyId){

        $validator = Validator::make($request->all(), [
            'floor_title' =>'required|max:191',
            'floor_description'=>'required',
            'floor_price' => 'required|integer',
            'floor_area_size' => 'required|integer',
            'floor_area_size_postfix' => 'required|max:191',
            'floor_bedrooms' => 'required',
            'floor_bathrooms' => 'required',
            'floor_image' =>'sometimes|nullable|image',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('tabName','floor-plan-id');
        }

        $property = Property::findOrFail($propertyId);

        //continue if only property exists

        $floor = new PropertyFloorPlan();

        $floor->floor_title = ucwords(strtolower($request->floor_title));
        $floor->property_id = $property->id;
        $floor->floor_description = $request->floor_description;
        $floor->floor_price = $request->floor_price;
        $floor->floor_price_postfix = $request->floor_price_postfix;
        $floor->floor_area_size = $request->floor_area_size;
        $floor->floor_area_size_postfix = $request->floor_area_size_postfix;

        $floor->floor_bedrooms = $request->floor_bedrooms;
        $floor->floor_bathrooms = $request->floor_bathrooms;

        //save floor Image
        if ($request->hasFile('floor_image')) {
            $filenameToStore=ImageService::saveImage($request->file('floor_image'));
            $floor->floor_image=$filenameToStore;
        }

        $floor->save();

        $property->verify_status = 'pending';

        $property->save();

        VerificationRequestService::sendVerificationRequestNotificationsToaAdmin($property);

        Session::flash('success', 'New Floor Has Been Added!');
        return redirect()->back()->with('tabName','floor-plan-id');
    }

    public function editFloor(Request $request,$propertyId,$floorId){

        $property = Property::findOrFail($propertyId);

        $floor = PropertyFloorPlan::where('property_id',$property->id)->where('id',$floorId)->first();

        if ($request->ajax()) {
            return view('frontend.pages.property.floor.floor-edit-ajax', compact('floor','property'))->render();
        }
    }

    public function updateFloor(Request $request,$propertyId,$floorId){
        $validator = Validator::make($request->all(), [
            'floor_title' =>'required|max:191',
            'floor_description'=>'required',
            'floor_price' => 'required|integer',
            'floor_area_size' => 'required|integer',
            'floor_area_size_postfix' => 'required|max:191',
            'floor_bedrooms' => 'required',
            'floor_bathrooms' => 'required',
            'floor_image' =>'sometimes|nullable|image',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('tabName','floor-plan-id');
        }

        $property = Property::findOrFail($propertyId);

        //continue if only property exists

        $floor = PropertyFloorPlan::where('property_id',$property->id)->where('id',$floorId)->first();

        $floor->floor_title = $request->floor_title;
        $floor->property_id = $property->id;
        $floor->floor_description = $request->floor_description;
        $floor->floor_price = $request->floor_price;
        $floor->floor_price_postfix = $request->floor_price_postfix;
        $floor->floor_area_size = $request->floor_area_size;
        $floor->floor_area_size_postfix = $request->floor_area_size_postfix;

        $floor->floor_bedrooms = $request->floor_bedrooms;
        $floor->floor_bathrooms = $request->floor_bathrooms;

        //save floor Image
        if ($request->hasFile('floor_image')) {

            $filenameToStore=ImageService::saveImage($request->file('floor_image'));

            $oldFileName=$floor->floor_image;
            $floor->floor_image=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $floor->floor_image == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }

        }

        $floor->save();

        $property->verify_status = 'pending';

        $property->save();

        VerificationRequestService::sendVerificationRequestNotificationsToaAdmin($property);

        Session::flash('success', 'Floor Has Been Updated!');
        return redirect()->back()->with('tabName','floor-plan-id');
    }

    public function deleteFloor($propertyId,$floorId){

        $property = Property::findOrFail($propertyId);

        //continue if only property exists

        $floor = PropertyFloorPlan::where('property_id',$property->id)->where('id',$floorId)->firstOrFail();

        $imageToBeDeleted=$floor->floor_image;

        //delete floor image
        ImageService::deleteImage($imageToBeDeleted);

        $floor->delete();

        Session::flash('success', 'Floor Has Been Deleted!');
        //redirect
        return redirect()->route('user.property.edit',$property->slug)->with('tabName','floor-plan-id');

    }

}
