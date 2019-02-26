<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'Stores';
    protected $primaryKey = 'id';

     public function StoreAddresses(){

      return $this->hasMany('App\StoreAddress');

    }
}
