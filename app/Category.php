<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * M2M relation with User
     */
    public function users(){
        return $this->belongsToMany('App\User', 'user_categories');
    }
}
