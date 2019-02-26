<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LipstickImage extends Model
{
    protected $table = 'LipstickImages';
    protected $primaryKey = 'id';

    public function lipstickColor(){

      return $this->belongsTo('App\LipstickColor');

    }
}
