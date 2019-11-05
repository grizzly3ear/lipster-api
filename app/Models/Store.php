<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'store';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'image' , 'force'];

    public function storeAddresses(){

        return $this->hasMany(StoreAddress::class, 'store_id');

      }
}
