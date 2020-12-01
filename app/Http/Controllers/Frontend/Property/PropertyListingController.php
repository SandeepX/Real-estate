<?php

namespace App\Http\Controllers\Frontend\Property;

use App\Property;
use App\PropertyAddress;
use App\PropertyCategory;
use App\PropertyFeature;
use App\PropertyFloorPlan;
use App\PropertyGallery;
use App\PropertyMoreInformation;
use App\PropertyReview;
use App\PropertyStatus;
use App\PropertySubCategory;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PropertyListingController extends Controller
{
    public function getAllProperties(){

        $feProperties = Property::with(['saleStatus','category','subCategory'])->verified()->latest()->paginate(15);

        $propertyStatuses = PropertyStatus::all();

        $propertyTypes = PropertySubCategory::where('status',1)->get();

        //property features
        $propertyFeatures = PropertyFeature::latest()->get();

        $title = 'All Properties';

        return view('frontend.pages.view-property.index',compact('feProperties','title',
            'propertyStatuses','propertyTypes','propertyFeatures'));
    }

    public function getSingleProperty($slug){

        $propertyUser =null;

        $propertyManager =null;

        $property = Property::verified()->where('slug',$slug)->firstOrFail();

        $property->view_count +=1;

        $property->save();

        $propertyGallery = PropertyGallery::where('property_id',$property->id)->latest()->get();

        if($property->featured_image){
            $featuredImage = new PropertyGallery();
            $featuredImage->image = $property->featured_image;

            $propertyGallery->prepend($featuredImage);
        }

        $singlePropertyFeatures = $property->propertyFeatures;

        $additionalFeatures = json_decode($property->additional_features);

        $floors = PropertyFloorPlan::where('property_id',$property->id)->get();

        $propertyAddress = PropertyAddress::where('property_id',$property->id)->first();

        $propertyInformation =PropertyMoreInformation::where('property_id',$property->id)->first();

        if (!is_null($propertyInformation)){

            if(!is_null($propertyInformation->user_id)){

                $propertyUser = User::where('id',$propertyInformation->user_id)->where('status',1)->first();

            }

            if(!is_null($propertyInformation->manager_id)){
                $propertyManager = User::where('id',$propertyInformation->manager_id)->where('status',1)->first();
            }

        }


        $propertyReviews = PropertyReview::with(['user'])->where('status',0)->where('property_id',$property->id)->get();

        $relatedProperties = Property::verified()->where('property_category_id',$property->property_category_id)->get();

        //for advance search

        $propertyStatuses = PropertyStatus::all();

        $propertyTypes = PropertySubCategory::where('status',1)->get();

        //property features
        $propertyFeatures = PropertyFeature::latest()->get();

        if (Auth::check()){

            $user = Auth::user();
            $fav=$user->favProperties->contains($property->id);
        }
        else{
            $fav = false;
        }

        //dd($propertyFeatures);

        return view('frontend.pages.view-property.single-property',compact('property','propertyGallery',
            'singlePropertyFeatures','additionalFeatures','floors','propertyAddress','propertyInformation',
            'propertyReviews','relatedProperties','propertyStatuses','propertyTypes','propertyFeatures','fav','propertyUser','propertyManager'));
    }

    public function getFeaturedProperties(){

        $feProperties = Property::with(['saleStatus','category','subCategory'])->verified()->featured()->latest()->paginate(6);

        $propertyStatuses = PropertyStatus::all();

        $propertyTypes = PropertySubCategory::where('status',1)->get();

        //property features
        $propertyFeatures = PropertyFeature::latest()->get();

        $title = 'Featured Properties';

       return view('frontend.pages.view-property.index',compact('feProperties','title','propertyStatuses','propertyTypes',
           'propertyFeatures'));
    }
    public function getNewProperties(){

        $feProperties = Property::with(['saleStatus','category','subCategory'])->verified()->latest()->paginate(1);

        $propertyStatuses = PropertyStatus::all();

        $propertyTypes = PropertySubCategory::where('status',1)->get();

        //property features
        $propertyFeatures = PropertyFeature::latest()->get();

        $title = 'New Properties';

        return view('frontend.pages.view-property.index',compact('feProperties','title','propertyStatuses',
            'propertyTypes','propertyFeatures'));
    }

    public function getTrendingProperties(){

        $feProperties = Property::with(['saleStatus','category','subCategory'])->verified()->orderBy('view_count','desc')->paginate(15);

        $propertyStatuses = PropertyStatus::all();

        $propertyTypes = PropertySubCategory::where('status',1)->get();

        //property features
        $propertyFeatures = PropertyFeature::latest()->get();

         $title = 'Trending Properties';

        return view('frontend.pages.view-property.index',compact('feProperties','title','propertyStatuses',
            'propertyTypes','propertyFeatures'));
    }

    public function getPropertiesByCategory($category){

        $category= PropertyCategory::where('slug',$category)->firstOrFail();

        $feProperties = Property::with(['saleStatus','category','subCategory'])->verified()
            ->where('property_category_id',$category->id)->latest()->paginate(15);

        $propertyStatuses = PropertyStatus::all();

        $propertyTypes = PropertySubCategory::where('status',1)->get();

        //property features
        $propertyFeatures = PropertyFeature::latest()->get();

        $title = $category->name;

        return view('frontend.pages.view-property.index',compact('feProperties','title','propertyStatuses',
            'propertyTypes','propertyFeatures'));
    }

    public function getPropertiesBySubCategory($subcat){

        $subCategory = PropertySubCategory::where('slug',$subcat)->firstOrFail();

        $feProperties = Property::with(['saleStatus','category','subCategory'])->verified()
            ->where('property_subcategory_id',$subCategory->id)->latest()->paginate(15);

        $propertyStatuses = PropertyStatus::all();

        $propertyTypes = PropertySubCategory::where('status',1)->get();

        //property features
        $propertyFeatures = PropertyFeature::latest()->get();

        $title = $subCategory->name;

        return view('frontend.pages.view-property.index',compact('feProperties','title','propertyStatuses',
            'propertyTypes','propertyFeatures'));
    }

    public function getPropertiesByStatus($status){

        $status = PropertyStatus::where('slug',$status)->firstOrFail();

        $feProperties = Property::with(['saleStatus','category','subCategory'])->verified()
            ->where('property_status_id',$status->id)->latest()->paginate(15);

        $propertyStatuses = PropertyStatus::all();

        $propertyTypes = PropertySubCategory::where('status',1)->get();

        //property features
        $propertyFeatures = PropertyFeature::latest()->get();

        $title = $status->title;

        return view('frontend.pages.view-property.index',compact('feProperties','title','propertyStatuses',
            'propertyTypes','propertyFeatures'));

    }
}
