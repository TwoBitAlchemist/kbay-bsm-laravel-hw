<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * M2M relation with Group
     */
    public function groups(){
        return $this->belongsToMany('App\Group', 'user_groups');
    }

    /**
     * 12M relation with Category
     */
    public function categories(){
        return $this->hasMany('App\Category');
    }
}
