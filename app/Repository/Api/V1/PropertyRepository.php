<?php

namespace App\Repository\Api\V1;

use App\CustomServices\ImageService;
use App\CustomServices\UserNotificationService;
use App\CustomServices\VerificationRequestService;
use App\Http\Resources\Collection\MinimalPropertyCollection;
use App\Http\Resources\Collection\PropertyRequestCollection;
use App\Http\Resources\MinimalPropertyResource;
use App\Http\Resources\PropertyDocumentResource;
use App\Http\Resources\PropertyFeatureResource;
use App\Http\Resources\PropertyFloorResource;
use App\Http\Resources\PropertyInfoResource;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\PropertyReviewResource;
use App\Http\Resources\PropertyStatusResource;
use App\Http\Resources\PropertyTypeResource;
use App\Property;
use App\PropertyAddress;
use App\PropertyCategory;
use App\PropertyDocument;
use App\PropertyFeature;
use App\PropertyFloorPlan;
use App\PropertyGallery;
use App\PropertyMoreInformation;
use App\PropertyRequest;
use App\PropertyReview;
use App\PropertyStatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertyRepository
{
	/**
	 * @var Request
	 */
	private $request;
	private $pending = 'pending';

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Gets all properties
	 *
	 * @return MinimalPropertyCollection
	 */
	public function getAllProperties()
	{
		if ($this->request->bearerToken() != null) {
			$user = User::where('api_token', $this->request->bearerToken())->first();
			if (!$user) {
				return sendResponse("User unauthenticated.", true, 200);
			}
		}
		$property = Property::where('verify_status', 'verified')->get();
		return new MinimalPropertyCollection($property);
	}

	/**
	 * Gets dashboard properties
	 *
	 * @return JsonResponse
	 */
	public function getDashboardProperties()
	{
		$featuredProperties = $this->getFeaturedProperties();
		$newProperties = $this->getNewProperties();
		$trendingProperties = $this->getTrendingProperties();

		return response()->json([
			'data' => [
				[
					"title" => "Featured Properties",
					"properties" => $featuredProperties,
				],
				[
					"title" => "New Properties",
					"properties" => $newProperties,
				],
				[
					"title" => "Trending Properties",
					"properties" => $trendingProperties,
				],
			],
			"error" => false,
			"code" => 200,
		]);
	}

	/**
	 * Gets property details
	 *
	 * @return JsonResponse
	 */
	public function getPropertyDetail($id)
	{
		if ($this->request->bearerToken() != null) {
			$user = User::where('api_token', $this->request->bearerToken())->first();
			if (!$user) {
				return sendResponse("User unauthenticated.", true, 200);
			}
		}
		//$id can be id or slug.
		$property = Property::find($id);
		if ($property == null) {
			$property = Property::where('slug', $id)->first();
			$relatedProperties = Property::where('verify_status', 'verified')
				->where('property_subcategory_id', $property->property_subcategory_id)
				->where('slug', '!=', $id)
				->get()
				->take(8);
		} else {
			$relatedProperties = Property::where('verify_status', 'verified')
				->where('property_subcategory_id', $property->property_subcategory_id)
				->where('id', '!=', $id)
				->get()
				->take(8);
		}

		$property->view_count += 1;
		$property->save();
		return response()->json([
			"data" => [
				"property" => new PropertyResource($property),
				"related_properties" => MinimalPropertyResource::collection($relatedProperties),
				"reviews" => PropertyReviewResource::collection($property->reviews),
			],
			"error" => false,
			"code" => 200,
		]);
	}

	/**
	 * Post property
	 *
	 * @return PropertyResource
	 */
	public function postProperty()
	{
		if ($this->request->isMethod('put') || $this->request->isMethod('patch')) {
			$validator = Validator::make($this->request->all(), [
				'title' => 'required|max:191',
				'category_id' => 'required',
				'sub_category_id' => 'required',
				'property_status_id' => 'required',
				// 'description'        => 'required',
				'price' => 'required|integer',
				// 'price_postfix'      => 'required|max:191',
				'area_size' => 'required|between:0,1471810.99',
				'area_size_postfix' => 'required|max:191',
				// 'lot_size'           => 'required|between:0,1471810.99',
				// 'lot_size_postfix'   => 'required|max:191',
				// 'featured_image'     => 'required',

				'address' => 'required',
				'latitude' => 'required',
				'longitude' => 'required',
				'province_id' => "required",
				'district_id' => "required",
				'municipality_id' => "required",

				// 'gallery_images'     => 'sometimes|nullable',
				// 'gallery_images.*'   => 'image',

			]);
		} else {
			$validator = Validator::make($this->request->all(), [
				'title'              => 'required|max:191|unique:properties,title',
				'category_id'        => 'required',
				'sub_category_id'    => 'required',
				'property_status_id' => 'required',
				'price'              => 'required|integer',
				'area_size'          => 'required|between:0,1471810.99',
				'area_size_postfix'  => 'required|max:191',

				'featured_image'     => 'required',

				/*'owner_name'         => 'required|max:191',
				'owner_address'      => 'required',
				'owner_contact'      => 'required',
				'ref_owner_name_1'   => 'required|max:191',
				'ref_owner_phone_1'  => 'required',*/

				'address'            => 'required',
				'latitude'           => 'required',
				'longitude'          => 'required',
				'province_id'        => "required",
				'district_id'        => "required",
				'municipality_id'    => "required",

				// 'gallery_images'     => 'sometimes|nullable',
				// 'gallery_images.*'   => '',

			]);
		}

		if ($validator->fails()) {
			return response()->json(["error" => true, "code" => 404, "errors" => $validator->errors(), "message" => $validator->errors()->first()]);
		}

		//generating the slug
		$slug = str_slug($this->request->title, '-');

		$property = new Property;

		if ($this->request->isMethod('put') || $this->request->isMethod('patch')) {
			$property = Property::findOrFail($this->request->property_id);
			if (auth()->user()->id != $property->information->user_id && auth()->user()->id != $property->information->manager_id) {
				return sendResponse("You are neither the manager nor the owner of this property", true, 404);
			}
		} else {
			$property->property_id = $property->generatePropertyId();
		}

		$property->title = ucwords(strtolower($this->request->title));
		$property->slug = $slug;
		$property->property_category_id = $this->request->category_id;
		$property->property_subcategory_id = $this->request->sub_category_id;
		$property->property_status_id = $this->request->property_status_id;

		//saving array with index of only not null..Returns a string containing the JSON representation of the supplied value.
		$additionalFeatures = array_filter($this->request->additional_features);

		if (!empty($additionalFeatures)) {
			$property->additional_features = json_encode($additionalFeatures);
		} else {
			$property->additional_features = null;
		}

		$property->status = $this->request->has('status');
		$property->description = $this->request->description;
		$property->price = $this->request->price;
		$property->price_postfix = ucwords(strtolower($this->request->price_postfix));
		$property->area_size = $this->request->area_size;
		$property->area_size_postfix = ucwords(strtolower($this->request->area_size_postfix));
		// $property->lot_size          = $this->request->lot_size;
		// $property->lot_size_postfix  = ucwords(strtolower($this->request->lot_size_postfix));
		$property->bedrooms = $this->request->bedrooms;
		$property->bathrooms = $this->request->bathrooms;
		$property->garages = $this->request->garages;
		$property->year_built = $this->request->year_built;
		$property->front_face = $this->request->front_face;
		$property->back_face = $this->request->back_face;
		// $property->isFeatured        = $this->request->has('isFeatured');

		//save featured Image
		if ($this->request->has('featured_image') && $this->request->filled('featured_image')) {
			if ($this->request->isMethod('put') || $this->request->isMethod('patch')) {
				//delete the old photo
				ImageService::deleteImage($property->featured_image);
			}
			$destination = 'common/images/';
			$destination_small = 'common/images/small/';
			$destination_medium = 'common/images/medium/';
			$filename = base64_to_jpeg($this->request->featured_image, $destination);
			$source = base64_decode($this->request->featured_image);
			file_put_contents($destination_small . $filename, $source);
			file_put_contents($destination_medium . $filename, $source);
			$property->featured_image = $filename;
		}

		if ($this->request->isMethod('put') || $this->request->isMethod('patch')) {
			//$property->verify_status = $this->pending;
			//VerificationRequestService::sendVerificationRequestNotificationsToaAdmin($property);
		}

		//temporary
		$property->verify_status = 'verified';

		$property->save();

		$address = $this->request->address;
		$latitude = $this->request->latitude;
		$longitude = $this->request->longitude;

		//saving address
		if (!empty($address) && !empty($latitude) && !empty($longitude)) {
			if ($this->request->isMethod('put') || $this->request->isMethod('patch')) {
				$propertyAddress = $property->address;
			} else {
				$propertyAddress = new PropertyAddress;
			}

			$propertyAddress->property_id = $property->id;
			$propertyAddress->address = $address;
			$propertyAddress->latitude = $latitude;
			$propertyAddress->longitude = $longitude;

			$propertyAddress->province_id = $this->request->province_id;
			$propertyAddress->district_id = $this->request->district_id;
			$propertyAddress->municipality_id = $this->request->municipality_id;

			$propertyAddress->save();
		}
		if ($this->request->isMethod('put') || $this->request->isMethod('patch')) {
			$property->propertyFeatures()->sync($this->request->property_features);
		} else {
			$property->propertyFeatures()->attach($this->request->property_features);
		}

		//saving gallery images
		if ($this->request->has('gallery_images') && !empty($this->request->gallery_images)) {
			foreach ($this->request->gallery_images as $gallery_image) {
				$gallery = new PropertyGallery;
				// $gallery->property_id = $property->id;
				$destination = 'common/images/';
				$filename = base64_to_jpeg($gallery_image, $destination);
				$gallery->image = $filename;
				$property->images()->save($gallery);
			}
		}
		// return $property->getPropertyImages();

		//storing property Information
		if ($this->request->isMethod('put') || $this->request->isMethod('patch')) {
			$propertyInfo = $property->information;
		} else {
			$propertyInfo = new PropertyMoreInformation;
		}

		$user = auth()->user();

		if ($this->request->isMethod('post')) {

			$propertyInfo->user_id           = $user->id;
			$propertyInfo->property_id       = $property->id;
			$propertyInfo->owner_name        = $this->request->owner_name;
			$propertyInfo->owner_address     = $this->request->owner_address;
			$propertyInfo->owner_contact     = $this->request->owner_contact;

			$propertyInfo->ref_owner_name_1  = $this->request->ref_owner_name_1;
			$propertyInfo->ref_owner_phone_1 = $this->request->ref_owner_phone_1;
			$propertyInfo->ref_owner_name_2  = $this->request->ref_owner_name_2;
			$propertyInfo->ref_owner_phone_2 = $this->request->ref_owner_phone_2;

			$propertyInfo->yt_url            = $this->request->yt_url;
			$propertyInfo->yt_title          = $this->request->yt_title;
			$propertyInfo->private_note      = $this->request->private_note;
			$propertyInfo->message           = $this->request->message;

			$propertyInfo->save();
		}

		return new PropertyResource($property);
	}

	/**
	 * Filters Property
	 *
	 * @return MinimalPropertyCollection
	 */
	public function filterProperty()
	{
		$property = Property::query();

		$property->where('verify_status', 'verified');

		if ($this->request->filled('status')) {
			$property->where('property_status_id', $this->request->status);
		}

		if ($this->request->filled('type')) {
			$property->where('property_subcategory_id', $this->request->type);
		}

		if ($this->request->filled('bedrooms')) {
			$property->where('bedrooms', $this->request->bedrooms);
		}

		if ($this->request->filled('bathrooms')) {
			$property->where('bathrooms', $this->request->bathrooms);
		}

		if ($this->request->filled('min_price')) {
			$property->where('price', '>=', $this->request->min_price);
		}

		if ($this->request->filled('max_price')) {
			$property->where('price', '<=', $this->request->max_price);
		}

		if ($this->request->filled('min_area')) {
			$property->where('area_size', '>=', $this->request->min_area);
		}

		if ($this->request->filled('max_area')) {
			$property->where('area_size', '<=', $this->request->max_area);
		}

		if ($this->request->filled('address')) {
			$municipality_id = $this->request->address;
			$property->whereHas('address', function ($property) use ($municipality_id) {
				$property->where('municipality_id', $municipality_id);
			});
		}

		if (!empty($this->request->additional_features)) {
			$additional_features = $this->request->additional_features;
			foreach ($additional_features as $feature) {
				$property->whereHas('propertyFeatures', function ($property) use ($feature) {
					$property->where('feature_id', $feature);
				});
			}
		}


		if ($this->request->filled('search_key')) {
			$search_query = $this->request->search_key;
			$property->where(function ($query) use ($search_query) {
				$query->orWhere(function ($query) use ($search_query) {
					$query->where('title', 'LIKE', '%' . $search_query . '%');
				})->orWhere(function ($query) use ($search_query) {
					$query->where('description', 'LIKE', '%' . $search_query . '%');
				})->orWhereHas('address', function ($query) use ($search_query) {
					$query->where('address', 'LIKE', '%' . $search_query . '%')
						->with('municipal')->with('district')->with('province')
						->orWhereHas('municipal', function ($query) use ($search_query) {
							$query->where('municipal_name', 'LIKE', '%' . $search_query . '%');
						})->orWhereHas('district', function ($query) use ($search_query) {
							$query->where('district_name', 'LIKE', '%' . $search_query . '%');
						})->orWhereHas('province', function ($query) use ($search_query) {
							$query->where('province_name', 'LIKE', '%' . $search_query . '%');
						});
				});
			});
		}


		$property = $property->get();
		$properties = $property->sortBy('title')
			->sortBy('address.province.province_name')
			->sortBy('address.district.district_name')
			->sortBy('address.municipal.municipal_name')
			->sortBy('address.address')
			->sortBy('description');
		return new MinimalPropertyCollection($properties);
	}

	/**
	 * Gets property review by user
	 *
	 * @return PropertyReviewResource/JsonResponse
	 */
	public function getUserRating($property_id)
	{
		$user = auth()->user();
		$userReview = PropertyReview::where(["property_id" => $property_id, "user_id" => $user->id])->first();

		if ($userReview) {
			return new PropertyReviewResource($userReview);
		}

		return sendResponse("No reivew submitted.", true, 404);
	}

	/**
	 * Reviews property
	 *
	 * @return PropertyReviewResource
	 */
	public function rateProperty()
	{
		$user = auth()->user();
		$property = Property::findOrFail($this->request->property_id);
		$notifyUser = User::find($property->information->user_id);
		$userReview = PropertyReview::where(["property_id" => $property->id, "user_id" => $user->id])->first();

		if ($userReview) {
			// Update existing reivew
			$userReview->client_message = $this->request->comment;
			$userReview->client_rating = $this->request->rating;
			$userReview->save();

			$route = route('fe.singleProperty', $property->slug);
			$image = $user->user_image;
			$msg = $user->name . ' has edited rating for your property ' . $property->title . '.';

			$androidMessage = [
				'message' => $user->name . ' has edited rating for your property ' . $property->title . '.',
				'user_id' => $user->id,
				'user_image' => $user->user_image,
				'property_id' => $property->id,
				'property_slug' => $property->slug,
				'notification_type' => 'PropertyReview',
			];

			UserNotificationService::sendNotificationToUser($msg, $route, $image, $notifyUser, $androidMessage);

			if ($notifyUser->device_token)
				androidPushNotification($notifyUser->device_token, $user->name . ' has edited rating for your property ' . $property->title . '.', $androidMessage);

			return new PropertyReviewResource($userReview);
		}

		// Post new review.
		$review = new PropertyReview;

		$review->property_id = $property->id;
		$review->user_id = $user->id;
		$review->client_message = $this->request->comment;
		$review->client_rating = $this->request->rating;
		$review->status = 0;

		$review->save();

		$route = route('fe.singleProperty', $property->slug);
		$image = $user->user_image;
		$msg = $user->name . ' has rated your property ' . $property->title . '.';

		$androidMessage = [
			'message' => $user->name . ' has rated your property ' . $property->title . '.',
			'user_id' => $user->id,
			'property_image' => $property->featured_image,
			'property_id' => $property->id,
			'property_slug' => $property->slug,
			'notification_type' => 'PropertyReview',
		];

		UserNotificationService::sendNotificationToUser($msg, $route, $image, $notifyUser, $androidMessage);

		if ($notifyUser->device_token)
			androidPushNotification($notifyUser->device_token, $user->name . ' has rated your property ' . $property->title . '.', $androidMessage);

		return new PropertyReviewResource($review);
	}

	/**
	 * Deletes property gallery image
	 *
	 * @return JsonResponse
	 */
	public function deleteGalleryImage($image_id)
	{
		$image = PropertyGallery::findOrFail($image_id);
		$image->delete();
		return sendResponse("Image has been deleted.");
	}

	/**
	 * Gets property dependent details
	 *
	 * @return JsonResponse
	 */
	public function getPropertyDetails()
	{
		return response()->json([
			"data" => [
				"property_features" => PropertyFeatureResource::collection(PropertyFeature::all()),
				"property_status" => PropertyStatusResource::collection(PropertyStatus::all()),
				"property_types" => PropertyTypeResource::collection(PropertyCategory::with('propertySubCategories')->get()),
			],
			"error" => false,
			"code" => 200,
		]);
	}

	/**
	 * Updates property more information.
	 *
	 * @return PropertyInfoResource/JsonResponse
	 */
	public function updatePropertyInformation()
	{
		$property = Property::find($this->request->property_id);
		if (auth()->user()->id == $property->information->user_id || auth()->user()->id == $property->information->manager_id) {
			$propertyInfo = $property->information;
			$propertyInfo->owner_name = $this->request->owner_name;
			$propertyInfo->owner_address = $this->request->owner_address;
			$propertyInfo->owner_contact = $this->request->owner_contact;
			$propertyInfo->ref_owner_name_1  = $this->request->ref_owner_name_1;
			$propertyInfo->ref_owner_phone_1 = $this->request->ref_owner_phone_1;
			$propertyInfo->ref_owner_name_2  = $this->request->ref_owner_name_2;
			$propertyInfo->ref_owner_phone_2 = $this->request->ref_owner_phone_2;
			$propertyInfo->yt_url = $this->request->yt_url;
			$propertyInfo->yt_title = $this->request->yt_title;
			$propertyInfo->private_note = $this->request->private_note;
			$propertyInfo->message = $this->request->message;
			$propertyInfo->save();

			$property->verify_status = $this->pending;
			$property->save();
			VerificationRequestService::sendVerificationRequestNotificationsToaAdmin($property);

			return new PropertyInfoResource($propertyInfo);
		} else {
			return sendResponse("You are neither the manager nor the owner of this property", true, 404);
		}
	}

	/**
	 * Gets floor from property
	 *
	 * @return PropertyFloorResource
	 */
	public function getFloor($property_id, $floor_id)
	{
		$property = Property::find($property_id);
		$floor = $property->floors()->where('id', $floor_id)->first();
		if ($floor) {
			return new PropertyFloorResource($floor);
		} else {
			return sendResponse("Floor not found.", true, 404);
		}
	}

	/**
	 * Adds new floor to property
	 *
	 * @return PropertyFloorResource
	 */
	public function addNewFloor()
	{
		$property = Property::find($this->request->property_id);
		if ($property->information->user_id != auth()->user()->id && $property->information->manager_id != auth()->user()->id) {
			return sendResponse("You are neither the manager nor the owner of this property", true, 200);
		}
		$floor = new PropertyFloorPlan;

		$floor->floor_title = $this->request->floor_title;
		$floor->floor_description = $this->request->floor_description;
		$floor->floor_price = $this->request->floor_price;
		$floor->floor_price_postfix = $this->request->floor_price_postfix;
		$floor->floor_area_size = $this->request->floor_area_size;
		$floor->floor_area_size_postfix = $this->request->floor_area_size_postfix;
		$floor->floor_bedrooms = $this->request->floor_bedrooms;
		$floor->floor_bathrooms = $this->request->floor_bathrooms;

		if ($this->request->has('floor_image')) {
			$destination = 'common/images/';
			$filename = base64_to_jpeg($this->request->floor_image, $destination);
			$floor->floor_image = $filename;
		}

		$property->floors()->save($floor);

		return new PropertyFloorResource($floor);
	}

	/**
	 * Updates existing floor to property
	 *
	 * @return PropertyFloorResource
	 */
	public function updateFloor()
	{
		$property = Property::find($this->request->property_id);
		if ($property->information->user_id != auth()->user()->id && $property->information->manager_id != auth()->user()->id) {
			return sendResponse("You are neither the manager nor the owner of this property", true, 200);
		}
		$floor = PropertyFloorPlan::findOrFail($this->request->floor_id);

		if (!$floor) {
			return sendResponse("Floor plan not found.", true, 404);
		}

		$floor->floor_title = $this->request->floor_title;
		$floor->floor_description = $this->request->floor_description;
		$floor->floor_price = $this->request->floor_price;
		$floor->floor_price_postfix = $this->request->floor_price_postfix;
		$floor->floor_area_size = $this->request->floor_area_size;
		$floor->floor_area_size_postfix = $this->request->floor_area_size_postfix;
		$floor->floor_bedrooms = $this->request->floor_bedrooms;
		$floor->floor_bathrooms = $this->request->floor_bathrooms;

		if ($this->request->has('floor_image')) {
			//delete the old photo
			if ($floor->floor_image) {
				ImageService::deleteImage($floor->floor_image);
			}

			$destination = 'common/images/';
			$filename = base64_to_jpeg($this->request->floor_image, $destination);
			$floor->floor_image = $filename;
		}

		$property->floors()->save($floor);

		$property->verify_status = $this->pending;
		$property->save();
		VerificationRequestService::sendVerificationRequestNotificationsToaAdmin($property);

		return new PropertyFloorResource($floor);
	}

	/**
	 * Deletes floor from property
	 *
	 * @return JsonResponse
	 */
	public function deleteFloor($property_id, $floor_id)
	{
		$property = Property::find($property_id);
		if ($property->floors()->where('id', $floor_id)->delete()) {
			return sendResponse("Your floor has been deleted.", false, 200);
		}
		return sendResponse("Something went wrong. Please try again.", true, 404);
	}

	/**
	 * Requests for property details.
	 *
	 * @return JsonResponse
	 */
	public function requestPropertyDetails()
	{
		$property_request = new PropertyRequest;
		$property_request->property_id = $this->request->property_id;
		$property_request->name = $this->request->full_name;
		$property_request->email = $this->request->email;
		$property_request->phone = $this->request->phone;
		$property_request->address = $this->request->address;
		$property_request->message = $this->request->message;
		$property_request->save();
		return sendResponse("We have recived your request and will mail the details about the property to you. Thank you. Keep in touch.");
	}

	/**
	 * Gets property requests.
	 *
	 * @return JsonResponse
	 */
	public function getPropertyRequests($property_id)
	{
		$property_requests = PropertyRequest::where('property_id', $property_id)->get();
		return new PropertyRequestCollection($property_requests);
	}

	/**
	 * Gets property documents.
	 *
	 * @return JsonResponse
	 */
	public function uploadPropertyDocuments()
	{
		$property = Property::findOrFail($this->request->property_id);

		//continue if only property exists
		$propertyDocument = PropertyDocument::where('property_id', $property->id)->first();

		if (is_null($propertyDocument)) {

			$propertyDocument = new PropertyDocument();
		}

		//saving property document files
		$propertyDocument->property_id = $property->id;

		//saving property document files
		if ($this->request->has('lal_purja')) {

			//delete the old photo
			if ($propertyDocument->lal_purja) {
				ImageService::deleteImage($propertyDocument->lal_purja);
			}

			$destination = 'common/images/';
			$filename = base64_to_jpeg($this->request->lal_purja, $destination);
			$propertyDocument->lal_purja = $filename;
		}

		if ($this->request->has('ghar_naksa')) {

			//delete the old photo
			if ($propertyDocument->ghar_naksa) {
				ImageService::deleteImage($propertyDocument->ghar_naksa);
			}

			$destination = 'common/images/';
			$filename = base64_to_jpeg($this->request->ghar_naksa, $destination);
			$propertyDocument->ghar_naksa = $filename;
		}

		if ($this->request->has('trace_naksa')) {

			//delete the old photo
			if ($propertyDocument->trace_naksa) {
				ImageService::deleteImage($propertyDocument->trace_naksa);
			}

			$destination = 'common/images/';
			$filename = base64_to_jpeg($this->request->trace_naksa, $destination);
			$propertyDocument->trace_naksa = $filename;
		}

		if ($this->request->has('blueprint')) {

			//delete the old photo
			if ($propertyDocument->blueprint) {
				ImageService::deleteImage($propertyDocument->blueprint);
			}

			$destination = 'common/images/';
			$filename = base64_to_jpeg($this->request->blueprint, $destination);
			$propertyDocument->blueprint = $filename;
		}

		if ($this->request->has('charkilla')) {

			//delete the old photo
			if ($propertyDocument->charkilla) {
				ImageService::deleteImage($propertyDocument->charkilla);
			}

			$destination = 'common/images/';
			$filename = base64_to_jpeg($this->request->charkilla, $destination);
			$propertyDocument->charkilla = $filename;
		}
		if ($this->request->has('tax_receipt')) {

			//delete the old photo
			if ($propertyDocument->tax_receipt) {
				ImageService::deleteImage($propertyDocument->tax_receipt);
			}

			$destination = 'common/images/';
			$filename = base64_to_jpeg($this->request->tax_receipt, $destination);
			$propertyDocument->tax_receipt = $filename;
		}

		$propertyDocument->save();

		$property->verify_status = $this->pending;

		$property->save();

		VerificationRequestService::sendVerificationRequestNotificationsToaAdmin($property);

		return sendResponse('Property Documents Has Been Updated!');
	}

	/**
	 * Gets property documents
	 *
	 * @return PropertyDocumentResource
	 */
	public function getPropertyDocuments($property_id)
	{
		$property = Property::find($property_id);
		if ($property->document) {
			return new PropertyDocumentResource($property->document);
		} else {
			return sendResponse("No document found", true, 200);
		}
	}

	/**
	 * Gets featured properties
	 *
	 * @return MinimalPropertyResource
	 */
	public function getFeaturedProperties()
	{
		$featuredProperties = Property::where('verify_status', 'verified')->where('feature_status', 'featured')->latest()->get()->take(8);
		return MinimalPropertyResource::collection($featuredProperties);
	}

	/**
	 * Gets new properties
	 *
	 * @return MinimalPropertyResource
	 */
	public function getNewProperties()
	{
		$newProperties = Property::where('verify_status', 'verified')->where('feature_status', 'unfeatured')->latest()->get()->take(8);
		return MinimalPropertyResource::collection($newProperties);
	}

	/**
	 * Gets trending properties
	 *
	 * @return MinimalPropertyResource
	 */
	public function getTrendingProperties()
	{
		$trendingProperties = Property::where('verify_status', 'verified')->where('feature_status', 'featured')->orderBy('view_count', 'desc')->get()->take(8);
		return MinimalPropertyResource::collection($trendingProperties);
	}
}
