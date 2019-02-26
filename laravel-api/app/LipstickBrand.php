<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LipstickBrand extends Model
{
  protected $table = 'LipstickBrands';
  protected $primaryKey = 'id';

  public function lipstickDetail(){

    return $this->hasMany('App\LipstickDetail');

  }
}
