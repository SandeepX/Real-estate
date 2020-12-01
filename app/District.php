<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    // Get the province that owns the district.
    public function province(){
        return $this->belongsTo('App\Province', 'province_id');
    }

    //get municipals  for the District
    public function municipals(){
        return $this->hasMany('App\Municipal','district_id');
    }

    //get property Address  for the district
    public function propertyAddress(){
        return $this->hasMany('App\PropertyAddress','district_id');
    }
}
