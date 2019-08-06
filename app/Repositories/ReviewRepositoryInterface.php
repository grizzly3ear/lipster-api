<?php

namespace App\Repositories;

interface ReviewRepositoryInterface
{
    public function findAll();
    public function findById($review_id);
    public function store($data, $user);
    public function update($review_id, $data);
    public function deleteById($review_id);
}
