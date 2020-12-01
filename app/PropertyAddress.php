<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyAddress extends Model
{
    /**
     * Get the property that owns the address.
     */
    public function property()
    {
        return $this->belongsTo('App\Property', 'property_id');
    }

    // Get the province that owns the property address.
    public function province(){
        return $this->belongsTo('App\Province', 'province_id');
    }

    // Get the district that owns the property address.
    public function district(){
        return $this->belongsTo('App\District', 'district_id');
    }

    // Get the municipal that owns the property address.
    public function municipal(){
        return $this->belongsTo('App\Municipal', 'municipality_id');
    }
}
