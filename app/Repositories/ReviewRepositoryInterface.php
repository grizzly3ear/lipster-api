<?php

namespace App\Repositories;

interface ReviewRepositoryInterface
{
    public function findAll();
    public function findById($review_id);
    public function store($data, $lipstickColor_id, $user);
    public function update($review_id, $lipstickColor_id, $user, $data);
    public function deleteById($review_id);
}
