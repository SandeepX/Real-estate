<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    /**
     * Get the category that owns the property.
     */
    public function category()
    {
        return $this->belongsTo('App\PropertyCategory','property_category_id');
    }


    /**
     * Get the subcategory that owns the property.
     */
    public function subCategory()
    {
        return $this->belongsTo('App\PropertySubCategory','property_subcategory_id');
    }

    /**
     * Get the sale type status that owns the property.
     */
    public function saleStatus()
    {
        return $this->belongsTo('App\PropertyStatus','property_status_id');
    }

    public function propertyFeatures()
    {
        return $this->belongsToMany('App\PropertyFeature','property_propertyfeature',
            'property_id', 'feature_id')->withTimestamps();
    }


    //get images  for the property
    public function images(){
        return $this->hasMany('App\PropertyGallery','property_id');
    }

    //get address  for the property
    public function address(){
        return $this->hasOne('App\PropertyAddress', 'property_id');
    }

    //get floor plans  for the property
    public function floors(){
        return $this->hasMany('App\PropertyFloorPlan', 'property_id');
    }

    //get information  for the property
    public function information(){
        return $this->hasOne('App\PropertyMoreInformation', 'property_id')->withDefault();
    }

    //get document  for the property
    public function document(){
        return $this->hasOne('App\PropertyDocument', 'property_id');
    }


    //get reviews  for the property
    public function reviews(){
        return $this->hasMany('App\PropertyReview','property_id');
    }

    //get manager requests  for the property
    public function managerRequests(){
        return $this->hasMany('App\ManagerRequest','property_id');
    }

    //get users of fav properties
    public function favPropertyUsers()
    {
        return $this->belongsToMany('App\User','user_fav_properties',
            'property_id', 'user_id')->withTimestamps();
    }

    //verified properties
    public function scopeVerified($query)
    {
        return $query->where('verify_status', 'verified');
        //return $query->where('verify_status', 'verified')->where('status',1);
    }

    //verified properties
    public function scopeFeatured($query)
    {
        return $query->where('feature_status', 'featured');
    }


    public function generatePropertyId(){
        $limit = 20;
        return 'omlot-'.substr(base_convert(sha1(time() . date('Y-m-d') . uniqid(mt_rand())), 16, 36), 0, $limit);

    }

    /*function unique_code($extra = null)
    {
        $limit = 20;
        return substr(base_convert(sha1($extra . time() . date('Y-m-d') . uniqid(mt_rand())), 16, 36), 0, $limit);
    }*/

    public function getPropertyImages()
    {
        $images = $this->images->pluck('image')->map(function ($item, $key) {
            return photoToUrl($item, '/common/images/');
        });
        return $images;
    }

    public function isLiked($bearerToken, $property_id)
    {
        $user = User::where('api_token', $bearerToken)->first();

        $liked = FavouriteProperty::where('property_id', $property_id)->where('user_id', $user->id);

        if ($liked->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
