<?php

namespace App\Repositories;

interface FavoriteTrendRepositoryInterface
{
    public function findAll();
    public function findById($favoriteTrend_id);
    public function store($user, $data);
    public function update($favoriteTrend_id, $data);
    public function deleteById($favoriteTrend_id);
}
