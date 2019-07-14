<?php

namespace App\Repositories;

interface StoreRepositoryInterface
{
    public function findAll();
    public function findById($store_id);
    public function store($data);
    public function update($store_id, $data);
    public function deleteById($store_id);
}
