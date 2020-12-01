<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyDocumentResource extends JsonResource
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
            "id"          => $this->id,
            "property_id" => $this->property_id,
            "lal_purja"   => photoToUrl($this->lal_purja, '/common/images/'),
            "ghar_naksa"  => photoToUrl($this->ghar_naksa, '/common/images/'),
            "trace_naksa" => photoToUrl($this->trace_naksa, '/common/images/'),
            "blueprint"   => photoToUrl($this->blueprint, '/common/images/'),
            "charkilla"   => photoToUrl($this->charkilla, '/common/images/'),
            "tax_receipt" => photoToUrl($this->tax_receipt, '/common/images/')
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
