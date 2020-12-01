<?php

namespace App\Http\Controllers\Admin;

use App\CustomServices\UserNotificationService;
use App\ManagerRequest;
use App\Property;
use App\PropertyMoreInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Session;

class ManagerRequestController extends Controller
{
    //property manager
    public function getAllManagerRequest(){

        $managerRequests = ManagerRequest::with(['property','manager','user'])->latest()->get();

        return view('admin.pages.requests.managers.index',compact('managerRequests'));
    }

    public function getSingleRequest($id){

        $managerRequest = ManagerRequest::findOrFail($id);

        return view('admin.pages.requests.managers.single',compact('managerRequest'));
    }

    public function updateRequest(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'property_title' =>'required',
            'user_email'=>'required|email',
            'manager_email' => 'required|email',
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $managerRequest = ManagerRequest::findOrFail($id);

        $property = Property::find($managerRequest->property_id);

        $propertyInfo = PropertyMoreInformation::where('property_id',$property->id)->first();

        if (!$property && !$propertyInfo){
            Session::flash('danger', 'Property Not Found');
            return redirect()->route('admin.request.index');
        }

        if ( $request->has('isCompleted')){

            if ($managerRequest->request_type == 'delete_manager'){
                $propertyInfo->isApprovedManager=0;
                $propertyInfo->manager_id =null;
                $propertyInfo->save();

                $managerRequest->delete();

                Session::flash('success', 'Request Completed');
                return redirect()->route('admin.request.index');

            }
            else{
                $managerRequest->isCompleted= 1;
                $propertyInfo->isApprovedManager=1;
            }

            $this->sendNotificationToUser($property);

            $this->sendNotificationToManager($property);
        }
        else{
            $managerRequest->isCompleted= 0;
            $propertyInfo->isApprovedManager=0;
        }

        $managerRequest->save();
        $propertyInfo->save();

        Session::flash('success', 'Request Completed');
        return redirect()->route('admin.request.index');

    }

    public function sendNotificationToUser($property){

        $notificationMsg= 'Manager Request for the "'.$property->title.'" property has been completed.';

        $user=$property->information->user;

        $route=route('user.property.manager.index');

        $image= $property->featured_image;

        $androidMessage = [
            'message'           => $notificationMsg,
            'user_image'        => photoToUrl($property->featured_image,'/common/images/'),
            'notification_type' => 'UserManagerRequestApproved'
        ];

        UserNotificationService::sendNotificationToUser($notificationMsg,$route,$image,$user,$androidMessage);

        if ($user->device_token){

            androidPushNotification($user->device_token, $notificationMsg, $androidMessage);
        }


    }

    public function sendNotificationToManager($property){

        $notificationMsg= 'You have been assigned as a manager for the property "'.$property->title.'"';

        $user=$property->information->manager;

        $route=route('manager.property.index');

        $image= $property->featured_image;

        $androidMessage = [
            'message'           => $notificationMsg,
            'user_image'        => photoToUrl($property->featured_image,'/common/images/'),
            'notification_type' => 'ManagerRequestApproved'
        ];

        UserNotificationService::sendNotificationToUser($notificationMsg,$route,$image,$user,$androidMessage);


        if ($user->device_token){
            androidPushNotification($user->device_token, $notificationMsg, $androidMessage);
        }
    }
}
