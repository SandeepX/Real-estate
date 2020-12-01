<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyReviewResource extends JsonResource
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
            "id"            => $this->id,
            "property_id"   => $this->property_id,
            "user_id"       => $this->user_id,
            "client_rating" => $this->client_rating,
            "client_message" => $this->client_message,
            "client_name"   => User::find($this->user_id)->name,
            "client_email"  => User::find($this->user_id)->email,
            "client_image"  => photoToUrl(User::find($this->user_id)->user_image, '/common/images/'),
            "created_at"    => $this->created_at->format('Y-m-d H: i: s'),
            "updated_at"    => $this->updated_at->format('Y-m-d H: i: s'),
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
