<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavouriteProperty extends Model
{
    protected $table ='user_fav_properties';

    protected $fillable = [
        'user_id',
        'property_id'
    ];

    public function property(){
        return $this->belongsTo('App\Property', 'property_id');
    }
}
