<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrendGroup extends Model
{
    protected $table = 'trend_group';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'image', 'description', 'release_date'];

    public function trends() {
        return $this->hasMany(Trend::class, 'trend_group_id');
    }

    public function notifications(){

        return $this->morphMany(Notification::class, 'notification');

    }
}
