<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyInfoResource extends JsonResource
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
            "id"                => $this->id,
            "owner_name"        => $this->owner_name,
            "user_id"           => $this->user_id,
            "manager_id"        => $this->manager_id,
            "property_id"       => $this->property_id,
            "user_name"         => $this->user->name,
            "user_email"        => $this->user->email,
            "owner_address"     => $this->owner_address,
            "owner_contact"     => $this->owner_contact,
            "yt_url"            => $this->yt_url,
            "yt_title"          => $this->yt_title,
            "private_note"      => $this->private_note,
            "message"           => $this->message,
            "ref_owner_name_1"  => $this->ref_owner_name_1,
            "ref_owner_phone_1" => $this->ref_owner_phone_1,
            "ref_owner_name_2"  => $this->ref_owner_name_2,
            "ref_owner_phone_2" => $this->ref_owner_phone_2,
            "message"           => $this->message,
            $this->mergeWhen($this->isApprovedManager == 1, function () {
                return [
                    "manager"       => [
                        "name"           => $this->manager->name,
                        "email"          => $this->manager->email,
                        "contact_number" => $this->manager->phone,
                        "address"        => $this->manager->address,
                    ]
                ];
            }),
            "created_at"    => $this->created_at->format('Y-m-d H:i:s'),
            "updated_at"    => $this->updated_at->format('Y-m-d H:i:s'),
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
