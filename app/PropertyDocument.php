<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyDocument extends Model
{
    /**
     * Get the property that owns the information.
     */
    public function property()
    {
        return $this->belongsTo('App\Property', 'property_id');
    }
}
