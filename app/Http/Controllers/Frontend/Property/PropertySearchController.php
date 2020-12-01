<?php

namespace App\Http\Controllers\Frontend\Property;

use App\Property;
use App\PropertyFeature;
use App\PropertyStatus;
use App\PropertySubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertySearchController extends Controller
{

    public function redirectSearch(){
        return redirect()->route('fe.home');
    }

    //
    public function searchAtHome(Request $request){

       $municipal = $request->municipal;

        $property_type = $request->property_type;

        $minPrice = $request->min_price;
        $maxPrice = $request->max_price;

        //dd($maxPrice);

        $feProperties = Property::query();

        $feProperties->when(!is_null($municipal), function ($queryProperty) use($municipal) {
            return $queryProperty->whereHas('address',function ($queryAddress) use($municipal) {
                $queryAddress->whereHas('municipal',function ($queryMunicipal) use($municipal) {
                    $queryMunicipal->where('id',$municipal);
                        });
            });

        })
        ->when(!is_null($property_type), function ($queryProperty) use($property_type) {
            return $queryProperty->whereHas('subCategory', function ($querySubCat) use ($property_type) {
                $querySubCat->where('id', $property_type);
            });
        })
        ->when(!is_null($minPrice) && !is_null($maxPrice), function ($queryProperty) use ($minPrice,$maxPrice) {
            return $queryProperty->whereBetween('price',[$minPrice, $maxPrice]);
        });

        $feProperties = $feProperties->verified()->latest()->get();

        //dd($feProperties);

        $title = "Search Property";

       // dd($feProperties);


        return view('frontend.pages.view-property.search-property',compact('feProperties','title'));


    }

    public function searchAtNav(Request $request){

        //dd($request);
        $keyword = $request->input('search');
        if (empty($keyword)){
            return redirect()->back();
        }

        $municipal = $request->municipal;

        $feProperties = Property::query();

        $feProperties->when(!is_null($municipal), function ($queryProperty) use($municipal) {
            return $queryProperty->whereHas('address',function ($queryAddress) use($municipal) {
                $queryAddress->whereHas('municipal',function ($queryMunicipal) use($municipal) {
                    $queryMunicipal->where('id',$municipal);
                });
            });

        })->when(!is_null($keyword), function ($queryProperty) use ($keyword) {
            return $queryProperty->where('title','like','%'.$keyword . '%');;
        });

        $feProperties = $feProperties->verified()->latest()->get();

        $title = "Search Property";

        // dd($feProperties);

        return view('frontend.pages.view-property.search-property',compact('feProperties','title'));
    }

    public function advanceSearch(Request $request){

        $saleStatus = $request->sale_status;

        $propertyType = $request->property_type;

        $municipal = $request->municipal;

        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;

        $minPrice = $request->min_price;
        $maxPrice = $request->max_price;

        $minArea = $request->min_area;
        $maxArea = $request->max_area;

        if (!empty($request->features)){
            $features = array_filter($request->features);
        }
        else{
            $features=[];
        }


        $propertyStatuses = PropertyStatus::all();

        $propertyTypes = PropertySubCategory::where('status',1)->get();

        //property features
        $propertyFeatures = PropertyFeature::latest()->get();


        $feProperties = Property::query();

     if(!empty($features)){
            foreach($features as $feature) {
                $feProperties->whereHas('propertyFeatures', function ($queryFeature) use ($feature) {
                    $queryFeature->where('feature_id', $feature);

                });
            }
        }

     if (!is_null($municipal)){
         $feProperties->whereHas('address',function ($queryAddress) use($municipal) {
             $queryAddress->whereHas('municipal',function ($queryMunicipal) use($municipal) {
                 $queryMunicipal->where('id',$municipal);
             });
         });
     }

     if (!is_null($saleStatus)){
         $feProperties->whereHas('saleStatus', function ($querySaleStatus) use ($saleStatus) {
             $querySaleStatus->where('id', $saleStatus);
         });
     }
     if(!is_null($propertyType)){
         $feProperties->whereHas('subCategory', function ($querySubCat) use ($propertyType) {
             $querySubCat->where('id', $propertyType);
         });
     }
     if(!is_null($minPrice) && !is_null($maxPrice)){
         $feProperties->whereBetween('price',[$minPrice, $maxPrice]);
     }
     if (!is_null($minArea) && !is_null($maxArea)){
         $feProperties->whereBetween('area_size',[$minArea, $maxArea]);
     }
    if (!is_null($bedrooms)){
        $feProperties->where('bedrooms',$bedrooms);
    }
    if (!is_null($bathrooms)){
        $feProperties->where('bathrooms',$bathrooms);
    }

    switch ($request->sort_by){
        case 'newest':
            $feProperties->latest();
            break;
        case 'oldest':
            $feProperties->orderBy('created_at','asc');
            break;
        case 'high_to_low':
            $feProperties->orderBy('price','desc');
            break;
        case 'low_to_high':
            $feProperties->orderBy('price','asc');
            break;

        default:
            $feProperties->verified()->latest();

    }


        $feProperties = $feProperties->paginate(15);


        $title = "Advance Search Property";

        if ($request->ajax()) {

            //return $request->sort_by;

            return view('frontend.pages.view-property.includes-properties',compact('feProperties','title','propertyStatuses','propertyTypes',
                'propertyFeatures'))->render();
        }

        return view('frontend.pages.view-property.index',compact('feProperties','title','propertyStatuses','propertyTypes',
            'propertyFeatures'));

    }

}


