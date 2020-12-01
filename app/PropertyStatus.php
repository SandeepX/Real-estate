<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyStatus extends Model
{
    //
    /**
     * Get the properties for the status.
     */
    public function properties()
    {
        return $this->hasMany('App\Property','property_status_id');
    }
}
