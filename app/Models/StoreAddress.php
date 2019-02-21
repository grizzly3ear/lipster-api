<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreAddress extends Model
{
    protected $table = 'StoreAddresses';

    public function getStoreByAddress(){
    return $this->belongsTo('App\Store');
  }



}
