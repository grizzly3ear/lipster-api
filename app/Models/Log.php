<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';
    protected $primaryKey = 'id';
    protected $fillable = ['action', 'detail'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
