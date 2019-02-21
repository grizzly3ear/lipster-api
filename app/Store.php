<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'Stores';
    protected $primaryKey = 'id';

    public function getAddressByStorel(){

      return $this->hasMany('App\StoreAddress');

    }

    public function LipstickDetail(){

      return $this->belongsToMany('App\LipstickDetail');

    }



}
