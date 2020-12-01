<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyMoreInformation extends Model
{
    //
    /**
     * Get the property that owns the information.
     */
    public function property()
    {
        return $this->belongsTo('App\Property', 'property_id')->withDefault();
    }

    /**
     * Get the user that owns the information.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id')->withDefault();
    }

    public function manager()
    {
        return $this->belongsTo('App\User', 'manager_id')->withDefault();
    }

}
