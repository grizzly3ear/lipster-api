<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LipstickColour extends Model
{

    protected $table = 'LipstickColours';

    public function lipstickDetail(){

      return $this->belongsTo('App\LipstickDetail');

    }

    public function storeAddresses(){

      return $this->belongsToMany('App\StoreAddresses');

    }

    public function lipstickImages(){

      return $this->hasMany('App\LipstickImage');

    }




}
