<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyReview extends Model
{
    /**
     * Get the property status that owns the reviews.
     */
    public function property()
    {
        return $this->belongsTo('App\Property','property_id');
    }

    /**
     * Get the user that owns the review.
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
