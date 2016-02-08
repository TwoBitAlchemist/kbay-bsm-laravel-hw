<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    /**
     * M2M relation with Category
     */
    public function categories(){
        return $this->belongsToMany('App\Category', 'bookmark_categories');
    }
}
