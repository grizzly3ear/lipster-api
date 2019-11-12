<?php

namespace App\Repositories;

interface TrendRepositoryInterface
{
    public function findAll();
    public function findById($trend_id);
    public function store($data);
    public function update($trend_id, $data);
    public function deleteById($trend_id);

    public function findSimilarColor($hex);
    public function ranking();
}
