<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyFloorResource extends JsonResource
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
            "floor_title"             => $this->floor_title,
            "property_id"             => $this->property_id,
            "floor_description"       => $this->floor_description,
            "floor_price"             => $this->floor_price,
            "floor_price_postfix"     => $this->floor_price_postfix,
            "floor_area_size"         => $this->floor_area_size,
            "floor_area_size_postfix" => $this->floor_area_size_postfix,
            "floor_bedrooms"          => $this->floor_bedrooms,
            "floor_bathrooms"         => $this->floor_bathrooms,
            "floor_image"             => photoToUrl($this->floor_image, '/common/images/'),
            "created_at"              => $this->created_at->format('Y-m-d H:i:s'),
            "updated_at"              => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        return [
            'error' => false,
            'code' => 200
        ];
    }

}
