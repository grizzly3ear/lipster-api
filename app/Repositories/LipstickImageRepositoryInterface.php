<?php

namespace App\Repositories;

interface LipstickImageRepositoryInterface
{
    public function findAll();
    public function findById($lipstickImage_id);
    public function store($data);
    public function update($lipstickImage_id, $data);
    public function deleteById($lipstickImage_id);
}
