<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipal extends Model
{

    // Get the district that owns the municipal.
    public function district(){
        return $this->belongsTo('App\District', 'district_id');
    }

    //get property Address  for the municipal
    public function propertyAddress(){
        return $this->hasMany('App\PropertyAddress','municipality_id');
    }
}
