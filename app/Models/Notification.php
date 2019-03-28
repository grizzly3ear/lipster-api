<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'notification_type', 'notification_id', 'user_id', 'created_at', 'updated_at'];

    public function notification(){

        return $this->morphTo();

    }
}
