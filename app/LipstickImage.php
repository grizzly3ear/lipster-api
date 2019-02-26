<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LipstickImage extends Model
{

  protected $table = 'LipstickImages';

  public function lipstickColour(){

    return $this->belongsTo('App\LipstickColours');

  }

}
