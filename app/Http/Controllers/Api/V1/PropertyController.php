<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Api\V1\PropertyRepository;
use App\Http\Resources\PropertyResource;

class PropertyController extends Controller
{
    /**
     * @var PropertyRepository
     */
    private $propertyRepo;

    public function __construct(PropertyRepository $propertyRepo)
    {
        $this->propertyRepo = $propertyRepo;
    }

    /**
     * Gets dashboard properties
     *
     * @return JsonResponse
     */
    public function getDashboardProperties()
    {
        return $this->propertyRepo->getDashboardProperties();
    }

    /**
     * Gets property details
     *
     * @return JsonResponse
     */
    public function getPropertyDetail($id)
    {
        return $this->propertyRepo->getPropertyDetail($id);
    }

    /**
     * Gets all properties
     *
     * @return MinimalPropertyCollection
     */
    public function getAllProperties()
    {
        return $this->propertyRepo->getAllProperties();
    }

    /**
     * Filters Property
     *
     * @return PropertyResource
     */
    public function filterProperty()
    {
        return $this->propertyRepo->filterProperty();
    }

    /**
     * Post property
     *
     * @return PropertyResource
     */
    public function postProperty()
    {
        return $this->propertyRepo->postProperty();
    }

    /**
     * Gets property review by user
     *
     * @return PropertyReviewResource/JsonResponse
     */
    public function getUserRating($property_id)
    {
        return $this->propertyRepo->getUserRating($property_id);
    }

    /**
     * Reviews property
     *
     * @return PropertyReviewResource
     */
    public function rateProperty()
    {
        return $this->propertyRepo->rateProperty();
    }

    /**
     * Deletes property gallery image
     *
     * @return JsonResponse
     */
    public function deleteGalleryImage($image_id)
    {
        return $this->propertyRepo->deleteGalleryImage($image_id);
    }

    /**
     * Gets property dependent details 
     *
     * @return JsonResponse
     */
    public function getPropertyDetails()
    {
        return $this->propertyRepo->getPropertyDetails();
    }

    /**
     * Updates property more information.
     *
     * @return PropertyInfoResource/JsonResponse
     */
    public function updatePropertyInformation()
    {
        return $this->propertyRepo->updatePropertyInformation();
    }

    /**
     * Gets floor from property
     *
     * @return PropertyFloorResource
     */
    public function getFloor($property_id, $floor_id)
    {
        return $this->propertyRepo->getFloor($property_id, $floor_id);
    }

    /**
     * Adds new floor to property
     *
     * @return PropertyFloorResource
     */
    public function addNewFloor()
    {
        return $this->propertyRepo->addNewFloor();
    }

    /**
     * Deletes floor from property
     *
     * @return JsonResponse
     */
    public function deleteFloor($property_id, $floor_id)
    {
        return $this->propertyRepo->deleteFloor($property_id, $floor_id);
    }

    /**
     * Updates existing floor to property
     *
     * @return PropertyFloorResource
     */
    public function updateFloor()
    {
        return $this->propertyRepo->updateFloor();
    }

    /**
     * Requests for property details.
     *
     * @return JsonResponse
     */
    public function requestPropertyDetails()
    {
        return $this->propertyRepo->requestPropertyDetails();
    }

    /**
     * Gets property requests.
     *
     * @return JsonResponse
     */
    public function getPropertyRequests($property_id)
    {
        return $this->propertyRepo->getPropertyRequests($property_id);
    }

    /**
     * Gets property documents.
     *
     * @return JsonResponse
     */
    public function uploadPropertyDocuments()
    {
        return $this->propertyRepo->uploadPropertyDocuments();
    }

    /**
     * Gets property documents
     *
     * @return JSONRESPONSE
     */
    public function getPropertyDocuments($property_id)
    {
        return $this->propertyRepo->getPropertyDocuments($property_id);
    }
}
