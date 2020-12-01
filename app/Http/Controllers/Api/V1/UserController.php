<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Api\V1\UserRepository;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Get user details
     *
     * @return UserResource
     */
    public function getUserDetails()
    {
        return $this->userRepo->getUserDetails();
    }

    /**
     * Requests for user to be a manager.
     *
     * @return response
     */
    public function sendRequest()
    {
        return $this->userRepo->sendRequest();
    }

    /**
     * Updates user details
     *
     * @return UserResource
     */
    public function updateUser()
    {
        return $this->userRepo->updateUser();
    }

    /**
     * Updates user details
     *
     * @return UserResource
     */
    public function updateSocialLinks()
    {
        return $this->userRepo->updateSocialLinks();
    }

    /**
     * Changes Password.
     *
     * @return response
     */
    public function changePassword()
    {
        return $this->userRepo->changePassword();
    }

    /**
     * Gets user properties
     *
     * @return response
     */
    public function getUserProperties()
    {
        return $this->userRepo->getUserProperties();
    }

    /**
     * Requests a manager
     *
     * @return response
     */
    public function requestManager()
    {
        return $this->userRepo->requestManager();
    }

    /**
     * Gets list of managers
     *
     * @return response
     */
    public function listManagersWithProperties()
    {
        return $this->userRepo->listManagersWithProperties();
    }

    /**
     * Updates manager for the property
     *
     * @return response
     */
    public function editManager()
    {
        return $this->userRepo->editManager();
    }

    /**
     * Deletes manager for the property
     *
     * @return response
     */
    public function deleteManager($property_id)
    {
        return $this->userRepo->deleteManager($property_id);
    }

    /**
     * Requests for users property verification
     *
     * @return UserResource
     */
    public function requestVerification($property_id)
    {
        return $this->userRepo->requestVerification($property_id);
    }

    /**
     * Requests for property featured verification
     *
     * @return UserResource
     */
    public function requestFeaturing($property_id)
    {
        return $this->userRepo->requestFeaturing($property_id);
    }

    /**
     * Gets list of properties without managers
     *
     * @return response
     */
    public function getPropertiesWithoutManager()
    {
        return $this->userRepo->getPropertiesWithoutManager();
    }

    /**
     * Gets my managed properties
     * 
     * @return MinimalPropertyCollection
     */
    public function managedProperties()
    {
        return $this->userRepo->managedProperties();
    }

    /**
     * Gets favourite properties.
     *
     * @return JsonResponse
     */
    public function getAllFavProperties()
    {
        return $this->userRepo->getAllFavProperties();
    }

    /**
     * Toogle favourite properties.
     *
     * @return JsonResponse
     */
    public function toggleFavourite($property_id)
    {
        return $this->userRepo->toggleFavourite($property_id);
    }

    /**
     * Get user notifications.
     *
     * @return JsonResponse
     */
    public function getNotifications()
    {
        return $this->userRepo->getNotifications();
    }

    public function updateUserContact(){
        return $this->userRepo->updateUserContact();
    }
}
