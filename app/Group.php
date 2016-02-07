<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * M2M relation with User
     */
    public function roles(){
        return $this->belongsToMany('App\User', 'user_groups');
    }
}
