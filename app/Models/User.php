<?php

namespace App\Models;

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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'Users';


    public function userLogs(){

      return $this->hasMany('App\UserLog');

    }


    public function lipstickDetails(){

      return $this->belongsToMany('App\LipstickDetail');

    }

    public function trends(){

      return $this->belongsToMany('App\Trend');

    }

  
}
