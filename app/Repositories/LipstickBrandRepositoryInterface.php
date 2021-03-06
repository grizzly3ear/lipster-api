<?php

namespace App\Repositories;

interface LipstickBrandRepositoryInterface
{
    public function findAll();
    public function findById($lipstickBrand_id);
    public function store(array $data);
    public function update($lipstickBrand_id, $data);
    public function deleteById($request, $lipstickBrand_id);

    public function destroy($lipstickBrand_ids);
}
