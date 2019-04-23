<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LipstickColor extends Model
{
    protected $table = 'lipstick_color';
    protected $primaryKey = 'id';
    protected $fillable = ['color_name', 'rgb', 'color_code', 'lipstick_detail_id'];

    public function lipstickDetail(){

        return $this->belongsTo(LipstickDetail::class, 'lipstick_detail_id');

    }

    public function trend(){

        return $this->hasMany(Trend::class, 'lipstick_color_id');

    }

    public function reviews(){

        return $this->belongsToMany(User::class, 'review', 'lipstick_color_id', 'user_id');

    }

    public function favouriteLipsticks(){

        return $this->belongsToMany(User::class, 'favourite_lipstick', 'lipstick_color_id', 'user_id');

    }

    public function lipstickImages(){

        return $this->hasMany(LipstickImage::class, 'lipstick_color_id');

    }

    public function recommends(){

        return $this->belongsToMany(User::class, 'recommend', 'lipstick_color_id', 'user_id');

    }

    public function storeAddresses(){

        return $this->belongsToMany(StoreAddress::class, 'store_has_lipstick', 'lipstick_color_id', 'store_address_id');

    }


}
