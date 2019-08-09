<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function findAll();
    public function findById($user_id);
    public function store($data);
    public function update($user_id, $data);
    public function deleteById($user_id);
}
