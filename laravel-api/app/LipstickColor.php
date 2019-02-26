<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LipstickColor extends Model
{
    protected $table = 'LipstickColors';
    protected $primaryKey = 'id';

    public function lipstickDetail(){

      return $this->belongsTo('App\LipstickDetail');

    }

    public function trend(){

      return $this->hasMany('App\Trend');

    }

    public function user(){

      return $this->belongsToMany('App\User');

    }

    public function lipstickImage(){

      return $this->hasMany('App\LipstickImage');

    }

    public function storeAddress(){

      return $this->belongsToMany('App\StoreAddress');

    }
}
