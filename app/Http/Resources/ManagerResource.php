<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"             => $this->id,
            "title"          => $this->title,
            "property_id"    => $this->property_id,
            "slug"           => $this->slug,
            "description"    => $this->description,
            "price"          => $this->price,
            "price_postfix"  => $this->price_postfix,
            "address"        => $this->address->address,
            "featured_image" => photoToUrl($this->featured_image, '/common/images/'),
            "status"         => $this->information->isApprovedManager == 0 ? "Pending" : "Active",
            "manager_id"     => $this->information->manager_id,
            "manager_name"   => User::find($this->information->manager_id)->name,
            "manager_email"  => User::find($this->information->manager_id)->email,
        ];
    }
}
