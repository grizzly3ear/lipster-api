<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'title', 'body'];

    public function notification(){

        return $this->morphTo();

    }
}
