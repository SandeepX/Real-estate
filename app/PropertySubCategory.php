<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertySubCategory extends Model
{
    //
    public function propertyCategories()
    {
        return $this->belongsToMany('App\PropertyCategory','category_subcategory','subcategory_id', 'category_id')->withTimestamps();
    }

    /**
     * Get the properties for the subcategory.
     */
    public function properties()
    {
        return $this->hasMany('App\Property','property_subcategory_id');
    }
}
