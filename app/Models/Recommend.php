<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    protected $table = 'recommend';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lipstickColor()
    {
        return $this->belongsTo(LipstickColor::class, 'lipstick_color_id');
    }
}
