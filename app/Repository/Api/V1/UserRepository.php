<?php

namespace App\Repository\Api\V1;

use Illuminate\Http\Request;
use App\Property;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\UserResource;
use App\CustomServices\ImageService;
use App\CustomServices\UserNotificationService;
use App\Http\Resources\Collection\ManagerCollection;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\MinimalPropertyResource;
use App\Http\Resources\Collection\MinimalPropertyCollection;
use App\Http\Resources\Collection\UserNotificationCollections;
use App\Http\Resources\ManagerResource;
use App\Http\Resources\UserNotificationResource;
use App\ManagerRequest;
use App\Notifications\ManagerRequestNotification;
use App\Notifications\PropertyVerificationRequestNotification;
use App\Notifications\RequestToBeManager;
use App\PropertyMoreInformation;
use App\User;
use Illuminate\Support\Facades\Notification;

class UserRepository
{
    private $createRequestType = 'create_manager';
    private $updateRequestType = 'update_manager';
    private $removeRequestType = 'delete_manager';

    private $unVerified = 'unverified';
    private $pending = 'pending';
    private $verified = 'Verified';

    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get user details
     *
     * @return UserResource
     */
    public function getUserDetails()
    {
        $user = auth()->user();
        return new UserResource($user);
    }

    /**
     * Update user details
     *
     * @return UserResource
     */
    public function updateUser()
    {
        $user                = auth()->user();
        if ($this->request->filled('title'))
            $user->title         = ucwords(strtolower($this->request->title));
        else
            return sendResponse('Title field is required.', true, 404);
        if ($this->request->filled('name'))
            $user->name          = ucwords(strtolower($this->request->name));
        else
            return sendResponse('Name field is required.', true, 404);
        if ($this->request->filled('phone'))
            $user->phone         = $this->request->phone;
        else
            return sendResponse('Phone field is required.', true, 404);

        if ($this->request->filled('address'))
            $user->address       = ucwords(strtolower($this->request->address));
        else
            return sendResponse('Address field is required.', true, 404);
        $user->province_id = $this->request->province_id;
        $user->district_id = $this->request->district_id;
        $user->municipality_id = $this->request->municipality_id;
        $user->personal_info = $this->request->personal_info;
        $user->mobile        = $this->request->mobile;

        if ($this->request->has('user_image') && $this->request->filled('user_image')) {
            //delete the old photo
            ImageService::deleteImage($user->user_image);
            $destination = 'common/images/';
            $filename    = base64_to_jpeg($this->request->user_image, $destination);
            $user->user_image = $filename;
        }

        $user->save();
        return new UserResource($user);
    }

    /**
     * Updates user social links
     *
     * @return UserResource
     */
    public function updateSocialLinks()
    {
        $user          = auth()->user();

        $url_facebook  = strpos($this->request->facebook, 'http') !== 0 ? "http://" . $this->request->facebook : $this->request->facebook;
        $url_twitter   = strpos($this->request->twitter, 'http') !== 0 ? "http://" . $this->request->twitter  : $this->request->twitter;
        $url_linkedin  = strpos($this->request->linkedin, 'http') !== 0 ? "http://" . $this->request->linkedin : $this->request->linkedin;
        $url_instagram = strpos($this->request->instagram, 'http') !== 0 ? "http://" . $this->request->instagram : $this->request->instagram;

        if (filter_var($url_facebook, FILTER_VALIDATE_URL)) {
            $user->facebook  = $this->request->facebook;
        } else {
            return sendResponse("Please enter a valid url for facebook.", true, 404);
        }
        if (filter_var($url_twitter, FILTER_VALIDATE_URL)) {
            $user->twitter   = $this->request->twitter;
        } else {
            return sendResponse("Please enter a valid url for twitter.", true, 404);
        }
        if (filter_var($url_linkedin, FILTER_VALIDATE_URL)) {
            $user->linkedin  = $this->request->linkedin;
        } else {
            return sendResponse("Please enter a valid url for linkedin.", true, 404);
        }
        if (filter_var($url_instagram, FILTER_VALIDATE_URL)) {
            $user->instagram  = $this->request->instagram;
        } else {
            return sendResponse("Please enter a valid url for instagram.", true, 404);
        }

        $user->save();

        return new UserResource($user);
    }

    /**
     * Changes Password.
     *
     * @return response
     */
    public function changePassword()
    {
        $user = auth()->user();
        if (Hash::check($this->request->old_password, $user->password)) {
            $user->password = bcrypt($this->request->new_password);
            $user->save();
            return sendResponse('Password has been changed successfully.');
        } else {
            return sendResponse("Your old password does not match", true, 403);
        }
    }

    /**
     * Requests for user to be a manager.
     *
     * @return response
     */
    public function sendRequest()
    {
        $user = auth()->user();

        if ($user->hasRole("Manager")) {
            return sendResponse('You already are a manager.', true, 200);
        }

        $user->manager_status = 'pending';
        $user->save();

        $superAdmins = User::role('Super Admin')->get();

        Notification::send($superAdmins, new RequestToBeManager($user));

        return sendResponse('Manager Request Has Been Sent.', false, 200);
    }

