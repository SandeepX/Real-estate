<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyCategory extends Model
{
    //
    public function propertySubCategories()
    {
        return $this->belongsToMany('App\PropertySubCategory','category_subcategory','category_id', 'subcategory_id')->withTimestamps();
    }

    /**
     * Get the properties for the category.
     */
    public function properties()
    {
        return $this->hasMany('App\Property','property_category_id');
    }
}
