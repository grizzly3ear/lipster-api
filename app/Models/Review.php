<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'id';
    protected $fillable = ['comment', 'rating'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lipstickColor() {
        return $this->belongsTo(LipstickColor::class, 'lipstick_color_id');
    }
}
