<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManagerRequest extends Model
{
    //

    /**
     * Get the property that owns the managerRequest.
     */
    public function property()
    {
        return $this->belongsTo('App\Property','property_id')->withDefault();
    }

    /**
     * Get the user that owns the managerRequest.
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id')->withDefault();
    }

    /**
     * Get the manager that owns the managerRequest.
     */
    public function manager()
    {
        return $this->belongsTo('App\User','manager_id')->withDefault();
    }
}
