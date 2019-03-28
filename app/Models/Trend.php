<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
    protected $table = 'trend';
    protected $primaryKey = 'id';

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorite_trend', 'trend_id', 'user_id');
    }

    public function lipstickColors(){

        return $this->belongsTo(LipstickColor::class, 'lipstick_color_id');
  
    }

    public function notifications(){

        return $this->morphMany(Notification::class, 'notification');
  
    }
}
