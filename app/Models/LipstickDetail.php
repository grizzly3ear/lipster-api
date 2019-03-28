<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LipstickDetail extends Model
{
    protected $table = 'lipstick_detail';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'price', 'type', 'opacity', 'description', 'composition', 'apply', 'lipstick_brand_id', 'create_at', 'update_at'];

    public function lipstickBrand(){

        return $this->belongsTo(LipstickBrand::class, 'lipstick_brand_id');
  
    }

    public function lipstickColors(){

        return $this->hasMany(LipstickColor::class, 'lipstick_detail_id');
  
    }
}
