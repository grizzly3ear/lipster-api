<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LipstickColour extends Model
{
  
    protected $table = 'LipstickColours';

    public function lipstickDetail(){

      return $this->belongsTo('App\LipstickDetail');

  }




}
