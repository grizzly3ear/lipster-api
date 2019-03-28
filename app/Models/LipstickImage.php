<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LipstickImage extends Model
{
    protected $table = 'lipstick_image';
    protected $primaryKey = 'id';
    
    public function lipstickColor(){

        return $this->belongsTo(LipstickColor::class, 'lipstick_color_id');
  
      }
}
