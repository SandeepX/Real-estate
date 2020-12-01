<?php

namespace App\Http\Controllers\Frontend\Property;

use App\CustomServices\ImageService;
use App\CustomServices\VerificationRequestService;
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
use App\PropertySubCategory;
use App\Province;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Session;

class PropertyController extends Controller
{
    private $pending = 'pending';

    public function deleteFeaturedImage(Request $request,$id){

        if ($request->ajax()) {

            $property = Property::findOrFail($id);

            $oldFileName = $property->featured_image;
            $property->featured_image =null;
            $property->save();

            //delete image from Server
            if (!empty($oldFileName)) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }

    }

    public function deleteImages(Request $request,$id){

        if ($request->ajax()) {
            $gallery = PropertyGallery::find($id);

            $oldFileName = $gallery->image;

            $gallery->delete();

            //delete image from Server
            if (!empty($oldFileName)) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }

    }
    //
    public function index(){

        $properties = Property::with(['address'])->whereHas('information', function ($query) {
            $query->where('user_id',Auth::id());
        })->latest()->paginate(10);

        return view('frontend.pages.property.index',compact('properties'));

    }

    public function createProperty(){

        //property type
        $propertyCategories = PropertyCategory::with([
            'propertySubCategories'=>function($query){
                $query->where('status',1);
            },
        ])->where('status',1)->latest()->get();

        //property Sale type
        $propertyStatus = PropertyStatus::latest()->get();

        //property features
        $propertyFeatures = PropertyFeature::latest()->get();

        $user = Auth::user();

        $oldFields=[];


        $provinces = Province::get();

        $districts = District::get();

        $municipals = Municipal::get();

        $areaPostfix=['Sq Ft','Aana','Ropani','Dhur','Kattha','Bigha'];

        return view('frontend.pages.property.create',compact('propertyCategories','propertyStatus',
            'propertyFeatures','user','oldFields','provinces','districts','municipals','areaPostfix'));
    }

