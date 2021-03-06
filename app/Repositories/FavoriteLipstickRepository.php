<?php

namespace App\Repositories;

use App\Models\FavoriteLipstick;

class FavoriteLipstickRepository implements FavoriteLipstickRepositoryInterface
{
    protected $favoriteLipstick;

    public function __construct(FavoriteLipstick $favoriteLipstick){
        $this->favoriteLipstick = $favoriteLipstick;
    }

    public function findAll() {
        return FavoriteLipstick::all();
    }

    public function findById($favoriteLipstick_id) {
        return FavoriteLipstick::findOrFail($favoriteLipstick_id);
    }

    public function store($user, $data) {

        return  $user->favoriteLipsticks()->sync($data['lipstick_color_id']);
    }

    public function getModel()
    {
        return $this->favoriteLipstick;
    }

    public function deleteById($lipstick_color_id, $user) {
        $favoriteLipstick = FavoriteLipstick::where([['lipstick_color_id', '=', $lipstick_color_id],['user_id', '=', $user->id]]);
        // dd($favoriteLipstick->lipstick_color_id);
        $result = $favoriteLipstick->delete();

          return "ลบแล้ว";
    }
}
