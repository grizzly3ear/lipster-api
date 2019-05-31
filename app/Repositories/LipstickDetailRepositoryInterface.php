<?php

namespace App\Repositories;

interface LipstickDetailRepositoryInterface
{
    public function findAll();
    public function findById($lipstickDetail_id);
    public function store($data);
    public function update($lipstickDetail_id, $data);
    public function deleteById($lipstickDetail_id);

    public function findDistinctColumnValue($column);
}
