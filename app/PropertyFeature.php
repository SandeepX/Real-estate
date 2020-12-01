<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyFeature extends Model
{
    //
    public function properties()
    {
        return $this->belongsToMany('App\Property','property_propertyfeature',
            'feature_id', 'property_id')->withTimestamps();
    }
}
