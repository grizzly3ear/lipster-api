<?php

namespace App\Repositories;

interface FavoriteLipstickRepositoryInterface
{
    public function findAll();
    public function findById($favoriteLipstick_id);
    public function store($user, $data);
    public function deleteById($lipstick_color_id, $user);
}
