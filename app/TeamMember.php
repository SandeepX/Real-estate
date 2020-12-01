<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{

    // Get the category that owns the member.
    public function category(){
        return $this->belongsTo('App\TeamCategory', 'category_id');
    }

    // Get the designation that owns the member.
    public function designation(){
        return $this->belongsTo('App\TeamDesignation', 'designation_id');
    }


}
