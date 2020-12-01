<?php

namespace App\Http\Controllers\Admin\Property;

use App\CustomServices\ImageService;
use App\Property;
use App\PropertyFloorPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Session;

class PropertyFloorPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($propertyId)
    {
        //
        $property = Property::findOrFail($propertyId);
        $propertyFloors = PropertyFloorPlan::where('property_id',$property->id)->latest()->get();

        dd($propertyFloors);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect('/admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$propertyId)
    {
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
                ->with('tabName','floor_plan');
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
        Session::flash('success', 'New Floor Has Been Added!');
        return redirect()->back()->with('tabName','floor_plan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return redirect('/admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$propertyId,$id)
    {
        $property = Property::findOrFail($propertyId);

        $floor = PropertyFloorPlan::where('property_id',$property->id)->where('id',$id)->first();

        if ($request->ajax()) {
            return view('admin.pages.property.property.floor.floor-edit-ajax', compact('floor','property'))->render();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$propertyId,$id)
    {
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
                ->withInput();
        }

        $property = Property::findOrFail($propertyId);

        //continue if only property exists

        $floor = PropertyFloorPlan::where('property_id',$property->id)->where('id',$id)->first();

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
        Session::flash('success', 'Floor Has Been Updated!');
        return redirect()->back()->with('tabName','floor_plan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($propertyId,$id)
    {
        $property = Property::findOrFail($propertyId);

        //continue if only property exists

        $floor = PropertyFloorPlan::where('property_id',$property->id)->where('id',$id)->first();

        $imageToBeDeleted=$floor->floor_image;

        //delete floor image
        ImageService::deleteImage($imageToBeDeleted);

        $floor->delete();

        Session::flash('success', 'Floor Has Been Deleted!');
        //redirect
        return redirect()->route('property.edit',$property->id)->with('tabName','floor_plan');
    }
}
