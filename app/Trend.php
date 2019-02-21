<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{

    protected $table = 'Trends';

    public function lipstickDetail(){

      return $this->belongsTo('App\LipstickDetail');

    }

    public function users(){

      return $this->belongsToMany('App\User');

    }



}
