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

    public function lipstickColor(){

      return $this->hasMany('App\LipstickColor');

    }
}
