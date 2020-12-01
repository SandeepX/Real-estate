<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // Get the category that owns the blog.
    public function category(){
        return $this->belongsTo('App\BlogCategory', 'category_id');
    }


    //get the tags of the blog
    public function tags()
    {
        return $this->belongsToMany('App\BlogTag','blogs-tags',
            'blog_id', 'tag_id')->withTimestamps();
    }

    //get reviews  for the blog
    public function reviews(){
        return $this->hasMany('App\BlogReview','blog_id');
    }
}
