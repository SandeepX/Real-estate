<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MinimalPropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id"                      => $this->id,
            "property_id"             => $this->property_id,
            "property_category_id"    => $this->property_category_id,
            "property_subcategory_id" => $this->property_subcategory_id,
            "property_status_id"      => $this->property_status_id,
            "title"                   => $this->title,
            "slug"                    => $this->slug,
            "property_images"         => PropertyImageResource::collection($this->images),
            "saleStatus"              => $this->saleStatus->title,
            "category"                => $this->category->name,
            "sub_category"            => $this->subCategory->name,
            "address"                 => new PropertyAddressResource($this->address),
            "price"                   => $this->price,
            "price_postfix"           => $this->price_postfix,
            "area_size"               => $this->area_size,
            "area_size_postfix"       => $this->area_size_postfix,
            "bedrooms"                => $this->bedrooms,
            "bathrooms"               => $this->bathrooms,
            "featured_image"          => photoToUrl($this->featured_image, '/common/images/'),
            "view_count"              => $this->view_count,
            $this->mergeWhen($request->bearerToken() != null, [
                "is_liked"               => $this->isLiked($request->bearerToken(), $this->id),
            ]),
            "verify_status"           => $this->verify_status,
            "feature_status"          => $this->feature_status,
            "created_at"              => $this->created_at->format('Y-m-d H:i:s'),
            "updated_at"              => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
