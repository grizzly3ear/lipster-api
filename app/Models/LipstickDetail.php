<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LipstickDetail extends Model
{
    protected $table = 'lipstick_detail';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'max_price', 'min_price', 'type', 'opacity', 'description', 'apply', 'lipstick_brand_id'];

    public function lipstickBrand(){

        return $this->belongsTo(LipstickBrand::class, 'lipstick_brand_id');

    }

    public function lipstickColors(){

        return $this->hasMany(LipstickColor::class, 'lipstick_detail_id');

    }
}
