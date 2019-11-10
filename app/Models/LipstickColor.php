<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LipstickColor extends Model
{
    protected $table = 'lipstick_color';
    protected $primaryKey = 'id';
    protected $fillable = ['color_name', 'rgb', 'color_code', 'lipstick_detail_id',  'composition', 'force'];

    public function lipstickDetail() {
        return $this->belongsTo(LipstickDetail::class, 'lipstick_detail_id');
    }

    public function reviews() {
        return $this->belongsToMany(User::class, 'review', 'lipstick_color_id', 'user_id')
                    ->withPivot('comment', 'skin_color', 'rating', 'created_at');
    }

    public function favoriteLipsticks(){
        return $this->belongsToMany(User::class, 'favorite_lipstick', 'lipstick_color_id', 'user_id');
    }

    public function storeHasLipsticks(){
        return $this->belongsToMany(StoreAddress::class, 'store_has_lipstick', 'lipstick_color_id', 'store_address_id')
                    ->withPivot('price');
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

    public function logs(){
        return $this->morphMany(Log::class, 'log');
    }
}
