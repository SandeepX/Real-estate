<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamCategory extends Model
{

    //get members  for the category
    public function teamMembers(){
        return $this->hasMany('App\TeamMember','category_id');
    }
}
