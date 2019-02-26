<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreAddress extends Model
{
    protected $table = 'StoreAddresses';
    protected $primaryKey = 'id';

    public function store(){

      return $this->belongsTo('App\Store');

    }

    public function lipstickColor(){

      return $this->belongsToMany('App\LipstickColor');

    }
}
