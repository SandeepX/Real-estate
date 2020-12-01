<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		//return parent::toArray($request);
		return [
			"id" => $this->id,
			"property_id" => $this->property_id,
			"property_category_id" => $this->property_category_id,
			"property_subcategory_id" => $this->property_subcategory_id,
			"property_status_id" => $this->property_status_id,
			"title" => $this->title,
			"slug" => $this->slug,
			"description" => $this->description,
			"property_images" => PropertyImageResource::collection($this->images),
			"saleStatus" => $this->saleStatus->title,
			"category" => $this->category->name,
			"sub_category" => $this->subCategory->name,
			"address" => new PropertyAddressResource($this->address),
			"price" => $this->price,
			"price_postfix" => $this->price_postfix,
			"area_size" => $this->area_size,
			"area_size_postfix" => $this->area_size_postfix,
			"lot_size" => $this->lot_size,
			"lot_size_postfix" => $this->lot_size_postfix,
			"front_face" => $this->front_face,
			"back_face" => $this->back_face,
			"bedrooms" => $this->bedrooms,
			"bathrooms" => $this->bathrooms,
			"garages" => $this->garages,
			"year_built" => $this->year_built,
			"featured_image" => photoToUrl($this->featured_image, '/common/images/'),
			"propertyFeatures" => PropertyFeatureResource::collection($this->propertyFeatures),
			"additionalFeatures" => json_decode($this->additional_features),
			"floors" => PropertyFloorResource::collection($this->floors),
			"information" => new PropertyInfoResource($this->information),
			"view_count" => $this->view_count,
			$this->mergeWhen($request->bearerToken() != null, [
				"is_liked" => $this->isLiked($request->bearerToken(), $this->id),
			]),
			"verify_status" => $this->verify_status,
			"feature_status" => $this->feature_status,
			"created_at" => $this->created_at->format('Y-m-d H:i:s'),
			"updated_at" => $this->updated_at->format('Y-m-d H:i:s'),
		];
	}

	/**
	 * Get additional data that should be returned with the resource array.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function with($request) {
		return [
			'error' => false,
			'code' => 200,
		];
	}
}
