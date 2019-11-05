<?php

namespace App\Repositories;

interface TrendGroupRepositoryInterface
{
    public function findAll();
    public function findById($trend_group_id);
    public function store($data);
    public function update($trend_group_id, $data);
    public function deleteById($request, $trend_group_id);
}
