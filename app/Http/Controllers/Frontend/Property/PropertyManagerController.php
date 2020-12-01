<?php

namespace App\Http\Controllers\Frontend\Property;

use App\ManagerRequest;
use App\Property;
use App\PropertyMoreInformation;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Illuminate\Support\Facades\Validator;

use Session;

class PropertyManagerController extends Controller
{

    private $createRequestType = 'create_manager';
    private $updateRequestType ='update_manager';
    private $removeRequestType ='delete_manager';
    //
    public function listManagers(){

         $userPropertiesWithOutManager = Property::whereHas('information', function ($query) {
             $query->where('user_id',Auth::id())->where('manager_id',null);
         })->verified()->latest()->get();

        $userPropertiesWithManager = Property::whereHas('information', function ($query) {
            $query->where('user_id',Auth::id())->where('manager_id','!=',null);
        })->latest()->paginate(10);


        $managers = User::with([
            'roles'=>function($query){
                $query->where('id',1);
            },
        ])->whereHas('roles', function ($query) {
            $query->where('id',1);
        })->latest()->get();


        return view('frontend.pages.property.managers.managers',compact('userPropertiesWithOutManager','managers',
            'userPropertiesWithManager'));
    }

    public function requestManager(Request $request){

        $validator = Validator::make($request->all(), [
            'property' =>'required',
            'manager' =>'required|email',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('tabName','manager_nav');
        }

        $property= Property::where('status',1)->where('id',$request->property)->whereHas('information', function ($query){
            $query->where('user_id',Auth::id());
        })->firstOrFail();

        $manager = User::where('email',$request->manager)->whereHas('roles', function ($query) {
            $query->where('id',1);
        })->first();

        if (!$manager){
            Session::flash('danger','Manager Not Found');
            return redirect()->back();
        }

        $propertyInfo = PropertyMoreInformation::where('property_id',$property->id)->firstOrFail();

        $propertyInfo->manager_id =$manager->id;

        $propertyInfo->isApprovedManager = 0;

        $propertyInfo->save();

        $user= Auth::user();


        $managerRequest = ManagerRequest::where('user_id',$user->id)->where('property_id',$property->id)->first();

        if(is_null($managerRequest)){
            $managerRequest = new ManagerRequest();
        }

        $managerRequest->property_id = $property->id;
        $managerRequest->user_id = $user->id;
        $managerRequest->manager_id = $manager->id;

        $managerRequest->request_type =$this->createRequestType;
        $managerRequest->isCompleted = 0;

        $managerRequest->save();

        $user->sendManagerRequestNotificationsToAdmin($user,$this->createRequestType,$property);

        Session::flash('success', $manager->name.' Has Been Requested As A Manager');
        return redirect()->back();
    }

    public function editManager(Request $request,$propertySlug){


        $property= Property::where('status',1)->where('slug',$propertySlug)->whereHas('information', function ($query) {
            $query->where('user_id',Auth::id());
        })->firstOrFail();

        $propertyInfo = PropertyMoreInformation::where('property_id',$property->id)->firstOrFail();


        $userPropertiesWithOutManager = Property::whereHas('information', function ($query) {
            $query->where('user_id',Auth::id())->where('manager_id',null);
        })->latest()->get();


        $manager = User::with([
            'roles'=>function($query){
                $query->where('id',1);
            },
        ])->whereHas('roles', function ($query) {
            $query->where('id',1);
        })->where('id',$propertyInfo->manager_id)->first();

        //dd($property);
        if ($request->ajax()) {
            //return $property;
            return view('frontend.pages.property.managers.edit',compact('property','manager',
                'propertyInfo','userPropertiesWithOutManager'))->render();
        }

        return view('frontend.pages.property.managers.edit',compact('property','manager',
            'propertyInfo','userPropertiesWithOutManager'));

    }

    public function updateManager(Request $request, $propertySlug){

        $validator = Validator::make($request->all(), [
            'property' =>'required',
            'manager' =>'required',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $property= Property::where('status',1)->where('slug',$propertySlug)->whereHas('information', function ($query) {
            $query->where('user_id',Auth::id());
        })->firstOrFail();

        $manager = User::where('email',$request->manager)->whereHas('roles', function ($query) {
            $query->where('id',1);
        })->first();

        if (!$manager){
            Session::flash('danger','Manager Not Found');
            return redirect()->back();
        }

        $propertyInfo = PropertyMoreInformation::where('property_id',$property->id)->firstOrFail();

        $alreadyManager = User::with([
            'roles'=>function($query){
                $query->where('id',1);
            },
        ])->whereHas('roles', function ($query) {
            $query->where('id',1);
        })->where('id',$propertyInfo->manager_id)->first();

        if($manager->email == $alreadyManager->email){

            Session::flash('danger',$manager->name.' Is Already A Manager');
            return redirect()->back();
        }

        $propertyInfo->manager_id =$manager->id;
        $propertyInfo->isApprovedManager =0;

        $propertyInfo->save();

        $user= Auth::user();

        $managerRequest = ManagerRequest::where('user_id',$user->id)->where('property_id',$property->id)->first();

            if(is_null($managerRequest)){
                $managerRequest = new ManagerRequest();
            }

            $managerRequest->property_id = $property->id;
            $managerRequest->user_id = $user->id;
            $managerRequest->manager_id = $manager->id;

            $managerRequest->request_type =$this->updateRequestType;
            $managerRequest->isCompleted = 0;

            $managerRequest->save();



        $user->sendManagerRequestNotificationsToAdmin($user,$this->updateRequestType,$property);


        Session::flash('success', $manager->name.' Has Been Requested To Be New Manager.');
        return redirect()->back()->with('tabName','manager_nav');


    }

    public function deleteManager($propertySlug){

        $property= Property::where('status',1)->where('slug',$propertySlug)->whereHas('information', function ($query) {
            $query->where('user_id',Auth::id());
        })->firstOrFail();

        $propertyInfo = PropertyMoreInformation::where('property_id',$property->id)->firstOrFail();

        $propertyInfo->isApprovedManager =0;

        $propertyInfo->save();

        $user= Auth::user();

        $managerRequest = ManagerRequest::where('user_id',$user->id)->where('property_id',$property->id)->first();

        if(is_null($managerRequest)){
            $managerRequest = new ManagerRequest();
        }

            $managerRequest->property_id = $property->id;
            $managerRequest->user_id = $user->id;
            $managerRequest->manager_id = $propertyInfo->manager_id;

            $managerRequest->request_type =$this->removeRequestType;
            $managerRequest->isCompleted =0;

            $managerRequest->save();

        $user->sendManagerRequestNotificationsToAdmin($user,$this->removeRequestType,$property);


        Session::flash('success', 'Manager Has Been Requested To Remove');
        return redirect()->back();
    }
}
