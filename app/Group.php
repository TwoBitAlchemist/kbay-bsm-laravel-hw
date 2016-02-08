<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * M2M relation with User
     */
    public function users(){
        return $this->belongsToMany('App\User', 'user_groups');
    }

    /**
     * Use misnamed table
     */
    protected $table = 'group';
}
