<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

  protected $table = 'Logs';

  public function user(){

    return $this->belongsTo('App\User');

  }

}
