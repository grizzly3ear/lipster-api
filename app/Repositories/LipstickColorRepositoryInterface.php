<?php

namespace App\Repositories;

interface LipstickColorRepositoryInterface
{
    public function findAll();
    public function findById($lipstickColor_id);
    public function store($data);
    public function update($lipstickColor_id, $data);
    public function deleteById($request, $lipstickColor_id);

    public function findSimilarColor($hex, $expectedResult = 10);
    public function getUserReviews($lipstickColor_id);
    public function getStoreAddresses($lipstickColor_id);
}
