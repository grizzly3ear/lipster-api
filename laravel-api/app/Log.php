<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'Logs';
    protected $primaryKey = 'id';

    public function user(){

      return $this->belongsTo('App\User');

    }
}
