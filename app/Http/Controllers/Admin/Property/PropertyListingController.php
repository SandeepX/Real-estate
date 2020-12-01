<?php

namespace App\Http\Controllers\Admin\Property;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyListingController extends Controller
{
    //
    public function getVerifiedProperties(){

        /*$properties = Property::with([
            'category'=>function($query){
                $query->where('status',1);
            },
            'subCategory'=>function($query){
                $query->where('status',1);
            },
            'address'
        ])->where('verify_status','verified')->latest()->get();*/

        $properties = Property::with(['category','subCategory','address'])->verified()->latest()->get();

        $title = 'Verified';

        return view('admin.pages.property.listing.listing',compact('properties','title'));

    }

    public function getUnverifiedProperties(){

        $properties = Property::with(['category','subCategory','address'])->where('verify_status','unverified')->latest()->get();

        $title = 'Unverified';

        return view('admin.pages.property.listing.listing',compact('properties','title'));

    }

    public function getFeaturedProperties(){

        $properties = Property::with(['category','subCategory','address'])->featured()->latest()->get();

        $title = 'Featured';

        return view('admin.pages.property.listing.listing',compact('properties','title'));

    }

    public function toggleFeature($id){

        $property = Property::findOrFail($id);


        $property->feature_status = $property->feature_status == 'featured' ? 'unfeatured' : 'featured';

        $property->save();

        return redirect()->back();

        //return redirect()->route('admin.properties.featured');
    }

}
