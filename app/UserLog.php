<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = 'UserLogs';

    public function user(){
      return $this->belongsTo('App\USer ');
  }







}
