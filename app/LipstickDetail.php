<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LipstickDetail extends Model
{
    protected $table = 'LipstickDetails';
    protected $primaryKey = 'id';

    public function getLipColourByLipDetail(){

      return $this->hasMany('App\LipstickColour');

    }

    public function getLipImgByLipDetail(){

      return $this->hasMany('App\LipstickImg');

    }

    public function getTrendByLipDetail(){

      return $this->hasMany('App\Trend');

    }

    public function getFavLipByStoreAndLipDetail(){

      return $this->belongsToMany('App\Store', 'StoreHasLipsticks  ');

    }


    public function getUserByLipDetail(){

      return $this->belongsToMany('App\User', 'FavoriteLipsticks');

    }

    public function getReviewByStoreAndLipDetail(){

      return $this->belongsToMany('App\User', 'Reviews ');

    }






}
