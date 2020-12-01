<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //get districts  for the province
    public function districts(){
        return $this->hasMany('App\District','province_id');
    }

    //get property Address  for the province
    public function propertyAddress(){
        return $this->hasMany('App\PropertyAddress','province_id');
    }
}
