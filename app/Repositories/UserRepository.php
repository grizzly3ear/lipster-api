<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function findAll() {
        return User::all();
    }

    public function findById($user_id) {
        return User::findOrFail($user_id);
    }

    public function store($data) {
        // some create logic
    }

    public function update($user_id, $data) {

    }

    public function deleteById($user_id) {
        $user = User::findOrFail($user_id);

        $user->delete();

        return $user->id;
    }

    public function addLipstickToFavorite($user_id, $lipstick_id) {

    }

    public function syncLipstickToFavorite($user_id, $lipstick_ids) {

    }

    public function removeLipstickFromFavorite($user_id, $lipstick_id) {

    }

    public function addTrendToFavorite($user_id, $trend_id) {

    }

    public function syncTrendToFavorite($user_id, $trend_ids) {

    }

    public function removeTrendFromFavorite($user_id, $trend_id) {

    }

    public function sendLocation($latitude, $longtitude) {

    }
}
