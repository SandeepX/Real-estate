<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyGallery extends Model
{
    //
    // Get the property that owns the images.
    public function property(){
        return $this->belongsTo('App\Property', 'property_id');
    }
}
