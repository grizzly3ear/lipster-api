<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LipstickDetail extends Model
{
    protected $table = 'lipstick_detail';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'type', 'opacity', 'description', 'apply', 'lipstick_brand_id', 'force'];

    public function lipstickBrand(){

        return $this->belongsTo(LipstickBrand::class, 'lipstick_brand_id');

    }

    public function lipstickColors(){

        return $this->hasMany(LipstickColor::class, 'lipstick_detail_id');

    }
}
