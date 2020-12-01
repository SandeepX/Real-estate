<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamDesignation extends Model
{
    //get members  for the designations
    public function teamMembers(){
        return $this->hasMany('App\TeamMember','designation_id');
    }
}
