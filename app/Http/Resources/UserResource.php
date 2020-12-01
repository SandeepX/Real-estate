<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "id"                => $this->id,
            "fb_id"             => $this->fb_id,
            "google_id"         => $this->google_id,
            "provider_id"       => $this->provider_id,
            "provider"          => $this->provider,
            "role"              => $this->hasRole('Manager') ? "manager" : "user",
            "title"             => $this->title,
            "name"              => $this->name,
            "email"             => $this->email,
            "email_verified_at" => $this->email_verified_at != null ? $this->email_verified_at->format('Y-m-d H:i:s') : $this->email_verified_at,
            "personal_info"     => $this->personal_info,
            "province_id"       => $this->province_id,
            "district_id"       => $this->district_id,
            "municipality_id"   => $this->municipality_id,
            "address"           => $this->address,
            "phone"             => $this->phone,
            "alt_phone"         => $this->alt_phone,
            "mobile"            => $this->mobile,
            "user_image"        => photoToUrl($this->user_image, '/common/images/'),
            "manager_status"    => $this->manaer_status,
            "facebook"          => $this->facebook,
            "instagram"         => $this->instagram,
            "twitter"           => $this->twitter,
            "linkedin"          => $this->linkedin,
            "status"            => $this->status,
            "api_token"         => $this->api_token,
            "device_token"      => $this->device_token,
            "token"             => $this->token,
            "created_at"        => $this->created_at->format('Y-m-d H:i:s'),
            "updated_at"        => $this->updated_at->format('Y-m-d H:i:s'),
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
