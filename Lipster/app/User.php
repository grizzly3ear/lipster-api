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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'Users';


    public function getLogByUSer(){

      return $this->hasMany('App\UserLog');

    }


    public function getFavLipByStoreAndLipDetail(){

      return $this->belongsToMany('App\LipstickDetail', 'FavouriteLipsticks ');

    }

    public function getFavTrendByUserAndTrends(){
 
      return $this->belongsToMany('App\Trend', 'FavouriteTrends ');

    }

    public function getReviewByStoreAndLipDetail(){

      return $this->belongsToMany('App\LipstickDetail', 'Reviews ');

    }
}
