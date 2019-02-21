<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LipstickImg extends Model
{
    protected $table = 'LipstickImg';

    public function lipstickDetail(){
    return $this->belongsTo('App\LipstickDetail');
  }




}
