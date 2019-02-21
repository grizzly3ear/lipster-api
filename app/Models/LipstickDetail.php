<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LipstickDetail extends Model
{
    protected $table = 'LipstickDetails';
    protected $primaryKey = 'id';


    public function lipstickColours(){

      return $this->hasMany('App\LipstickColour');

    }

    public function LipstickImages(){

      return $this->hasMany('App\LipstickImage');

    }

    public function trends(){

      return $this->hasMany('App\Trend');

    }

    public function stores(){

      return $this->belongsToMany('App\Store');

    }

    public function users(){

      return $this->belongsToMany('App\User');

    }


}
