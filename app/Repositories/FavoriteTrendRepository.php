<?php

namespace App\Repositories;

use App\Models\FavoriteTrend;

class FavoriteTrendRepository implements FavoriteTrendRepositoryInterface
{
    protected $favoriteTrend;

    public function __construct(FavoriteTrend $favoriteTrend){
        $this->favoriteTrend = $favoriteTrend;
    }

    public function findAll() {
        return FavoriteTrend::all();
    }

    public function findById($favoriteTrend_id) {
        return FavoriteTrend::findOrFail($favoriteTrend_id);
    }

    public function store($user, $data) {
        return  $user->favoriteTrends()->sync($data['trend_id']);
    }

    public function update($favoriteTrend_id, $data) {

    }

    public function deleteById($favoriteTrend_id) {
        $favoriteTrend = FavoriteTrend::findOrFail($favoriteTrend_id);

        $favoriteTrend->delete();

        return $favoriteTrend->id;
    }

    public function getModel()
    {
        return $this->favoriteTrend;
    }
}
