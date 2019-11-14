<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
    protected $table = 'trend';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'image', 'skin_color', 'description', 'lipstick_color', 'trend_group_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorite_trend', 'trend_id', 'user_id');
    }

    public function trendGroup() {
        return $this->belongsTo(TrendGroup::class, 'trend_group_id');
    }

    public function logs(){
        return $this->morphMany(Log::class, 'log');
    }

    public function trendGroup(){

        return $this->belongsTo(trendGroup::class, 'trend_group_id');

    }

}
