<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * M2M relation with Bookmark
     */
    public function bookmarks(){
        return $this->belongsToMany('App\Bookmark', 'bookmark_categories');
    }
}
