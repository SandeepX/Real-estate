<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyFloorPlan extends Model
{
    // Get the property that owns the floor plans.
    public function property(){
        return $this->belongsTo('App\Property', 'property_id');
    }
}
