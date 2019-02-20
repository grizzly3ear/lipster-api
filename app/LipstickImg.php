<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LipstickImg extends Model
{
    protected $table = 'LipstickImg';

    public function lipstickDetail(){
    return $this->belongsTo('App\LipstickDetail');
  }




}
