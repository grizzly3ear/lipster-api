<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreAddress extends Model
{
    protected $table = 'store_address';
    protected $primaryKey = 'id';
    protected $fillable = ['latitude', 'longitude', 'address_detail', 'store_id', 'period', 'tel'];

    public function store(){

        return $this->belongsTo(Store::class, 'store_id');

      }

      public function lipstickColors(){

        return $this->belongsToMany(LipstickColor::class, 'store_has_lipstick', 'store_address_id', 'lipstick_color_id');

      }

      public function storeHasLipsticks(){

        return $this->belongsToMany(LipstickColor::class, 'store_has_lipstick', 'store_address_id', 'lipstick_color_id')
                    ->withPivot('price');

    }
}
