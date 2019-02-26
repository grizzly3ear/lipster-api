<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
    protected $table = 'Trends';
    protected $primaryKey = 'id';

    public function lipstickColor(){

      return $this->belongsTo('App\LipstickColor');

    }

    public function user(){

      return $this->belongsToMany('App\User');

    }
}
