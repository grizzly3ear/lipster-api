<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'title', 'body', 'user_id', 'release'];

    protected static function boot()
    {
        parent::boot();
     
        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }


    public function notification(){

        return $this->morphTo();

    }
}
