<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LipstickDetail extends Model
{
    protected $table = 'LipstickDetails';
    protected $primaryKey = 'id';

    public function lipstickBrand(){

      return $this->belongsTo('App\LipstickBrand');

    }

    public function lipstickColours(){

      return $this->hasMany('App\LipstickColour');

    }

    public function trends(){

      return $this->hasMany('App\Trend');

    }

    public function users(){

      return $this->belongsToMany('App\User');

    }








}
