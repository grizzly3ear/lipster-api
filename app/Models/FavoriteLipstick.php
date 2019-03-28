<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteLipstick extends Model
{
    protected $table = 'favorite_lipstick';
    protected $primaryKey = 'id';

    public function notifications(){

        return $this->morphMany(Notification::class, 'notification');
  
    }
}
