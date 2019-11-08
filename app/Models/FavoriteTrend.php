<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteTrend extends Model
{
    protected $table = 'favorite_trend';
    protected $primaryKey = 'id';
    protected $fillable = ['trend_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trends() {
        return $this->belongsTo(Trend::class, 'trend_id');
    }
}
