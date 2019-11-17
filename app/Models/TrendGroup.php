<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TrendGroup extends Model
{
    protected $table = 'trend_group';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'image', 'description', 'release_date', 'release', 'force'];

    protected static function boot()
    {
        parent::boot();

        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

    public function trends() {
        return $this->hasMany(Trend::class, 'trend_group_id');
    }

    public function notifications(){

        return $this->morphMany(Notification::class, 'notification');

    }
}
