<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreHasLipstick extends Model
{
    protected $table = 'store_has_lipstick';
    protected $primaryKey = 'id';
    protected $fillable = ['lipstick_color_id', 'store_address_id', 'price'];

    public function lipstickColor() {
        return $this->belongsTo(LipstickColor::class, 'lipstick_color_id');
    }

    public function storeAddress() {
        return $this->belongsTo(StoreAddress::class, 'store_address_id');
    }
}
