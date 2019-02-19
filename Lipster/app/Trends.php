<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trends extends Model
{
    protected $table = 'Trends';

    public function getLipDetailByTrends(){
    return $this->belongsTo('App\LipstickDetails');
  }

  public function getFavTrendByUserAndTrends(){

    return $this->belongsToMany('App\User', 'FavouriteTrend ');

  }



}
