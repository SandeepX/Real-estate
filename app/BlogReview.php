<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogReview extends Model
{
    //

    /**
     * Get the blog that owns the reviews.
     */
    public function blog()
    {
        return $this->belongsTo('App\Blog','blog_id');
    }

    /**
     * Get the user that owns the review.
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
