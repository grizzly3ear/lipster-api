<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreAddress extends Model
{

    protected $table = 'StoreAddresses';

    public function store(){

      return $this->belongsTo('App\Store');

  }

  public function lipstickColours(){

    return $this->belongsToMany('App\LipstickColour');

  }



}
