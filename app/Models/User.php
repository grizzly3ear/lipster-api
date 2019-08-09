<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'firstname', 'lastname', 'gender', 'skin_color', 'email', 'password', 'image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'user';
    protected $primaryKey = 'id';

    public function logs()
    {
        return $this->hasMany(Log::class, 'user_id');
    }

    public function recommends(){

        return $this->belongsToMany(LipstickColor::class, 'recommend', 'user_id', 'lipstick_color_id');

    }

    public function trends()
    {
        return $this->belongsToMany(Trend::class, 'favorite_trend', 'user_id', 'trend_id');
    }

    public function reviews(){

        return $this->belongsToMany(LipstickColor::class, 'review', 'user_id', 'lipstick_color_id');

    }

    public function favouriteLipsticks(){

        return $this->belongsToMany(LipstickColor::class, 'favourite_lipstick', 'user_id', 'lipstick_color_id');

    }
}
