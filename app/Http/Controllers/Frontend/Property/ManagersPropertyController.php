<?php

namespace App\Http\Controllers\Frontend\Property;

use App\CustomServices\ImageService;
use App\District;
use App\Municipal;
use App\Property;
use App\PropertyAddress;
use App\PropertyCategory;
use App\PropertyDocument;
use App\PropertyFeature;
use App\PropertyFloorPlan;
use App\PropertyGallery;
use App\PropertyMoreInformation;
use App\PropertyReview;
use App\PropertyStatus;
use App\Province;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Session;

class ManagersPropertyController extends Controller
{
    //listing property managed by managers
    public function managedProperties(){

        /*$manager =Auth::user()->whereHas('roles', function ($query) {
            $query->where('id',1);
        })->firstOrFail();*/

        $manager= Auth::user();
        //dd($manager);

        $managedProperties = Property::whereHas('information', function ($query) use ($manager){
            $query->where('manager_id',$manager->id)->where('isApprovedManager',1);
        })->verified()->latest()->paginate(10);

        $title = "My Managed Properties";

        return view('frontend.pages.view-property.managed-property.index',compact('title'))->with('properties',$managedProperties);
    }

}
