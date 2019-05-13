<?php

namespace App\Repositories;

interface UserRepositoryInterface {
    public function findAll();
    public function findById($user_id);
    public function store();
    public function update();
    public function deleteById($user_id);

    public function addLipstickToFavorite($user_id, $lipstick_id);
    public function syncLipstickToFavorite($user_id, $lipstick_ids);
    public function removeLipstickFromFavorite($user_id, $lipstick_id);

    public function addTrendToFavorite($user_id, $trend_id);
    public function sycnTrendToFavorite($user_id, $trend_ids);
    public function removeTrendFromFavorite($user_id, $trend_id);

    public function sendLocation($latitude, $longtitude);
}
