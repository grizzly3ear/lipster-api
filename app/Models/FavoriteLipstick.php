<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteLipstick extends Model
{
    protected $table = 'favorite_lipstick';
    protected $primaryKey = 'id';
    protected $fillable = ['lipstick_color_id'];

    public function notifications(){
        return $this->morphMany(Notification::class, 'notification');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lipstickColors() {
        return $this->belongsTo(LipstickColor::class, 'lipstick_color_id');
    }
}
