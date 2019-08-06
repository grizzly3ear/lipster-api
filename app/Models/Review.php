<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'id';
    protected $fillable = ['comment', 'skin_color', 'rating', 'lipstick_color_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
