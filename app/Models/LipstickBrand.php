<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LipstickBrand extends Model
{
    protected $table = 'lipstick_brand';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'image', 'force'];

    public function lipstickDetails() {
        return $this->hasMany(LipstickDetail::class, 'lipstick_brand_id');
      }
}
