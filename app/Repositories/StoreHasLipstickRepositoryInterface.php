<?php

namespace App\Repositories;

interface StoreHasLipstickRepositoryInterface
{
    public function findAll();
    public function findById($storeHasLipstick_id);
    public function store($data);
    public function update($storeHasLipstick_id, $data);
    public function deleteById($storeHasLipstick_id);
}
