<?php

namespace App\Repositories;

interface LogRepositoryInterface
{
    public function findAll();
    public function findById($log_id);
    public function store($user, $data, $lipstickColor);
    public function deleteById($log_id);
}