    public function storeProperty(Request $request){

        $validator = Validator::make($request->all(), [
            'title' =>'required|max:191|unique:properties,title',
            'property_type'=>'required',
            'property_status'=>'required',
            'description'=>'required',
            'price' => 'required|integer',
            'area_size' => 'required|integer',
            'area_size_postfix' => 'required|max:191',
            'featured_image' =>'required|image|max:5120',

            'owner_name'=>'required|max:191',
            'owner_address' => 'required',
            'owner_contact' => 'required',
            'ref_owner_name_1'=>'required|max:191',
            'ref_owner_phone_1'=>'required',

            'address'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'province' => "required",
            'district' => "required",
            'municipal' =>"required",

            'gallery_images'=> 'sometimes|nullable',
            'gallery_images.*' => 'image|max:5120',

        ]);

        if ($validator->fails()) {

            $oldFields = array_filter($request->additional_features);

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('oldFields',$oldFields);
        }


        //get category id & subcategory id
        $aId=explode(',', $request->property_type);
        $categoryId = $aId[0];
        $subCategoryId = $aId[1];

        //generating the slug
        $slug = str_slug($request->title, '-');

        $property = new Property();

        $property->property_id = $property->generatePropertyId();

        $property->title = ucwords(strtolower($request->title));
        $property->slug = $slug;

        $property->property_category_id = $categoryId;
        $property->property_subcategory_id = $subCategoryId;

        $property->property_status_id = $request->property_status;

        //saving array with index of only not null..Returns a string containing the JSON representation of the supplied value.
        $additionalFeatures=array_filter($request->additional_features);
        if (!empty($additionalFeatures)){

            $property->additional_features =  json_encode($additionalFeatures);
        }

        //$property->status = $request->has('status');
        $property->description = $request->description;
        $property->price = $request->price;
        $property->	price_postfix = ucwords(strtolower($request->price_postfix));
        $property->area_size = $request->area_size;
        $property->area_size_postfix = ucwords(strtolower($request->area_size_postfix));
        /*$property->lot_size = $request->lot_size;
        $property->lot_size_postfix = ucwords(strtolower($request->lot_size_postfix));*/


        $property->front_face = $request->front_face;
        $property->back_face = $request->back_face;
        //$property->isFeatured = $request->has('isFeatured');

        //dd($property);

        //save featured Image
        if ($request->hasFile('featured_image')) {
            $filenameToStore=ImageService::saveMultipleSizeImage($request->file('featured_image'));
            $property->featured_image=$filenameToStore;
        }
        $property->verify_status = 'verified';
        $property->save();

        //storing property Information
        $user=Auth::user();
        $this->savePropertyInformation($request,$property,$user);

        $address = $request->address;
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        //saving address
        if (!empty($address) && !empty($latitude) && !empty($longitude)){
            $propertyAddress = new PropertyAddress();

            $propertyAddress->property_id = $property->id;
            $propertyAddress->address = $address;
            $propertyAddress->latitude = $latitude;
            $propertyAddress->longitude = $longitude;

            $propertyAddress->province_id = $request->province;
            $propertyAddress->district_id = $request->district;
            $propertyAddress->municipality_id = $request->municipal;

            $propertyAddress->save();

        }


        $propertySubCategory = PropertySubCategory::find($property->property_subcategory_id);
        if($propertySubCategory->slug != 'land'){
            $property->bedrooms = $request->bedrooms;
            $property->bathrooms = $request->bathrooms;
            $property->garages = $request->garages;
            $property->year_built = $request->year_built;


            $property->save();

            $property->propertyFeatures()->attach($request->property_features);
        }



        //saving gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $gallery_image){

                $gallery= new PropertyGallery();
                $gallery->property_id = $property->id;

                $filenameToStore=ImageService::saveImage($gallery_image);
                $gallery->image=$filenameToStore;

                $gallery->save();
            }

        }


        Session::flash('success', 'New Property Has Been Added!');
        //return redirect()->back();
        //return redirect()->route('user.property.edit',$property->slug);
        return redirect()->route('user.property.index');
    }

    public function savePropertyInformation($request,$property,$user){

        $propertyInfo = PropertyMoreInformation::where('property_id',$property->id)->first();

        if (is_null($propertyInfo)){

            //return redirect()->back()->with('danger','Information Already Exists');
            $propertyInfo = new PropertyMoreInformation();
        }

        $propertyInfo->user_id = $user->id;
        $propertyInfo->property_id = $property->id;
        $propertyInfo->owner_name = $request->owner_name;
        $propertyInfo->owner_address = $request->owner_address;
        $propertyInfo->owner_contact = $request->owner_contact;

        $propertyInfo->ref_owner_name_1 = $request->ref_owner_name_1;
        $propertyInfo->ref_owner_phone_1 = $request->ref_owner_phone_1;
        $propertyInfo->ref_owner_name_2 = $request->ref_owner_name_2;
        $propertyInfo->ref_owner_phone_2 = $request->ref_owner_phone_2;

        $propertyInfo->yt_url = $request->yt_url;
        $propertyInfo->yt_title = $request->yt_title;
        $propertyInfo->private_note = $request->private_note;
        $propertyInfo->message = $request->message;

        $propertyInfo->save();
    }

    public function editProperty($slug){


        $property = Property::where('slug',$slug)->firstOrFail();

        if (auth()->user()->id != $property->information->user_id && auth()->user()->id != $property->information->manager_id){

            return redirect()->route('fe.home');
        }


        //retrieving only id and converting to array
        $featuresOfProperty = $property->propertyFeatures->pluck('id')->all();

        //additional features of property
        $additionalFeatures =json_decode($property->additional_features);

        //address of the property
        $propertyAddress = PropertyAddress::where('property_id',$property->id)->first();

        $propertyDistricts = District::where('province_id',$propertyAddress->province_id)->get();

        $propertyMunicipals = Municipal::where('district_id',$propertyAddress->district_id)->get();

        //property gallery Images
        $propertyImages = PropertyGallery::where('property_id',$property->id)->latest()->get();


        //property type
        $propertyCategories = PropertyCategory::with([
            'propertySubCategories'=>function($query){
                $query->where('status',1);
            },
        ])->where('status',1)->latest()->get();

        //property Sale type
        $propertyStatus = PropertyStatus::latest()->get();

        //property features
        $propertyFeatures = PropertyFeature::latest()->get();

        $oldFields=[];

        //property floors
        $propertyFloors = PropertyFloorPlan::where('property_id',$property->id)->latest()->get();

        $user = Auth::user();

        $propertyInfo = PropertyMoreInformation::where('property_id',$property->id)->first();

        //property documents
        //$propertyDocuments = PropertyDocument::where('property_id',$property->id)->latest()->get();
        $propertyDocument = PropertyDocument::where('property_id',$property->id)->first();

        $provinces = Province::get();

        $districts = District::get();

        $municipals = Municipal::get();

        $areaPostfix=['Sq Ft','Aana','Ropani','Dhur','Kattha','Bigha'];

        return view('frontend.pages.property.edit',compact('property','featuresOfProperty',
            'additionalFeatures','propertyAddress','propertyDistricts','propertyMunicipals','propertyImages',
            'propertyCategories','propertyStatus', 'propertyFeatures','propertyFloors','user',
            'propertyInfo','propertyDocument',
            'oldFields','provinces','districts','municipals','areaPostfix'));
    }

    public function updateProperty(Request $request, $slug){

        //check if the property belongs to user or manager
        $property = Property::where('slug',$slug)->firstOrFail();

        if (auth()->user()->id != $property->information->user_id && auth()->user()->id != $property->information->manager_id){

            return redirect()->route('fe.home');
        }

        $validator = Validator::make($request->all(), [
            'title' =>'required|max:191|unique:properties,title,'.$property->id,
            'property_type'=>'required',
            'property_status'=>'required',
            'description'=>'required',
            'price' => 'required|integer',
            'area_size' => 'required|integer',
            'area_size_postfix' => 'required|max:191',
            'featured_image' =>'sometimes|nullable|image|max:5120',

            'address'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',

            'gallery_images'=> 'sometimes|nullable',
            'gallery_images.*' => 'image|max:5120',

        ]);

        if ($validator->fails()) {

            $oldFields = array_filter($request->additional_features);

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('oldFields',$oldFields)
                ->with('tabName','general-id');
        }

        //get category id & subcategory id
        $aId=explode(',', $request->property_type);
        $categoryId = $aId[0];
        $subCategoryId = $aId[1];

        //generating the slug
        $slug = str_slug($request->title, '-');


        $property->title = ucwords(strtolower($request->title));
        $property->slug = $slug;

        $property->property_category_id = $categoryId;
        $property->property_subcategory_id = $subCategoryId;
        $property->property_status_id = $request->property_status;

        //saving array..Returns a string containing the JSON representation of the supplied value.
        $additionalFeatures=array_filter($request->additional_features);
        if (!empty($additionalFeatures)){
            $property->additional_features = json_encode($additionalFeatures);

        }
        else{
            $property->additional_features =null;
        }

        //$property->status = $request->has('status');
        $property->description = $request->description;
        $property->price = $request->price;
        $property->	price_postfix = ucwords(strtolower($request->price_postfix));
        $property->area_size = $request->area_size;
        $property->area_size_postfix = ucwords(strtolower($request->area_size_postfix));
        /*$property->lot_size = $request->lot_size;
        $property->lot_size_postfix = ucwords(strtolower($request->lot_size_postfix));*/

        $property->front_face = $request->front_face;
        $property->back_face = $request->back_face;
        //$property->isFeatured = $request->has('isFeatured');


        //save featured Image
        if ($request->hasFile('featured_image')) {
            $filenameToStore=ImageService::saveMultipleSizeImage($request->file('featured_image'));

            $oldFileName=$property->featured_image;
            $property->featured_image=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $property->featured_image == $filenameToStore) {
                //delete the old photo
                ImageService::deleteMultipleSizeImage($oldFileName);
            }
        }

        //$property->verify_status = $this->pending;
        $property->verify_status = 'verified';

        $property->save();

        //VerificationRequestService::sendVerificationRequestNotificationsToaAdmin($property);

        $address = $request->address;
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        //saving address
        if (!empty($address) && !empty($latitude) && !empty($longitude)){
            $propertyAddress =PropertyAddress::where('property_id',$property->id)->first();
            $propertyAddress->property_id = $property->id;
            $propertyAddress->address = $address;
            $propertyAddress->latitude = $latitude;
            $propertyAddress->longitude = $longitude;

            $propertyAddress->province_id = $request->province;
            $propertyAddress->district_id = $request->district;
            $propertyAddress->municipality_id = $request->municipal;

            $propertyAddress->save();

        }

        $propertySubCategory = PropertySubCategory::find($property->property_subcategory_id);
        if($propertySubCategory->slug != 'land'){
            $property->bedrooms = $request->bedrooms;
            $property->bathrooms = $request->bathrooms;
            $property->garages = $request->garages;
            $property->year_built = $request->year_built;

            $property->save();

            $property->propertyFeatures()->sync($request->property_features);
        }


        //saving gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $gallery_image){

                $gallery= new PropertyGallery();
                $gallery->property_id = $property->id;

                $filenameToStore=ImageService::saveImage($gallery_image);
                $gallery->image=$filenameToStore;

                $gallery->save();
            }

        }

        Session::flash('success', 'Property Has Been Updated!');
        return redirect()->route('user.property.edit',$property->slug)->with('tabName','general-id');
    }

    public function deleteProperty($propertySlug){




        return redirect()->back();




        $property= Property::where('status',1)->where('slug',$propertySlug)->whereHas('information', function ($query){
            $query->where('user_id',Auth::id());
        })->firstOrFail();

        $imageToBeDeleted=$property->featured_image;

        //delete property image
        //ImageService::deleteImage($imageToBeDeleted);
        ImageService::deleteMultipleSizeImage($imageToBeDeleted);

        //property features detach
        $property->propertyFeatures()->detach();

        //delete property Address
        PropertyAddress::where('property_id',$property->id)->delete();

        //delete property gallery images
        $propertyImages = PropertyGallery::where('property_id',$property->id)->get();

        foreach ($propertyImages as $pImages){
            ImageService::deleteImage($pImages->image);
        }

        PropertyGallery::where('property_id',$property->id)->delete();

        //delete floor plans
        $propertyFloorPlans = PropertyFloorPlan::where('property_id',$property->id)->get();

        foreach ($propertyFloorPlans as $floorPlan){
            ImageService::deleteImage($floorPlan->floor_image);
        }

        PropertyFloorPlan::where('property_id',$property->id)->delete();

        //delete property information
        PropertyMoreInformation::where('property_id',$property->id)->delete();

        $propertyDocuments =PropertyDocument::where('property_id',$property->id)->get();

        foreach ($propertyDocuments as $doc){
            ImageService::deleteImage($doc->document);
        }

        //delete Reviews
        PropertyReview::where('property_id',$property->id)->delete();

        $property->delete();

        Session::flash('success', 'Property Has Been deleted!');
        //redirect
        return redirect()->route('user.property.index');


    }

}
