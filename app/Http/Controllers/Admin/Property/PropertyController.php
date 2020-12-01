<?php

namespace App\Http\Controllers\Admin\Property;

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
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Facades\Input;
use File;
use Session;

class PropertyController extends Controller
{

    public function deleteFeaturedImage(Request $request,$id){

        if ($request->ajax()) {

            $property = Property::findOrFail($id);

            $oldFileName = $property->featured_image;
            $property->featured_image=null;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       /*$properties = Property::with([
            'category'=>function($query){
                $query->where('status',1);
            },
           'subCategory'=>function($query){
                $query->where('status',1);
            },
           'address'
        ])->latest()->get();*/

        $properties = Property::with(['category','subCategory','address'])->latest()->get();

       return view('admin.pages.property.property.index',compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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


        //for more information tab
        $users = User::with([
            'roles'=>function($query){
                $query->where('id',3);
            },
        ])->whereHas('roles', function ($query) {
            $query->where('id',3);
        })->latest()->get();

        $oldFields=[];

        $provinces = Province::get();

        $districts = District::get();

        $municipals = Municipal::get();

        $areaPostfix=['Sq Ft','Aana','Ropani','Dhur','Kattha','Bigha'];

        return view('admin.pages.property.property.create',compact('propertyCategories','propertyStatus',
            'propertyFeatures','users','oldFields','provinces','districts','municipals'))->with('areaPostfix',$areaPostfix);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' =>'required|max:191|unique:properties,title',
            'property_type'=>'required',
            'property_status'=>'required',
            'description'=>'required',
            'price' => 'required|integer',
            'area_size' => 'required|integer',
            'area_size_postfix' => 'required|max:191',
            'featured_image' =>'required|image',

            'user_id' =>'required',
            'owner_name'=>'required|max:191',
            'owner_address' => 'required',
            'owner_contact' => 'required',
            'ref_owner_name_1'=>'required|max:191',
            'ref_owner_phone_1'=>'required',

            'address'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',

            'gallery_images'=> 'sometimes|nullable',
            'gallery_images.*' => 'image',

        ]);

        if ($validator->fails()) {

            $oldFields = array_filter($request->additional_features);
            //dd($request);
            //dd($oldFields);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
               ->with('oldFields',$oldFields);
        }

        $user = User::findOrFail($request->user_id);

        //get category id & subcategory id
        $aId=explode(',', $request->property_type);
        $categoryId = $aId[0];
        $subCategoryId = $aId[1];

        //generating the slug
        $slug = str_slug($request->title, '-');

        $property = new Property();

        $property->property_id = $property->generatePropertyId();

        $property->title =  ucwords(strtolower($request->title));
        $property->slug = $slug;

        $property->property_category_id = $categoryId;
        $property->property_subcategory_id = $subCategoryId;
        $property->property_status_id = $request->property_status;

        //saving array.and.Returns a string containing the JSON representation of the supplied value.
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
        $property->bedrooms = $request->bedrooms;
        $property->bathrooms = $request->bathrooms;
        $property->garages = $request->garages;
        $property->year_built = $request->year_built;
        $property->front_face = $request->front_face;
        $property->back_face = $request->back_face;
        //$property->isFeatured = $request->has('isFeatured');


        //dd($property);

        //save featured Image
        if ($request->hasFile('featured_image')) {
            $filenameToStore=ImageService::saveMultipleSizeImage($request->file('featured_image'));
            $property->featured_image=$filenameToStore;
        }

        /*try{
            $property->save();
        }catch (\Exception  $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }*/
        $property->save();

        //property Information
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

        $property->propertyFeatures()->attach($request->property_features);

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
        return redirect()->route('property.edit',$property->id);


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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return redirect()->route('property.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $property = Property::findOrFail($id);

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

        //property floors
        $propertyFloors = PropertyFloorPlan::where('property_id',$property->id)->latest()->get();


        //for more information tab
        $users = User::with([
            'roles'=>function($query){
                $query->where('id',3);
            },
        ])->whereHas('roles', function ($query) {
                $query->where('id',3);
            })->latest()->get();

        $propertyInfo = PropertyMoreInformation::where('property_id',$property->id)->first();

        //property documents
        //$propertyDocuments = PropertyDocument::where('property_id',$property->id)->latest()->get();
        $propertyDocument = PropertyDocument::where('property_id',$property->id)->first();

        $tabName='';

        $provinces = Province::get();

        $districts = District::get();

        $municipals = Municipal::get();

        $areaPostfix=['Sq Ft','Aana','Ropani','Dhur','Kattha','Bigha'];

        return view('admin.pages.property.property.edit',compact('property','featuresOfProperty',
            'additionalFeatures','propertyAddress','propertyDistricts','propertyMunicipals',
            'propertyCategories','propertyStatus','propertyFeatures','propertyImages',
            'propertyFloors','users','propertyInfo','propertyDocument','tabName',
            'provinces','districts','municipals','areaPostfix'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' =>'required|max:191|unique:properties,title,'.$id,
            'property_type'=>'required',
            'property_status'=>'required',
            'description'=>'required',
            'price' => 'required|integer',
            'area_size' => 'required|integer',
            'area_size_postfix' => 'required|max:191',
            'featured_image' =>'sometimes|nullable|image',

            'address'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',

            'gallery_images'=> 'sometimes|nullable',
            'gallery_images.*' => 'image',

        ]);

        if ($validator->fails()) {

            $oldFields = array_filter($request->additional_features);
            //dd($request);
            //dd($oldFields);
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

        $property = Property::findOrFail($id);

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

       // $property->status = $request->has('status');
        $property->description = $request->description;
        $property->price = $request->price;
        $property->	price_postfix = ucwords(strtolower($request->price_postfix));
        $property->area_size = $request->area_size;
        $property->area_size_postfix = ucwords(strtolower($request->area_size_postfix));
      /*  $property->lot_size = $request->lot_size;
        $property->lot_size_postfix = ucwords(strtolower($request->lot_size_postfix));*/
        $property->bedrooms = $request->bedrooms;
        $property->bathrooms = $request->bathrooms;
        $property->garages = $request->garages;
        $property->year_built = $request->year_built;
        $property->front_face = $request->front_face;
        $property->back_face = $request->back_face;
        //$property->isFeatured = $request->has('isFeatured');

        //dd($property);

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



        $property->save();
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

        $property->propertyFeatures()->sync($request->property_features);

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
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $property = Property::findOrFail($id);

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
        return redirect()->route('property.index');

    }
}
