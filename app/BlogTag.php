<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{

    //get the blogs of the tag
    public function blogs()
    {
        return $this->belongsToMany('App\BlogTag','blogs-tags',
            'tag_id`', 'blog_id')->withTimestamps();
    }

}
