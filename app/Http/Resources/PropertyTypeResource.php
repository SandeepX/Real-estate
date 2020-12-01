<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\PropertySubCategory;

class PropertyTypeResource extends JsonResource
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
            "name"                    => $this->name,
            "slug"                    => $this->slug,
            "description"             => $this->description,
            $this->mergeWhen(!is_null($this->propertySubCategories), [
                "property_sub_categpries" => PropertySubCategoryResource::collection($this->propertySubCategories),
            ]),
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
