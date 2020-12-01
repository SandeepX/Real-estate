<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyAddressResource extends JsonResource
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
            "id"              => $this->id,
            "province_id"     => $this->province_id,
            "district_id"    => $this->district_id,
            "municipality_id" => $this->municipality_id,
            "address"         => $this->address,
            "latitude"        => $this->latitude,
            "longitude"       => $this->longitude,
        ];
    }
}
