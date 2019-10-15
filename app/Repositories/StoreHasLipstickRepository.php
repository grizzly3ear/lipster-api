<?php

namespace App\Repositories;

use App\Models\StoreHasLipstick;

class StoreHasLipstickRepository implements StoreHasLipstickRepositoryInterface
{
    protected $storeHasLipstick;

    public function __construct(StoreHasLipstick $storeHasLipstick){
        $this->storeHasLipstick = $storeHasLipstick;
    }

    public function findAll() {
        return StoreHasLipstick::all();
    }

    public function findById($storeHasLipstick_id) {
        return StoreHasLipstick::findOrFail($storeHasLipstick_id);
    }

    public function store($data) {
        return $this->storeHasLipstick->create($data);
    }

    public function update($storeHasLipstick_id, $data) {
        $storeHasLipstick = StoreHasLipstick::findOrFail($storeHasLipstick_id);
        $storeHasLipstick->store_address_id = $data['store_address_id'];
        $storeHasLipstick->lipstick_color_id = $data['lipstick_color_id'];
        $storeHasLipstick->price = $data['price'];
        $storeHasLipstick->save();

        return $storeHasLipstick;
    }

    public function deleteById($storeHasLipstick_id) {
        $storeHasLipstick = StoreHasLipstick::findOrFail($storeHasLipstick_id);

        $storeHasLipstick->delete();

        return $storeHasLipstick->id;
    }

    public function getModel()
    {
        return $this->storeHasLipstick;
    }
}
