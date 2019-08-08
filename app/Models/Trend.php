<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
    protected $table = 'trend';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'year', 'image', 'skin_color', 'description', 'lipstick_color'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorite_trend', 'trend_id', 'user_id');
    }

    public function notifications(){

        return $this->morphMany(Notification::class, 'notification');

    }

    public function trendGroup() {
        return $this->belongsTo(TrendGroup::class, 'trend_group_id');
    }
}
