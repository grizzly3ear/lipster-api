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
    protected $primaryKey = 'id';

    public function trend(){

      return $this->belongsToMany('App\Trend');

    }

    public function lipstickColor(){

      return $this->belongsToMany('App\LipstickColor');

    }

    public function log(){

      return $this->hasMany('App\Log');

    }

}
