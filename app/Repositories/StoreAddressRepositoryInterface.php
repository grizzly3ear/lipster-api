<?php

namespace App\Repositories;

interface StoreAddressRepositoryInterface
{
    public function findAll();
    public function findById($storeAddress_id);
    public function store($data);
    public function update($storeAddress_id, $data);
    public function deleteById($storeAddress_id);
}
