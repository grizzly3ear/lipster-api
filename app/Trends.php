<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trends extends Model
{
    protected $table = 'Trends';

    public function lipstickDetail(){
    return $this->belongsTo('App\LipstickDetails');
  }

  public function users(){

    return $this->belongsToMany('App\User');

  }



}