    /**
     * Gets user properties
     *
     * @return response
     */
    public function getUserProperties()
    {
        $user = auth()->user();
        $properties = Property::whereHas('information', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->latest()->get();
        return new MinimalPropertyCollection($properties);
    }


    /**
     * Requests a manager
     *
     * @return response
     */
    public function requestManager()
    {
        $user = auth()->user();

        $property = Property::where('id', $this->request->property_id)->whereHas('information', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->firstOrFail();

        if ($property->verify_status != "verified") {
            return sendResponse("Please verify your property first.", true, 200);
        }

        $manager = User::where('email', $this->request->manager_email)->whereHas('roles', function ($query) {
            $query->where('id', 1);
        })->first();

        if (!$manager) {
            return sendResponse("Please enter a valid manager email. There is no manager with this email.", true, 200);
        }

        $propertyInfo = PropertyMoreInformation::where('property_id', $property->id)->firstOrFail();

        $propertyInfo->manager_id = $manager->id;

        $propertyInfo->isApprovedManager = 0;

        $propertyInfo->save();

        $managerRequest = ManagerRequest::where('user_id', $user->id)->where('property_id', $property->id)->first();

        if (is_null($managerRequest)) {
            $managerRequest = new ManagerRequest();
        }

        $managerRequest->property_id = $property->id;
        $managerRequest->user_id     = $user->id;
        $managerRequest->manager_id  = $manager->id;

        $managerRequest->request_type = $this->createRequestType;
        $managerRequest->isCompleted = 0;

        $managerRequest->save();

        $user->sendManagerRequestNotificationsToAdmin($user, $this->createRequestType, $property);

        return sendResponse($manager->name . ' Has Been Requested As A Manager');
    }

    /**
     * Gets list of managers
     *
     * @return response
     */
    public function listManagersWithProperties()
    {

        $user = auth()->user();

        $userPropertiesWithManager = Property::with('information')->whereHas('information', function ($query) use ($user) {
            $query->where('user_id', $user->id)->where('manager_id', '!=', null);
        })->latest()->get();

        return new ManagerCollection($userPropertiesWithManager);
    }

    /**
     * Gets list of properties without managers
     *
     * @return response
     */
    public function getPropertiesWithoutManager()
    {

        $user = auth()->user();

        $userPropertiesWithOutManager = Property::with('information')->whereHas('information', function ($query) use ($user) {
            $query->where('user_id', $user->id)->where('manager_id', null);
        })->latest()->get();

        return new MinimalPropertyCollection($userPropertiesWithOutManager);
    }

    /**
     * Updates manager for the property
     *
     * @return response
     */
    public function editManager()
    {
        $user = auth()->user();

        $property = Property::where('id', $this->request->property_id)->whereHas('information', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->firstOrFail();

        if ($property->verify_status != "verified") {
            return sendResponse("Please verify your property first.", true, 200);
        }

        $manager = User::where('email', $this->request->manager_email)->whereHas('roles', function ($query) {
            $query->where('id', 1);
        })->first();

        if (!$manager) {
            return sendResponse("Please enter a valid manager email. There is no manager with this email.", true, 200);
        }

        $propertyInfo = PropertyMoreInformation::where('property_id', $property->id)->firstOrFail();

        $alreadyManager = User::with([
            'roles' => function ($query) {
                $query->where('id', 1);
            },
        ])->whereHas('roles', function ($query) {
            $query->where('id', 1);
        })->where('id', $propertyInfo->manager_id)->first();

        if ($manager->email == $alreadyManager->email) {
            return sendResponse($manager->name . ' Is Already A Manager', true, 200);
        }

        $propertyInfo->manager_id = $manager->id;
        $propertyInfo->isApprovedManager = 0;

        $propertyInfo->save();

        $managerRequest = ManagerRequest::where('user_id', $user->id)->where('property_id', $property->id)->first();

        if (is_null($managerRequest)) {
            $managerRequest = new ManagerRequest();
        }

        $managerRequest->property_id = $property->id;
        $managerRequest->user_id = $user->id;
        $managerRequest->manager_id = $manager->id;

        $managerRequest->request_type = $this->updateRequestType;
        $managerRequest->isCompleted = 0;

        $managerRequest->save();

        $user->sendManagerRequestNotificationsToAdmin($user, $this->updateRequestType, $property);

        return sendResponse($manager->name . ' Has Been Requested To Be New Manager.');
    }

    /**
     * Deletes manager for the property
     *
     * @return response
     */
    public function deleteManager($property_id)
    {

        $user = auth()->user();

        $property = Property::where('verify_status', "verified")->where('id', $property_id)->whereHas('information', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->firstOrFail();

        $propertyInfo = PropertyMoreInformation::where('property_id', $property->id)->firstOrFail();

        $propertyInfo->isApprovedManager = 0;

        $propertyInfo->save();

        $managerRequest = ManagerRequest::where('user_id', $user->id)->where('property_id', $property->id)->first();

        if (is_null($managerRequest)) {
            $managerRequest = new ManagerRequest();
        }

        $managerRequest->property_id = $property->id;
        $managerRequest->user_id     = $user->id;
        $managerRequest->manager_id  = $propertyInfo->manager_id;

        $managerRequest->request_type = $this->removeRequestType;
        $managerRequest->isCompleted = 0;

        $managerRequest->save();

        $user->sendManagerRequestNotificationsToAdmin($user, $this->removeRequestType, $property);

        return sendResponse('Manager Has Been Requested To Remove');
    }

    /**
     * Requests for users property verification
     *
     * @return UserResource
     */
    public function requestVerification($property_id)
    {

        $property = Property::find($property_id);

        if ($property->information->user_id != auth()->user()->id && $property->information->manager_id != auth()->user()->id) {
            return sendResponse("You are neither the manager nor the owner of this property", true, 200);
        }

        $property->verify_status = $this->pending;

        $property->save();

        $this->sendVerificationRequestNotificationsToaAdmin($property);

        return sendResponse('Verification Request Has Been Sent.');
    }

    /**
     * Requests for property featured verification
     *
     * @return UserResource
     */
    public function requestFeaturing($property_id)
    {
        $property = Property::find($property_id);

        if ($property->information->user_id != auth()->user()->id && $property->information->manager_id != auth()->user()->id) {
            return sendResponse("You are neither the manager nor the owner of this property", true, 200);
        }

        $property->feature_status = $this->pending;

        $property->save();

        $this->sendFeatureRequestNotificationsToaAdmin($property);

        return sendResponse('Featured Request Has Been Sent.');
    }

    /**
     * Gets my managed properties
     * 
     * @return MinimalPropertyCollection
     */
    public function managedProperties()
    {
        $manager = auth()->user();

        if (!$manager->hasrole('Manager')) {
            return sendResponse("You are not a manager.", true, 200);
        }

        $managedProperties = Property::whereHas('information', function ($query) use ($manager) {
            $query->where('manager_id', $manager->id)->where('isApprovedManager', 1);
        })->latest()->get();

        return new MinimalPropertyCollection($managedProperties);
    }

    /**
     * Gets favourite properties.
     *
     * @return JsonResponse
     */
    public function getAllFavProperties()
    {
        $user = auth()->user();

        $favProperties = $user->favProperties()->get();

        return new MinimalPropertyCollection($favProperties);
    }

    /**
     * Toogle favourite properties.
     *
     * @return JsonResponse
     */
    public function toggleFavourite($property_id)
    {
        $property = Property::findOrFail($property_id);

        $user = auth()->user();

        $notifyUser = User::find($property->information->user_id);

        $alreadyFav = $user->favProperties->contains($property_id);

        //check if property is already users fav
        if ($alreadyFav) {
            $user->favProperties()->detach($property_id);
            return sendResponse($property->title . " property removed from your favourite.", false, 200, ["is_liked" => false]);
        } else {
            $user->favProperties()->attach($property_id);

            $route        = route('fe.singleProperty', $property->slug);
            $image        = $user->user_image;
            $msg          = $user->name . ' has liked your property ' . $property->title . '.';
            $propertyUser = $property->information->user;

            $androidMessage = [
                'message'           => $user->name . ' has liked your property ' . $property->title . '.',
                'user_id'           => $user->id,
                'user_image'        => $user->user_image,
                'property_id'       => $property->id,
                'property_slug'     => $property->slug,
                'notification_type' => 'LikeProperty'
            ];

            UserNotificationService::sendNotificationToUser($msg, $route, $image, $propertyUser, $androidMessage);

            if ($notifyUser->device_token)
                androidPushNotification($notifyUser->device_token, $user->name . ' has liked your product ' . $property->title . '.', $androidMessage);
            return sendResponse($property->title . " property added to your favourite.", false, 200, ["is_liked" => true]);
        }
    }

    /**
     * Get user notifications.
     *
     * @return JsonResponse
     */
    public function getNotifications()
    {
        $user = auth()->user();
        $user->unreadNotifications()->where("type", '=', "App\Notifications\UserNotification")->get()->markAsRead();
        $notifications = $user->notifications;
        return new UserNotificationCollections($notifications);
    }

    public function sendVerificationRequestNotificationsToaAdmin($property)
    {

        $superAdmins = User::role('Super Admin')->get();

        $route = route('admin.request.verification');

        $msg = 'Verification request for the property ' . '"' . $property->title . '"';

        Notification::send($superAdmins, new PropertyVerificationRequestNotification($property, $route, $msg));
    }

    public function sendFeatureRequestNotificationsToaAdmin($property)
    {

        $superAdmins = User::role('Super Admin')->get();

        $route = route('admin.request.featured');

        $msg = 'Feature request for the property ' . '"' . $property->title . '"';

        Notification::send($superAdmins, new PropertyVerificationRequestNotification($property, $route, $msg));
    }


    /**
     * Update user contact details only
     *
     * @return UserResource
     */
    public function updateUserContact()
    {
        $user                = auth()->user();

        if ($this->request->filled('phone'))
            $user->phone         = $this->request->phone;
        else
            return sendResponse('Phone field is required.', true, 404);

        $user->save();
        return new UserResource($user);
    }
}
