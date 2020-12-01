<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    //get blogs  for the category
    public function blogs(){
        return $this->hasMany('App\Blog','category_id');
    }
}
