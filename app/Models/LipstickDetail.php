<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LipstickDetail extends Model
{
    protected $table = 'lipstick_detail';
    protected $primaryKey = 'id';

    public function lipstickBrand(){

        return $this->belongsTo(LipstickBrand::class, 'lipstick_brand_id');
  
    }

    public function lipstickColors(){

        return $this->hasMany(LipstickColor::class, 'lipstick_detail_id');
  
    }
}
